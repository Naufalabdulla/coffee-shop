<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Permission;

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

// ADMIN (USER / STAFF)
Route::get('/user', [UserController::class, 'index'])
    ->name('user.index');

Route::get('/user/create', [UserController::class, 'create'])
    ->name('user.create');

Route::post('/user', [UserController::class, 'store'])
    ->name('user.store');

Route::get('/user/{id}/edit', [UserController::class, 'edit'])
    ->name('user.edit');

Route::put('/user/{id}', [UserController::class, 'update'])
    ->name('user.update');

Route::delete('/user/{id}', [UserController::class, 'destroy'])
    ->name('user.destroy');

