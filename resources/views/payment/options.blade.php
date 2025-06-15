@extends('layouts.app')

@section('title', 'Choose Payment Method')

@section('content')
<div class="container text-light py-5">
    <h2 class="mb-4 text-info">💳 Choose Your Payment Method</h2>

    <ul class="list-group mb-4">
        @foreach ($cart as $item)
            <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                <span>₹{{ $item['price'] * $item['quantity'] }}</span>
            </li>
        @endforeach
        <li class="list-group-item bg-secondary text-light d-flex justify-content-between">
            <strong>Total:</strong>
            <strong>₹{{ $total }}</strong>
        </li>
    </ul>

    <form method="POST" action="{{ route('payment.process') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Select Payment Method:</label>
            <select name="payment_method" class="form-select bg-dark text-light border-secondary" required>
                <option value="">-- Choose --</option>
                <option value="upi">UPI</option>
                <option value="cod">Cash on Delivery</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Confirm Payment</button>
    </form>
</div>
@endsection
