<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdertController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');

// Auth Routes
Route::get('/register', [registerController::class, 'registerForm'])->name('register');
Route::post('register', [registerController::class, 'register'])->name('register');
Route::get('/login', [loginController::class, 'loginForm'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('login');
Route::post('/logout', [logoutController::class, 'logout'])->name('logout');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::middleware(['auth'])->group(function() {
    // Route::get('/customer', [CustomerController::class, 'index'])->name('user.index');

    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    // Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{id}/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    // Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');



    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

});


Route::middleware(['auth', AuthAdmin::class])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Category Routes
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/admin/product', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/admin/product/{product}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/admin/product/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    // Route::get('/admin/order', [OrdertController::class, 'index'])->name('admin.order.index');

});
// Route::get('/admin/order/detail', [OrdertController::class, 'order_detail'])->name('admin.order.detail');