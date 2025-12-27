<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


Route::get('/', [ProductController::class, 'index'])->name('product.index');

Route::middleware(['auth'])->group(function () {
    // Rute untuk halaman cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Rute untuk menambahkan item ke cart
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

    // Rute untuk mengupdate item di cart
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

    // Rute untuk menghapus item dari cart
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('transactions', TransactionController::class)->middleware('auth');
