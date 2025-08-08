<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
Route::get('/', [NoteController::class, 'index'])->middleware(['auth']);
// Route yang butuh login
Route::middleware('auth')->group(function () {
    Route::resource('notes', NoteController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Auth routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);



// Kalau kamu pakai Laravel UI atau Breeze, Auth::routes() boleh dipertahankan
Auth::routes();
