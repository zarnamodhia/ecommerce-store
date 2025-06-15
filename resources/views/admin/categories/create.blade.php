@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-gray-900 text-white p-8 rounded-xl shadow-xl">
    <h2 class="text-3xl font-bold text-indigo-400 mb-6">Add New Category</h2>

    {{-- Error Message Display --}}
    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-4">
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Category Form --}}
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="name" class="block mb-2 text-indigo-300 font-medium">Category Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Enter category name"
                required
            >
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.categories.index') }}"
               class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition duration-300">
                ← Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition duration-300">
                Save Category
            </button>
        </div>
    </form>
</div>
@endsection
