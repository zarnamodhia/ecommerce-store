<!-- Single Product Page -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3>{{ $product->name }}</h3>
            <p><strong>Price:</strong> ₹{{ $product->price }}</p>
            <p>{{ $product->description }}</p>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="300">
            @endif
        </div>
    </div>
</div>
@endsection
