<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberProfileController extends Controller
{
    public function edit()
    {
        return view('member.profile.edit');
    }

    public function update(Request $request)
    {
        // Add validation and update logic here
        return back()->with('success', 'Profile updated successfully');
    }

    public function settings()
    {
        return view('member.settings.index');
    }

    public function updateSettings(Request $request)
    {
        // Validate settings data
        $request->validate([
            'email_notifications' => 'nullable|boolean',
            'match_reminders' => 'nullable|boolean',
            'newsletter' => 'nullable|boolean',
            'profile_visibility' => 'nullable|boolean',
            'activity_status' => 'nullable|boolean',
        ]);

        // Update user settings
        $user = auth()->user();
        $user->settings = array_merge($user->settings ?? [], $request->only([
            'email_notifications',
            'match_reminders',
            'newsletter',
            'profile_visibility',
            'activity_status',
        ]));
        $user->save();

        return back()->with('success', 'Settings updated successfully');
    }
} 