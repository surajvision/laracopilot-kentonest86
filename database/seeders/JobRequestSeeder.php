<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobRequest;

class JobRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobRequest::factory()->count(20)->create();
    }
}