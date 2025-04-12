@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
            <h2 class="mt-6 text-3xl font-bold">Change Password</h2>
            <p class="mt-2 text-sm text-muted-foreground">
                Enter your current password and your new password
            </p>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                {{-- Current Password Input --}}
                <div>
                    <label for="current_password" class="sr-only">Current Password</label>
                    <input id="current_password" name="current_password" type="password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border {{ $errors->has('current_password') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                           placeholder="Current Password"
                           aria-invalid="{{ $errors->has('current_password') ? 'true' : 'false' }}"
                           aria-describedby="current-password-error">
                    @error('current_password')
                        <p class="mt-1 text-xs text-red-600" id="current-password-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- New Password Input --}}
                <div>
                    <label for="password" class="sr-only">New Password</label>
                    <input id="password" name="password" type="password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                           placeholder="New Password"
                           aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                           aria-describedby="password-error">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600" id="password-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password Input --}}
                <div>
                    <label for="password_confirmation" class="sr-only">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                           placeholder="Confirm New Password">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Change Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 