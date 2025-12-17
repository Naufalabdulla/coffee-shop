<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('product.index');

Route::post('/add-to-cart/{id}', [ProductController::class, 'addToCart'])
    ->name('cart.add');

Route::post('/cart/increase/{id}', [ProductController::class, 'increase'])
    ->name('cart.increase');

Route::post('/cart/decrease/{id}', [ProductController::class, 'decrease'])
    ->name('cart.decrease');

