<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Professor::factory()->count(1)->create();
        Student::factory()->count(1)->create();
    }
}
