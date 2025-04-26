@extends('layouts.member')

@section('title', 'Travel Tips')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Travel Tips</h1>
    <p class="text-gray-600">Essential tips for navigating Morocco during the 2030 World Cup.</p>
</div>

<!-- Navigation Tabs -->
<div class="mb-8">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="{{ route('member.travel.index') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Overview
            </a>
            <a href="{{ route('member.travel.transportation') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Transportation
            </a>
            <a href="{{ route('member.travel.accommodations') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Accommodations
            </a>
            <a href="{{ route('member.travel.tips') }}" class="border-primary text-primary hover:text-primary hover:border-primary px-1 py-4 text-sm font-medium border-b-2">
                Travel Tips
            </a>
        </nav>
    </div>
</div>

<!-- Tips Content -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Cultural Tips</h2>
        <p class="text-gray-600 mb-4">Important cultural information for visiting Morocco.</p>
        <!-- Add cultural tips here -->
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Safety Advice</h2>
        <p class="text-gray-600 mb-4">Stay safe during your World Cup travels.</p>
        <!-- Add safety advice here -->
    </div>
</div>

<!-- Essential Information -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Essential Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Add essential info cards here -->
    </div>
</div>

@endsection
