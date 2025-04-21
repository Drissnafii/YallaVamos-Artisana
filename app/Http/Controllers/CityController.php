<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;

class CityController extends BaseController
{
    /**
     * Ensure admin access
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the cities.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
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

        // Execute query with pagination
        $cities = $query->orderBy('name')->simplePaginate(10);

        return view('dashboard.admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new city.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.admin.cities.create');
    }

    /**
     * Store a newly created city in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cities', 'public');
            $validated['image'] = $imagePath;
        }

        City::create($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'City created successfully.');
    }

    /**
     * Display the specified city.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Contracts\View\View
     */
    public function show(City $city)
    {
        $city->load(['stadiums', 'accommodations', 'favoriteCities']);

        return view('dashboard.admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified city.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(City $city)
    {
        return view('dashboard.admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified city in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($city->image) {
                Storage::disk('public')->delete($city->image);
            }

            $imagePath = $request->file('image')->store('cities', 'public');
            $validated['image'] = $imagePath;
        }

        $city->update($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified city from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(City $city)
    {
        // Check if the city has associated stadiums or accommodations
        if ($city->stadiums()->exists()) {
            return redirect()->route('admin.cities.index')
                ->with('error', 'Cannot delete city because it has associated stadiums. Delete the stadiums first or move them to another city.');
        }

        if ($city->accommodations()->exists()) {
            return redirect()->route('admin.cities.index')
                ->with('error', 'Cannot delete city because it has associated accommodations. Delete the accommodations first or move them to another city.');
        }

        // Delete the city image if it exists
        if ($city->image) {
            Storage::disk('public')->delete($city->image);
        }

        // Actually delete the city
        $city->delete();

        return redirect()->route('admin.cities.index')
            ->with('success', 'City deleted successfully.');
    }
}
