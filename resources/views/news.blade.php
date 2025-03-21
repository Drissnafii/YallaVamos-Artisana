@extends('app')

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

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card">
                <img src="/images/news1.jpg" alt="Stadium Construction" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 15, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Stadium Construction Ahead of Schedule</h3>
                    <p class="text-muted-foreground mb-4">Construction of the new stadiums for the 2030 World Cup is progressing faster than expected, with several venues already 50% complete.</p>
                    <a href="/news/stadium-construction" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/news2.jpg" alt="Ticket Sales" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 10, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Ticket Sales to Begin Next Year</h3>
                    <p class="text-muted-foreground mb-4">FIFA announces that ticket sales for the 2030 World Cup will begin in early 2026, with a new digital ticketing system to improve fan experience.</p>
                    <a href="/news/ticket-sales" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/news3.jpg" alt="Transportation" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 5, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Transportation Infrastructure Upgrades</h3>
                    <p class="text-muted-foreground mb-4">Morocco invests in major transportation upgrades to prepare for the 2030 World Cup, including new high-speed rail lines connecting host cities.</p>
                    <a href="/news/transportation" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/news4.jpg" alt="Fan Zones" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">February 28, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Fan Zones Planned for All Host Cities</h3>
                    <p class="text-muted-foreground mb-4">Organizers announce plans for extensive fan zones in all host cities, featuring large screens, entertainment, and cultural experiences.</p>
                    <a href="/news/fan-zones" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/news5.jpg" alt="Cultural Program" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">February 20, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Cultural Program to Showcase Moroccan Heritage</h3>
                    <p class="text-muted-foreground mb-4">A comprehensive cultural program will run alongside the tournament, showcasing Morocco's rich heritage, cuisine, and traditions to visitors.</p>
                    <a href="/news/cultural-program" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/news6.jpg" alt="Sustainability" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">February 15, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Sustainability at the Core of World Cup Planning</h3>
                    <p class="text-muted-foreground mb-4">Morocco commits to hosting the most sustainable World Cup ever, with solar-powered stadiums and comprehensive recycling programs.</p>
                    <a href="/news/sustainability" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Press Releases</h2>
            <div class="bg-white rounded-lg shadow-md divide-y">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold">FIFA and Morocco Organizing Committee Meeting</h3>
                            <p class="text-sm text-muted-foreground mt-1">Joint statement on preparation progress and upcoming milestones</p>
                        </div>
                        <span class="text-sm text-muted-foreground">March 1, 2025</span>
                    </div>
                    <a href="#" class="text-primary text-sm hover:underline mt-2 inline-block">Download PDF →</a>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold">Volunteer Program Launch</h3>
                            <p class="text-sm text-muted-foreground mt-1">Details on the World Cup volunteer recruitment program</p>
                        </div>
                        <span class="text-sm text-muted-foreground">February 10, 2025</span>
                    </div>
                    <a href="#" class="text-primary text-sm hover:underline mt-2 inline-block">Download PDF →</a>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold">Official Mascot Announcement</h3>
                            <p class="text-sm text-muted-foreground mt-1">Introducing the official mascot for the 2030 World Cup</p>
                        </div>
                        <span class="text-sm text-muted-foreground">January 25, 2025</span>
                    </div>
                    <a href="#" class="text-primary text-sm hover:underline mt-2 inline-block">Download PDF →</a>
                </div>
            </div>
        </div>

        <div class="mt-12 bg-primary/10 p-6 rounded-lg">
            <h2 class="text-xl font-bold mb-4">Subscribe to Updates</h2>
            <p class="mb-4">Stay informed with the latest news and updates about the 2030 World Cup in Morocco.</p>
            <form class="flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Your email address" class="flex-grow px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary">
                <button type="submit" class="btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</div>
@endsection
