<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchScheduleController extends Controller
{
    /**
     * Display the match schedule page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Create sample data for group matches
        // this gonna come from the database ...
        $groupMatches = [
            'June 15, 2030' => [
                [
                    'time' => '18:00',
                    'stadium' => 'Grand Stade de Casablanca',
                    'teams' => 'Morocco vs. Spain',
                    'group' => 'Group A'
                ],
                [
                    'time' => '21:00',
                    'stadium' => 'Stade Mohammed V',
                    'teams' => 'Brazil vs. Germany',
                    'group' => 'Group B'
                ]
            ],
            'June 16, 2030' => [
                [
                    'time' => '15:00',
                    'stadium' => 'Stade de Marrakech',
                    'teams' => 'France vs. Argentina',
                    'group' => 'Group C'
                ],
                [
                    'time' => '18:00',
                    'stadium' => 'Stade Ibn Batouta',
                    'teams' => 'England vs. Italy',
                    'group' => 'Group D'
                ]
            ],
            'June 17, 2030' => [
                [
                    'time' => '18:00',
                    'stadium' => 'Stade Adrar',
                    'teams' => 'Portugal vs. Netherlands',
                    'group' => 'Group E'
                ],
                [
                    'time' => '21:00',
                    'stadium' => 'Grand Stade de Fez',
                    'teams' => 'Belgium vs. Croatia',
                    'group' => 'Group F'
                ]
            ]
        ];

        // Pass the data to the view
        return view('pages.match-schedule.index', compact('groupMatches'));
    }

    /**
     * Display a specific match.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // In a real application, you would fetch the match by ID from your database
        $match = [
            'id' => $id,
            'date' => 'June 15, 2030',
            'time' => '18:00',
            'stadium' => 'Grand Stade de Casablanca',
            'teams' => 'Morocco vs. Spain',
            'group' => 'Group A',
            'status' => 'Upcoming',
            'description' => 'Opening match of the 2030 FIFA World Cup',
            'venue_details' => [
                'name' => 'Grand Stade de Casablanca',
                'capacity' => '93,000',
                'location' => 'Casablanca, Morocco',
                'image' => '/images/stadiums/casablanca.jpg'
            ]
        ];

        return view('pages.match-schedule.show', compact('match'));
    }
}
