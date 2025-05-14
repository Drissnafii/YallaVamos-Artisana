<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StadiumsTableSeeder extends Seeder
{
    public function run(): void
    {
        // First get city IDs
        $mexicoCity = DB::table('cities')->where('name', 'Mexico City')->first()->id;
        $newYork = DB::table('cities')->where('name', 'New York City')->first()->id;
        $losAngeles = DB::table('cities')->where('name', 'Los Angeles')->first()->id;
        $toronto = DB::table('cities')->where('name', 'Toronto')->first()->id;
        $vancouver = DB::table('cities')->where('name', 'Vancouver')->first()->id;

        $stadiums = [
            [
                'name' => 'Estadio Azteca',
                'city_id' => $mexicoCity,
                'address' => 'Calz. de Tlalpan 3465, Sta. Úrsula Coapa, Coyoacán, 04650',
                'capacity' => 87523,
                'image' => 'stadiums/azteca.jpg',
                'description' => 'The largest stadium in Mexico and the first to host two FIFA World Cup Finals.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MetLife Stadium',
                'city_id' => $newYork,
                'address' => '1 MetLife Stadium Dr, East Rutherford, NJ 07073',
                'capacity' => 82500,
                'image' => 'stadiums/metlife.jpg',
                'description' => 'Home to the New York Giants and Jets, selected to host the 2026 FIFA World Cup Final.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SoFi Stadium',
                'city_id' => $losAngeles,
                'address' => '1001 Stadium Dr, Inglewood, CA 90301',
                'capacity' => 70240,
                'image' => 'stadiums/sofi.jpg',
                'description' => 'One of the most technologically advanced stadiums in the world.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BMO Field',
                'city_id' => $toronto,
                'address' => '170 Princes\' Blvd, Toronto, ON M6K 3C3',
                'capacity' => 30991,
                'image' => 'stadiums/bmo.jpg',
                'description' => 'Home to Toronto FC and the Canadian national soccer team.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BC Place',
                'city_id' => $vancouver,
                'address' => '777 Pacific Blvd, Vancouver, BC V6B 4Y8',
                'capacity' => 54500,
                'image' => 'stadiums/bcplace.jpg',
                'description' => 'Multi-purpose stadium with a retractable roof system.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('stadiums')->insert($stadiums);
    }
} 