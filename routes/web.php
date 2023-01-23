<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// admin
Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
});

Route::resource('products', ProductController::class)->middleware(['auth']);

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/log', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/reg', [RegisterController::class, 'register'])->name('register.post');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

// guest
Route::prefix('')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('landingpage');
    Route::get('/product/{id}', [ClientController::class, 'show'])->name('client.product.show')->middleware(['auth']);
});

Route::resource('cart', CartController::class)->middleware(['auth']);
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware(['auth']);