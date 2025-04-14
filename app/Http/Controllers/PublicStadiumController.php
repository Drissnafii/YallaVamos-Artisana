<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;

class PublicStadiumController extends Controller
{
    /**
     * Display a public listing of stadiums.
     */
    public function index(Request $request)
    {
        $query = Stadium::with(['city', 'matches']);

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $stadiums = $query->orderBy('name')->paginate(10);

        return view('pages.stadiums.index', compact('stadiums'));
    }

    /**
     * Display the specified stadium.
     */
    public function show(Stadium $stadium)
    {
        $stadium->load(['city', 'matches']);

        return view('pages.stadiums.show', compact('stadium'));
    }
}
