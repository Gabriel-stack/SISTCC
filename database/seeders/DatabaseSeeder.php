<?php

namespace Database\Seeders;

use App\Models\Manager;
use App\Models\Professor;
use App\Models\Student;
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
        ]);
        Student::updateOrcreate([
            'name' => 'yslandio',
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
        ]);

        $student = Student::factory()->count(30)->create();
        $professor = Professor::factory()->count(30)->create();

        Manager::updateOrcreate([
            'professor_id' => 1,
            'email' => 'gabriel.alves@ifsertao-pe.edu.br',
            'user_type' => 'professor',
            'password' => Hash::make('12345678'),
        ]);
        Manager::updateOrcreate([
            'professor_id' => 2,
            'email' => 'yslandio.souza@aluno.ifsertao-pe.edu.br',
            'user_type' => 'professor',
            'password' => Hash::make('12345678'),
        ]);

        $manager = Manager::factory()->make();
        $manager->professor_id = $professor->random()->id;
        $manager->save();

        $subject = Subject::factory()->count(1)->create();

        $tcc = Tcc::factory(30)->make()->each(function ($tcc) use ($subject, $professor, $student) {
            $tcc->student_id = $student->random()->id;
            $tcc->subject_id = $subject->random()->id;
            $tcc->professor_id = $professor->random()->id;
        });

        $tcc->each(function ($tcc) {
            Tcc::create($tcc->toArray());
        });

    }
}
