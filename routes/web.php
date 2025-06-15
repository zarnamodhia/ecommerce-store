<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductViewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::match(['get', 'post'], '/orders/customer', [OrderController::class, 'customerOrders'])->name('orders.customer');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductViewController::class, 'index'])->name('products');

// About & Contact Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Payment Routes
Route::get('/payment/options', [PaymentController::class, 'options'])->name('payment.options');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/upi', [PaymentController::class, 'upi'])->name('payment.upi');
Route::post('/payment/upi/confirm', [PaymentController::class, 'confirmUpi'])->name('payment.upi.confirm');

// Shipping & Checkout (Only accessible after login)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [ShippingController::class, 'checkout'])->name('shipping.checkout');  // Page showing cart & form
    Route::post('/checkout', [ShippingController::class, 'store'])->name('shipping.form');         // Submit shipping form

    Route::get('/orders/customer', [OrderController::class, 'customerOrders'])->name('orders.customer');

    // User Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Auth
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
        Route::get('/orders', [OrderController::class, 'adminOrders'])->name('orders');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });
});

// Breeze Auth Routes
require __DIR__ . '/auth.php';
