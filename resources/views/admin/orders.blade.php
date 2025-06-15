@extends('layouts.app')

@section('content')
<div class="container py-4 text-white">
    <h2 class="mb-4 text-info">Manage Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No orders found.</div>
    @else
        @foreach($orders as $order)
            <div class="bg-dark p-4 mb-4 rounded shadow border border-secondary">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h5 class="mb-1 text-warning">Order #{{ $order->id }}</h5>
                        <p class="mb-1"><strong>User:</strong> {{ $order->user->name }}</p>
                        <p class="mb-1"><strong>Address:</strong> {{ $order->shipping_address }}</p>
                        <p class="mb-1"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                        <p class="mb-1"><strong>Total:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    </div>
                    <div class="mt-3 mt-md-0 text-md-end">
                        <form method="POST" action="{{ route('orders.update.status', $order->id) }}">
                            @csrf
                            <div class="input-group input-group-sm">
                                <select name="status" class="form-select bg-dark text-white border-secondary">
                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                        <div class="mt-2">
                            <span class="badge bg-info text-dark">Current: {{ $order->status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
