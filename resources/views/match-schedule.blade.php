@extends('app')

@section('title', 'Match Schedule')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">Match Schedule</h1>
            <p class="section-subtitle">Plan your World Cup experience with our comprehensive match schedule</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Group Stage</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Date</th>
                            <th class="py-3 px-4 text-left">Time</th>
                            <th class="py-3 px-4 text-left">Match</th>
                            <th class="py-3 px-4 text-left">Venue</th>
                            <th class="py-3 px-4 text-left">Group</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4">June 10, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">Morocco vs TBD</td>
                            <td class="py-3 px-4">Mohammed V Stadium, Casablanca</td>
                            <td class="py-3 px-4">Group A</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">June 11, 2030</td>
                            <td class="py-3 px-4">15:00</td>
                            <td class="py-3 px-4">TBD vs TBD</td>
                            <td class="py-3 px-4">Marrakech Stadium, Marrakech</td>
                            <td class="py-3 px-4">Group B</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">June 11, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">TBD vs TBD</td>
                            <td class="py-3 px-4">Rabat Stadium, Rabat</td>
                            <td class="py-3 px-4">Group C</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">June 12, 2030</td>
                            <td class="py-3 px-4">15:00</td>
                            <td class="py-3 px-4">TBD vs TBD</td>
                            <td class="py-3 px-4">Tangier Stadium, Tangier</td>
                            <td class="py-3 px-4">Group D</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">June 12, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">TBD vs TBD</td>
                            <td class="py-3 px-4">Fez Stadium, Fez</td>
                            <td class="py-3 px-4">Group E</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Round of 16</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Date</th>
                            <th class="py-3 px-4 text-left">Time</th>
                            <th class="py-3 px-4 text-left">Match</th>
                            <th class="py-3 px-4 text-left">Venue</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4">June 28, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">Winner Group A vs Runner-up Group B</td>
                            <td class="py-3 px-4">Mohammed V Stadium, Casablanca</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">June 29, 2030</td>
                            <td class="py-3 px-4">15:00</td>
                            <td class="py-3 px-4">Winner Group C vs Runner-up Group D</td>
                            <td class="py-3 px-4">Marrakech Stadium, Marrakech</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">June 29, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">Winner Group E vs Runner-up Group F</td>
                            <td class="py-3 px-4">Rabat Stadium, Rabat</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Quarter Finals</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Date</th>
                            <th class="py-3 px-4 text-left">Time</th>
                            <th class="py-3 px-4 text-left">Match</th>
                            <th class="py-3 px-4 text-left">Venue</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4">July 3, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">QF1: TBD vs TBD</td>
                            <td class="py-3 px-4">Mohammed V Stadium, Casablanca</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">July 4, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">QF2: TBD vs TBD</td>
                            <td class="py-3 px-4">Marrakech Stadium, Marrakech</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Semi Finals</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Date</th>
                            <th class="py-3 px-4 text-left">Time</th>
                            <th class="py-3 px-4 text-left">Match</th>
                            <th class="py-3 px-4 text-left">Venue</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4">July 7, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">Winner QF1 vs Winner QF2</td>
                            <td class="py-3 px-4">Mohammed V Stadium, Casablanca</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-6">Final</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Date</th>
                            <th class="py-3 px-4 text-left">Time</th>
                            <th class="py-3 px-4 text-left">Match</th>
                            <th class="py-3 px-4 text-left">Venue</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4">July 10, 2030</td>
                            <td class="py-3 px-4">18:00</td>
                            <td class="py-3 px-4">Winner SF1 vs Winner SF2</td>
                            <td class="py-3 px-4">Mohammed V Stadium, Casablanca</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 bg-primary/10 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Note:</h3>
            <p class="text-muted-foreground">This is a preliminary schedule. Final match details including teams will be updated as qualifications progress. All times are local Morocco time (GMT+1).</p>
        </div>
    </div>
</div>
@endsection

