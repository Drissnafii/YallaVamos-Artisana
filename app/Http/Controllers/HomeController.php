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
        // Limit to 3 items for each category
        $cities = City::take(3)->get();
        $stadiums = Stadium::take(3)->get();
        $news = News::latest()->take(3)->get();
        return view('pages.home', compact('cities', 'stadiums', 'news'));
    }
}
