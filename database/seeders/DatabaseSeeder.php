<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; // Import the Role model
use App\Models\Admin; // Import the Admin model
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role = Role::create([
            "name"  =>  "Super Admin",
            "is_super_admin"    =>  Role::STATUS_YES


        ]);

        Admin::create(
            [
                "name"  =>  "Admin",
                "email" =>  "admin@gmail.com",
                "password"  =>  Hash::make("Test@1234"),
                "role_id"   =>  $role->id
            ]
        );
    }
}
