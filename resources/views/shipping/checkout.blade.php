@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <div class="bg-dark text-light p-5 rounded shadow-lg mx-auto" style="max-width: 700px;">

        <h2 class="mb-4 text-info">
            <i class="bi bi-truck"></i> Shipping & Checkout
        </h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h4 class="mb-3">🛒 Order Summary</h4>
        <ul class="list-group mb-4">
            @forelse ($cart as $item)
                <li class="list-group-item bg-secondary text-light d-flex justify-content-between align-items-center">
                    <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                    <span>₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                </li>
            @empty
                <li class="list-group-item bg-secondary text-light text-center">Your cart is empty.</li>
            @endforelse

            <li class="list-group-item bg-info text-dark d-flex justify-content-between">
                <strong>Total:</strong>
                <strong>₹{{ number_format($total, 2) }}</strong>
            </li>
        </ul>

        <h4 class="mb-3">📦 Shipping Details</h4>
        <form action="{{ route('orders.customer') }}" method="GET">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control bg-dark text-light border-secondary" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control bg-dark text-light border-secondary" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control bg-dark text-light border-secondary" required>
            </div>
            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-arrow-right-circle-fill"></i> Save & Continue
            </button>
        </form>
    </div>
</div>
@endsection
