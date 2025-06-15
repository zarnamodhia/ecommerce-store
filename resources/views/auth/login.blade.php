@extends('layouts.app')

@section('title', 'Customer Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card bg-dark text-light shadow p-4" style="width: 100%; max-width: 420px;">
        <h2 class="text-center text-info mb-4">Customer Login</h2>

        @if(session('status'))
            <div class="alert alert-danger">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" class="form-control bg-dark text-light border-secondary" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-outline-primary">Login</button>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('register') }}" class="text-info">New user? Register here</a>
            </div>
        </form>
    </div>
</div>
@endsection
