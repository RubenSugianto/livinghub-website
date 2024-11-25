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
            'user_id' => User::factory(),
            'name' => $this->faker->city . ' ' . $this->faker->randomElement(['Rumah', 'Apartemen']),
            'price' => $this->faker->numberBetween(1000000, 1000000000),
            'city' => $this->faker->city,
            'location' => $this->faker->state,
            'full_location' => $this->faker->streetAddress . ', ' . $this->faker->city . ', ' . $this->faker->state . ', ' . $this->faker->postcode,
            'description' => $this->faker->paragraph,
            'bedroom' => $this->faker->numberBetween(1, 5),
            'bathroom' => $this->faker->numberBetween(1, 5),
            'electricity' => $this->faker->numberBetween(100, 5000),
            'surfaceArea' => $this->faker->numberBetween(100, 5000),
            'buildingArea' => $this->faker->numberBetween(100, 5000),
            'status' => $this->faker->randomElement(['Dijual', 'Disewa']),
            'type' => $this->faker->randomElement(['Rumah', 'Apartemen']),
            'check' => $this->faker->randomElement(['Pending', 'Approved']),
            'published_at' => $this->faker->optional()->dateTime,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
