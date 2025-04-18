<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\CustomerController;
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
});