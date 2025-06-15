@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-gray-900 text-white p-6 rounded-xl shadow-lg">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-bold text-indigo-400">All Categories</h2>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300">
           + Add Category
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Categories Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border-separate border-spacing-y-2">
            <thead class="bg-gray-800 text-indigo-400 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Category Name</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="bg-gray-800 hover:bg-gray-700 transition duration-200">
                        <td class="px-6 py-3">{{ $category->id }}</td>
                        <td class="px-6 py-3">{{ $category->name }}</td>
                        <td class="px-6 py-3 flex flex-wrap gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition text-xs">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition text-xs">
                                    🗑 Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-400">
                            No categories available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
