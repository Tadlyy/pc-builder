<?php

namespace Database\Factories;

use App\Models\Build;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Build>
 */
class BuildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'total_price' => fake()->randomFloat(2, 500, 5000),
            'is_public' => false,
        ];
    }
}
