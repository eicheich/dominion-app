<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Order\CheckoutController;
use App\Http\Controllers\Order\TransactionController;

// admin
Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

    // Users Management
    Route::resource('users', UserController::class, ['as' => 'admin']);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::post('/users/{user}/update-password', [UserController::class, 'updatePassword'])->name('admin.users.update-password');

    // Products
    Route::resource('products', ProductController::class);

    // Orders
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{id}/update', [OrderController::class, 'updateDelivery'])->name('orders.update.delivery');

    // Deliveries
    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('admin.deliveries');
    Route::get('/deliveries/{id}', [DeliveryController::class, 'show'])->name('admin.deliveries.show');
    Route::post('/deliveries/{id}/update', [DeliveryController::class, 'updateStatus'])->name('delivery.update.status');
});




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
    Route::get('/search', [ClientController::class, 'search'])->name('search');
    Route::get('/category/{id}', [ClientController::class, 'category'])->name('category');
});
Route::resource('cart', CartController::class)->middleware(['auth']);
Route::prefix('cart')->middleware(['auth'])->group(function () {
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('cart.count');
    Route::get('/total', [CartController::class, 'getCartTotal'])->name('cart.total');
});
Route::prefix('order')->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware(['auth']);
    Route::get('/payment/{order_number}', [TransactionController::class, 'payment'])->name('payment')->middleware(['auth']);
    Route::post('/pay', [TransactionController::class, 'pay'])->name('pay')->middleware(['auth']);
    Route::get('/', [TransactionController::class, 'history'])->name('history')->middleware(['auth']);
    Route::get('/detail/{id}', [TransactionController::class, 'detail'])->name('detail')->middleware(['auth']);
    Route::post('/confirm-delivery/{id}', [TransactionController::class, 'confirmDelivery'])->name('confirm.delivery')->middleware(['auth']);
});
