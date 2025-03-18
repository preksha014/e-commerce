<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LoginController as AdminLogin;

use App\Http\Controllers\User\SessionController as UserLogin;
use App\Http\Controllers\User\RegisteredUserController as UserRegister;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController as UserProducts;
use App\Http\Controllers\User\CategoryController as UserCategory;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', "index");
    Route::get('/about', "about");
    Route::get('/contact', "contact");
});

Route::controller(UserProducts::class)->group(function () {
    Route::get('/catalog', "index");
    Route::get('/product-overview/{slug}', "show")->name('product.show');
});

Route::get('/category/{slug}', [UserCategory::class, 'show'])->name('category.show');
// Route::controller(Cate::class)->group(function () {
//     Route::get('/catalog', "index");
//     Route::get('/product-overview/{slug}', "show")->name('product.show');
// });

Route::view('/cart', 'user.cart');

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