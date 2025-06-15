@extends('layouts.app')

@section('title', 'Customer Register')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card bg-dark text-light shadow p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center text-info mb-4">Create Customer Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" type="text" name="name" class="form-control bg-dark text-light border-secondary" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-outline-primary">Register</button>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('login') }}" class="text-info">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
