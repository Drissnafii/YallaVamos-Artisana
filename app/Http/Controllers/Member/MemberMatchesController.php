<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MatchX;
use App\Models\FavoriteMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMatchesController extends Controller
{
    /**
     * Display a listing of matches for members with enhanced features
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $matches = MatchX::with(['stadium', 'homeTeam', 'awayTeam'])
            ->orderBy('match_date')
            ->get();
        $favoriteMatches = Auth::user()->favoriteMatches->pluck('match_id')->toArray();

        return view('member.matches.index', compact('matches', 'favoriteMatches'));
    }

    /**
     * Display the specified match with member-specific information
     *
     * @param  \App\Models\MatchX  $match
     * @return \Illuminate\View\View
     */
    public function show(MatchX $match)
    {
        $match->load(['stadium.city', 'homeTeam', 'awayTeam']);
        $isFavorite = Auth::user()->favoriteMatches()->where('match_id', $match->id)->exists();

        // Getting nearby accommodations in the same city as the stadium
        $nearbyAccommodations = $match->stadium->city->accommodations ?? collect([]);

        return view('member.matches.show', compact('match', 'isFavorite', 'nearbyAccommodations'));
    }

    /**
     * Toggle favorite status for a match
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchX  $match
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite(Request $request, MatchX $match)
    {
        $user = Auth::user();
        $exists = $user->favoriteMatches()->where('match_id', $match->id)->exists();

        if ($exists) {
            $user->favoriteMatches()->where('match_id', $match->id)->delete();
            $status = 'removed';
        } else {
            FavoriteMatch::create([
                'user_id' => $user->id,
                'match_id' => $match->id,
            ]);
            $status = 'added';
        }

        return response()->json([
            'status' => $status,
            'message' => $status === 'added' ? 'Match added to favorites.' : 'Match removed from favorites.',
        ]);
    }
}
