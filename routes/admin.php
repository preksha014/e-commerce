<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\StaticBlockController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\RoleController;

//Admin Routes
Route::prefix("admin")->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get("login", [AdminLogin::class, "index"])->name("login");
        Route::post("login", [AdminLogin::class, "store"]);
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name("admin.dashboard");

        Route::prefix("product")->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name("admin.product")->can('manage-products');
            Route::get('/create', [ProductController::class, 'create'])->name("admin.product.create")->can('manage-products');
            Route::post('/create', [ProductController::class, 'store'])->name("admin.product.store")->can('manage-products');
            // Trashed products routes
            Route::get('/trashed',[ProductController::class, 'trashed'])->name('admin.product.trashed')->can('manage-products');
            Route::patch('/trashed/{id}/restore', [ProductController::class, 'restore'])->name('admin.product.restore')->can('manage-products');
            Route::delete('/trashed/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('admin.product.force-delete')->can('manage-products');
            Route::get('/{product}', [ProductController::class, 'show'])->name("admin.product.show")->can('manage-products');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name("admin.product.edit")->can('manage-products');
            Route::patch('/{product}/update', [ProductController::class, 'update'])->name("admin.product.update")->can('manage-products');
            Route::delete('/{product}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy')->can('manage-products');   
        });

        Route::prefix("category")->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name("admin.category")->can('manage-categories');
            Route::get('/create', [CategoryController::class, 'create'])->name("admin.category.create")->can('manage-categories');
            Route::post('/create', [CategoryController::class, 'store'])->name("admin.category.store")->can('manage-categories');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name("admin.category.edit")->can('manage-categories');
            Route::patch('/{category}/update', [CategoryController::class, 'update'])->name("admin.category.update")->can('manage-categories');
            Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy')->can('manage-categories');
            
            // Trashed categories routes
            Route::get('/trashed', [CategoryController::class, 'trashed'])->name('admin.category.trashed')->can('manage-categories');
            Route::patch('/trashed/{id}/restore', [CategoryController::class, 'restore'])->name('admin.category.restore')->can('manage-categories');
            Route::delete('/trashed/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('admin.category.force-delete')->can('manage-categories');
        });

        Route::prefix("order")->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name("admin.orders")->can('manage-orders');
            Route::get('/{order}', [OrderController::class, 'show'])->name("admin.order.show")->can('manage-orders');
            Route::patch('/{order}/update', [OrderController::class, 'update'])->name("admin.order.update")->can('manage-orders');
        });

        Route::get('/customers', [CustomerController::class,'index'])->name("admin.customers")->can('manage-customers');

        Route::prefix('admins')->group(function(){
            Route::get('/',[AdminController::class,'index'])->name('admin.admins.index')->can('manage-admins');

            Route::get('/create',[AdminController::class,'create'])->name('admin.admins.create')->can('manage-admins');
            Route::post('/create',[AdminController::class,'store'])->name('admin.admins.store')->can('manage-admins');

            Route::get('/{admin}/edit',[AdminController::class,'edit'])->name('admin.admins.edit')->can('manage-admins');
            Route::patch('/{admin}/update',[AdminController::class,'update'])->name('admin.admins.update')->can('manage-admins');

            Route::delete('/{admin}/delete',[AdminController::class,'destroy'])->name('admin.admins.destroy')->can('manage-admins');
        });

        Route::prefix('role')->group(function(){
            Route::get('/',[RoleController::class,'index'])->name('admin.role')->can('manage-roles');

            Route::get('/create',[RoleController::class,'create'])->name('admin.role.create')->can('manage-roles');
            Route::post('/create',[RoleController::class,'store'])->name('admin.role.store')->can('manage-roles');

            Route::get('/{role}/edit',[RoleController::class,'edit'])->name('admin.role.edit')->can('manage-roles');
            Route::patch('/{role}/update',[RoleController::class,'update'])->name('admin.role.update')->can('manage-roles');

            Route::delete('/{role}/delete',[RoleController::class,'destroy'])->name('admin.role.destroy')->can('manage-roles');
        });
        
        Route::prefix('permission')->group(function(){
            Route::get('/',[PermissionController::class,'index'])->name('admin.permission')->can('manage-permissions');

            Route::get('/create',[PermissionController::class,'create'])->name('admin.permission.create')->can('manage-permissions');
            Route::post('/create',[PermissionController::class,'store'])->name('admin.permission.store')->can('manage-permissions');

            Route::get('/{permission}/edit',[PermissionController::class,'edit'])->name('admin.permission.edit')->can('manage-permissions');
            Route::patch('/{permission}/update',[PermissionController::class,'update'])->name('admin.permission.update')->can('manage-permissions');

            Route::delete('/{permission}/delete',[PermissionController::class,'destroy'])->name('admin.permission.destroy')->can('manage-permissions');
        });

        Route::prefix('block')->group(function(){
            Route::get('/',[StaticBlockController::class,'index'])->name('admin.block')->can('manage-static-blocks');

            Route::get('/create',[StaticBlockController::class,'create'])->name('admin.block.create')->can('manage-static-blocks');
            Route::post('/create',[StaticBlockController::class,'store'])->name('admin.block.store')->can('manage-static-blocks');

            Route::get('/{slug}/edit',[StaticBlockController::class,'edit'])->name('admin.block.edit')->can('manage-static-blocks');
            Route::patch('/{slug}/update',[StaticBlockController::class,'update'])->name('admin.block.update')->can('manage-static-blocks');

            Route::delete('/{slug}/delete',[StaticBlockController::class,'destroy'])->name('admin.block.destroy')->can('manage-static-blocks');
        });

        Route::prefix('page')->group(function(){
            Route::get('/',[StaticPageController::class,'index'])->name('admin.page')->can('manage-static-pages');

            Route::get('/create',[StaticPageController::class,'create'])->name('admin.page.create')->can('manage-static-pages');
            Route::post('/create',[StaticPageController::class,'store'])->name('admin.page.store')->can('manage-static-pages');

            Route::get('/{slug}/edit',[StaticPageController::class,'edit'])->name('admin.page.edit')->can('manage-static-pages');
            Route::patch('/{slug}/update',[StaticPageController::class,'update'])->name('admin.page.update')->can('manage-static-pages');

            Route::delete('/{slug}/delete',[StaticPageController::class,'destroy'])->name('admin.page.destroy')->can('manage-static-pages');
        });

        Route::get('/reports', [DashboardController::class,'report'])->name("admin.reports");
        
        Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts')->can('manage-contacts');
        
        Route::get('/logout', [AdminLogin::class, "logout"])->name("admin.logout");
    });
});