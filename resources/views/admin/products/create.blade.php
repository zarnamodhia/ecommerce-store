@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-gray-900 text-white p-8 rounded-xl shadow-xl">
    <h2 class="text-3xl font-bold text-indigo-400 mb-6">Add New Product</h2>

    {{-- Error Display --}}
    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-4">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Product Name --}}
            <div>
                <label for="name" class="block mb-2 text-indigo-300 font-medium">Product Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500"
                       placeholder="Enter product name" required>
            </div>

            {{-- Product Price --}}
            <div>
                <label for="price" class="block mb-2 text-indigo-300 font-medium">Price</label>
                <input type="number" name="price" id="price" step="0.01"
                       value="{{ old('price') }}"
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500"
                       placeholder="₹0.00" required>
            </div>

            {{-- Product Description --}}
            <div class="md:col-span-2">
                <label for="description" class="block mb-2 text-indigo-300 font-medium">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500"
                          placeholder="Write product details...">{{ old('description') }}</textarea>
            </div>

            {{-- Product Category --}}
            <div>
                <label for="category_id" class="block mb-2 text-indigo-300 font-medium">Category</label>
                <select name="category_id" id="category_id"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                    <option value="" disabled selected>-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Product Image --}}
            <div>
                <label for="image" class="block mb-2 text-indigo-300 font-medium">Product Image</label>
                <input type="file" name="image" id="image"
                       class="w-full file:bg-indigo-600 file:text-white file:border-0 file:rounded-lg file:px-4 file:py-2
                              bg-gray-800 border border-gray-700 rounded-lg text-white">
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex justify-end mt-6 space-x-4">
            <a href="{{ route('admin.products.index') }}"
               class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-white transition duration-300">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-white font-semibold transition duration-300">
                Add Product
            </button>
        </div>
    </form>
</div>
@endsection
