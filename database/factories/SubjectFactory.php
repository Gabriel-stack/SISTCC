<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class' => $this->faker->word(),
            'class_code' => Str::random(5), 
            'start_date' => now(),
            'end_date' => $this->faker->dateTimeBetween('+4 months', '+5 months'),
            'situation' => $this->faker->randomElement(['ativa', 'encerrada']),
        ];
    }

}
