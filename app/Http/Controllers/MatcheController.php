<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MatchX;
use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Http\Request;

class MatcheController extends Controller
{
    /**
     * Display a listing of the matches.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = MatchX::with(['stadium', 'team1', 'team2']);

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('team1', function ($teamQuery) use ($search) {
                      $teamQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('team2', function ($teamQuery) use ($search) {
                      $teamQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('stadium', function ($stadiumQuery) use ($search) {
                      $stadiumQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->input('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by stadium
        if ($request->has('stadium') && $request->input('stadium')) {
            $query->where('stadium_id', $request->input('stadium'));
        }

        // Get stadiums for filter dropdown
        $stadiums = Stadium::orderBy('name')->get();

        // Execute query with pagination
        $matches = $query->orderBy('date', 'desc')->paginate(10);

        return view('dashboard.admin.matches.index', compact('matches', 'stadiums'));
    }

    /**
     * Show the form for creating a new match.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $stadiums = Stadium::where('status', 'active')->orderBy('name')->get();
        $teams = Team::orderBy('name')->get();

        return view('dashboard.admin.matches.create', compact('stadiums', 'teams'));
    }

    /**
     * Store a newly created match in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'stadium_id' => 'required|exists:stadiums,id',
            'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled',
            'score_team1' => 'nullable|integer|min:0',
            'score_team2' => 'nullable|integer|min:0',
        ]);

        // Only include scores if the match is in progress or completed
        if ($validated['status'] !== 'in_progress' && $validated['status'] !== 'completed') {
            $validated['score_team1'] = null;
            $validated['score_team2'] = null;
        }

        $match = MatchX::create($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match scheduled successfully.');
    }

    /**
     * Display the specified match.
     *
     * @param  \App\Models\MatchX  $match
     * @return \Illuminate\Contracts\View\View
     */
    public function show(MatchX $match)
    {
        $match->load(['stadium', 'stadium.city', 'team1', 'team2']);

        return view('dashboard.admin.matches.show', compact('match'));
    }

    /**
     * Show the form for editing the specified match.
     *
     * @param  \App\Models\MatchX  $match
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(MatchX $match)
    {
        $stadiums = Stadium::orderBy('name')->get();
        $teams = Team::orderBy('name')->get();

        return view('dashboard.admin.matches.edit', compact('match', 'stadiums', 'teams'));
    }

    /**
     * Update the specified match in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchX  $match
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, MatchX $match)
    {
        // If we're just changing status (from quick actions)
        if ($request->has('status') && count($request->all()) === 3) { // status + _token + _method
            $validated = $request->validate([
                'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled',
            ]);

            $match->update($validated);

            return redirect()->route('admin.matches.show', $match)
                ->with('success', 'Match status updated successfully.');
        }

        // Full update
        $validated = $request->validate([
            'date' => 'required|date',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'stadium_id' => 'required|exists:stadiums,id',
            'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled',
            'score_team1' => 'nullable|integer|min:0',
            'score_team2' => 'nullable|integer|min:0',
        ]);

        // Only include scores if the match is in progress or completed
        if ($validated['status'] !== 'in_progress' && $validated['status'] !== 'completed') {
            $validated['score_team1'] = null;
            $validated['score_team2'] = null;
        }

        $match->update($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match updated successfully.');
    }

    /**
     * Remove the specified match from storage.
     *
     * @param  \App\Models\MatchX  $match
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MatchX $match)
    {
        // Check if the match has associated favorite_matches
        if ($match->favoriteMatches()->exists()) {
            return redirect()->route('admin.matches.index')
                ->with('error', 'Cannot delete this match because users have saved it as a favorite. Consider marking it as cancelled instead.');
        }

        $match->delete();

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match deleted successfully.');
    }
}
