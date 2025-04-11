@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
             <img class="mx-auto h-12 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
            <h2 class="mt-6 text-3xl font-bold">Set Your New Password</h2>
            <p class="mt-2 text-sm text-muted-foreground">
                Create a new secure password for your account
            </p>
        </div>

         {{-- Afficher les erreurs générales (ex: token invalide) --}}
         @error('email') {{-- L'erreur générale est souvent liée à l'email/token --}}
             <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                 {{ $message }}
             </div>
         @enderror

        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf

            {{-- Champ caché pour le token --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email Input --}}
            <div>
                <label for="email" class="sr-only">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ $email ?? old('email') }}"
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                       placeholder="Email address"
                       aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                       aria-describedby="email-error-reset">
                {{-- Note: L'erreur email ici est souvent l'erreur générale de token/email invalide --}}
                @error('email')
                    <p class="mt-1 text-xs text-red-600" id="email-error-reset">{{ $message }}</p>
                @enderror
            </div>

             {{-- Password Input --}}
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                       placeholder="New Password"
                       aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                       aria-describedby="password-error-reset">
                 @error('password')
                     <p class="mt-1 text-xs text-red-600" id="password-error-reset">{{ $message }}</p>
                 @enderror
            </div>

            {{-- Password Confirmation Input --}}
            <div>
                <label for="password-confirm" class="sr-only">Confirm Password</label>
                <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                       placeholder="Confirm New Password">
                 {{-- Pas besoin d'afficher d'erreur ici, l'erreur 'confirmed' s'affiche sous le champ 'password' --}}
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
