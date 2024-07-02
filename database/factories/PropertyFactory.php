<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->words(mt_rand(2, 3), true),
            'price' => $this->faker->randomFloat(2, 1000000, 1000000000), 
            'location' => $this->faker->address(),
            'description' => $this->faker->paragraph(),
            'bedroom' => $this->faker->numberBetween(1, 10),
            'bathroom' => $this->faker->numberBetween(1, 10),
            'electricity' => $this->faker->numberBetween(1000, 10000),
            'surfaceArea' => $this->faker->numberBetween(50, 500),
            'buildingArea' => $this->faker->numberBetween(50, 500),
            'status' => $this->faker->randomElement(['available', 'sold', 'rented']),
            'type' => $this->faker->randomElement(['house', 'apartment', 'condo']),
            'published_at' => $this->faker->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}