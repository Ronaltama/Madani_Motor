<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Auth\AuthController;

// ==========================
// Public
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==========================
// Auth
// ==========================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==========================
// Admin (HARUS pakai auth)
// ==========================
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Log Aktivitas
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas');
        
        // Manajemen Produk
        Route::resource('products', ProductController::class)
            ->except(['show'])
            ->parameters(['products' => 'mobil']);
        
        // Manajemen Review/Ulasan
        Route::resource('reviews', ReviewController::class);
    });
