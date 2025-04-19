<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfileRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the admin profile edit form
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('dashboard.admin.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show the form for creating a new user profile
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.admin.profile.create');
    }

    /**
     * Store a newly created user profile
     *
     * @param  \App\Http\Requests\Admin\StoreProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProfileRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        // Assign role if using a role management system
        if (isset($validated['role'])) {
            $user->assignRole($validated['role']);
        }

        return redirect()->route('admin.users.index')
            ->with('status', 'User profile created successfully.');
    }

    /**
     * Update the admin's profile
     *
     * @param  \App\Http\Requests\Admin\UpdateProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = User::find(Auth::id());
        $validated = $request->validated();

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }

            // Store the new image
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Update password if provided
        if ($request->filled('password')) {
            // Verify that the current password matches before allowing the change
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'The provided current password does not match your actual password.'])
                    ->withInput();
            }

            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.profile.edit')->with('status', 'Profile updated successfully.');
    }
}
