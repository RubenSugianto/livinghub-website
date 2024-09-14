<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
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
            'fullname' => 'tester123',
            'username' => 'tester123',
            'email' => 'tester123@gmail.com',
            'gender' => 'male',
            'age' => 25,
            'phone' => '0851212341234',
            'password' => 'tester',
            'role' => 'user',
        ]);

        Property::factory(20)->create();
    }
}
