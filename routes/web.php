<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ProfileController;


use App\Http\Controllers\Auth\AuthController;
use Inertia\Inertia; // <-- Pastikan ini ada

// ==========================
// Public
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/compare', [HomeController::class, 'compare'])->name('compare');
Route::get('/cars', [HomeController::class, 'cars'])->name('cars.index');
Route::get('/cars/{id}', [HomeController::class, 'show'])->name('cars.show');

Route::get('/jual-mobil', function () {
    // DIUBAH: 'Publik' menjadi 'Public' agar sesuai nama folder
    return Inertia::render('Public/JualMobil');
})->name('jual.mobil');


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
            ->parameters(['products' => 'mobil']);

        // Route khusus untuk update dengan file upload
        Route::post('products/{mobil}/update-with-files', [ProductController::class, 'update'])
            ->name('products.update-files');       // Manajemen Review/Ulasan
        Route::resource('reviews', ReviewController::class);

        // Profile

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/profile', function () {
            return Inertia::render('Admin/Profile');
        })->name('profile');

    }
);