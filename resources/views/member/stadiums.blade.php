@extends('layouts.member')

@section('title', 'Stadium Locations')

@section('head')
    <!-- Add Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    
    <!-- Add Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Stadium Locations</h1>
            <p class="text-gray-600 mb-6">View the geographical distribution of all World Cup stadiums across Morocco</p>
            
            <!-- Map Container -->
            <div class="w-full h-[600px] rounded-lg overflow-hidden border border-gray-200" id="map"></div>
        </div>
    </div>

    <!-- Map Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the map with specific options
            const map = L.map('map', {
                minZoom: 5,
                maxZoom: 18,
                zoomControl: true,
                scrollWheelZoom: true
            });

            // Add OpenStreetMap tiles with better styling
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 18,
                tileSize: 512,
                zoomOffset: -1
            }).addTo(map);

            // Create custom icon for stadium markers
            const stadiumIcon = L.icon({
                iconUrl: '/images/stadium-marker.svg',
                iconSize: [32, 32],
                iconAnchor: [16, 16],
                popupAnchor: [0, -16]
            });

            // Get stadium data
            const stadiums = {!! json_encode($stadiumsData) !!};

            // Add markers for each stadium
            const markers = [];
            stadiums.forEach(stadium => {
                if (stadium.latitude && stadium.longitude) {
                    const marker = L.marker([stadium.latitude, stadium.longitude], {
                        icon: stadiumIcon
                    }).addTo(map);

                    // Create popup content
                    const popupContent = `
                        <div class="p-3 max-w-xs">
                            ${stadium.image ? `<img src="${stadium.image}" alt="${stadium.name}" class="w-full h-32 object-cover rounded-lg mb-2">` : ''}
                            <h3 class="font-semibold text-lg mb-1">${stadium.name}</h3>
                            <p class="text-gray-600 text-sm mb-1">${stadium.city}</p>
                            <p class="text-gray-600 text-sm mb-1">Capacity: ${stadium.capacity}</p>
                            <p class="text-gray-600 text-sm mb-2">Status: ${stadium.status}</p>
                            <a href="${stadium.url}" class="inline-block bg-primary-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">View Details</a>
                        </div>
                    `;

                    marker.bindPopup(popupContent);
                    markers.push(marker);
                }
            });

            // Set initial view to Morocco
            map.setView([31.7917, -7.0926], 6);

            // If we have markers, fit the map to show all of them
            if (markers.length > 0) {
                const group = L.featureGroup(markers);
                map.fitBounds(group.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 7
                });
            }

            // Handle window resize
            function handleResize() {
                map.invalidateSize();
                if (markers.length > 0) {
                    const group = L.featureGroup(markers);
                    map.fitBounds(group.getBounds(), {
                        padding: [50, 50],
                        maxZoom: 7
                    });
                }
            }

            window.addEventListener('resize', handleResize);

            // Force a resize check after a short delay
            setTimeout(handleResize, 250);
        });
    </script>

    <style>
        #map {
            width: 100% !important;
            height: 600px !important;
            z-index: 1;
        }
        .leaflet-container {
            width: 100% !important;
            height: 100% !important;
        }
        .leaflet-popup-content {
            margin: 0;
            min-width: 200px;
        }
        .leaflet-popup-content-wrapper {
            padding: 0;
            border-radius: 8px;
            overflow: hidden;
        }
        .leaflet-control-zoom {
            border: none !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
        }
        .leaflet-control-zoom a {
            border-radius: 8px !important;
            color: #4B5563 !important;
            background-color: white !important;
        }
        .leaflet-control-zoom a:hover {
            background-color: #F3F4F6 !important;
        }
    </style>
</div>
@endsection 