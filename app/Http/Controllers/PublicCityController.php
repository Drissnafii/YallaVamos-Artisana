<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Check if the user is authenticated
        $isAuthenticated = Auth::check();

        // If not authenticated, limit to 3 cities
        if (!$isAuthenticated) {
            $cities = $query->orderBy('name')->take(3)->get();
            $showLoginMessage = true;
        } else {
            $cities = $query->orderBy('name')->paginate(10);
            $showLoginMessage = false;
        }

        return view('pages.cities.index', compact('cities', 'isAuthenticated', 'showLoginMessage'));
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
