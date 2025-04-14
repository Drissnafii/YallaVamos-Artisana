<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class PublicCityController extends Controller
{
    /**
     * Display a public listing of the cities.
     */
    public function index(Request $request)
    {
        $query = City::with(['stadiums', 'accommodations']);

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $cities = $query->orderBy('name')->paginate(10);

        return view('pages.cities.index', compact('cities'));
    }

    /**
     * Display the specified city.
     */
    public function show(City $city)
    {
        $city->load(['stadiums', 'accommodations']);

        return view('pages.cities.show', compact('city'));
    }
}
