<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LoginController as AdminLogin;

//Admin Routes
Route::prefix("admin")->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get("login", [AdminLogin::class, "index"])->name("login");
        Route::post("login", [AdminLogin::class, "store"]);
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name("admin.dashboard");

        Route::prefix("product")->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name("admin.product");
            Route::get('/create', [ProductController::class, 'create'])->name("admin.product.create");
            Route::post('/create', [ProductController::class, 'store'])->name("admin.product.store");
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name("admin.product.edit");
            Route::patch('/{product}/update', [ProductController::class, 'update'])->name("admin.product.update");
            Route::delete('/{product}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        });

        Route::prefix("category")->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name("admin.category");
            Route::get('/create', [CategoryController::class, 'create'])->name("admin.category.create");
            Route::post('/create', [CategoryController::class, 'store'])->name("admin.category.store");
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name("admin.category.edit");
            Route::post('/{category}/update', [CategoryController::class, 'update'])->name("admin.category.update");
            Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        Route::view('/orders', 'dashboard.orders')->name("admin.orders");

        Route::view('/customers', 'dashboard.customers')->name("admin.customers");

        Route::view('/reports', 'dashboard.reports')->name("admin.reports");

        Route::get('/logout', [AdminLogin::class, "logout"])->name("admin.logout");
    });
});