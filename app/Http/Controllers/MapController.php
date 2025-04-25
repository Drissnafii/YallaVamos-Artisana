<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class MapController extends Controller
{
    /**
     * Display the interactive map page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Get a list of cities for the map (to be implemented later)
        $cities = City::all();

        return view('pages.map.interactive', compact('cities'));
    }
}
