<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('pages.cities.index', compact('cities'));
    }

    public function show($city)
    {
        $city = City::findOrFail($city);
        return view('pages.cities.show', compact('city'));
    }
}
