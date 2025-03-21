@extends('app')

@section('title', 'Stadiums')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">World Cup Stadiums</h1>
            <p class="section-subtitle">Discover the magnificent venues hosting the 2030 World Cup matches</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
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
            <div class="card">
                <img src="/images/stadium4.jpg" alt="Tangier Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Tangier Stadium</h3>
                    <p class="text-muted-foreground mb-4">A coastal venue with stunning views and a capacity of 40,000 spectators.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm bg-primary/10 text-primary px-2 py-1 rounded">Capacity: 40,000</span>
                        <a href="/stadiums/tangier" class="text-primary hover:underline">Learn more →</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="/images/stadium5.jpg" alt="Fez Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Fez Stadium</h3>
                    <p class="text-muted-foreground mb-4">A blend of traditional architecture and modern amenities with 38,000 seats.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm bg-primary/10 text-primary px-2 py-1 rounded">Capacity: 38,000</span>
                        <a href="/stadiums/fez" class="text-primary hover:underline">Learn more →</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="/images/stadium6.jpg" alt="Agadir Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Agadir Stadium</h3>
                    <p class="text-muted-foreground mb-4">A beachside stadium with a capacity of 35,000 and modern facilities.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm bg-primary/10 text-primary px-2 py-1 rounded">Capacity: 35,000</span>
                        <a href="/stadiums/agadir" class="text-primary hover:underline">Learn more →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
