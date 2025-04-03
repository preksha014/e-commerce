<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;

class AuthorizeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(function (Admin $admin) {
            return $admin->isSuperAdmin() ? true : null;
        });

        Gate::define('manage-products', function (Admin $admin) {
            return $admin->hasPermission('manage-products');
        });
        Gate::define('manage-categories', function (Admin $admin) {
            return $admin->hasPermission('manage-categories');
        });
        Gate::define('manage-orders', function (Admin $admin) {
            return $admin->hasPermission('manage-orders');
        });
        Gate::define('manage-contacts', function (Admin $admin) {
            return $admin->hasPermission('manage-contacts');
        });
        Gate::define('manage-static-blocks', function (Admin $admin) {
            return $admin->hasPermission('manage-static-blocks');
        });
        Gate::define('manage-static-pages', function (Admin $admin) {
            return $admin->hasPermission('manage-static-pages');
        });
        Gate::define('manage-admins', function (Admin $admin) {
            return $admin->hasPermission('manage-admins');
        });
        Gate::define('manage-roles', function (Admin $admin) {
            return $admin->hasPermission('manage-roles');
        });
        Gate::define('manage-permissions', function (Admin $admin) {
            return $admin->hasPermission('manage-permissions');
        });
        Gate::define('manage-customers', function (Admin $admin) {
            return $admin->hasPermission('manage-customers');
        });
        
    }
}