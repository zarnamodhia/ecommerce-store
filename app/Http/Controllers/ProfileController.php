<?php

namespace App\Http\Controllers;
use App\Models\Shipping;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  
    public function index()
    {
    $user = Auth::user();
    $addresses = Shipping::where('user_id', $user->id)->latest()->get();
    $orders = Order::where('user_id', $user->id)->latest()->get();

    return view('profile', compact('user', 'addresses', 'orders'));
}


    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            // 'image' => 'nullable|image|max:2048', // Uncomment if adding profile image
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
         $user->update($request->only('name', 'email'));
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout(); // logout before delete

        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
