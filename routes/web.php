<?php
@include 'admin.php';

use App\Http\Controllers\User\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SessionController as UserLogin;
use App\Http\Controllers\User\RegisteredUserController as UserRegister;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController as UserProducts;
use App\Http\Controllers\User\CategoryController as UserCategory;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\User\WishlistController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', "index")->name('home');
    Route::get('/about', "about");
});

Route::controller(UserProducts::class)->group(function () {
    Route::get('/catalog', "index");
    Route::get('/product-overview/{slug}', "show")->name('product.show');
});

Route::get('api/search', [SearchController::class, 'search']);

Route::get('/category/{slug}', [UserCategory::class, 'show'])->name('category.show');

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

    Route::get('/checkout-address', [CheckoutController::class, 'showAddressPage'])->name('checkout.address.show');
    Route::post('/checkout-address', [CheckoutController::class, 'storeAddress'])->name('checkout.address.store');

    Route::get('/checkout-payment', [CheckoutController::class, 'showPaymentPage'])->name('checkout.payment.show');
    Route::post('/checkout-payment', [CheckoutController::class, 'storePayment'])->name('checkout.payment.store');

    Route::get('/checkout-review', [CheckoutController::class, 'showReviewPage'])->name('checkout.review');
    Route::post('/checkout-review', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
    Route::view('/checkout-confimation', 'user.checkout-confirmation')->name('checkout.confirmation');

    Route::get('/terms-condition', [PageController::class, 'show'])->name('terms&conditions');

    // Customer Account Routes
    Route::prefix('account')->middleware('auth:customer')->group(function () {
        Route::get('/profile', [CustomerController::class, 'profile'])->name('account.profile');
        Route::get('/orders', [CustomerController::class, 'orders'])->name('account.orders');
        Route::get('/profile/edit', [CustomerController::class, 'editProfile'])->name('account.profile.edit');
        Route::patch('/profile/update', [CustomerController::class, 'updateProfile'])->name('account.profile.update');
    });

    // Wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

Route::get("signup", [UserRegister::class, "create"]);
Route::post("signup", [UserRegister::class, "store"]);

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [HomeController::class, 'submit'])->name('contact.submit');