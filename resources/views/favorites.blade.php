@extends('app')

@section('title', 'Favorites')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">My Favorites</h1>
            <p class="section-subtitle">Keep track of your favorite matches, teams, and venues</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Favorites tabs -->
        <div class="mb-8 border-b border-gray-200">
            <div class="flex flex-wrap -mb-px">
                <button class="inline-block p-4 border-b-2 border-primary text-primary font-medium" id="tab-matches">
                    Matches
                </button>
                <button class="inline-block p-4 border-b-2 border-transparent hover:text-primary hover:border-primary font-medium" id="tab-teams">
                    Teams
                </button>
                <button class="inline-block p-4 border-b-2 border-transparent hover:text-primary hover:border-primary font-medium" id="tab-venues">
                    Venues
                </button>
            </div>
        </div>

        <!-- Matches tab content -->
        <div id="content-matches" class="tab-content">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="text-center py-8">
                    <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-500 mb-2">No favorite matches yet</h3>
                    <p class="text-gray-400 mb-4">Save matches to your favorites to see them here</p>
                    <a href="/match-schedule" class="btn-primary">Browse Match Schedule</a>
                </div>
            </div>

            <!-- Example of favorite match (hidden by default) -->
            <div class="hidden bg-white rounded-lg shadow-md overflow-hidden mb-4">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-sm text-muted-foreground">June 10, 2030 • 18:00</div>
                            <h3 class="text-xl font-semibold my-2">Morocco vs TBD</h3>
                            <div class="text-sm text-muted-foreground">Mohammed V Stadium, Casablanca • Group A</div>
                        </div>
                        <button class="text-primary hover:text-primary/80">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teams tab content (hidden by default) -->
        <div id="content-teams" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="text-center py-8">
                    <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-500 mb-2">No favorite teams yet</h3>
                    <p class="text-gray-400 mb-4">Save teams to your favorites to see them here</p>
                    <a href="#" class="btn-primary">Browse Teams</a>
                </div>
            </div>
        </div>

        <!-- Venues tab content (hidden by default) -->
        <div id="content-venues" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="text-center py-8">
                    <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-500 mb-2">No favorite venues yet</h3>
                    <p class="text-gray-400 mb-4">Save venues to your favorites to see them here</p>
                    <a href="/stadiums" class="btn-primary">Browse Stadiums</a>
                </div>
            </div>
        </div>

        <div class="bg-primary/10 p-6 rounded-lg mt-8">
            <div class="flex items-start">
                <svg class="h-6 w-6 text-primary mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Login to save your favorites</h3>
                    <p class="text-muted-foreground mb-4">Create an account or log in to save your favorites and access them from any device.</p>
                    <a href="/login" class="btn-primary">Login or Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = ['matches', 'teams', 'venues'];

        tabs.forEach(tab => {
            document.getElementById(`tab-${tab}`).addEventListener('click', function() {
                // Hide all tab contents
                tabs.forEach(t => {
                    document.getElementById(`content-${t}`).classList.add('hidden');
                    document.getElementById(`tab-${t}`).classList.remove('border-primary', 'text-primary');
                    document.getElementById(`tab-${t}`).classList.add('border-transparent');
                });

                // Show selected tab content
                document.getElementById(`content-${tab}`).classList.remove('hidden');
                document.getElementById(`tab-${tab}`).classList.add('border-primary', 'text-primary');
                document.getElementById(`tab-${tab}`).classList.remove('border-transparent');
            });
        });
    });
</script>
@endsection
