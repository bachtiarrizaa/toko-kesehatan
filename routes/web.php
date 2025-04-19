<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrdertController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/register', [registerController::class, 'registerForm'])->name('register');
Route::post('register', [registerController::class, 'register'])->name('register');

Route::get('/login', [loginController::class, 'loginForm'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('login');

Route::post('/logout', [logoutController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/customer', [CustomerController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', AuthAdmin::class])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/admin/category/add', [CategoryController::class, 'addCategoryForm'])->name('admin.category.add');
    Route::post('/admin/category/add', [CategoryController::class, 'store'])->name('admin.category.add');

    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');

    Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');



    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin/product/add', [ProductController::class, 'add_product'])->name('admin.product.add');

    Route::get('/admin/order', [OrdertController::class, 'index'])->name('admin.order.index');
    Route::get('/admin/order/detail', [OrdertController::class, 'order_detail'])->name('admin.order.detail');
});