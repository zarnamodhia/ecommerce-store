@extends('layouts.app')

@section('title', 'Home')

@section('content')

<style>
    .navbar-custom {
        background-color: #0d6efd;
    }
    .navbar-custom .nav-link,
    .navbar-custom .navbar-brand {
        color: white;
    }
    .navbar-custom .nav-link:hover {
        color: #ffc107;
    }

    .hero-section {
        background: linear-gradient(to right, #0d6efd, #6610f2);
        color: white;
        padding: 80px 20px;
        text-align: center;
    }

    .card img {
        height: 200px;
        object-fit: cover;
    }

    .footer-bar {
        margin-top: 50px;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <h1 class="display-5 fw-bold">Welcome to EcoShop</h1>
    <p class="lead">Gear up your creative journey with professional tools & resources.</p>
    <a href="{{ route('products') }}" class="btn btn-warning btn-lg mt-3">Browse Products</a>
</div>

<!-- Flash Message -->
@if(session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

<!-- Products Grid -->
<div class="container py-5">
    <div class="row g-4">
        @if($products->isEmpty())
            <div class="col-12 text-center text-muted">
                <p>No products available right now. Check back soon!</p>
            </div>
        @else
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text small text-muted">{{ $product->description }}</p>
                            <h6 class="fw-bold text-primary mt-auto mb-3">₹{{ $product->price }}</h6>

                            @auth
                                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mb-2">
                                    @csrf
                                    <button class="btn btn-outline-primary w-100">Add to Cart</button>
                                </form>

                                <form method="GET" action="{{ route('shipping.form', $product->id) }}">
                                    <button type="submit" class="btn btn-primary w-100">Buy Now</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary w-100">Login to Buy</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection
