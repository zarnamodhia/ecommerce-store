@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<style>
    .profile-card {
        background-color: #1e1e1e;
        color: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0, 180, 216, 0.3);
        max-width: 700px;
        margin: 0 auto 40px;
    }

    .profile-card h2 {
        color: #00B4D8;
        margin-bottom: 20px;
        text-align: center;
    }

    .profile-detail {
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .profile-detail span {
        color: #FFD166;
    }

    .section {
        background-color: #222;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .section h5 {
        color: #00B4D8;
        margin-bottom: 15px;
    }

    .address, .order {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #2b2b2b;
        border-left: 3px solid #00B4D8;
        border-radius: 6px;
    }
</style>

<div class="container py-5">

    <div class="profile-card">
        <h2><i class="bi bi-person-circle"></i> My Profile</h2>

        <div class="profile-detail"><strong>Name:</strong> <span>{{ $user->name }}</span></div>
        <div class="profile-detail"><strong>Email:</strong> <span>{{ $user->email }}</span></div>
        <div class="profile-detail"><strong>Member Since:</strong> <span>{{ $user->created_at->format('d M Y') }}</span></div>

        <a href="{{ route('profile.edit') }}" class="btn btn-outline-info w-100 mt-3">Edit Profile</a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-danger w-100 mt-3">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    {{-- Saved Addresses --}}
    <div class="section">
        <h5><i class="bi bi-geo-alt"></i> Saved Shipping Addresses</h5>
        @forelse ($addresses as $address)
            <div class="address">
                <p><strong>Address:</strong> {{ $address->address }}</p>
                <p><strong>City:</strong> {{ $address->city }}</p>
                <p><strong>ZIP:</strong> {{ $address->zip }}</p>
                <p><strong>Phone:</strong> {{ $address->phone }}</p>
            </div>
        @empty
            <p class="text-muted">No saved addresses yet.</p>
        @endforelse
    </div>

    {{-- My Orders --}}
    <div class="section">
        <h5><i class="bi bi-bag"></i> My Orders</h5>
        @forelse ($orders as $order)
            <div class="order">
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Total:</strong> ₹{{ $order->total_amount }}</p>
                <p><strong>Status:</strong> <span class="badge bg-info">{{ $order->status }}</span></p>
                <p><strong>Ordered on:</strong> {{ $order->created_at->format('d M Y') }}</p>
            </div>
        @empty
            <p class="text-muted">You haven't placed any orders yet.</p>
        @endforelse

        <a href="{{ route('orders.customer') }}" class="btn btn-outline-light mt-3">View All Orders</a>
    </div>
</div>
@endsection
