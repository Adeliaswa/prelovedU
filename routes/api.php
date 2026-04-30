<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\CheckoutApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\AdminOrderApiController;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartApiController::class, 'index']);
    Route::post('/cart/add/{productId}', [CartApiController::class, 'store']);
    Route::put('/cart/update/{cartId}', [CartApiController::class, 'update']);
    Route::delete('/cart/delete/{cartId}', [CartApiController::class, 'destroy']);

    Route::post('/checkout', [CheckoutApiController::class, 'store']);

    Route::get('/orders', [OrderApiController::class, 'index']);
    Route::get('/orders/{id}', [OrderApiController::class, 'show']);

    Route::put('/admin/orders/{id}/status', [AdminOrderApiController::class, 'updateStatus']);
});