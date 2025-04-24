@extends('layouts.app')

@section('title', 'News')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">Latest News</h1>
            <p class="section-subtitle">Stay updated with the latest news about the 2030 World Cup in Morocco</p>
        </div>
    </div>
</div>

<!-- Featured News -->
<div class="py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2">Featured News</h2>
        </div>
        <div class="card lg:col-span-2 mb-10">
            <div class="md:flex shadow-md rounded-lg overflow-hidden">
                <div class="md:w-2/3">
                    <img src="{{ asset('images/news1.jpg') }}" alt="Stadium Construction" class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="p-6 md:w-1/3 flex flex-col justify-center">
                    <div class="flex items-center mb-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/20 text-primary">Featured</span>
                        <span class="ml-2 text-sm text-muted-foreground">March 15, 2025</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Stadium Construction Ahead of Schedule</h3>
                    <p class="text-muted-foreground mb-6">Construction of the new stadiums for the 2030 World Cup is progressing faster than expected, with several venues already 50% complete. This puts Morocco well on track to meet all infrastructure deadlines.</p>
                    <a href="{{ route('news.show', 'stadium-construction') }}" class="text-primary hover:underline font-medium flex items-center">
                        Read full article
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- News Grid -->
<div class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2">Latest Updates</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card">
                <div class="relative">
                    <img src="{{ asset('images/news2.jpg') }}" alt="Ticket Sales" class="w-full h-48 object-cover">
                    <div class="absolute top-0 right-0 bg-blue-500 text-white px-3 py-1 m-2 text-sm font-medium rounded">Tickets</div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 10, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Ticket Sales to Begin Next Year</h3>
                    <p class="text-muted-foreground mb-4">FIFA announces that ticket sales for the 2030 World Cup will begin in early 2026, with a new digital ticketing system to improve fan experience.</p>
                    <a href="{{ route('news.show', 'ticket-sales') }}" class="text-primary hover:underline inline-flex items-center">
                        Read more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="relative">
                    <img src="{{ asset('images/news3.jpg') }}" alt="Transportation" class="w-full h-48 object-cover">
                    <div class="absolute top-0 right-0 bg-green-500 text-white px-3 py-1 m-2 text-sm font-medium rounded">Infrastructure</div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 5, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Transportation Infrastructure Upgrades</h3>
                    <p class="text-muted-foreground mb-4">Morocco invests in major transportation upgrades to prepare for the 2030 World Cup, including new high-speed rail lines connecting host cities.</p>
                    <a href="{{ route('news.show', 'transportation') }}" class="text-primary hover:underline inline-flex items-center">
                        Read more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="relative">
                    <img src="{{ asset('images/news4.jpg') }}" alt="Fan Zones" class="w-full h-48 object-cover">
                    <div class="absolute top-0 right-0 bg-purple-500 text-white px-3 py-1 m-2 text-sm font-medium rounded">Fan Experience</div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">February 28, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Fan Zones Planned for All Host Cities</h3>
                    <p class="text-muted-foreground mb-4">Organizers announce plans for extensive fan zones in all host cities, featuring large screens, entertainment, and cultural experiences.</p>
                    <a href="{{ route('news.show', 'fan-zones') }}" class="text-primary hover:underline inline-flex items-center">
                        Read more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="relative">
                    <img src="{{ asset('images/news5.jpg') }}" alt="Cultural Program" class="w-full h-48 object-cover">
                    <div class="absolute top-0 right-0 bg-red-500 text-white px-3 py-1 m-2 text-sm font-medium rounded">Culture</div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">February 20, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Cultural Program to Showcase Moroccan Heritage</h3>
                    <p class="text-muted-foreground mb-4">A comprehensive cultural program will run alongside the tournament, showcasing Morocco's rich heritage, cuisine, and traditions to visitors.</p>
                    <a href="{{ route('news.show', 'cultural-program') }}" class="text-primary hover:underline inline-flex items-center">
                        Read more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="relative">
                    <img src="{{ asset('images/news6.jpg') }}" alt="Sustainability" class="w-full h-48 object-cover">
                    <div class="absolute top-0 right-0 bg-yellow-500 text-white px-3 py-1 m-2 text-sm font-medium rounded">Sustainability</div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">February 15, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Sustainability at the Core of World Cup Planning</h3>
                    <p class="text-muted-foreground mb-4">Morocco commits to hosting the most sustainable World Cup ever, with solar-powered stadiums and comprehensive recycling programs.</p>
                    <a href="{{ route('news.show', 'sustainability') }}" class="text-primary hover:underline inline-flex items-center">
                        Read more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="relative">
                    <img src="{{ asset('images/news7.jpg') }}" alt="Volunteer Program" class="w-full h-48 object-cover">
                    <div class="absolute top-0 right-0 bg-indigo-500 text-white px-3 py-1 m-2 text-sm font-medium rounded">Community</div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">February 10, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Volunteer Program Launch</h3>
                    <p class="text-muted-foreground mb-4">Morocco 2030 organizing committee launches its volunteer program, aiming to recruit 30,000 volunteers to support the tournament.</p>
                    <a href="{{ route('news.show', 'volunteer-program') }}" class="text-primary hover:underline inline-flex items-center">
                        Read more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- View All News Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('news.archive') }}" class="btn-primary inline-flex items-center">
                View All News
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Press Releases -->
<div class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2">Official Press Releases</h2>
        </div>
        <div class="bg-white rounded-lg shadow-md divide-y">
            <div class="p-6 hover:bg-gray-50 transition duration-150">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h3 class="font-semibold">FIFA and Morocco Organizing Committee Meeting</h3>
                        <p class="text-sm text-muted-foreground mt-1">Joint statement on preparation progress and upcoming milestones</p>
                    </div>
                    <div class="mt-2 sm:mt-0 flex items-center">
                        <span class="text-sm text-muted-foreground mr-4">March 1, 2025</span>
                        <a href="{{ asset('press-releases/fifa-morocco-meeting.pdf') }}" class="inline-flex items-center text-primary text-sm hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-6 hover:bg-gray-50 transition duration-150">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h3 class="font-semibold">Volunteer Program Launch</h3>
                        <p class="text-sm text-muted-foreground mt-1">Details on the World Cup volunteer recruitment program</p>
                    </div>
                    <div class="mt-2 sm:mt-0 flex items-center">
                        <span class="text-sm text-muted-foreground mr-4">February 10, 2025</span>
                        <a href="{{ asset('press-releases/volunteer-program.pdf') }}" class="inline-flex items-center text-primary text-sm hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-6 hover:bg-gray-50 transition duration-150">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h3 class="font-semibold">Official Mascot Announcement</h3>
                        <p class="text-sm text-muted-foreground mt-1">Introducing the official mascot for the 2030 World Cup</p>
                    </div>
                    <div class="mt-2 sm:mt-0 flex items-center">
                        <span class="text-sm text-muted-foreground mr-4">January 25, 2025</span>
                        <a href="{{ asset('press-releases/mascot-announcement.pdf') }}" class="inline-flex items-center text-primary text-sm hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Press Releases -->
        <div class="mt-6 text-right">
            <a href="{{ route('press-releases') }}" class="inline-flex items-center text-primary hover:underline">
                View all press releases
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="mt-12 bg-primary/10 p-8 rounded-lg max-w-4xl mx-auto mb-12">
    <h2 class="text-xl font-bold mb-4">Subscribe to Updates</h2>
    <p class="mb-4">Stay informed with the latest news and updates about the 2030 World Cup in Morocco.</p>
    <form class="relative w-full" id="newsletter-form">
        <input type="email" placeholder="Enter your email" class="w-full px-6 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 pr-20">
        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 px-6 py-2 rounded-full bg-primary text-white font-semibold text-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary transition duration-300 ease-in-out">
            Subscribe
        </button>
    </form>
    <p class="text-sm text-muted-foreground mt-4">By subscribing, you agree to receive email communications from Morocco 2030.</p>
</div>
@endsection
