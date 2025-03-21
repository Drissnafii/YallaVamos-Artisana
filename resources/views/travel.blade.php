@extends('app')

@section('title', 'Travel')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">Travel Information</h1>
            <p class="section-subtitle">Everything you need to know about traveling to Morocco for the 2030 World Cup</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <section class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Getting to Morocco</h2>
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold mb-4">By Air</h3>
                        <p class="mb-4">Morocco has several international airports with the main ones being:</p>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li>Mohammed V International Airport (Casablanca) - The largest airport and main hub</li>
                            <li>Marrakech Menara Airport - Serving the popular tourist destination</li>
                            <li>Rabat-Salé Airport - Serving the capital city</li>
                            <li>Ibn Battouta Airport (Tangier) - Serving the northern region</li>
                        </ul>
                        <p>For the 2030 World Cup, additional flights will be scheduled from major cities worldwide.</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold mb-4">By Sea</h3>
                        <p class="mb-4">Ferry services connect Morocco to Spain and France:</p>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li>Tangier to Algeciras (Spain) - Approximately 1.5 hours</li>
                            <li>Tangier to Tarifa (Spain) - Approximately 1 hour</li>
                            <li>Nador to Almeria (Spain) - Approximately 6 hours</li>
                            <li>Tangier to Barcelona (Spain) - Overnight journey</li>
                        </ul>
                    </div>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Getting Around</h2>
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold mb-4">Public Transportation</h3>
                        <p class="mb-4">Morocco has invested heavily in its transportation infrastructure for the 2030 World Cup:</p>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li><strong>Trains:</strong> The ONCF rail network connects major cities with comfortable and efficient service</li>
                            <li><strong>Trams:</strong> Casablanca, Rabat, and Marrakech have modern tram systems</li>
                            <li><strong>Buses:</strong> Extensive intercity bus networks operated by CTM and Supratours</li>
                            <li><strong>Taxis:</strong> Both "petit taxis" (within cities) and "grand taxis" (between cities) are available</li>
                        </ul>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">World Cup Transportation Pass</h3>
                        <p class="mb-4">A special World Cup Transportation Pass will be available for fans, providing:</p>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li>Unlimited travel on public transportation in host cities</li>
                            <li>Discounted intercity train and bus travel</li>
                            <li>Free shuttle services to and from stadiums on match days</li>
                        </ul>
                        <p>Passes can be purchased online or at transportation hubs upon arrival.</p>
                    </div>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Accommodation</h2>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <p class="mb-4">Morocco offers a wide range of accommodation options:</p>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li><strong>Hotels:</strong> From luxury 5-star to budget-friendly options</li>
                            <li><strong>Riads:</strong> Traditional Moroccan houses with interior gardens, offering an authentic experience</li>
                            <li><strong>Apartments:</strong> Short-term rentals available in all major cities</li>
                            <li><strong>Fan Villages:</strong> Special accommodation zones created for the World Cup</li>
                        </ul>
                        <div class="bg-primary/10 p-4 rounded-lg">
                            <p class="font-semibold">Booking Tip:</p>
                            <p>Early booking is strongly recommended as accommodation will fill up quickly. The official FIFA accommodation portal will open in early 2029.</p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 mb-8 sticky top-24">
                    <h3 class="text-xl font-semibold mb-4">Travel Essentials</h3>

                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Visa Information</h4>
                        <p class="text-sm text-muted-foreground mb-2">Many countries have visa-free access to Morocco. For the 2030 World Cup, a special fan ID system will be implemented that will serve as a visa for ticket holders.</p>
                        <a href="#" class="text-primary text-sm hover:underline">Check visa requirements →</a>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Currency</h4>
                        <p class="text-sm text-muted-foreground">The Moroccan Dirham (MAD) is the official currency. Credit cards are widely accepted in urban areas and tourist destinations.</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Language</h4>
                        <p class="text-sm text-muted-foreground">Arabic and Berber are the official languages. French is widely spoken, and English is common in tourist areas.</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Weather</h4>
                        <p class="text-sm text-muted-foreground">June-July in Morocco is generally hot and dry. Coastal cities are more moderate, while inland cities can reach high temperatures.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-2">Emergency Contacts</h4>
                        <ul class="text-sm text-muted-foreground space-y-1">
                            <li>Emergency: 190</li>
                            <li>Police: 190</li>
                            <li>Ambulance: 150</li>
                            <li>World Cup Helpline: TBA</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
