<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LandingController;
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
    // Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

});


Route::middleware(['auth', AuthAdmin::class])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/admin/category/add', [CategoryController::class, 'addCategoryForm'])->name('admin.category.add');
    Route::post('/admin/category/add', [CategoryController::class, 'store'])->name('admin.category.add');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'editCategoryForm'])->name('admin.category.edit');
    Route::put('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');


    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin/product/add', [ProductController::class, 'addProductForm'])->name('admin.product.add');
    Route::post('/admin/product/add', [ProductController::class, 'store'])->name('admin.product.add');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'editProductForm'])->name('admin.product.edit');
    Route::put('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');


});
// Route::get('/admin/order', [OrdertController::class, 'index'])->name('admin.order.index');
// Route::get('/admin/order/detail', [OrdertController::class, 'order_detail'])->name('admin.order.detail');


// Route::middleware(['auth', AuthAdmin::class])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('index');

//     Route::resource('category', CategoryController::class)->except(['show', 'create']);
//     Route::resource('product', ProductController::class)->except(['show', 'create']);
// });