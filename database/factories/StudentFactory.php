<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber,
            'semester_origin' => $this->faker->numberBetween(1, 10),
            'attended_count_tcc' => $this->faker->numberBetween(1, 10),
            'missing_subjects'=> $this->faker->sentence(3),
            'street'=> $this->faker->streetName,
            'district'=> $this->faker->city,
            'city'=> $this->faker->city,
            'state'=> $this->faker->state,
            'zip_code'=> $this->faker->postcode,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
