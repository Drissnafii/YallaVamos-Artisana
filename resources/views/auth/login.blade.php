@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
            <h2 class="mt-6 text-3xl font-bold">Sign in to your account</h2>
            <p class="mt-2 text-sm text-muted-foreground">
                Or <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary/90">create a new account</a> {{-- Use route helper --}}
            </p>
        </div>

        {{-- Optional: Display a general error summary --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops! Something went wrong.</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST"> {{-- Ensure route name is 'login' --}}
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                {{-- Email Input --}}
                <div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                           value="{{ old('email') }}" {{-- Retain old input --}}
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                           placeholder="Email address"
                           aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                           aria-describedby="email-error">
                    {{-- Display Email Errors --}}
                    @error('email')
                        <p class="mt-1 text-xs text-red-600" id="email-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                           placeholder="Password"
                           aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                           aria-describedby="password-error">
                     {{-- Display Password Errors --}}
                     @error('password')
                         <p class="mt-1 text-xs text-red-600" id="password-error">{{ $message }}</p>
                     @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"> {{-- Changed name to 'remember' (common Laravel standard) --}}
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    {{-- Use route helper if you have a password reset route --}}
                    <a href="{{ route('password.request') }}" class="font-medium text-primary hover:text-primary/90">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-primary-foreground group-hover:text-primary-foreground/90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Sign in
                </button>
            </div>
        </form>

        {{-- Optional Social Login Section (keep as is or implement later) --}}
        {{-- <div class="mt-6"> ... </div> --}}
    </div>
</div>
@endsection
