<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// USER
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// CART (USER)
Route::post('/add-to-cart/{id}', [DashboardController::class, 'addToCart'])
    ->name('cart.add');

Route::post('/cart/increase/{id}', [DashboardController::class, 'increase'])
    ->name('cart.increase');

Route::post('/cart/decrease/{id}', [DashboardController::class, 'decrease'])
    ->name('cart.decrease');

Route::post('/cart/cancel', [DashboardController::class, 'cancel'])
    ->name('cart.cancel');

// ADMIN (PRODUCT)
Route::get('/product', [ProductController::class, 'index'])
    ->name('product.index');

Route::get('/product/create', [ProductController::class, 'create'])
    ->name('product.create');

Route::post('/product', [ProductController::class, 'store'])
    ->name('product.store');

Route::get('/product/{product}/edit', [ProductController::class, 'edit'])
    ->name('product.edit');

Route::put('/product/{product}', [ProductController::class, 'update'])
    ->name('product.update');

Route::delete('/product/{product}', [ProductController::class, 'destroy'])
    ->name('product.destroy');
