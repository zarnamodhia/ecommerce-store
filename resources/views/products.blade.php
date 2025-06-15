@extends('layouts.app')

@section('title', 'All Products')

@section('content')
<style>
    body {
        background-color: #121212;
        color: #e0e0e0;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
        color: #00B4D8;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
        padding: 20px 0;
    }

    .product-card {
        background-color: #1e1e1e;
        border: 1px solid #2a2a2a;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 180, 216, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 180, 216, 0.3);
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-info {
        padding: 15px;
    }

    .product-info h3 {
        font-size: 1.2rem;
        color: #00B4D8;
        margin-bottom: 0.5rem;
    }

    .product-info p {
        font-size: 0.9rem;
        color: #aaa;
        height: 60px;
        overflow: hidden;
    }

    .price {
        font-size: 1.1rem;
        font-weight: bold;
        color: #FFD166;
        margin: 10px 0;
    }

    .buttons form,
    .buttons a {
        display: block;
        margin-bottom: 10px;
    }

    .buttons button {
        width: 100%;
        padding: 8px;
        background-color: #00B4D8;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .buttons button:hover {
        background-color: #0096c7;
    }

    .message {
        background-color: #1c1c1c;
        border-left: 5px solid #00B4D8;
        padding: 10px;
        margin-bottom: 20px;
        color: #ffffff;
    }
</style>

<div class="container py-4">
    <h2><i class="bi bi-box2-heart"></i> All Products</h2>

    @if(session('success'))
        <div class="message text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 80) }}</p>
                    <div class="price">₹{{ number_format($product->price, 2) }}</div>

                    <div class="buttons">
                        @auth
                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                @csrf
                                <button type="submit">Add to Cart</button>
                            </form>

                            <form method="GET" action="{{ route('shipping.form', $product->id) }}">
                                <button type="submit">Buy Now</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">
                                <button type="button">Login to Buy</button>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
