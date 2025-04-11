<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morocco 2030 World Cup - @yield('title', 'Home')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex flex-col">

    {{-- Using the Header Component from views/components --}}
    <x-header />

    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Using the Footer Component from views/components --}}
    <x-footer />

    @stack('scripts')
</body>
</html>
