<?php

namespace Database\Seeders;

use App\Models\Advisor;
use App\Models\Professor;
use App\Models\Student;
use App\Models\StudentHistory;
use App\Models\Subject;
use App\Models\Tcc;
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
        Student::updateOrcreate([
            'name' => 'Gabriel',
            'email' => 'gabriel.alves@ifsertao-pe.edu.br',
            'password' => Hash::make('12345678'),
            // fill all the missing fields with the faker data
            'phone' => '11999999999',
            'missing_subjects' => 'missfagaeerqef fwer erqe',
            'semester_origin' => '1',
            'attended_count_tcc' => '0',
            'state' => 'SP',
            'city' => 'São Paulo',
            'district' => 'Vila Mariana',
            'street' => 'Rua dos Bobos',
            'zip_code' => '01234567',
            'status' => 'cursando',

        ]);
        Student::updateOrcreate([
            'name' => 'ysladio',
            'email' => 'yslandio.souza@aluno.ifsertao-pe.edu.br',
            'password' => Hash::make('12345678'),
            // fill all the missing fields with the faker data
            'phone' => '11999999999',
            'missing_subjects' => 'faf aarererqerq rqerqerqrq',
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
        Professor::updateOrcreate([
            'name' => 'yslandio',
            'email' => 'yslandio.souza@aluno.ifsertao-pe.edu.br',
            'password' => Hash::make('12345678'),
        ]);
       $subject = Subject::factory()->count(1)->create();
       $student = Student::factory()->count(30)->create();
        $advisor = Advisor::factory()->count(30)->create();
       $studentHistory =  StudentHistory::factory(30)->make()->each(function($history) use ($student, $subject) {
            $history->student_id = $student->random()->id;
            $history->subject_id = $subject->random()->id;
        });

        StudentHistory::insert($studentHistory->toArray());

        $tcc = Tcc::factory(5)->make()->each(function($tcc) use ($student, $advisor, $subject) {
            $tcc->student_id = $student->random()->id;
            $tcc->advisor_id = $advisor->random()->id;
            $tcc->subject_id = $subject->random()->id;
        });

        $tcc->each(function($tcc) {
             Tcc::create($tcc->toArray());
        });
        
    }
}

