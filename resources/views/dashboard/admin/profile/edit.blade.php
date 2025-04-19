@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Hero profile header with gradient background -->
    <div class="rounded-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-primary to-purple-700 px-6 py-12 sm:px-10 relative">
            <div class="flex flex-col sm:flex-row items-start sm:items-end gap-6">
                <!-- Profile image with edit overlay (removed white border) -->
                <div class="relative group">
                    <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full bg-gray-200 overflow-hidden">
                        <img
                            src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                            alt="{{ $user->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <label for="profile_photo" class="absolute inset-0 flex items-center justify-center rounded-full bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span class="sr-only">Choose photo</span>
                    </label>
                </div>

                <!-- Profile name -->
                <div class="flex-1 ml-0 sm:ml-4 text-white">
                    <h4 class="text-sm font-medium opacity-90">Profile</h4>
                    <h1 class="text-4xl sm:text-6xl font-bold mt-1">{{ $user->name }}</h1>
                    <div class="flex items-center mt-2">
                        <div class="text-sm opacity-90">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status message -->
    @if (session('status'))
        <div class="mb-6 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Profile edit form -->
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Hidden file input for profile photo -->
        <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*">

        <!-- Personal Information Card -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                <p class="mt-1 text-sm text-gray-500">Update your account details</p>
            </div>

            <div class="px-6 py-5 space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out @error('name') border-red-300 @enderror"
                            placeholder="Enter your full name"
                        >
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out @error('email') border-red-300 @enderror"
                            placeholder="you@example.com"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Password Card -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Change Password</h3>
                <p class="mt-1 text-sm text-gray-500">Ensure your account is using a secure password</p>
            </div>

            <div class="px-6 py-5 space-y-6">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out @error('current_password') border-red-300 @enderror"
                            placeholder="Enter your current password"
                        >
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out @error('password') border-red-300 @enderror"
                            placeholder="Enter your new password"
                        >
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out"
                            placeholder="Confirm your new password"
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Form actions -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-150 ease-in-out transform hover:scale-105"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Save changes
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Handle profile photo selection
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('profile_photo');
        const photoLabel = document.querySelector('label[for="profile_photo"]');
        const photoImg = document.querySelector('.w-32.h-32 img'); // More specific selector

        // Make the entire photo area clickable
        photoLabel.addEventListener('click', function(e) {
            e.preventDefault();
            photoInput.click();
        });

        photoInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    photoImg.src = e.target.result;
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
</script>
@endpush
@endsection
