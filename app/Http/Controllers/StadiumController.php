<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin \Illuminate\Routing\Controller
 * @method \Illuminate\Routing\ControllerMiddlewareOptions middleware(string|array $middleware, array $options = [])
 */
class StadiumController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware is already applied at the route level
    }

    /**
     * Display a listing of the stadiums.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Stadium::with('city');

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhereHas('city', function ($cityQuery) use ($search) {
                      $cityQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Execute query with pagination
        $stadiums = $query->orderBy('name')->paginate(10);

        return view('dashboard.admin.stadiums.index', compact('stadiums'));
    }

    /**
     * Show the form for creating a new stadium.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $cities = City::orderBy('name')->get();
        $selectedCityId = $request->input('city_id');
        
        return view('dashboard.admin.stadiums.create', compact('cities', 'selectedCityId'));
    }

    /**
     * Store a newly created stadium in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $messages = [
            'latitude.between' => 'Latitude must be between -90 and 90 degrees.',
            'latitude.regex' => 'Latitude must be a valid decimal number with up to 8 decimal places.',
            'longitude.between' => 'Longitude must be between -180 and 180 degrees.',
            'longitude.regex' => 'Longitude must be a valid decimal number with up to 8 decimal places.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'capacity' => 'required|integer|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 10),
            'status' => 'required|in:active,under_construction,renovation,inactive',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
                'regex:/^-?\d{1,2}(\.\d{1,8})?$/'
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
                'regex:/^-?\d{1,3}(\.\d{1,8})?$/'
            ],
        ], $messages);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stadiums', 'public');
            $validated['image'] = $imagePath;
        }

        try {
            Stadium::create($validated);
            
            // Check if we came from a city view
            if ($request->has('from_city')) {
                return redirect()->route('admin.cities.show', $validated['city_id'])
                    ->with('success', 'Stadium created successfully.');
            }
            
            return redirect()->route('admin.stadiums.index')
                ->with('success', 'Stadium created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create stadium: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified stadium.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Stadium $stadium)
    {
        $stadium->load('city');

        // Get upcoming matches
        $upcomingMatches = $stadium->upcomingMatches()->with(['team1', 'team2'])->get();

        // Basic stats
        $stats = (object) [
            'total_matches' => $stadium->matches()->count(),
            'upcoming_matches' => $upcomingMatches->count(),
        ];

        return view('dashboard.admin.stadiums.show', compact('stadium', 'upcomingMatches', 'stats'));
    }

    /**
     * Show the form for editing the specified stadium.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Stadium $stadium)
    {
        $cities = City::orderBy('name')->get();
        return view('dashboard.admin.stadiums.edit', compact('stadium', 'cities'));
    }

    /**
     * Update the specified stadium in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Stadium $stadium)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'capacity' => 'required|integer|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 10),
            'status' => 'required|in:active,under_construction,renovation,inactive',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($stadium->image) {
                Storage::disk('public')->delete($stadium->image);
            }

            $imagePath = $request->file('image')->store('stadiums', 'public');
            $validated['image'] = $imagePath;
        }

        $stadium->update($validated);

        return redirect()->route('admin.stadiums.index')
            ->with('success', 'Stadium updated successfully.');
    }

    /**
     * Remove the specified stadium from storage.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Stadium $stadium)
    {
        // Check if the stadium has associated matches
        $hasMatches = $stadium->matches()->exists();

        if ($hasMatches) {
            return redirect()->route('admin.stadiums.index')
                ->with('error', 'Cannot delete stadium because it has associated matches. Consider marking it as inactive instead.');
        }

        // Delete the stadium image if it exists
        if ($stadium->image) {
            Storage::disk('public')->delete($stadium->image);
        }

        $stadium->delete();

        return redirect()->route('admin.stadiums.index')
            ->with('success', 'Stadium deleted successfully.');
    }
}
