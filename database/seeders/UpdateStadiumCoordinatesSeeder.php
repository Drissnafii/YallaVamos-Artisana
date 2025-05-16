<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateStadiumCoordinatesSeeder extends Seeder
{
    /**
     * Run the database seeds to update stadium coordinates.
     *
     * @return void
     */
    public function run()
    {
        $stadiums = [
            'Estadio Azteca' => [
                'latitude' => 19.3030252,
                'longitude' => -99.1512398
            ],
            'MetLife Stadium' => [
                'latitude' => 40.8135064,
                'longitude' => -74.0758249
            ],
            'SoFi Stadium' => [
                'latitude' => 33.9534809,
                'longitude' => -118.3383965
            ],
            'BMO Field' => [
                'latitude' => 43.6332393,
                'longitude' => -79.4199422
            ],
            'BC Place' => [
                'latitude' => 49.2765592,
                'longitude' => -123.1119445
            ]
        ];

        foreach ($stadiums as $name => $coordinates) {
            DB::table('stadiums')
                ->where('name', $name)
                ->update($coordinates);
        }

        $this->command->info('Stadium coordinates updated successfully!');
    }
}
