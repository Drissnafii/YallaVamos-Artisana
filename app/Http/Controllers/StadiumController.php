<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StadiumController extends Controller
{
    public function index()
    {
        return view('pages.stadiums');
    }

    public function show($stadium)
    {
        return view('stadiums', ['stadium' => $stadium]);
    }
}
