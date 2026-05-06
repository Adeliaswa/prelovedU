<?php

// ============================================================
// ADMIN ROUTES
// Pastikan middleware 'admin' sudah terdaftar di bootstrap/app.php
// ============================================================

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Produk (CRUD)
    Route::resource('/products', AdminProductController::class);

    // Manajemen Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    
    // Ini adalah rute update status pesanan yang BENAR dan sudah terintegrasi
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');

});

// ============================================================
// REDIRECT: /admin → /admin/dashboard
// ============================================================
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'admin']);