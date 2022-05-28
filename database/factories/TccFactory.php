<?php

namespace Database\Factories;

use App\Models\Advisor;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tcc>
 */
class TccFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'stage' => $this->faker->randomElement(['etapa 1', 'etapa 2', 'etapa 3']),
            'title' => $this->faker->sentence(),
            'theme' => $this->faker->words(5, true),
            'ethics_committee' => $this->faker->boolean(),
            'term_commitment' => $this->faker->sentence(),
            'date_claim' => $this->faker->dateTimeBetween(now(), '+4 months'),
        ];
    }
}
