<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Transaction\CheckoutController;
// admin
Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
});
// auth
Route::resource('products', ProductController::class)->middleware(['auth']);
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/log', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/reg', [RegisterController::class, 'register'])->name('register.post');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
// client
Route::resource('profile', ProfileController::class)->middleware(['auth']);
Route::prefix('')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('landingpage');
    Route::get('/product/{id}', [ClientController::class, 'show'])->name('client.product.show')->middleware(['auth']);
});
Route::resource('cart', CartController::class)->middleware(['auth']);
Route::prefix('order')->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware(['auth']);
    Route::get('/payment/{order_number}', [CheckoutController::class, 'payment'])->name('payment')->middleware(['auth']);
    Route::post('/pay', [CheckoutController::class, 'pay'])->name('pay')->middleware(['auth']);
    Route::get('/history', [CheckoutController::class, 'history'])->name('history')->middleware(['auth']);
    Route::get('/detail/{id}', [CheckoutController::class, 'detail'])->name('detail')->middleware(['auth']);
}); 