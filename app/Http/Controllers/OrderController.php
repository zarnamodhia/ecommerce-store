<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Shipping;



class OrderController extends Controller
{
    public function placeCOD()
{
    $user = auth()->user();
    $cart = session('cart', []);
    $shippingId = session('shipping_id');

    $shipping = Shipping::find($shippingId);

    if (!$shipping || empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Missing shipping or cart info.');
    }

    $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

    Order::create([
        'user_id' => $user->id,
        'shipping_address' => $shipping->address,
        'payment_method' => 'COD',
        'status' => 'Pending',
        'total_amount' => $total,
    ]);

    session()->forget('cart');
    session()->forget('shipping_id');

    return redirect()->route('orders.customer')->with('success', 'Order placed with Cash on Delivery!');
}


    public function customerOrders()
    {
        $orders = Order::with('orderItems.product')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('orders.customer', compact('orders'));
    }

    public function adminOrders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Shipped,Delivered',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated.');
    }
}
?>
