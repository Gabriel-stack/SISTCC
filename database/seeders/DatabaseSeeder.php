<?php

namespace Database\Seeders;

use App\Models\Advisor;
use App\Models\Professor;
use App\Models\Student;
use App\Models\StudentHistory;
use App\Models\Subject;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Mockery\Matcher\Subset;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Student::updateOrcreate([
            'name' => 'Gabriel',
            'email' => 'gabriel.alves@ifsertao-pe.edu.br',
            'password' => Hash::make('12345678'),
            // fill all the missing fields with the faker data
            'phone' => '11999999999',
            'missing_subjects' => '',
            'semester_origin' => '1',
            'attended_count_tcc' => '0',
            'state' => 'SP',
            'city' => 'São Paulo',
            'district' => 'Vila Mariana',
            'street' => 'Rua dos Bobos',
            'zip_code' => '01234567',
            'status' => 'cursando',

        ]);
        Professor::updateOrcreate([
            'name' => 'Gabriel',
            'email' => 'gabriel.alves@ifsertao-pe.edu.br',
            'password' => Hash::make('12345678'),
        ]);
       Subject::factory()->count(30)->create();
       Student::factory()->count(30)->create();
        StudentHistory::factory()->count(30)->create();
        Advisor::factory()->count(30)->create();
       
    }
}

