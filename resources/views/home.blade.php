@extends('app')

@section('title', 'Home')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">Morocco 2030 World Cup</h1>
            <p class="section-subtitle">Experience the magic of football in the heart of North Africa</p>
            <div class="mt-8">
                <a href="/match-schedule" class="btn-primary">View Match Schedule</a>
            </div>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold">Host Cities</h2>
            <p class="mt-4 text-lg text-muted-foreground">Discover the beautiful cities of Morocco hosting the 2030 World Cup</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card">
                <img src="/images/casablanca.jpg" alt="Casablanca" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Casablanca</h3>
                    <p class="text-muted-foreground mb-4">Morocco's largest city and economic center, featuring the iconic Hassan II Mosque.</p>
                    <a href="/cities/casablanca" class="text-primary hover:underline">Learn more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/marrakech.jpg" alt="Marrakech" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Marrakech</h3>
                    <p class="text-muted-foreground mb-4">The Red City with its famous Jemaa el-Fnaa square and historic medina.</p>
                    <a href="/cities/marrakech" class="text-primary hover:underline">Learn more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/rabat.jpg" alt="Rabat" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Rabat</h3>
                    <p class="text-muted-foreground mb-4">Morocco's capital city, home to the Royal Palace and Kasbah of the Udayas.</p>
                    <a href="/cities/rabat" class="text-primary hover:underline">Learn more →</a>
                </div>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="/cities" class="btn-primary">View All Cities</a>
        </div>
    </div>
</div>

<div class="bg-muted py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold">Featured Stadiums</h2>
            <p class="mt-4 text-lg text-muted-foreground">Explore the magnificent venues hosting the 2030 World Cup matches</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card">
                <img src="/images/stadium1.jpg" alt="Mohammed V Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Mohammed V Stadium</h3>
                    <p class="text-muted-foreground mb-4">Casablanca's premier stadium with a capacity of 67,000 spectators.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm bg-primary/10 text-primary px-2 py-1 rounded">Capacity: 67,000</span>
                        <a href="/stadiums/mohammed-v" class="text-primary hover:underline">Learn more →</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="/images/stadium2.jpg" alt="Marrakech Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Marrakech Stadium</h3>
                    <p class="text-muted-foreground mb-4">A modern venue with a capacity of 45,000 in the heart of Marrakech.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm bg-primary/10 text-primary px-2 py-1 rounded">Capacity: 45,000</span>
                        <a href="/stadiums/marrakech" class="text-primary hover:underline">Learn more →</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="/images/stadium3.jpg" alt="Rabat Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Rabat Stadium</h3>
                    <p class="text-muted-foreground mb-4">The capital's flagship stadium with a capacity of 52,000 spectators.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm bg-primary/10 text-primary px-2 py-1 rounded">Capacity: 52,000</span>
                        <a href="/stadiums/rabat" class="text-primary hover:underline">Learn more →</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="/stadiums" class="btn-primary">View All Stadiums</a>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold">Latest News</h2>
            <p class="mt-4 text-lg text-muted-foreground">Stay updated with the latest news about the 2030 World Cup</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card">
                <img src="/images/news1.jpg" alt="Stadium Construction" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 15, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Stadium Construction Ahead of Schedule</h3>
                    <p class="text-muted-foreground mb-4">Construction of the new stadiums for the 2030 World Cup is progressing faster than expected.</p>
                    <a href="/news/stadium-construction" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/news2.jpg" alt="Ticket Sales" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 10, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Ticket Sales to Begin Next Year</h3>
                    <p class="text-muted-foreground mb-4">FIFA announces that ticket sales for the 2030 World Cup will begin in early 2026.</p>
                    <a href="/news/ticket-sales" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/news3.jpg" alt="Transportation" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">March 5, 2025</div>
                    <h3 class="text-xl font-semibold mb-2">Transportation Infrastructure Upgrades</h3>
                    <p class="text-muted-foreground mb-4">Morocco invests in major transportation upgrades to prepare for the 2030 World Cup.</p>
                    <a href="/news/transportation" class="text-primary hover:underline">Read more →</a>
                </div>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="/news" class="btn-primary">View All News</a>
        </div>
    </div>
</div>

<div class="bg-primary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold">Stay Connected</h2>
            <p class="mt-4 text-lg text-muted-foreground">Subscribe to receive the latest updates about the 2030 World Cup</p>

            <div class="mt-8 max-w-md mx-auto">
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Your email address" class="flex-grow px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
    