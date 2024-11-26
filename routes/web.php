<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login_page'])->name('login_page');
Route::get('/register', [AuthController::class, 'register_page']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'home_page'])->name('home_page');
    Route::get('/project/create', [ProjectController::class, 'create_project_page'])->name('create_project_page');
    Route::post('/category/create', [ProjectCategoryController::class, 'create_category'])->name('create_category');
    Route::post('/project/create', [ProjectController::class, 'create_project'])->name('create_project');
});
Route::get('/project/{projectID}', [ProjectController::class, 'project_detail_page'])->name('project_detail_page');

