<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Permission;


// USER
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// CART (USER)
Route::post('/add-to-cart/{id}', [DashboardController::class, 'addToCart'])
    ->name('cart.add')->middleware([PermissionMiddleware::class . ':first floor']);

Route::post('/cart/increase/{id}', [DashboardController::class, 'increase'])
    ->name('cart.increase')->middleware([PermissionMiddleware::class . ':first floor']);

Route::post('/cart/decrease/{id}', [DashboardController::class, 'decrease'])
    ->name('cart.decrease')->middleware([PermissionMiddleware::class . ':first floor']);

Route::post('/cart/cancel', [DashboardController::class, 'cancel'])
    ->name('cart.cancel')->middleware([PermissionMiddleware::class . ':first floor']);

// ADMIN (PRODUCT)
Route::get('/product', [ProductController::class, 'index'])
    ->name('product.index')->middleware([PermissionMiddleware::class . ':first floor']);

Route::get('/product/create', [ProductController::class, 'create'])
    ->name('product.create')->middleware([PermissionMiddleware::class . ':second floor']);

Route::post('/product', [ProductController::class, 'store'])
    ->name('product.store')->middleware([PermissionMiddleware::class . ':second floor']);

Route::get('/product/{product}/edit', [ProductController::class, 'edit'])
    ->name('product.edit')->middleware([PermissionMiddleware::class . ':second floor']);

Route::put('/product/{product}', [ProductController::class, 'update'])
    ->name('product.update')->middleware([PermissionMiddleware::class . ':second floor']);

Route::delete('/product/{product}', [ProductController::class, 'destroy'])
    ->name('product.destroy')->middleware([PermissionMiddleware::class . ':second floor']);

// ADMIN (USER / STAFF)
Route::get('/user', [UserController::class, 'index'])
    ->name('user.index')->middleware();

Route::get('/user/create', [UserController::class, 'create'])
    ->name('user.create')->middleware();

Route::post('/user', [UserController::class, 'store'])
    ->name('user.store')->middleware();

Route::get('/user/{id}/edit', [UserController::class, 'edit'])
    ->name('user.edit')->middleware();

Route::put('/user/{id}', [UserController::class, 'update'])
    ->name('user.update')->middleware();

Route::delete('/user/{id}', [UserController::class, 'destroy'])
    ->name('user.destroy')->middleware();


Route::resource('transactions', TransactionController::class)->except(['create'])->middleware(['auth', PermissionMiddleware::class . ':first floor']);
Route::post('/midtrans-callback', [TransactionController::class, 'midtranscallback']);

require __DIR__ . '/auth.php';