<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    /**
     * Display a listing of the teams.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Team::withCount(['homeMatches', 'awayMatches']);

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by group
        if ($request->has('group') && $request->input('group')) {
            $query->where('group', $request->input('group'));
        }

        // Execute query with pagination
        $teams = $query->orderBy('name')->paginate(12);

        return view('dashboard.admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.admin.teams.create');
    }

    /**
     * Store a newly created team in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams',
            'code' => 'required|string|max:3|min:2|unique:teams',
            'description' => 'nullable|string',
            'group' => 'nullable|string|max:1',
            'is_qualified' => 'boolean',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the flag upload
        if ($request->hasFile('flag')) {
            $flagPath = $request->file('flag')->store('teams', 'public');
            $validated['flag'] = $flagPath;
        }

        Team::create($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified team.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Team $team)
    {
        return view('dashboard.admin.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified team.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Team $team)
    {
        return view('dashboard.admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified team in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('teams')->ignore($team->id)],
            'code' => ['required', 'string', 'max:3', 'min:2', Rule::unique('teams')->ignore($team->id)],
            'description' => 'nullable|string',
            'group' => 'nullable|string|max:1',
            'is_qualified' => 'boolean',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the flag upload
        if ($request->hasFile('flag')) {
            // Delete old flag if exists
            if ($team->flag) {
                Storage::disk('public')->delete($team->flag);
            }

            $flagPath = $request->file('flag')->store('teams', 'public');
            $validated['flag'] = $flagPath;
        }

        $team->update($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team updated successfully.');
    }

    /**
     * Remove the specified team from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Team $team)
    {
        // Check if the team has associated matches
        $hasMatches = $team->homeMatches()->exists() || $team->awayMatches()->exists();

        if ($hasMatches) {
            return redirect()->route('admin.teams.index')
                ->with('error', 'Cannot delete team because it has associated matches. Consider removing the matches first.');
        }

        // Check for favorite teams
        if ($team->favoriteTeams()->exists()) {
            return redirect()->route('admin.teams.index')
                ->with('error', 'Cannot delete team because users have saved it as a favorite.');
        }

        // Delete the team flag if it exists
        if ($team->flag) {
            Storage::disk('public')->delete($team->flag);
        }

        $team->delete();

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team deleted successfully.');
    }
}
