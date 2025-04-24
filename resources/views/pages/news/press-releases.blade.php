@extends('layouts.app')

@section('title', 'Press Releases - Morocco 2030 World Cup')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Press Releases</h1>
            <p class="text-xl text-gray-600">Official statements and documents from the Morocco 2030 World Cup Organizing Committee</p>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Filter options -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h2 class="text-lg font-semibold">Filter Press Releases</h2>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="relative">
                            <select class="form-select rounded border-gray-300 pr-10 focus:border-primary focus:ring focus:ring-primary/20">
                                <option value="">All Categories</option>
                                <option value="infrastructure">Infrastructure</option>
                                <option value="events">Events</option>
                                <option value="announcements">Announcements</option>
                                <option value="meetings">Meetings</option>
                            </select>
                        </div>
                        <div class="relative">
                            <select class="form-select rounded border-gray-300 pr-10 focus:border-primary focus:ring focus:ring-primary/20">
                                <option value="">All Years</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Press Releases List -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pressReleases as $release)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $release['title'] }}</div>
                                            <div class="text-sm text-gray-500">{{ $release['description'] }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $release['date'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $release['size'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ asset($release['file']) }}" class="text-primary hover:text-primary-dark hover:underline inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                            </svg>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Media Contact Info -->
            <div class="bg-primary/5 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-3">Media Contact</h3>
                <p class="mb-4">For media inquiries related to these press releases or to request additional information:</p>
                <div class="space-y-2">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <span>media@morocco2030.com</span>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+212 522 123 456</span>
                    </div>
                </div>
            </div>

            <!-- Subscribe to Press Releases -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-xl font-semibold mb-3">Stay Updated</h3>
                <p class="mb-4">Subscribe to receive press releases directly to your email inbox:</p>
                <form class="flex flex-col sm:flex-row gap-4" id="press-subscribe-form" method="POST" action="{{ route('newsletter.subscribe') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Your email address" required class="flex-grow px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary">
                    <input type="hidden" name="list" value="press-releases">
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-md transition-colors duration-200 ease-in-out whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
                <p class="text-sm text-gray-500 mt-4">By subscribing, you agree to receive email communications from Morocco 2030 World Cup Organization.</p>
            </div>
        </div>
    </div>
</div>
@endsection
