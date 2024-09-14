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
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(1000000, 1000000000),
            'location' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'bedroom' => $this->faker->numberBetween(1, 5),
            'bathroom' => $this->faker->numberBetween(1, 5),
            'electricity' => $this->faker->numberBetween(100, 5000),
            'surfaceArea' => $this->faker->numberBetween(100, 5000),
            'buildingArea' => $this->faker->numberBetween(100, 5000),
            'status' => $this->faker->randomElement(['dijual', 'disewa']),
            'type' => $this->faker->randomElement(['rumah', 'apartemen']),
            'check' => 'Pending',
            'published_at' => $this->faker->optional()->dateTime,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
