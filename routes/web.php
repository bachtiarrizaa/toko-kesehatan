<?php

use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\registerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', [registerController::class, 'registerForm'])->name('register');
Route::post('register', [registerController::class, 'register'])->name('register');

Route::get('/login', [loginController::class, 'loginForm'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('login');