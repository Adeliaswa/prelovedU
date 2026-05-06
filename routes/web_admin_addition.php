<?php

// ============================================================
// TAMBAHKAN KODE INI KE DALAM FILE routes/web.php
// Letakkan setelah use statements yang sudah ada
// ============================================================

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;

// ============================================================
// ADMIN ROUTES
// Pastikan middleware 'admin' sudah terdaftar di bootstrap/app.php
// ============================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Produk (CRUD)
    Route::resource('/products', AdminProductController::class);

    // Manajemen Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

});

// ============================================================
// REDIRECT: /admin → /admin/dashboard
// ============================================================
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'admin']);

Route::put('/admin/orders/{order}', [\App\Http\Controllers\Admin\AdminOrderController::class, 'update'])
    ->name('admin.orders.update')
    ->middleware('admin'); 