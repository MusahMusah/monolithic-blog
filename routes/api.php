<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/**
 * AUTHENTICATION ROUTES
 */
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

/**
 * USER MANAGEMENT ROUTES
 */
Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'user', 'as' => 'user.'], fn () => [
    Route::get('/', [UserController::class, '__invoke'])->name('me'),
    Route::post('/create-post', [PostController::class, 'createPost'])
            ->name('create-post'),
    Route::get('/posts', [PostController::class, 'getUserPosts'])
        ->name('posts'),
]);

/**
 * OTHER ROUTES
 */
Route::get('/posts/all', [PostController::class, 'getPosts'])
    ->name('posts.all');


/**
 * ADMIN ROUTES
 */
Route::group(['middleware' => ['auth:sanctum', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], fn () => [
    Route::post('/create-import', [AdminController::class, 'createImport'])
                ->name('create-import'),
]);

