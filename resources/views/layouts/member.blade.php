<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member - Morocco 2030 World Cup - @yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/flash-messages.js'])
    @stack('styles')
</head>
<body class="bg-background text-foreground antialiased min-h-screen">
    @include('components.member-header')
    
    <main class="pb-8">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Flash Messages -->
                @if(session('success'))
                    <x-flash-message type="success" :message="session('success')" />
                @endif

                @if(session('error'))
                    <x-flash-message type="error" :message="session('error')" />
                @endif

                @if(session('warning'))
                    <x-flash-message type="warning" :message="session('warning')" />
                @endif

                @if(session('info'))
                    <x-flash-message type="info" :message="session('info')" />
                @endif
                @yield('content')
            </div>
        </div>
    </main>

    @stack('scripts')
</body>
</html>
