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
        return view('pages.favorites.index');
    }

    /**
     * Display member's favorites
     */
    public function memberIndex()
    {
        $user = Auth::user();

        // Get all favorite items for the authenticated user using the proper relationships
        // For cities, get them through FavoriteCity
        $favoriteCityIds = FavoriteCity::where('user_id', $user->id)->pluck('city_id');
        $favoriteCities = City::whereIn('id', $favoriteCityIds)->get();

        // For stadiums, get them through FavoriteStadium
        $favoriteStadiumIds = FavoriteStadium::where('user_id', $user->id)->pluck('stadium_id');
        $favoriteStadiums = Stadium::whereIn('id', $favoriteStadiumIds)->get();

        // For teams, get them through FavoriteTeam
        $favoriteTeamIds = FavoriteTeam::where('user_id', $user->id)->pluck('team_id');
        $favoriteTeams = Team::whereIn('id', $favoriteTeamIds)->get();

        // For matches, get them through FavoriteMatch
        $favoriteMatchIds = FavoriteMatch::where('user_id', $user->id)->pluck('match_id');
        $favoriteMatches = MatchX::whereIn('id', $favoriteMatchIds)
                           ->with(['team1', 'team2', 'stadium.city'])
                           ->get();

        // Count all favorites
        $favoriteCount = $favoriteCities->count() + $favoriteStadiums->count() +
                         $favoriteTeams->count() + $favoriteMatches->count();

        return view('member.favorites.index', compact(
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

        // Get favorite match IDs first
        $favoriteMatchIds = FavoriteMatch::where('user_id', $user->id)->pluck('match_id');

        // Then get the actual matches with their related data
        // Explicitly specify attributes to include flag data
        $favoriteMatches = MatchX::whereIn('id', $favoriteMatchIds)
                          ->with(['team1:id,name,flag,code', 'team2:id,name,flag,code', 'stadium.city'])
                          ->get();

        return view('member.favorites.matches', compact('favoriteMatches'));
    }

    /**
     * Display member's favorite cities
     */
    public function memberCities()
    {
        $user = Auth::user();

        // Get favorite city IDs first
        $favoriteCityIds = FavoriteCity::where('user_id', $user->id)->pluck('city_id');

        // Then get the actual cities with their related stadiums
        $favoriteCities = City::whereIn('id', $favoriteCityIds)
                          ->with('stadiums')
                          ->get();

        return view('member.favorites.cities', compact('favoriteCities'));
    }

    /**
     * Display member's favorite stadiums
     */
    public function memberStadiums()
    {
        $user = Auth::user();

        // Get favorite stadium IDs first
        $favoriteStadiumIds = FavoriteStadium::where('user_id', $user->id)->pluck('stadium_id');

        // Then get the actual stadiums with their related city and matches
        $favoriteStadiums = Stadium::whereIn('id', $favoriteStadiumIds)
                            ->with(['city', 'matches' => function($query) {
                                $query->where('date', '>=', now()->startOfDay())
                                      ->orderBy('date', 'asc');
                            }])
                            ->get();

        // Add a property to each stadium with just the upcoming matches
        foreach ($favoriteStadiums as $stadium) {
            $stadium->upcomingMatches = $stadium->matches->filter(function($match) {
                return $match->date >= now()->startOfDay();
            });
        }

        return view('member.favorites.stadiums', compact('favoriteStadiums'));
    }
}
