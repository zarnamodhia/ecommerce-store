@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto text-white">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    @if(session('success'))
        <div class="bg-green-800 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <a href="{{ route('admin.products.create') }}" class="bg-green-700 hover:bg-green-800 p-4 rounded shadow text-center">
            ➕ Add Product
        </a>
        <a href="{{ route('admin.categories.index') }}" class="bg-indigo-700 hover:bg-indigo-800 p-4 rounded shadow text-center">
            📂 Manage Categories
        </a>
        <a href="{{ route('admin.orders') }}" class="bg-yellow-600 hover:bg-yellow-700 p-4 rounded shadow text-center">
            📦 View Orders
        </a>
    </div>

    <div class="bg-gray-900 p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Product List</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-white">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="p-3 border border-gray-700">Image</th>
                        <th class="p-3 border border-gray-700">Name</th>
                        <th class="p-3 border border-gray-700">Price</th>
                        <th class="p-3 border border-gray-700">Category</th>
                        <th class="p-3 border border-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-800">
                            <td class="p-3 border border-gray-700">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="p-3 border border-gray-700">{{ $product->name }}</td>
                            <td class="p-3 border border-gray-700">₹{{ number_format($product->price, 2) }}</td>
                            <td class="p-3 border border-gray-700">{{ $product->category->name ?? 'Uncategorized' }}</td>
                            <td class="p-3 border border-gray-700 space-x-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-400 hover:underline">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
