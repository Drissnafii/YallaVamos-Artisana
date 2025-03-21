@extends('app')

@section('title', 'Login')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">Login</h1>
            <p class="section-subtitle">Access your Morocco 2030 World Cup account</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-md">
        <div class="card p-8">
            <form>
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-primary hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="w-full btn-primary">Sign in</button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-muted-foreground">Don't have an account? <a href="#" class="text-primary hover:underline">Register now</a></p>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-center text-sm text-muted-foreground mb-4">Or sign in with</p>
                <div class="flex justify-center space-x-4">
                    <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.545, 10.239v3.821h5.445c-0.712, 2.315-2.647, 3.972-5.445, 3.972-3.332, 0-6.033-2.701-6.033-6.032s2.701-6.032, 6.033-6.032c1.498, 0, 2.866, 0.549, 3.921, 1.453l2.814-2.814C17.503, 2.988, 15.139, 2, 12.545, 2 7.021, 2, 2.543, 6.477, 2.543, 12s4.478, 10, 10.002, 10c8.396, 0, 10.249-7.85, 9.426-11.748l-9.426, 0.013z"/>
                        </svg>
                        Google
                    </button>
                    <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 0H1.325C0.593, 0, 0, 0.593, 0, 1.325v21.351C0, 23.407, 0.593, 24, 1.325, 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1, 1.893-4.788, 4.659-4.788, 1.325, 0, 2.463, 0.099, 2.795, 0.143v3.24l-1.918, 0.001c-1.504, 0-1.795, 0.715-1.795, 1.763v2.313h3.587l-0.467, 3.622h-3.12V24h6.116c0.73, 0, 1.323-0.593, 1.323-1.325V1.325C24, 0.593, 23.407, 0, 22.675, 0z"/>
                        </svg>
                        Facebook
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
