<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use Faker\Factory as Faker;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing records from the table
        Teacher::truncate();

        // Create Faker instance
        $faker = Faker::create();

        // Generate 50 random dummy records
        for ($i = 0; $i < 50; $i++) {
            Teacher::create([
                'lastname' => $faker->lastName,
                'firstname' => $faker->firstName,
                'email' => $faker->email,
                'description' => $faker->jobTitle,
                'remarks' => $faker->sentence,
                'phone' => $faker->phoneNumber,
                'website' => $faker->url,
                'approved' => 1, // Set as approved by default
                'location_id' => $faker->numberBetween(1, 4), // Random location ID from 1 to 4
                'category_id' => $faker->numberBetween(1, 26), // Random category ID from 1 to 26
                'streetnr' => $faker->buildingNumber,
                'codecity' => $faker->randomElement(['Genk', 'Brussels', 'Leuven']), // Set to Genk, Brussels, or Leuven randomly
                // Add more fields as needed
            ]);
        }
    }
}
