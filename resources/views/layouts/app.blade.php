<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Official guide for the 2030 FIFA World Cup in Morocco. Find information about host cities, stadiums, match schedules, travel, and news.">
    <meta name="keywords" content="Morocco 2030, World Cup, FIFA, Football, Stadiums, Cities, Travel">
    <meta name="author" content="Morocco 2030">
    <meta property="og:title" content="Morocco 2030 World Cup">
    <meta property="og:description" content="Official guide for the 2030 FIFA World Cup in Morocco">
    <meta property="og:image" content="{{ asset('images/morocco-logo.svg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <title>Morocco 2030 World Cup - @yield('title', 'Home')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
    @stack('styles')
    <!-- Preload critical assets -->
    <link rel="preload" href="{{ asset('images/morocco-logo.svg') }}" as="image">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Add favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/morocco-logo.svg') }}">

    <!-- Add manifest for PWA support -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
</head>
<body class="bg-transparent backdrop-blur-lg text-foreground antialiased min-h-screen flex flex-col">

    {{-- Using the Header Component from views/components --}}
    <x-header />

    <main class="flex-grow w-full" id="main-content">
        <!-- Add flash messages container -->
        <div class="w-full">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <x-flash-message type="success" :message="session('success')" />
                @endif

                @if(session('error'))
                    <x-flash-message type="error" :message="session('error')" />
                @endif
            </div>

            @yield('content')
        </div>
    </main>

    {{-- Using the Footer Component from views/components --}}
    <x-footer />

    @stack('scripts')
</body>
</html>
