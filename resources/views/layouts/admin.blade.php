<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-white font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 shadow-lg">
            <div class="p-6 text-center border-b border-gray-700">
                <h2 class="text-xl font-bold text-indigo-500">Admin Panel</h2>
            </div>
            <nav class="p-4">
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                            🏠 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('admin.products.create') ? 'bg-gray-800' : '' }}">
                            ➕ Add Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('admin.products.index') ? 'bg-gray-800' : '' }}">
                            📦 All Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('admin.categories.index') ? 'bg-gray-800' : '' }}">
                            🗂️ Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}" class="block py-2 px-3 rounded hover:bg-gray-800 {{ request()->routeIs('orders.admin') ? 'bg-gray-800' : '' }}">
                            📑 Orders
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 px-3 rounded hover:bg-red-600 bg-red-500 mt-4 text-white">
                                🚪 Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-950 p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-indigo-400">Welcome, {{ auth('admin')->user()->name ?? 'Admin' }}</h1>
            </div>

            @if(session('success'))
                <div class="bg-green-600 text-white p-4 mb-6 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
