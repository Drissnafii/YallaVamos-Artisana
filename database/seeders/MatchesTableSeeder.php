<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MatchesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get stadium IDs
        $azteca = DB::table('stadiums')->where('name', 'Estadio Azteca')->first()->id;
        $metlife = DB::table('stadiums')->where('name', 'MetLife Stadium')->first()->id;
        $sofi = DB::table('stadiums')->where('name', 'SoFi Stadium')->first()->id;
        $bmo = DB::table('stadiums')->where('name', 'BMO Field')->first()->id;
        $bcplace = DB::table('stadiums')->where('name', 'BC Place')->first()->id;

        // Get team IDs
        $brazil = DB::table('teams')->where('name', 'Brazil')->first()->id;
        $argentina = DB::table('teams')->where('name', 'Argentina')->first()->id;
        $france = DB::table('teams')->where('name', 'France')->first()->id;
        $germany = DB::table('teams')->where('name', 'Germany')->first()->id;
        $spain = DB::table('teams')->where('name', 'Spain')->first()->id;
        $england = DB::table('teams')->where('name', 'England')->first()->id;
        $portugal = DB::table('teams')->where('name', 'Portugal')->first()->id;
        $netherlands = DB::table('teams')->where('name', 'Netherlands')->first()->id;
        $mexico = DB::table('teams')->where('name', 'Mexico')->first()->id;
        $usa = DB::table('teams')->where('name', 'USA')->first()->id;

        $matches = [
            [
                'date' => Carbon::create(2026, 6, 11, 20, 0, 0),
                'stadium_id' => $azteca,
                'team1_id' => $mexico,
                'team2_id' => $usa,
                'score_team1' => null,
                'score_team2' => null,
                'status' => 'scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::create(2026, 6, 12, 17, 0, 0),
                'stadium_id' => $metlife,
                'team1_id' => $brazil,
                'team2_id' => $argentina,
                'score_team1' => null,
                'score_team2' => null,
                'status' => 'scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::create(2026, 6, 13, 20, 0, 0),
                'stadium_id' => $sofi,
                'team1_id' => $france,
                'team2_id' => $germany,
                'score_team1' => null,
                'score_team2' => null,
                'status' => 'scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::create(2026, 6, 14, 14, 0, 0),
                'stadium_id' => $bmo,
                'team1_id' => $spain,
                'team2_id' => $england,
                'score_team1' => null,
                'score_team2' => null,
                'status' => 'scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::create(2026, 6, 15, 17, 0, 0),
                'stadium_id' => $bcplace,
                'team1_id' => $portugal,
                'team2_id' => $netherlands,
                'score_team1' => null,
                'score_team2' => null,
                'status' => 'scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('matches')->insert($matches);
    }
} 