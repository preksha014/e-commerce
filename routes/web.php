<?php
@include 'admin.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SessionController as UserLogin;
use App\Http\Controllers\User\RegisteredUserController as UserRegister;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController as UserProducts;
use App\Http\Controllers\User\CategoryController as UserCategory;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\CheckoutController;

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

// Route::get('/checkout-address', [CheckoutController::class, 'index']);
Route::view('/checkout-payment', 'user.checkout-payment');
// Route::view('/checkout-review', 'user.checkout-review');
// Route::view('/checkout-confirmation', 'user.checkout-confirmation');

Route::middleware('guest:customer')->group(function () {
    Route::get("login", [UserLogin::class, "index"])->name('customer.login');
    Route::post("login", [UserLogin::class, "store"]);
});

Route::middleware('auth:customer')->group(function () {
    Route::get("logout", [UserLogin::class, "logout"]);
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add/{slug}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/update/{slug}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{slug}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout-address', [CheckoutController::class, 'address_create'])->name('checkout.address.create');
    Route::post('/checkout-address', [CheckoutController::class, 'address_store'])->name('checkout.address.store');
    Route::get('/checkout-payment', [CheckoutController::class, 'payment_create'])->name('checkout.payment.create');
    //Route::post('/checkout-payment', [CheckoutController::class, 'payment_store'])->name('checkout.payment.store');
    Route::get('/checkout-review', [CheckoutController::class, 'review'])->name('checkout.review');
    //Route::post('/checkout/store/{slug}', [CheckoutController::class, 'order_store'])->name('order.store');

    Route::get('/checkout-confirmation', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

Route::get("signup", [UserRegister::class, "create"]);
Route::post("signup", [UserRegister::class, "store"]);
