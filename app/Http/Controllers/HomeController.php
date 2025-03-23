<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\News;
use App\Models\Stadium;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $stadiums = Stadium::all();
        $news = News::all();
        return view('pages.home', compact('cities', 'stadiums', 'news'));
    }
}
