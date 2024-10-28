<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Property;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
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
            'property_id' => Property::factory(),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['SHM', 'SHGB', 'SHGU', 'Hak Pakai']),
            'status' => $this->faker->randomElement(['Not Uploaded', 'Pending', 'Verified', 'Rejected']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
