<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Welcome Page (Public)
use App\Http\Controllers\CartController;

// 1. Updated Welcome Page
Route::get('/', [ProductController::class, 'welcome']);

// 2. Add these to your existing middleware 'auth' group
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout Route
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.process');
Route::get('/', function () {
    return view('welcome');
});

// 2. SHARED ROUTES (Accessible by both Customers and Business Owners)
// Both 'viewer' and 'admin' can see the dashboard and product details
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard (Main Product List)
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    
    // Product Detail Page
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
});
// --- ACCOUNTANT & ADMIN ROUTES ---
Route::middleware(['auth', 'role:admin,accountant'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

// 3. ADMIN ONLY ROUTES (Accessible ONLY by Business Owners)
// The 'role:admin' middleware uses the alias you created in Kernel.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    // Create Product Form
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    // Store Product (Save to DB)
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

    // Edit Product Form
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

    // Update Product (Save Changes)
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');

    // Delete Product
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// 4. PROFILE ROUTES (Standard Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Load Authentication Routes (Login, Register, Forgot Password)
require __DIR__.'/auth.php';