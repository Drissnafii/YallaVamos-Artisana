<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Routing\Controller as BaseController;

class AccommodationController extends BaseController
{
    /**
     * Ensure admin access
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the accommodations.
     */
    public function index(Request $request)
    {
        $query = Accommodation::with('city');
        $accommodations = Accommodation::with('city')->paginate(10);
        $cities = City::all(); // Add this line to get all cities

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('city', function ($cityQuery) use ($search) {
                      $cityQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $accommodations = $query->orderBy('name')->paginate(10);

        return view('dashboard.admin.accommodations.index', compact('accommodations', 'cities'));
    }

    /**
     * Show the form for creating a new accommodation.
     */
    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('dashboard.admin.accommodations.create', compact('cities'));
    }

    /**
     * Store a newly created accommodation in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:hotel,apartment,riad,guesthouse,other',
            'price_range' => 'required|string|in:budget,mid-range,luxury',
            'price_min' => 'required|numeric|min:0',
            'price_max' => 'required|numeric|min:0|gte:price_min',
            'city_id' => 'required|exists:cities,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('accommodations', 'public');
            $validated['image'] = $imagePath;
        }

        Accommodation::create($validated);

        return redirect()->route('admin.accommodations.index')
            ->with('success', 'Accommodation created successfully.');
    }

    /**
     * Display the specified accommodation.
     */
    public function show(Accommodation $accommodation)
    {
        $accommodation->load('city');
        return view('dashboard.admin.accommodations.show', compact('accommodation'));
    }

    /**
     * Show the form for editing the specified accommodation.
     */
    public function edit(Accommodation $accommodation)
    {
        $cities = City::orderBy('name')->get();
        return view('dashboard.admin.accommodations.edit', compact('accommodation', 'cities'));
    }

    /**
     * Update the specified accommodation in storage.
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:hotel,apartment,riad,guesthouse,other',
            'price_range' => 'required|string|in:budget,mid-range,luxury',
            'price_min' => 'required|numeric|min:0',
            'price_max' => 'required|numeric|min:0|gte:price_min',
            'city_id' => 'required|exists:cities,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($accommodation->image) {
                Storage::disk('public')->delete($accommodation->image);
            }

            $imagePath = $request->file('image')->store('accommodations', 'public');
            $validated['image'] = $imagePath;
        }

        $accommodation->update($validated);

        return redirect()->route('admin.accommodations.index')
            ->with('success', 'Accommodation updated successfully.');
    }

    /**
     * Remove the specified accommodation from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        // Delete the image if it exists
        if ($accommodation->image) {
            Storage::disk('public')->delete($accommodation->image);
        }

        $accommodation->delete();

        return redirect()->route('admin.accommodations.index')
            ->with('success', 'Accommodation deleted successfully.');
    }
}
