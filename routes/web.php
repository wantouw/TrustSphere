<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home_page'])->name('home_page')->middleware('auth');
Route::get('/login', [LoginController::class, 'login_page'])->name('login_page');
Route::get('/register', [RegisterController::class, 'register_page']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
