<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            [
                'name' => 'Mexico City',
                'description' => 'The capital and largest city of Mexico, known for its rich history and vibrant culture.',
                'image' => 'cities/mexico-city.jpg',
                'latitude' => 19.4326,
                'longitude' => -99.1332,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New York City',
                'description' => 'The most populous city in the United States and a global hub for culture and commerce.',
                'image' => 'cities/new-york.jpg',
                'latitude' => 40.7128,
                'longitude' => -74.0060,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Los Angeles',
                'description' => 'The entertainment capital of the world and second-largest city in the United States.',
                'image' => 'cities/los-angeles.jpg',
                'latitude' => 34.0522,
                'longitude' => -118.2437,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toronto',
                'description' => 'The largest city in Canada and a multicultural metropolis on Lake Ontario.',
                'image' => 'cities/toronto.jpg',
                'latitude' => 43.6532,
                'longitude' => -79.3832,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vancouver',
                'description' => 'A major city in western Canada, known for its stunning natural beauty.',
                'image' => 'cities/vancouver.jpg',
                'latitude' => 49.2827,
                'longitude' => -123.1207,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('cities')->insert($cities);
    }
} 