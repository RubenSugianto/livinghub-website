<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Document;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // user test so no need to register again
        User::factory()->create([
            'name' => 'tester123',
            'username' => 'tester123',
            'email' => 'tester123@gmail.com',
            'gender' => 'male',
            'age' => 25,
            'phone' => '0851212341234',
            'password' => 'tester',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Nicola Liu',
            'username' => 'nicola123',
            'email' => 'nicola@gmail.com',
            'gender' => 'male',
            'age' => 25,
            'phone' => '081912837267',
            'password' => 'nicola',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Ruben Sugianto',
            'username' => 'ruben123',
            'email' => 'ruben@gmail.com',
            'gender' => 'male',
            'age' => 25,
            'phone' => '091827364019',
            'password' => 'ruben',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Admin LivingHub',
            'username' => 'admin123',
            'email' => 'admin123@gmail.com',
            'gender' => 'male',
            'age' => 18,
            'phone' => '098718271827',
            'password' => 'admin',
            'role' => 'admin',
        ]);

        // Property::factory(20)->create();

        // Document::factory(20)->create();

        Property::factory(20)
        ->create()
        ->each(function ($property) {
            // Link a document to each property and assign a user
            Document::factory()->create([
                'property_id' => $property->id, // Link the document to the property
                'user_id' => User::inRandomOrder()->first()->id, // Assign a random user to the document
            ]);
        });
    }
}
