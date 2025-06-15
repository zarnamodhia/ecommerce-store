@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container text-light">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold text-info">Get in Touch</h2>
        <p class="text-secondary">We’d love to hear from you! Whether you're curious about features, a free trial, or even press—we’re ready to answer any and all questions.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}" class="bg-dark border rounded p-4 shadow-lg">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label text-light">Name</label>
                    <input type="text" name="name" id="name" class="form-control bg-dark text-light border-secondary" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-light">Email</label>
                    <input type="email" name="email" id="email" class="form-control bg-dark text-light border-secondary" required>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label text-light">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control bg-dark text-light border-secondary" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label text-light">Message</label>
                    <textarea name="message" id="message" rows="5" class="form-control bg-dark text-light border-secondary" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-outline-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
