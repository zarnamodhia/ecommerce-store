<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function options()
    {
        $user = auth()->user();

        $cart = CartItem::with('product')->where('user_id', $user->id)->get();
        $shipping = session()->get('shipping');

        if (!$shipping || $cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Missing shipping or cart data.');
        }

        $total = $cart->sum(fn($item) => $item->product->price * $item->quantity);

        return view('payment.options', compact('cart', 'shipping', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'method' => 'required|in:cod,upi',
        ]);

        $method = $request->input('method');

        if ($method === 'cod') {
            return $this->createOrder('COD');
        } elseif ($method === 'upi') {
            return redirect()->route('payment.upi');
        }

        return back()->with('error', 'Invalid payment method selected.');
    }

    public function upi()
    {
        return view('payment.upi');
    }

    public function confirmUpi(Request $request)
    {
        $request->validate([
            'upi_id' => 'required|string', // You can refine validation for real UPI formats
        ]);

        return $this->createOrder('UPI');
    }

    protected function createOrder(string $method)
    {
        $user = auth()->user();
        $shipping = session()->get('shipping');

        if (!$shipping) {
            return redirect()->route('cart.index')->with('error', 'Shipping info missing.');
        }

        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'shipping_address' => $shipping['address'],
                'payment_method' => $method,
                'status' => 'Pending',
                'total_amount' => $total,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Clear cart and session shipping data
            CartItem::where('user_id', $user->id)->delete();
            session()->forget('shipping');

            DB::commit();

            return redirect()->route('orders.customer')->with('success', 'Order placed successfully with ' . $method . '.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process your order. Please try again.');
        }
    }
}
