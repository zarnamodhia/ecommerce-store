@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-lg rounded-xl p-6">
    <h2 class="text-3xl font-bold text-indigo-500 mb-6">Shipping Information</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-400 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('shipping.store') }}" method="POST">
        @csrf

        {{-- Address Field --}}
        <div class="mb-5">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Full Address</label>
            <input type="text" name="address" id="address"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                value="{{ old('address') }}" required>
            @error('address')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- City Field --}}
        <div class="mb-5">
            <label for="city" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
            <input type="text" name="city" id="city"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                value="{{ old('city') }}" required>
            @error('city')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ZIP Code Field --}}
        <div class="mb-5">
            <label for="zip" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">ZIP Code</label>
            <input type="text" name="zip" id="zip"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                value="{{ old('zip') }}" required>
            @error('zip')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit"
                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-300">
                Continue to Checkout →
            </button>
        </div>
    </form>
</div>
@endsection
