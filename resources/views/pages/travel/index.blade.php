@extends('layouts.app')

@section('title', 'Travel Information')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Travel Information</h1>
            <p class="text-xl text-muted-foreground">Everything you need to know for your trip to Morocco</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <h2 class="text-3xl font-bold mb-6">Getting to Morocco</h2>

                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">By Air</h3>
                    <p class="mb-4">Morocco has several international airports, with the main ones being:</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li>Mohammed V International Airport (Casablanca)</li>
                        <li>Marrakesh Menara Airport</li>
                        <li>Rabat–Salé Airport</li>
                        <li>Tangier Ibn Battouta Airport</li>
                        <li>Fes–Saïs Airport</li>
                    </ul>
                    <p>Direct flights are available from major cities in Europe, the Middle East, and North America. For the World Cup, additional flights will be scheduled to accommodate the increased number of visitors.</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Visa Information</h3>
                    <p class="mb-4">Visa requirements for Morocco vary depending on your nationality. Many countries have visa-free access for stays up to 90 days, including:</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li>European Union countries</li>
                        <li>United States</li>
                        <li>Canada</li>
                        <li>Australia</li>
                        <li>Many South American countries</li>
                    </ul>
                    <p>For the 2030 FIFA World Cup, Morocco will implement a special visa process for ticket holders. More information will be available closer to the event.</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Transportation Within Morocco</h3>
                    <p class="mb-4">Morocco has an excellent transportation network that will be further enhanced for the World Cup:</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li><strong>Trains:</strong> Morocco's rail network connects major cities with comfortable and efficient service.</li>
                        <li><strong>Buses:</strong> Intercity buses are a popular and affordable option for traveling between cities.</li>
                        <li><strong>Taxis:</strong> Both petit taxis (within cities) and grand taxis (between cities) are widely available.</li>
                        <li><strong>Car Rental:</strong> Major international car rental companies operate in Morocco.</li>
                    </ul>
                    <p>For the World Cup, special shuttle services will be available between airports, major hotels, and stadiums.</p>
                </div>
            </div>

            <div>
                <div class="card p-6 mb-6">
                    <h3 class="text-xl font-semibold mb-4">Quick Facts</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary mt-0.5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><strong>Time Zone:</strong> GMT+1 (GMT+0 during Ramadan) </span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary mt-0.5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            <span><strong>Currency:</strong> Moroccan Dirham (MAD) </span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary mt-0.5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21l5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 016-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 01-3.827-5.802" />
                            </svg>
                            <span><strong>Languages:</strong> Arabic, Berber (official) , French (widely spoken)</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary mt-0.5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>
                            <span><strong>Electricity:</strong> 220V, 50Hz (European plugs) </span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary mt-0.5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>
                            <span><strong>Internet:</strong> 4G/5G widely available in cities</span>
                        </li>
                    </ul>
                </div>

                <div class="card p-6">
                    <h3 class="text-xl font-semibold mb-4">Weather</h3>
                    <p class="mb-4">The World Cup will take place during summer in Morocco. Typical temperatures:</p>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span>Casablanca:</span>
                            <span>22-28°C (72-82°F) </span>
                        </li>
                        <li class="flex justify-between">
                            <span>Marrakech:</span>
                            <span>25-38°C (77-100°F)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Rabat:</span>
                            <span>22-26°C (72-79°F)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Tangier:</span>
                            <span>23-28°C (73-82°F)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Fes:</span>
                            <span>25-35°C (77-95°F)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-muted py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Accommodation</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card overflow-hidden">
                <img src="/images/accommodation/hotels.jpg" alt="Hotels" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Hotels</h3>
                    <p class="text-muted-foreground mb-4">From luxury 5-star hotels to budget-friendly options, Morocco offers a wide range of accommodations in all host cities.</p>
                    <a href="/travel/accommodation#hotels" class="text-primary hover:underline">View Options</a>
                </div>
            </div>
            <div class="card overflow-hidden">
                <img src="/images/accommodation/riads.jpg" alt="Traditional Riads" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Traditional Riads</h3>
                    <p class="text-muted-foreground mb-4">Experience authentic Moroccan hospitality in a traditional riad, typically found in the medinas of major cities.</p>
                    <a href="/travel/accommodation#riads" class="text-primary hover:underline">View Options</a>
                </div>
            </div>
            <div class="card overflow-hidden">
                <img src="/images/accommodation/apartments.jpg" alt="Apartments" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Apartments & Villas</h3>
                    <p class="text-muted-foreground mb-4">Ideal for families or groups, rental apartments and villas offer more space and the convenience of self-catering.</p>
                    <a href="/travel/accommodation#apartments" class="text-primary hover:underline">View Options</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
