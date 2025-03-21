@extends('app')

@section('title', 'Cities')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">Host Cities</h1>
            <p class="section-subtitle">Explore the beautiful cities of Morocco hosting the 2030 World Cup</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
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
            <div class="card">
                <img src="/images/tangier.jpg" alt="Tangier" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Tangier</h3>
                    <p class="text-muted-foreground mb-4">A coastal city with a rich history, located at the western entrance to the Strait of Gibraltar.</p>
                    <a href="/cities/tangier" class="text-primary hover:underline">Learn more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/fez.jpg" alt="Fez" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Fez</h3>
                    <p class="text-muted-foreground mb-4">Home to the oldest university in the world and a UNESCO World Heritage medina.</p>
                    <a href="/cities/fez" class="text-primary hover:underline">Learn more →</a>
                </div>
            </div>
            <div class="card">
                <img src="/images/agadir.jpg" alt="Agadir" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Agadir</h3>
                    <p class="text-muted-foreground mb-4">A modern resort city with beautiful beaches along the Atlantic coast.</p>
                    <a href="/cities/agadir" class="text-primary hover:underline">Learn more →</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
