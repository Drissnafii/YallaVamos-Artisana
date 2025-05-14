<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Brazil',
                'group' => 'A',
                'flag' => 'flags/brazil.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Argentina',
                'group' => 'A',
                'flag' => 'flags/argentina.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'France',
                'group' => 'B',
                'flag' => 'flags/france.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Germany',
                'group' => 'B',
                'flag' => 'flags/germany.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spain',
                'group' => 'C',
                'flag' => 'flags/spain.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'England',
                'group' => 'C',
                'flag' => 'flags/england.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Portugal',
                'group' => 'D',
                'flag' => 'flags/portugal.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Netherlands',
                'group' => 'D',
                'flag' => 'flags/netherlands.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mexico',
                'group' => 'E',
                'flag' => 'flags/mexico.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'USA',
                'group' => 'E',
                'flag' => 'flags/usa.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('teams')->insert($teams);
    }
} 