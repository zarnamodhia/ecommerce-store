<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Homepage with optional category filtering
    public function index(Request $request)
    {
        $query = Product::query();

        // Optional: Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(8); // Pagination for better UX
        $categories = Category::all(); // For category filter dropdown or sidebar

        return view('home', compact('products', 'categories'));
    }

    // Show single product detail page
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('customer.show', compact('product'));
    }
}
