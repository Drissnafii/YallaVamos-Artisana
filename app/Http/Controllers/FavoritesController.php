<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display the favorites page
     */
    public function index()
    {
        return view('pages.favorites.index');
    }
}
