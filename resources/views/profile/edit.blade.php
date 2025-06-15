@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<style>
    .profile-form-card {
        background-color: #1e1e1e;
        color: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0, 180, 216, 0.3);
        max-width: 700px;
        margin: 0 auto;
    }

    .profile-form-card h2 {
        color: #00B4D8;
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        font-weight: bold;
        margin-top: 10px;
    }

    .form-control, .btn {
        margin-top: 10px;
    }
</style>

<div class="container py-5">
    <div class="profile-form-card">
        <h2>Edit Profile</h2>

        @include('profile.partials.update-profile-information-form')

        <hr class="my-4" />

        @include('profile.partials.update-password-form')

        <hr class="my-4" />

        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
