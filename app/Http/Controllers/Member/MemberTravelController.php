<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberTravelController extends Controller
{
    /**
     * Display travel information with enhanced member features
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cities = City::all();
        $accommodations = Accommodation::with('city')->get();
        $favoriteAccommodations = collect(); // You can expand this if you implement favorite accommodations

        return view('member.travel.index', compact('cities', 'accommodations', 'favoriteAccommodations'));
    }

    /**
     * Display accommodation options for members with enhanced features
     *
     * @return \Illuminate\View\View
     */
    public function accommodations()
    {
        $accommodations = Accommodation::with('city')->get();
        return view('member.travel.accommodations', compact('accommodations'));
    }

    /**
     * Display transportation options for members with enhanced features
     *
     * @return \Illuminate\View\View
     */
    public function transportation()
    {
        $cities = City::all();
        return view('member.travel.transportation', compact('cities'));
    }

    /**
     * Show detailed travel tips for members
     *
     * @return \Illuminate\View\View
     */
    public function tips()
    {
        return view('member.travel.tips');
    }

    /**
     * Show details for a specific accommodation
     *
     * @param Accommodation $accommodation
     * @return \Illuminate\View\View
     */
    public function showAccommodation(Accommodation $accommodation)
    {
        return view('member.travel.accommodation_show', compact('accommodation'));
    }
}
