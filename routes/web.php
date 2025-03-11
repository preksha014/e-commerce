<?php

use Illuminate\Support\Facades\Route;

Route::view('/','user.home');
Route::view('/catalog','user.catalog');
Route::view('/about','user.about');
Route::view('/contact','user.contact');
Route::view('/login','user.login');
Route::view('/signup','user.signup');
Route::view('/cart','user.cart');