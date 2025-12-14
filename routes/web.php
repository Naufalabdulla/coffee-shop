<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/order', [OrderController::class, 'index'])->name('order');

    Route::get('/add-to-cart/{id}', [OrderController::class, 'addToCart']);

    Route::post('/cart-increase/{id}', [OrderController::class, 'increase']);
    Route::post('/cart-decrease/{id}', [OrderController::class, 'decrease']);

    Route::post('/pay', [OrderController::class, 'pay']);

    Route::get('/transactions', [OrderController::class, 'transactions']);
});
