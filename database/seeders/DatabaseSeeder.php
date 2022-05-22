<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Professor::create([
            'name' => 'Professor 1',
            'email' => 'gabriel.alves@ifsertao-pe.edu.br',
            'password' => Hash::make('12345678'),
        ]);
    }
}
