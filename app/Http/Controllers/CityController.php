<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return view('cities');
    }

    public function show($city)
    {
        return view('cities', ['city' => $city]);
    }
} 