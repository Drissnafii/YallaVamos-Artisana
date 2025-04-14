@extends('layouts.admin')

@section('title', $accommodation->name)

@section('header', 'Accommodation Details')

@section('content')
<div class="container mx-auto px-0 md:px-4 py-0 md:py-4 max-w-5xl">
    <!-- Header Image with Title Overlay -->
    <div class="relative overflow-hidden rounded-lg shadow-md bg-white">
        <div class="h-64 md:h-80">
            @if($accommodation->image)
                <img src="{{ asset('storage/' . $accommodation->image) }}" alt="{{ $accommodation->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            @endif
        </div>
        <div class="absolute bottom-0 left-0 w-full h-2/5 bg-gradient-to-t from-black/70 to-transparent"></div>
        <h1 class="absolute bottom-6 left-6 text-white text-2xl md:text-3xl font-bold max-w-[70%] leading-tight">{{ $accommodation->name }}</h1>
    </div>
    <!-- Sticky Action Bar -->
    <div id="stickyActionBar" class="sticky top-16 z-9 backdrop-blur-md bg-white/70 shadow-md flex justify-between items-center p-4 mt-1 rounded-lg transition-all duration-500">
        <a href="{{ route('admin.accommodations.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Back</span>
        </a>

        <div class="flex space-x-2 relative h-8 overflow-hidden">
            <!-- Tags (visible by default) -->
            <div id="accommodationTags" class="flex space-x-2 absolute inset-0 transition-all duration-500 ease-in-out opacity-100 transform translate-y-0">
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                    {{ ucfirst($accommodation->type) }}
                </span>
                <span class="px-3 py-1 text-xs font-medium rounded-full
                    {{ $accommodation->price_range === 'luxury' ? 'bg-purple-100 text-purple-800' :
                    ($accommodation->price_range === 'mid-range' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($accommodation->price_range) }}
                </span>
            </div>

            <!-- Accommodation Name (hidden by default) -->
            <div id="accommodationName" class="transition-all duration-500 delay-100 ease-in-out opacity-0 transform -translate-y-4 absolute left-1/2 transform -translate-x-1/2 font-semibold whitespace-nowrap max-w-[250px] truncate">
                {{ $accommodation->name }}
            </div>
        </div>

        <div class="flex space-x-2">
            <a href="{{ route('admin.accommodations.edit', $accommodation) }}" class="flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition-colors duration-200 font-medium text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                <span class="hidden md:inline">Edit</span>
            </a>
            <form action="{{ route('admin.accommodations.destroy', $accommodation) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center justify-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded transition-colors duration-200 font-medium text-sm" onclick="return confirm('Are you sure you want to delete this accommodation?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden md:inline">Delete</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Content Card -->
    <div class="bg-white rounded-lg shadow-md mt-4 overflow-hidden">
        <!-- Description Section -->
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-sm font-medium text-blue-600 uppercase tracking-wide mb-4">Description</h2>
            <div class="text-gray-700 leading-relaxed">
                {{ $accommodation->description ?? 'No description available.' }}
            </div>
        </div>

        <!-- Location Section -->
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-sm font-medium text-blue-600 uppercase tracking-wide mb-4">Location</h2>
            <div class="text-lg text-gray-800">{{ $accommodation->address }}</div>
            <div class="text-gray-600">{{ $accommodation->city->name }}</div>
            <div class="mt-4 h-40 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-gray-500">Map placeholder</span>
            </div>
        </div>

        <!-- Contact Information Section -->
        @if($accommodation->phone || $accommodation->email || $accommodation->website)
        <div class="p-6">
            <h2 class="text-sm font-medium text-blue-600 uppercase tracking-wide mb-4">Contact Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($accommodation->phone)
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span class="text-gray-800">{{ $accommodation->phone }}</span>
                </div>
                @endif

                @if($accommodation->email)
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <a href="mailto:{{ $accommodation->email }}" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">{{ $accommodation->email }}</a>
                </div>
                @endif

                @if($accommodation->website)
                <div class="flex items-center col-span-1 md:col-span-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <a href="{{ $accommodation->website }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200 truncate">{{ $accommodation->website }}</a>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Quick Actions Section -->
    <div class="bg-white rounded-lg shadow-md mt-4 mb-8 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-medium text-blue-600 uppercase tracking-wide">Quick Actions</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="p-4 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors duration-200 flex flex-col items-center justify-center text-center group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mb-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="font-medium text-blue-800">View Bookings</span>
            </a>
            <a href="#" class="p-4 rounded-lg bg-green-50 hover:bg-green-100 transition-colors duration-200 flex flex-col items-center justify-center text-center group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mb-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="font-medium text-green-800">Gallery</span>
            </a>
            <a href="#" class="p-4 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors duration-200 flex flex-col items-center justify-center text-center group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 mb-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <span class="font-medium text-purple-800">Reviews</span>
            </a>
            <a href="#" class="p-4 rounded-lg bg-orange-50 hover:bg-orange-100 transition-colors duration-200 flex flex-col items-center justify-center text-center group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600 mb-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                <span class="font-medium text-orange-800">Share</span>
            </a>
        </div>
    </div>
</div>

<!-- Quick Access FAB -->
<div class="fixed bottom-6 right-6">
    <button class="w-14 h-14 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
    </button>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const headerImageContainer = document.querySelector('.relative.overflow-hidden.rounded-lg');
        const headerImage = document.querySelector('.h-64.md\\:h-80 img') || document.querySelector('.h-64.md\\:h-80 div');
        const accommodationTags = document.getElementById('accommodationTags');
        const accommodationName = document.getElementById('accommodationName');
        const stickyActionBar = document.getElementById('stickyActionBar');

        // Extract dominant color from the header image
        function extractDominantColor() {
            // Default fallback colors if we can't extract
            let bgColor = 'rgba(255, 255, 255, 0.7)';
            let textColor = 'rgb(30, 64, 175)'; // blue-800

            // If it's a gradient div (no image), use its color
            if (headerImage && headerImage.classList.contains('bg-gradient-to-r')) {
                // Extract blue color from the gradient
                bgColor = 'rgba(96, 165, 250, 0.7)'; // blue-400 with opacity
                // Set the sticky bar style immediately
                applyColorToStickyBar(bgColor, textColor);
                return;
            }

            // For actual images, we'll use a lightweight approach
            // since we can't directly analyze the image without a canvas
            // This is a simplified implementation - for production, consider
            // extracting the dominant color server-side
            if (headerImage && headerImage.tagName === 'IMG') {
                // Set the sticky bar style with default blue-tinted background
                // as a fallback since we can't easily extract image colors
                bgColor = 'rgba(219, 234, 254, 0.8)'; // blue-100 with opacity
                applyColorToStickyBar(bgColor, textColor);
            }
        }

        function applyColorToStickyBar(bgColor, textColor) {
            // Apply the extracted/default color to the sticky bar
            stickyActionBar.style.backgroundColor = bgColor;
            accommodationName.style.color = textColor;
        }

        // Call once on page load
        extractDominantColor();

        window.addEventListener('scroll', function() {
            // Get the position and dimensions of the header image
            const headerRect = headerImageContainer.getBoundingClientRect();

            // Calculate how much of the image has scrolled out (0 to 1)
            const scrollProgress = Math.min(1, Math.max(0, 1 - (headerRect.bottom / headerRect.height)));

            // Apply blur effect proportional to scroll
            const blurAmount = Math.min(16, Math.floor(scrollProgress * 20));
            stickyActionBar.style.backdropFilter = `blur(${blurAmount}px)`;

            // Check if the header image has scrolled out of view (when bottom of image is above viewport)
            if (headerRect.bottom <= 0) {
                // Show accommodation name, hide tags with enhanced animations
                accommodationTags.classList.remove('opacity-100', 'translate-y-0');
                accommodationTags.classList.add('opacity-0', 'translate-y-4');

                // Slight delay for staggered effect
                setTimeout(() => {
                    accommodationName.classList.remove('opacity-0', '-translate-y-4');
                    accommodationName.classList.add('opacity-100', 'translate-y-0');
                }, 50);
            } else {
                // Show tags, hide accommodation name
                accommodationName.classList.remove('opacity-100', 'translate-y-0');
                accommodationName.classList.add('opacity-0', '-translate-y-4');

                // Slight delay for staggered effect
                setTimeout(() => {
                    accommodationTags.classList.remove('opacity-0', 'translate-y-4');
                    accommodationTags.classList.add('opacity-100', 'translate-y-0');
                }, 50);
            }
        });
    });
</script>
@endpush

@endsection
