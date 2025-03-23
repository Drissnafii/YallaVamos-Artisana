<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StadiumsController extends Controller
{
    /**
     * Display the stadiums listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Sample stadium data - in a real app, this would come from your database
        $stadiums = [
            [
                'id' => 1,
                'name' => 'Grand Stade de Casablanca',
                'image' => '/images/stadiums/casablanca.jpg',
                'city' => 'Casablanca',
                'description' => 'The largest stadium in Morocco, with a capacity of 93,000 spectators.'
            ],
            [
                'id' => 2,
                'name' => 'Stade Mohammed V',
                'image' => '/images/stadiums/mohammed-v.jpg',
                'city' => 'Casablanca',
                'description' => 'Historic stadium in the heart of Casablanca, renovated for the World Cup.'
            ],
            [
                'id' => 3,
                'name' => 'Stade de Marrakech',
                'image' => '/images/stadiums/marrakech.jpg',
                'city' => 'Marrakech',
                'description' => 'Modern stadium with a capacity of 45,000, featuring traditional Moroccan design elements.'
            ],
            [
                'id' => 4,
                'name' => 'Stade Ibn Batouta',
                'image' => '/images/stadiums/tangier.jpg',
                'city' => 'Tangier',
                'description' => 'Located in northern Morocco, this stadium offers views of the Mediterranean Sea.'
            ],
            [
                'id' => 5,
                'name' => 'Grand Stade de Fez',
                'image' => '/images/stadiums/fez.jpg',
                'city' => 'Fez',
                'description' => 'Newly constructed stadium combining modern amenities with traditional architecture.'
            ],
            [
                'id' => 6,
                'name' => 'Stade Adrar',
                'image' => '/images/stadiums/agadir.jpg',
                'city' => 'Agadir',
                'description' => 'Coastal stadium with excellent facilities and a capacity of 45,000 spectators.'
            ]
        ];

        return view('pages.stadiums.index', compact('stadiums'));
    }

    /**
     * Display a specific stadium.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // In a real app, I Should fetch this from my database !
        $stadiums = [
            1 => [
                'id' => 1,
                'name' => 'Grand Stade de Casablanca',
                'image' => '/images/stadiums/casablanca.jpg',
                'city' => 'Casablanca',
                'capacity' => '93,000',
                'description' => 'The largest stadium in Morocco, the Grand Stade de Casablanca will host the opening match and the final of the 2030 FIFA World Cup. This state-of-the-art facility features cutting-edge technology, excellent visibility from all seats, and a design inspired by traditional Moroccan architecture.',
                'facilities' => ['VIP Lounges', 'Restaurants', 'Shops', 'Museum', 'Guided Tours'],
                'transportation' => ['Metro', 'Bus', 'Taxi', 'Parking'],
                'matches' => [
                    ['date' => 'June 15, 2030', 'teams' => 'Morocco vs. Spain', 'type' => 'Opening Match'],
                    ['date' => 'July 15, 2030', 'teams' => 'TBD vs. TBD', 'type' => 'Final']
                ]
            ],
            // other stadiums ...
        ];

        // Check if the stadium exists
        if (!isset($stadiums[$id])) {
            abort(404);
        }

        $stadium = $stadiums[$id];

        return view('pages.stadiums.show', compact('stadium'));
    }
}
