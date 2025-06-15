@extends('layouts.app')

@section('title', 'UPI Payment')

@section('content')
<div class="container py-5 text-light">
    <h2 class="text-info mb-4">📲 UPI Payment</h2>
    <p>Please scan the QR code or enter your UPI ID to complete the payment.</p>

    <div class="mb-4">
        <img src="{{ asset('images/mock-qr.png') }}" alt="QR Code" width="200">
        <p class="text-muted mt-2">Scan with any UPI app</p>
    </div>

    <form action="{{ route('payment.upi.confirm') }}" method="POST" class="w-100" style="max-width: 400px;">
        @csrf
        <div class="mb-3">
            <label for="upi_id" class="form-label">Or enter your UPI ID</label>
            <input type="text" id="upi_id" name="upi_id" placeholder="example@upi" class="form-control bg-dark text-light border-secondary" required>
        </div>
        <button type="submit" class="btn btn-success">Complete Payment</button>
    </form>
</div>
@endsection
