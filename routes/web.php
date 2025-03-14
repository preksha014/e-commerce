<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLogin;
use App\Http\Controllers\User\SessionController as UserLogin;
use App\Http\Controllers\User\RegisteredUserController as UserRegister;

Route::view('/', 'user.home');
Route::view('/catalog', 'user.catalog');
Route::view('/about', 'user.about');
Route::view('/contact', 'user.contact');
Route::view('/cart', 'user.cart');
Route::view('/product-overview', 'user.product-overview');

Route::view('/checkout-address', 'user.checkout-address');
Route::view('/checkout-payment', 'user.checkout-payment');
Route::view('/checkout-review', 'user.checkout-review');
Route::view('/checkout-confirmation', 'user.checkout-confirmation');

// Route::prefix('/dashboard')->group(function () {
//     Route::view('/', 'dashboard.index');
//     Route::view('/products', 'dashboard.products');
//     Route::view('/categories', 'dashboard.category.create');
//     Route::view('/orders', 'dashboard.orders');
//     Route::view('/customers', 'dashboard.customers');
//     Route::view('/reports', 'dashboard.reports');
// });


Route::middleware('guest:customer')->group(function () {
    Route::get("login", [UserLogin::class, "index"]);
    Route::post("login", [UserLogin::class, "store"]);
});

Route::middleware('auth:customer')->group(function () {
    Route::get("logout", [UserLogin::class, "logout"]);
});

Route::get("signup", [UserRegister::class, "create"]);
Route::post("signup", [UserRegister::class, "store"]);

Route::prefix("admin")->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get("login", [AdminLogin::class, "index"])->name('login');
        Route::post("login", [AdminLogin::class, "store"]);
    });     
    Route::middleware('auth:admin')->group(function () {
        Route::view('/dashboard', 'dashboard.index')->name("admin.dashboard");
        Route::view('/products', 'dashboard.products');
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/category/create', [CategoryController::class, 'create']);
        Route::view('/orders', 'dashboard.orders');
        Route::view('/customers', 'dashboard.customers');
        Route::view('/reports', 'dashboard.reports');
    });    
});
Route::get("logout", [AdminLogin::class, "logout"]);