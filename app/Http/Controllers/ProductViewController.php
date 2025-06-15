<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductViewController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all categories (for filters if needed in the view)
        $categories = Category::all();

        // Query products with category relationship
        $query = Product::with('category');

        // Optional: filter by category if passed
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        // Paginate the result (8 per page)
        $products = $query->latest()->paginate(8);

        return view('products', compact('products', 'categories'));
    }
}
