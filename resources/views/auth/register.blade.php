@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full space-y-8">
        <div class="flex flex-col md:flex-row md:space-x-8 items-center">
            <!-- Form Section -->
            <div class="w-full md:w-1/2">
                <div class="text-center">
                    <img class="mx-auto h-12 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
                    <h2 class="mt-6 text-3xl font-bold">Create a new account</h2>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Or <a href="/login" class="font-medium text-primary hover:text-primary/90">sign in to your existing account</a>
                    </p>
                </div>
                <form class="mt-8 space-y-6" action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="name" class="sr-only">Full name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" placeholder="Full name">
                        </div>

                        <div>
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" placeholder="Email address">
                        </div>

                        <div>
                            <label for="role" class="sr-only">Role</label>
                            <select id="role" name="role" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm">
                                <option value="" disabled selected>Select your role</option>
                                <option value="admin">Admin</option>
                                <option value="member">Member</option>
                            </select>
                        </div>

                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" placeholder="Password">
                        </div>
                        <div>
                            <label for="password-confirm" class="sr-only">Confirm Password</label>
                            <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" placeholder="Confirm password">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            I agree to the <a href="/terms" class="font-medium text-primary hover:text-primary/90">Terms of Service</a> and <a href="/privacy" class="font-medium text-primary hover:text-primary/90">Privacy Policy</a>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-primary-foreground group-hover:text-primary-foreground/90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Create Account
                        </button>
                    </div>
                </form>
            </div>

            <!-- SVG Illustration Section -->
            <div class="w-full md:w-1/2 flex items-center justify-center mt-16 md:mt-8 md:ml-16">
                <x-svg-icon name="login-illustration" class="w-full h-auto" style="background: transparent;" />
            </div>
        </div>
    </div>
</div>
@endsection
