@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
            <h2 class="mt-6 text-3xl font-bold">Reset Password</h2>
            <p class="mt-2 text-sm text-muted-foreground">
                Enter your email address and we will send you a link to reset your password.
            </p>
        </div>

        {{-- Afficher le message de statut (succès de l'envoi) --}}
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="sr-only">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                       placeholder="Email address"
                       aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                       aria-describedby="email-error">
                @error('email')
                    <p class="mt-1 text-xs text-red-600" id="email-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Send Password Reset Link
                </button>
            </div>
             <div class="text-sm text-center">
                 <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary/90">
                     Back to Login
                 </a>
             </div>
        </form>
    </div>
</div>
@endsection
