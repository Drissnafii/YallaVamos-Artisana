@extends('layouts.member')

@section('title', $accommodation->name)

@section('content')
<div class="mb-6">
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('member.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('member.travel.index') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-primary md:ml-2">Travel</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('member.travel.accommodations') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-primary md:ml-2">Accommodations</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $accommodation->name }}</span>
                </div>
            </li>
        </ol>
    </nav>
    
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">{{ $accommodation->name }}</h1>
    <p class="text-gray-600">{{ $accommodation->type }} in {{ $accommodation->city->name ?? 'Unknown Location' }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Accommodation Details -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <!-- Image Gallery -->
            <div class="h-96 bg-gray-200">
                @if($accommodation->image)
                    <img 
                        src="{{ asset('storage/' . $accommodation->image) }}" 
                        alt="{{ $accommodation->name }}" 
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
            </div>
            
            <!-- Main Content -->
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="h-5 w-5 {{ $i <= ($accommodation->rating ?? 3) ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="ml-2 text-gray-500">{{ $accommodation->rating ?? 3 }} stars</span>
                </div>

                <!-- Description -->
                <h2 class="text-xl font-semibold text-gray-800 mb-3">About This Property</h2>
                <p class="text-gray-600 mb-4">
                    {{ $accommodation->description ?? 'This World Cup 2030 accommodation offers comfort and convenience for all visitors. Located in ' . ($accommodation->city->name ?? 'Morocco') . ', it provides easy access to match venues and local attractions.' }}
                </p>
                
                <!-- Features -->
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Property Features</h2>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        <span class="text-gray-700">{{ $accommodation->capacity ?? 'Multiple' }} Guests</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">Air Conditioning</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">{{ $accommodation->distance_to_stadium ?? '2' }} km to stadium</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">24/7 Security</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">Free Wi-Fi</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        <span class="text-gray-700">Nearby Shops</span>
                    </div>
                </div>

                <!-- Location -->
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Location</h2>
                <div class="h-64 bg-gray-200 rounded mb-4">
                    <!-- Placeholder for map -->
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-gray-500">Map view of the location</span>
                    </div>
                </div>
                
                <!-- Neighborhood -->
                <h2 class="text-xl font-semibold text-gray-800 mb-3">About the Area</h2>
                <p class="text-gray-600 mb-6">
                    This property is located in {{ $accommodation->city->name ?? 'a prime location' }} with easy access to local attractions, restaurants, and transportation. 
                    The nearest stadium is within {{ $accommodation->distance_to_stadium ?? 'a short' }} distance, making it an ideal choice for World Cup 2030 visitors.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Booking Sidebar -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Booking Information</h2>
            
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-700">Price per night</span>
                <span class="text-xl font-bold text-gray-800">${{ number_format($accommodation->price_min ?? 100) }}</span>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mb-4">
                <div class="mb-4">
                    <label for="check-in" class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                    <input type="date" id="check-in" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                </div>
                
                <div class="mb-4">
                    <label for="check-out" class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                    <input type="date" id="check-out" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                </div>
                
                <div class="mb-4">
                    <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                    <select id="guests" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        <option>1 Guest</option>
                        <option>2 Guests</option>
                        <option>3 Guests</option>
                        <option>4 Guests</option>
                        <option>5+ Guests</option>
                    </select>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">${{ number_format($accommodation->price_min ?? 100) }} x 5 nights</span>
                    <span class="text-gray-700">${{ number_format(($accommodation->price_min ?? 100) * 5) }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Service fee</span>
                    <span class="text-gray-700">${{ number_format(($accommodation->price_min ?? 100) * 0.1) }}</span>
                </div>
                <div class="flex justify-between items-center font-bold text-lg mt-4">
                    <span>Total</span>
                    <span>${{ number_format((($accommodation->price_min ?? 100) * 5) + (($accommodation->price_min ?? 100) * 0.1)) }}</span>
                </div>
            </div>
            
            <button class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-3 px-4 rounded-md transition-colors">
                Book Now
            </button>
            
            <p class="text-xs text-gray-500 text-center mt-4">You won't be charged yet</p>
            
            <div class="mt-6 p-4 bg-blue-50 rounded-md">
                <h3 class="font-medium text-blue-800">Member Exclusive</h3>
                <p class="text-sm text-gray-600 mt-1">Get 10% off when you book as a YallaDiscover member!</p>
            </div>
        </div>
    </div>
</div>

<!-- Similar Accommodations -->
<div class="mt-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Similar Accommodations</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Placeholder for similar accommodations -->
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <div class="h-48 bg-gray-200 rounded mb-4 flex items-center justify-center">
                <span class="text-gray-500">Accommodation Image</span>
            </div>
            <h3 class="font-medium text-gray-800">Similar Option 1</h3>
            <p class="text-sm text-gray-600 mt-1">Near {{ $accommodation->city->name ?? 'this location' }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <div class="h-48 bg-gray-200 rounded mb-4 flex items-center justify-center">
                <span class="text-gray-500">Accommodation Image</span>
            </div>
            <h3 class="font-medium text-gray-800">Similar Option 2</h3>
            <p class="text-sm text-gray-600 mt-1">Near {{ $accommodation->city->name ?? 'this location' }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <div class="h-48 bg-gray-200 rounded mb-4 flex items-center justify-center">
                <span class="text-gray-500">Accommodation Image</span>
            </div>
            <h3 class="font-medium text-gray-800">Similar Option 3</h3>
            <p class="text-sm text-gray-600 mt-1">Near {{ $accommodation->city->name ?? 'this location' }}</p>
        </div>
    </div>
</div>
@endsection
