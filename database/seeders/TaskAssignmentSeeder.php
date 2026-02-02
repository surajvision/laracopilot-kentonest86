<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskAssignment;

class TaskAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskAssignment::factory()->count(60)->create();
    }
}