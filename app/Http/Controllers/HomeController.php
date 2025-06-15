<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // fetch all products from DB
        return view('home', compact('products')); // pass to Blade view
    }
}
