<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main admin account
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@taskflow.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'active' => true,
        ]);

        // Create manager account
        Admin::create([
            'name' => 'Manager User',
            'email' => 'manager@taskflow.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
            'active' => true,
        ]);

        // Create supervisor account
        Admin::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@taskflow.com',
            'password' => Hash::make('supervisor123'),
            'role' => 'supervisor',
            'active' => true,
        ]);

        // Create additional admin users using factory
        Admin::factory()->count(5)->create();
    }
}