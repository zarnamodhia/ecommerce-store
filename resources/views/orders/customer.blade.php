@extends('layouts.app')
@section('content')
<div class="container py-4 text-white">
    <h2 class="mb-4">My Orders</h2>
    @foreach($orders as $order)
        <div class="bg-dark p-3 mb-3 rounded shadow">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Payment:</strong> {{ $order->payment_method }}</p>
            <p><strong>Total:</strong> ₹{{ $order->total_amount }}</p>
            <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
        </div>
    @endforeach
</div>
@endsection
