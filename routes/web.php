<?php
@include 'admin.php';

use Illuminate\Support\Facades\Route;
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
