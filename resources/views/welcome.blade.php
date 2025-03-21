<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>World Cup Morocco 2030 - Official Guide</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        neutral: {
                            50: '#f9fafb',
                        },
                        gray: {
                            800: '#1f2937',
                            600: '#4b5563',
                            500: '#6b7280',
                        },
                        red: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                            900: '#881337', // Added red-900 as in gradient
                        },
                        green: {
                            100: '#f0fdf4',
                            600: '#16a34a',
                            700: '#15803d',
                            900: '#166534', // Added green-900 as in gradient
                        },
                        indigo: {
                            100: '#e0e7ff',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                        },
                    },
                },
                fontFamily: {
                    'montserrat': ['Montserrat', 'sans-serif'],
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c10000' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .countdown-item {
            position: relative;
            overflow: hidden;
        }
        .countdown-item:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #e11d48, #fb7185);
            transform: translateX(-100%);
            animation: countdown 60s linear infinite;
        }
        @keyframes countdown {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(0);
            }
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="antialiased bg-neutral-50 text-gray-800">
    <!-- Header/Navigation -->
    <header class="bg-gradient-to-r from-red-700 to-red-900 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-3.5l6-4.5-6-4.5v9z" />
                </svg>
                <span class="text-xl font-bold">Morocco 2030</span>
            </div>

            <nav class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="#" class="py-1 border-b-2 border-transparent hover:border-white transition duration-300">Home</a>
                <a href="#" class="py-1 border-b-2 border-transparent hover:border-white transition duration-300">Cities</a>
                <a href="#" class="py-1 border-b-2 border-transparent hover:border-white transition duration-300">Stadiums</a>
                <a href="#" class="py-1 border-b-2 border-transparent hover:border-white transition duration-300">Matches</a>
                <a href="#" class="py-1 border-b-2 border-transparent hover:border-white transition duration-300">Teams</a>
                <a href="#" class="py-1 border-b-2 border-transparent hover:border-white transition duration-300">News</a>
                <a href="#" class="py-1 border-b-2 border-transparent hover:border-white transition duration-300">Travel Info</a>
            </nav>

            <div class="flex items-center space-x-4">
                <a href="#" class="bg-white text-red-700 px-4 py-1 rounded-full text-sm font-bold hover:bg-red-100 transition">Sign In</a>
                <button class="md:hidden text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center hero-pattern flex items-center justify-center" style="background-image: url('https://source.unsplash.com/1600x900/?stadium');">
        <div class="absolute inset-0 bg-gradient-to-r from-red-900/70 to-green-900/70"></div>

        <div class="container mx-auto px-4 relative z-10 text-center text-white">
            <div class="max-w-3xl mx-auto">
                <img src="https://placehold.co/200x80/red/white?text=Morocco+2030+Logo&fontsize=20" alt="Morocco 2030 Logo" class="h-32 mx-auto mb-4 floating">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-4 leading-tight">
                    <span class="block">FIFA World Cup</span>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-green-500">
                        Morocco 2030
                    </span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">
                    The ultimate guide to football's greatest celebration. Experience the magic of Morocco.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="#" class="px-8 py-3 bg-red-600 text-white rounded-full font-bold hover:bg-red-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Explore Cities
                    </a>
                    <a href="#" class="px-8 py-3 bg-green-600 text-white rounded-full font-bold hover:bg-green-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        View Matches
                    </a>
                </div>
            </div>
        </div>

        <!-- Countdown ticker -->
        <div class="absolute bottom-0 left-0 right-0 bg-black/80 text-white py-4">
            <div class="container mx-auto">
                <div class="flex justify-center items-center space-x-4 md:space-x-10">
                    <div class="countdown-item text-center px-3">
                        <div class="text-3xl font-bold">2</div>
                        <div class="text-xs uppercase tracking-wider">Years</div>
                    </div>
                    <div class="countdown-item text-center px-3">
                        <div class="text-3xl font-bold">4</div>
                        <div class="text-xs uppercase tracking-wider">Months</div>
                    </div>
                    <div class="countdown-item text-center px-3">
                        <div class="text-3xl font-bold">15</div>
                        <div class="text-xs uppercase tracking-wider">Days</div>
                    </div>
                    <div class="countdown-item text-center px-3">
                        <div class="text-3xl font-bold">7</div>
                        <div class="text-xs uppercase tracking-wider">Hours</div>
                    </div>
                    <div class="text-sm md:text-base font-medium">Until Kickoff</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Cities Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-2">Host Cities</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Discover the vibrant cities that will host the greatest football tournament in the world.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- City Card 1 -->
                <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 bg-white transform hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?casablanca" alt="Casablanca" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4 text-white">
                            <h3 class="text-2xl font-bold">Casablanca</h3>
                            <p class="text-sm opacity-90">The economic heart of Morocco</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span>3 Stadiums</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Experience the blend of modern architecture and traditional Moroccan culture in this vibrant coastal city.</p>
                        <a href="#" class="inline-block text-red-600 font-medium hover:text-red-800 transition">
                            Explore Casablanca →
                        </a>
                    </div>
                </div>

                <!-- City Card 2 -->
                <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 bg-white transform hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?marrakech" alt="Marrakech" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4 text-white">
                            <h3 class="text-2xl font-bold">Marrakech</h3>
                            <p class="text-sm opacity-90">The Red City</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span>2 Stadiums</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Immerse yourself in the colors, scents and sounds of this magical city with its famous Medina and Jemaa el-Fnaa square.</p>
                        <a href="#" class="inline-block text-red-600 font-medium hover:text-red-800 transition">
                            Explore Marrakech →
                        </a>
                    </div>
                </div>

                <!-- City Card 3 -->
                <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 bg-white transform hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?rabat" alt="Rabat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4 text-white">
                            <h3 class="text-2xl font-bold">Rabat</h3>
                            <p class="text-sm opacity-90">The Capital City</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span>2 Stadiums</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Discover Morocco's capital with its blend of modern and historic landmarks, including the Hassan Tower and Kasbah of the Udayas.</p>
                        <a href="#" class="inline-block text-red-600 font-medium hover:text-red-800 transition">
                            Explore Rabat →
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="#" class="inline-flex items-center px-5 py-3 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition">
                    View All Host Cities
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Upcoming Matches -->
    <section class="py-16 bg-gradient-to-b from-red-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium mb-3">Upcoming Matches</span>
                <h2 class="text-3xl font-bold mb-2">Match Schedule</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Plan your World Cup experience with our comprehensive match schedule.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-red-600 to-red-800 text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold">Group Stage Matches</h3>
                        <span class="text-sm bg-white text-red-600 px-3 py-1 rounded-full font-medium">Day 1</span>
                    </div>
                </div>

                <!-- Match List -->
                <div class="divide-y divide-gray-100">
                    <!-- Match 1 -->
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between flex-wrap">
                            <div class="w-full md:w-auto mb-4 md:mb-0">
                                <div class="text-sm text-gray-500 mb-1">June 12, 2030 • 20:00</div>
                                <div class="text-sm font-medium text-gray-500">Stade Mohammed V, Casablanca</div>
                            </div>

                            <div class="flex items-center space-x-6">
                                <div class="text-center">
                                    <img src="https://flagcdn.com/w40/ma.png" alt="Morocco" class="w-10 h-10 mx-auto mb-1 rounded shadow-sm">
                                    <div class="font-semibold">Morocco</div>
                                </div>

                                <div class="text-center">
                                    <div class="text-xs text-gray-500 mb-1">Opening Match</div>
                                    <div class="text-2xl font-bold text-gray-800">VS</div>
                                </div>

                                <div class="text-center">
                                    <img src="https://flagcdn.com/w40/br.png" alt="Brazil" class="w-10 h-10 mx-auto mb-1 rounded shadow-sm">
                                    <div class="font-semibold">Brazil</div>
                                </div>
                            </div>

                            <div class="w-full md:w-auto mt-4 md:mt-0">
                                <button class="px-4 py-2 border border-red-600 text-red-600 rounded-full text-sm font-medium hover:bg-red-600 hover:text-white transition">
                                    Add to Favorites
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Match 2 -->
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between flex-wrap">
                            <div class="w-full md:w-auto mb-4 md:mb-0">
                                <div class="text-sm text-gray-500 mb-1">June 12, 2030 • 17:00</div>
                                <div class="text-sm font-medium text-gray-500">Stade Ibn Batouta, Tangier</div>
                            </div>

                            <div class="flex items-center space-x-6">
                                <div class="text-center">
                                    <img src="https://flagcdn.com/w40/fr.png" alt="France" class="w-10 h-10 mx-auto mb-1 rounded shadow-sm">
                                    <div class="font-semibold">France</div>
                                </div>

                                <div class="text-center">
                                    <div class="text-xs text-gray-500 mb-1">Group A</div>
                                    <div class="text-2xl font-bold text-gray-800">VS</div>
                                </div>

                                <div class="text-center">
                                    <img src="https://flagcdn.com/w40/ar.png" alt="Argentina" class="w-10 h-10 mx-auto mb-1 rounded shadow-sm">
                                    <div class="font-semibold">Argentina</div>
                                </div>
                            </div>

                            <div class="w-full md:w-auto mt-4 md:mt-0">
                                <button class="px-4 py-2 border border-red-600 text-red-600 rounded-full text-sm font-medium hover:bg-red-600 hover:text-white transition">
                                    Add to Favorites
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 text-center border-t">
                    <a href="#" class="text-red-600 font-medium hover:text-red-800 transition inline-flex items-center">
                        View Complete Schedule
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Morocco Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center gap-12">
                <div class="md:w-1/2">
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium mb-3">Experience Morocco</span>
                    <h2 class="text-3xl font-bold mb-6">More Than Just Football</h2>
                    <p class="text-gray-600 mb-6">Discover the rich culture, breathtaking landscapes, and warm hospitality of Morocco. From ancient medinas and bustling souks to majestic mountains and serene deserts - experience a journey of a lifetime.</p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-600 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-medium">Cuisine</h3>
                                <p class="text-sm text-gray-500">Taste authentic Moroccan dishes</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-600 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-medium">Crafts</h3>
                                <p class="text-sm text-gray-500">Explore traditional handicrafts</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-600 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-medium">Heritage</h3>
                                <p class="text-sm text-gray-500">Visit UNESCO World Heritage sites</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-600 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-medium">Festivals</h3>
                                <p class="text-sm text-gray-500">Experience vibrant local celebrations</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="inline-flex items-center px-5 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 transition">
                        Discover Morocco
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <div class="md:w-1/2 grid grid-cols-2 gap-4">
                    <div class="rounded-xl overflow-hidden h-48 md:h-64">
                        <img src="https://source.unsplash.com/400x300/?moroccan,culture" alt="Moroccan Culture" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden h-48 md:h-64 transform translate-y-8">
                        <img src="https://source.unsplash.com/400x300/?moroccan,market" alt="Moroccan Culture" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden h-48 md:h-64 transform translate-y-4">
                        <img src="https://source.unsplash.com/400x300/?moroccan,food" alt="Moroccan Culture" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden h-48 md:h-64 transform -translate-y-4">
                        <img src="https://source.unsplash.com/400x300/?moroccan,architecture" alt="Moroccan Culture" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-3">Latest Updates</span>
                <h2 class="text-3xl font-bold mb-2">News & Articles</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Stay updated with the latest news and stories about the World Cup 2030.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- News Card 1 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?stadium,construction" alt="Stadium Construction" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2h12a2 2 0 002-2H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <span>October 15, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Stadium Construction Updates</h3>
                        <p class="text-gray-600 text-sm">Detailed progress on the construction of world-class stadiums for the upcoming World Cup.</p>
                        <a href="#" class="inline-block text-indigo-600 font-medium hover:text-indigo-800 transition">
                            Read More →
                        </a>
                    </div>
                </div>

                <!-- News Card 2 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?volunteers" alt="Volunteer Program Launch" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2h12a2 2 0 002-2H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <span>October 10, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Volunteer Program Officially Launched</h3>
                        <p class="text-gray-600 text-sm">Exciting news! Registration for the World Cup 2030 volunteer program is now open.</p>
                        <a href="#" class="inline-block text-indigo-600 font-medium hover:text-indigo-800 transition">
                            Join Us →
                        </a>
                    </div>
                </div>

                <!-- News Card 3 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?sustainability" alt="Sustainability Initiatives" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2h12a2 2 0 002-2H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <span>October 5, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Morocco 2030 Pledges to be Greenest World Cup Ever</h3>
                        <p class="text-gray-600 text-sm">Learn about the ambitious sustainability initiatives planned for the tournament.</p>
                        <a href="#" class="inline-block text-indigo-600 font-medium hover:text-indigo-800 transition">
                            Learn More →
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="#" class="inline-flex items-center px-5 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition">
                    View All News
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-bold mb-4 text-white">About Morocco 2030</h4>
                    <p class="text-sm">The official guide for the FIFA World Cup 2030 hosted in Morocco. Explore host cities, stadiums, match schedules, and experience Moroccan culture.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4 text-white">Explore</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#" class="hover:text-white transition">Cities</a></li>
                        <li><a href="#" class="hover:text-white transition">Stadiums</a></li>
                        <li><a href="#" class="hover:text-white transition">Matches</a></li>
                        <li><a href="#" class="hover:text-white transition">Teams</a></li>
                        <li><a href="#" class="hover:text-white transition">News</a></li>
                        <li><a href="#" class="hover:text-white transition">Travel Info</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4 text-white">Connect</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Facebook</a></li>
                        <li><a href="#" class="hover:text-white transition">Twitter</a></li>
                        <li><a href="#" class="hover:text-white transition">Instagram</a></li>
                        <li><a href="#" class="hover:text-white transition">YouTube</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4 text-white">Download App</h4>
                    <p class="text-sm mb-2">Get the official mobile app for the best experience.</p>
                    <div class="flex space-x-2">
                        <a href="#" class="hover:opacity-80 transition"><img src="https://placehold.co/40x40/gray/white?text=App+Store&fontsize=12" alt="App Store" class="h-10"></a>
                        <a href="#" class="hover:opacity-80 transition"><img src="https://placehold.co/40x40/gray/white?text=Google+Play&fontsize=12" alt="Google Play" class="h-10"></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 py-4 text-center text-sm">
                © 2023 Morocco 2030. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
