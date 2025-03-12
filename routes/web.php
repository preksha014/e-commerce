<?php

use Illuminate\Support\Facades\Route;

Route::view('/','user.home');
Route::view('/catalog','user.catalog');
Route::view('/about','user.about');
Route::view('/contact','user.contact');
Route::view('/login','user.login');
Route::view('/signup','user.signup');
Route::view('/cart','user.cart');
Route::view('/product-overview','user.product-overview');

Route::view('/checkout-address','user.checkout-address');
Route::view('/checkout-payment','user.checkout-payment');
Route::view('/checkout-review','user.checkout-review');
Route::view('/checkout-confirmation','user.checkout-confirmation');

Route::prefix('/dashboard')->group(function(){
    Route::view('/','dashboard.index');
    Route::view('/products','dashboard.products');
    Route::view('/orders','dashboard.orders');
    Route::view('/customers','dashboard.customers');
    Route::view('/reports','dashboard.reports');
    Route::view('/logout','dashboard.index');
});