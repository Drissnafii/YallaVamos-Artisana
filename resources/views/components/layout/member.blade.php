<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Member dashboard for Morocco 2030 World Cup.">
    <meta name="keywords" content="Morocco 2030, World Cup, Member Dashboard">
    <meta name="author" content="Morocco 2030">
    <meta property="og:title" content="Morocco 2030 - Member Dashboard">
    <meta property="og:description" content="Member dashboard for Morocco 2030 World Cup">
    <meta property="og:image" content="{{ asset('images/morocco-logo.svg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <title>Morocco 2030 - @yield('title', 'Member Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
<body class="bg-background text-foreground antialiased min-h-screen flex flex-col">

    {{-- Using the Member Header Component --}}
    <x-member-header />

    <main class="flex-grow" id="main-content">
        <!-- Add flash messages container -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <x-flash-message type="success" :message="session('success')" />
            @endif

            @if(session('error'))
                <x-flash-message type="error" :message="session('error')" />
            @endif

            @yield('content')
        </div>
    </main>

    {{-- Using the Footer Component from views/components --}}
    <x-footer />

    <!-- Alpine.js (if not already included in your app.js) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    if (mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('hidden');
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    } else {
                        mobileMenu.style.maxHeight = '0';
                        setTimeout(function() {
                            mobileMenu.classList.add('hidden');
                        }, 500);
                    }
                });
            }

            // Handle hover indicator for desktop navigation
            const navLinks = document.querySelectorAll('.nav-link');
            const hoverIndicator = document.getElementById('hover-indicator');

            if (navLinks.length && hoverIndicator) {
                navLinks.forEach(link => {
                    link.addEventListener('mouseenter', function() {
                        const rect = this.getBoundingClientRect();
                        hoverIndicator.style.width = rect.width + 'px';
                        hoverIndicator.style.height = rect.height + 'px';
                        hoverIndicator.style.left = (rect.left - this.parentElement.getBoundingClientRect().left) + 'px';
                        hoverIndicator.style.top = (rect.top - this.parentElement.getBoundingClientRect().top) + 'px';
                        hoverIndicator.style.opacity = '1';
                    });

                    link.addEventListener('mouseleave', function() {
                        hoverIndicator.style.opacity = '0';
                    });
                });
            }
        });
    </script>

    @stack('scripts')
