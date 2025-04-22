<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\FavoriteCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberCitiesController extends Controller
{
    /**
     * Display a listing of the cities.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cities = City::with('stadiums')->get();

        // Get the IDs of cities favorited by the current user
        $favoriteCities = Auth::user()->favoriteCities()
            ->pluck('city_id')
            ->toArray();

        return view('member.cities.index', compact('cities', 'favoriteCities'));
    }

    /**
     * Display the specified city.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\View\View
     */
    public function show(City $city)
    {
        $city->load(['stadiums', 'accommodations']);

        // Check if this city is favorited by the user
        $isFavorite = Auth::user()->favoriteCities()
            ->where('city_id', $city->id)
            ->exists();

        return view('member.cities.show', compact('city', 'isFavorite'));
    }

    /**
     * Toggle favorite status for a city.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite(Request $request, City $city)
    {
        $userId = Auth::id();

        $favorite = FavoriteCity::where('user_id', $userId)
            ->where('city_id', $city->id)
            ->first();

        if ($favorite) {
            // If the city is already favorited, remove it
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // If the city is not favorited, add it
            FavoriteCity::create([
                'user_id' => $userId,
                'city_id' => $city->id
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
