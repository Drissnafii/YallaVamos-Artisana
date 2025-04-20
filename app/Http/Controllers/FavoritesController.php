<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteCity;
use App\Models\FavoriteStadium;
use App\Models\FavoriteTeam;
use App\Models\FavoriteMatch;
use App\Models\City;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\MatchX;

class FavoritesController extends Controller
{
    /**
     * Display all favorites for public access.
     */
    public function index()
    {
        // Implementation for the public favorites page
        return view('favorites.index');
    }

    /**
     * Display member's favorites
     */
    public function memberIndex()
    {
        $user = Auth::user();

        // Get all favorite items for the authenticated user
        $favoriteCities = FavoriteCity::where('user_id', $user->id)->with('city')->get();
        $favoriteStadiums = FavoriteStadium::where('user_id', $user->id)->with('stadium')->get();
        $favoriteTeams = FavoriteTeam::where('user_id', $user->id)->with('team')->get();
        $favoriteMatches = FavoriteMatch::where('user_id', $user->id)->with('match')->get();

        // Count all favorites
        $favoriteCount = $favoriteCities->count() + $favoriteStadiums->count() +
                         $favoriteTeams->count() + $favoriteMatches->count();

        return view('dashboard.member.favorites.index', compact(
            'favoriteCities',
            'favoriteStadiums',
            'favoriteTeams',
            'favoriteMatches',
            'favoriteCount'
        ));
    }

    /**
     * Display member's favorite matches
     */
    public function memberMatches()
    {
        $user = Auth::user();

        // Get favorite matches for the authenticated user
        $favoriteMatches = FavoriteMatch::where('user_id', $user->id)->with('match')->get();

        // Extract the match models
        $matches = $favoriteMatches->pluck('match');

        // Get upcoming matches (those with dates in the future)
        $upcomingMatches = $matches->filter(function($match) {
            return $match && $match->date >= now()->startOfDay();
        })->sortBy('date');

        return view('dashboard.member.favorites.matches', compact('upcomingMatches'));
    }
}
