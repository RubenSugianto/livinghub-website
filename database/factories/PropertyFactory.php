<?php
// database/factories/PropertyFactory.php
namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(1000000, 100000000),
            'location' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'bedroom' => $this->faker->numberBetween(1, 10),
            'bathroom' => $this->faker->numberBetween(1, 5),
            'electricity' => $this->faker->numberBetween(100, 1000),
            'surfaceArea' => $this->faker->numberBetween(50, 500),
            'buildingArea' => $this->faker->numberBetween(50, 500),
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'published_at' => now(),
        ];
    }
}
