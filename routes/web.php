<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\HomeController;

// Public routes - accessible by everyone
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mobil/{id}', [HomeController::class, 'show'])->name('mobil.show');
Route::get('/bandingkan', [HomeController::class, 'compare'])->name('mobil.compare');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin routes - protected by auth middleware
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [DashboardController::class, 'products'])->name('products');
});
