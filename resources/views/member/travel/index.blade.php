@extends('layouts.member')

@section('title', 'Travel Information')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Travel Information</h1>
    <p class="text-gray-600">Plan your Morocco 2030 World Cup journey with member-exclusive travel resources.</p>
</div>

<!-- Navigation Tabs -->
<div class="mb-8">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="{{ route('member.travel.index') }}" class="border-primary text-primary hover:text-primary hover:border-primary px-1 py-4 text-sm font-medium border-b-2">
                Overview
            </a>
            <a href="{{ route('member.travel.transportation') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Transportation
            </a>
            <a href="{{ route('member.travel.accommodations') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Accommodations
            </a>
            <a href="{{ route('member.travel.tips') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Travel Tips
            </a>
        </nav>
    </div>
</div>

<!-- Cities Map Section -->
<div class="bg-white rounded-lg shadow-md p-5 mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Host Cities Map</h2>
    <div class="h-96 bg-gray-100 rounded-lg flex items-center justify-center mb-4">
        <!-- Interactive Map would be embedded here -->
        <div class="text-center">
            <p class="text-gray-500 mb-2">Interactive Map Coming Soon</p>
            <p class="text-sm text-gray-400">Explore host cities, stadiums, and transportation routes</p>
        </div>
    </div>
    <p class="text-gray-600 text-sm italic">As a member, you have access to our interactive travel planning map with information about transportation routes, accommodations, and attractions.</p>
</div>

<!-- Travel Planning Tools -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">My Travel Itinerary</h2>
        <p class="text-gray-600 mb-4">Create and manage your custom World Cup travel itinerary.</p>
        <div class="space-y-4">
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                <h3 class="text-md font-semibold text-blue-800 mb-2">Member Exclusive Feature</h3>
                <p class="text-blue-700 text-sm">Build your personalized travel plan based on your favorite matches and cities.</p>
                <a href="#" class="mt-3 inline-block text-primary font-medium hover:text-primary/80 transition-colors text-sm">
                    Start Planning
                </a>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="text-md font-semibold text-gray-800 mb-2">Suggested Itineraries</h3>
                <ul class="text-sm text-gray-600 space-y-2 list-disc list-inside">
                    <li>7-Day Northern Morocco Tour</li>
                    <li>10-Day Complete Morocco Cup Experience</li>
                    <li>5-Day Final Week Package</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Transportation Options</h2>
        <p class="text-gray-600 mb-4">Compare and book various transportation methods between host cities.</p>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <h3 class="font-medium text-gray-800">Trains</h3>
                    <p class="text-sm text-gray-600">High-speed rail connections</p>
                </div>
                <a href="{{ route('member.travel.transportation') }}#trains" class="text-primary hover:text-primary/80 text-sm">View Options</a>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <h3 class="font-medium text-gray-800">Flights</h3>
                    <p class="text-sm text-gray-600">Domestic air travel</p>
                </div>
                <a href="{{ route('member.travel.transportation') }}#flights" class="text-primary hover:text-primary/80 text-sm">View Options</a>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <h3 class="font-medium text-gray-800">Bus Services</h3>
                    <p class="text-sm text-gray-600">Intercity coach services</p>
                </div>
                <a href="{{ route('member.travel.transportation') }}#buses" class="text-primary hover:text-primary/80 text-sm">View Options</a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Accommodations -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Featured Accommodations</h2>
        <a href="{{ route('member.travel.accommodations') }}" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">
            View All Accommodations
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @if($accommodations && $accommodations->count() > 0)
            @foreach($accommodations->take(3) as $accommodation)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-48 bg-gray-200 relative">
                    @if($accommodation->image_path)
                    <img 
                        src="{{ asset('storage/' . $accommodation->image_path) }}" 
                        alt="{{ $accommodation->name }}" 
                        class="w-full h-full object-cover"
                    >
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3">
                        <span class="text-white font-medium">{{ $accommodation->city->name ?? 'Unknown Location' }}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $accommodation->name }}</h3>
                    <p class="text-gray-500 text-sm mb-2">{{ $accommodation->type }}</p>
                    
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= $accommodation->rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="text-gray-700 font-medium">${{ number_format($accommodation->price_per_night) }}/night</span>
                    </div>
                    
                    <a href="#" class="text-primary font-medium hover:text-primary/80 transition-colors text-sm">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        @else
        <div class="col-span-3 p-6 text-center bg-gray-50 rounded-lg">
            <p class="text-gray-600">No accommodations available at this time.</p>
        </div>
        @endif
    </div>
</div>

<!-- Travel Tips -->
<div class="bg-white rounded-lg shadow-md p-5 mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Member Travel Tips</h2>
    
    <div class="space-y-4">
        <div class="p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Best Time to Visit</h3>
            <p class="text-gray-600">Morocco's climate varies by region. Coastal areas are pleasant year-round, while inland cities can be very hot in summer. The World Cup matches are scheduled to optimize for comfortable viewing conditions.</p>
        </div>
        
        <div class="p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Local Currency</h3>
            <p class="text-gray-600">The official currency is the Moroccan Dirham (MAD). ATMs are widely available in urban areas. Credit cards are accepted at major establishments, but carry cash for smaller businesses.</p>
        </div>
        
        <div class="p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Cultural Customs</h3>
            <p class="text-gray-600">Morocco is a Muslim country with rich cultural traditions. Dress modestly when visiting religious sites. Learn a few phrases in Arabic or French, which are widely spoken alongside English in tourist areas.</p>
        </div>
    </div>
    
    <div class="mt-4 text-right">
        <a href="{{ route('member.travel.tips') }}" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">
            View All Travel Tips →
        </a>
    </div>
</div>

<!-- Member Resources -->
<div class="bg-blue-50 border border-blue-100 rounded-lg p-5">
    <h2 class="text-xl font-semibold text-blue-800 mb-3">Member Resources</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Downloadable Resources</h3>
            <ul class="space-y-2">
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                    </svg>
                    <a href="#" class="text-primary hover:text-primary/80 text-sm">Morocco 2030 Travel Guide (PDF)</a>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                    </svg>
                    <a href="#" class="text-primary hover:text-primary/80 text-sm">City Transit Maps (PDF)</a>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                    </svg>
                    <a href="#" class="text-primary hover:text-primary/80 text-sm">Match Day Travel Guide (PDF)</a>
                </li>
            </ul>
        </div>
        
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Travel Support</h3>
            <div class="p-4 bg-white rounded-lg">
                <p class="text-gray-600 mb-3">Need assistance planning your trip? Our member support team is here to help!</p>
                <a href="#" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary/90 transition-colors">
                    Contact Travel Support
                </a>
            </div>
        </div>
    </div>
</div>

@endsection