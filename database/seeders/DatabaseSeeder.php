<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin accounts first
        $this->call(AdminSeeder::class);
        
        // Seed settings
        $this->call(SettingSeeder::class);
        
        // Seed other data
        $this->call([
            UserSeeder::class,
            TaskSeeder::class,
            ApplicationSeeder::class,
            KycSeeder::class,
            TaskAssignmentSeeder::class,
            JobRequestSeeder::class,
        ]);
    }
}