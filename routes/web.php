<?php

use App\Http\Controllers\Admin\CancellController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Order\CheckoutController;
use App\Http\Controllers\Order\TransactionController;

// admin
Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('admin.deliveries');
    Route::post('/deliveries/{id}/update', [DeliveryController::class, 'updateStatus'])->name('delivery.update.status');
    Route::post('/orders/{id}/update', [OrderController::class, 'updateDelivery'])->name('orders.update.delivery');
    Route::get('/cancellations', [CancellController::class, 'index'])->name('admin.cancellations');
    Route::put('/cancellations/{id}/approve', [CancellController::class, 'approve'])->name('admin.cancellations.approve');
    Route::put('/cancellations/{id}/reject', [CancellController::class, 'reject'])->name('admin.cancellations.reject');
});
Route::resource('products', ProductController::class)->middleware(['isAdmin']);
Route::resource('orders', OrderController::class)->middleware(['isAdmin']);

// auth
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
    Route::get('/payment/{order_number}', [TransactionController::class, 'payment'])->name('payment')->middleware(['auth']);
    Route::post('/pay', [TransactionController::class, 'pay'])->name('pay')->middleware(['auth']);
    Route::get('/', [TransactionController::class, 'history'])->name('history')->middleware(['auth']);
    Route::get('/detail/{id}', [TransactionController::class, 'detail'])->name('detail')->middleware(['auth']);
    Route::put('/confirm/{id}', [TransactionController::class, 'confirm'])->name('confirm.orders')->middleware(['auth']);
});
Route::get('/orders/{id}/cancel', [CancellController::class, 'cancel'])->name('orders.cancel')->middleware(['auth']);
Route::post('/orders/{id}/cancel', [CancellController::class, 'cancelOrder'])->name('orders.cancellation')->middleware(['auth']);
