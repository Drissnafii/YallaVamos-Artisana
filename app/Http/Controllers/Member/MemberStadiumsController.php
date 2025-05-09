<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Stadium;
use App\Models\FavoriteStadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberStadiumsController extends Controller
{
    /**
     * Display a listing of the stadiums.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stadiums = Stadium::with(['city', 'matches'])->get();

        // Get the IDs of stadiums favorited by the current user
        $favoriteStadiums = FavoriteStadium::where('user_id', Auth::id())
            ->pluck('stadium_id')
            ->toArray();

        return view('member.stadiums.index', compact('stadiums', 'favoriteStadiums'));
    }

    /**
     * Display the specified stadium.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\View\View
     */
    public function show(Stadium $stadium)
    {
        $stadium->load(['city', 'matches.team1', 'matches.team2']);

        // Check if this stadium is favorited by the user
        $isFavorite = FavoriteStadium::where('user_id', Auth::id())
            ->where('stadium_id', $stadium->id)
            ->exists();

        // Get upcoming matches at this stadium
        $upcomingMatches = $stadium->matches()
            ->with(['team1', 'team2'])
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->get();

        return view('member.stadiums.show', compact('stadium', 'isFavorite', 'upcomingMatches'));
    }

    /**
     * Toggle favorite status for a stadium.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite(Request $request, Stadium $stadium)
    {
        $userId = Auth::id();

        $favorite = FavoriteStadium::where('user_id', $userId)
            ->where('stadium_id', $stadium->id)
            ->first();

        if ($favorite) {
            // If the stadium is already favorited, remove it
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // If the stadium is not favorited, add it
            FavoriteStadium::create([
                'user_id' => $userId,
                'stadium_id' => $stadium->id
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
