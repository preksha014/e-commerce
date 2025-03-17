<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLogin;
use App\Http\Controllers\User\SessionController as UserLogin;
use App\Http\Controllers\User\RegisteredUserController as UserRegister;

Route::view('/', 'user.home')->name('user.home');
Route::view('/catalog', 'user.catalog');
Route::view('/about', 'user.about');
Route::view('/contact', 'user.contact');
Route::view('/cart', 'user.cart');
Route::view('/product-overview', 'user.product-overview');

Route::view('/checkout-address', 'user.checkout-address');
Route::view('/checkout-payment', 'user.checkout-payment');
Route::view('/checkout-review', 'user.checkout-review');
Route::view('/checkout-confirmation', 'user.checkout-confirmation');

Route::middleware('guest:customer')->group(function () {
    Route::get("login", [UserLogin::class, "index"])->name('customer.login');
    Route::post("login", [UserLogin::class, "store"]);
});

Route::middleware('auth:customer')->group(function () {
    Route::get("logout", [UserLogin::class, "logout"]);
});

Route::get("signup", [UserRegister::class, "create"]);
Route::post("signup", [UserRegister::class, "store"]);

Route::prefix("admin")->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get("login", [AdminLogin::class, "index"])->name("login");
        Route::post("login", [AdminLogin::class, "store"]);
    });
    Route::middleware('auth:admin')->group(function () {
        Route::view('/dashboard', 'dashboard.index')->name("admin.dashboard");

        Route::prefix("product")->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name("admin.product");
            Route::get('/create', [ProductController::class, 'create'])->name("admin.product.create");
            Route::post('/create', [ProductController::class, 'store'])->name("admin.product.store");
            Route::get('/{slug}/edit', [ProductController::class, 'edit'])->name("admin.product.edit");
            Route::post('/{slug}/update', [ProductController::class, 'update'])->name("admin.product.update");
            Route::delete('/{slug}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        });

        Route::prefix("category")->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name("admin.category");
            Route::get('/create', [CategoryController::class, 'create'])->name("admin.category.create");
            Route::post('/create', [CategoryController::class, 'store'])->name("admin.category.store");
            Route::get('/{slug}/edit', [CategoryController::class, 'edit'])->name("admin.category.edit");
            Route::post('/{slug}/update', [CategoryController::class, 'update'])->name("admin.category.update");
            Route::delete('/{slug}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        Route::view('/orders', 'dashboard.orders')->name("admin.orders");

        Route::view('/customers', 'dashboard.customers')->name("admin.customers");

        Route::view('/reports', 'dashboard.reports')->name("admin.reports");

        Route::get('/logout', [AdminLogin::class, "logout"])->name("admin.logout");
    });
});