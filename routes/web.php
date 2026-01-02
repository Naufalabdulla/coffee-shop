<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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
Route::resource('products', App\Http\Controllers\ProductController::class)->only(['index'])->middleware([Permission::class . ':first floor']);
Route::resource('products', App\Http\Controllers\ProductController::class)->except(['index'])->middleware([Permission::class . ':second floor']);
Route::resource('transactions', TransactionController::class)->except(['create'])->middleware(['auth', Permission::class . 'first floor']);

require __DIR__ . '/auth.php';
