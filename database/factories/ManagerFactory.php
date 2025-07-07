<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => $this->faker->userName,
            'email' => fake()->unique()->safeEmail(),
            'role' => $this->faker->randomElement([3, 4]),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
