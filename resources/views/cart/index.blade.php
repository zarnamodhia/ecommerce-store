@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<div class="container py-5 text-light">
    <h2 class="mb-4 text-info">🛒 Your Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-warning">Your cart is currently empty. <a href="{{ route('products') }}" class="text-info">Browse products</a></div>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="70" class="rounded">
                            </td>
                            <td>₹{{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm me-2 bg-dark text-light border-secondary" style="width: 70px;">
                                    <button class="btn btn-sm btn-outline-info">Update</button>
                                </form>
                            </td>
                            <td>₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td colspan="2" class="fw-bold text-success">₹{{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('shipping.checkout') }}" class="btn btn-success btn-lg">
                Proceed to Checkout →
            </a>
        </div>
    @endif
</div>
@endsection
