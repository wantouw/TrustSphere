<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectVoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLikeController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login_page'])->name('login_page');
Route::get('/register', [AuthController::class, 'register_page']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'home_page'])->name('home_page');
    Route::get('/explore', [ProjectController::class, 'explore_project_page'])->name('explore_project_page');
    Route::get('/project/create', [ProjectController::class, 'create_project_page'])->name('create_project_page');
    Route::post('/like', [UserLikeController::class, 'like_project'])->name('like_project');
    Route::post('/category/create', [ProjectCategoryController::class, 'create_category'])->name('create_category');
    Route::post('/project/create', [ProjectController::class, 'create_project'])->name('create_project');
    Route::post('/comment/create', [CommentController::class, 'create_comment'])->name('create_comment');
    Route::delete('/comment/delete/{project_id}', [CommentController::class,'delete_comment'])->name('delete_comment');
    Route::post('/vote', [ProjectVoteController::class, 'vote'])->name('vote');
    Route::get('/friends', [FriendController::class, 'friends_page'])->name('friends_page');
    Route::post('/friend/follow', [FriendController::class, 'follow_friends'])->name('follow_friend');
});
Route::get('/project/{project_id}', [ProjectController::class, 'project_detail_page'])->name(name: 'project_detail_page');
Route::get('/search', [ProjectController::class, 'search_project_page'])->name('search_project');
Route::get('my-projects', [ProjectController::class, 'my_projects_page'])->name('my_projects_page');
