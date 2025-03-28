<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Admin\StaticBlockController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Models\Contact;

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
            Route::get('/{product}', [ProductController::class, 'show'])->name("admin.product.show");
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name("admin.product.edit");
            Route::patch('/{product}/update', [ProductController::class, 'update'])->name("admin.product.update");
            Route::delete('/{product}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');
            
            // Trashed products routes
            Route::get('/trashed', [ProductController::class, 'trashed'])->name('admin.product.trashed');
            Route::patch('/trashed/{id}/restore', [ProductController::class, 'restore'])->name('admin.product.restore');
            Route::delete('/trashed/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('admin.product.force-delete');
        });

        Route::prefix("category")->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name("admin.category");
            Route::get('/create', [CategoryController::class, 'create'])->name("admin.category.create");
            Route::post('/create', [CategoryController::class, 'store'])->name("admin.category.store");
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name("admin.category.edit");
            Route::patch('/{category}/update', [CategoryController::class, 'update'])->name("admin.category.update");
            Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
            
            // Trashed categories routes
            Route::get('/trashed', [CategoryController::class, 'trashed'])->name('admin.category.trashed');
            Route::patch('/trashed/{id}/restore', [CategoryController::class, 'restore'])->name('admin.category.restore');
            Route::delete('/trashed/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('admin.category.force-delete');
        });

        Route::prefix("order")->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name("admin.orders");
            Route::get('/{order}', [OrderController::class, 'show'])->name("admin.order.show");
            Route::patch('/{order}/update', [OrderController::class, 'update'])->name("admin.order.update");
        });

        Route::get('/customers', [CustomerController::class,'index'])->name("admin.customers");

        Route::prefix('block')->group(function(){
            Route::get('/',[StaticBlockController::class,'index'])->name('admin.block');

            Route::get('/create',[StaticBlockController::class,'create'])->name('admin.block.create');
            Route::post('/create',[StaticBlockController::class,'store'])->name('admin.block.store');

            Route::get('/{slug}/edit',[StaticBlockController::class,'edit'])->name('admin.block.edit');
            Route::patch('/{slug}/update',[StaticBlockController::class,'update'])->name('admin.block.update');

            Route::delete('/{slug}/delete',[StaticBlockController::class,'destroy'])->name('admin.block.destroy');
        });

        Route::prefix('page')->group(function(){
            Route::get('/',[StaticPageController::class,'index'])->name('admin.page');

            Route::get('/create',[StaticPageController::class,'create'])->name('admin.page.create');
            Route::post('/create',[StaticPageController::class,'store'])->name('admin.page.store');

            Route::get('/{slug}/edit',[StaticPageController::class,'edit'])->name('admin.page.edit');
            Route::patch('/{slug}/update',[StaticPageController::class,'update'])->name('admin.page.update');

            Route::delete('/{slug}/delete',[StaticPageController::class,'destroy'])->name('admin.page.destroy');
        });

        Route::get('/reports', [DashboardController::class,'report'])->name("admin.reports");
        
        Route::get('/admin/contacts', function () {
            $contacts = Contact::latest()->get();
            return view('dashboard.contacts', compact('contacts'));
        })->name('admin.contacts');
        
        Route::get('/logout', [AdminLogin::class, "logout"])->name("admin.logout");
    });
});