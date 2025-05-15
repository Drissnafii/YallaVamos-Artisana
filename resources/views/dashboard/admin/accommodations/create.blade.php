@extends('layouts.admin')

@section('title', 'Create Accommodation')

@section('header', 'Create New Accommodation')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('admin.accommodations.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Back to Accommodations
                </a>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden">
                <!-- Header -->
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-light text-gray-900">New Accommodation</h2>
                    <p class="mt-2 text-sm text-gray-500">Fill in the details to create a new accommodation listing</p>
                </div>

                <!-- Multi-step Form Progress -->
                <div class="px-8 pt-6">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-full flex items-center">
                            <!-- Step 1 -->
                            <div class="relative flex flex-col items-center">
                                <div id="step-indicator-1"
                                    class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-medium z-10">
                                    1
                                </div>
                                <div class="text-sm font-medium text-blue-600 mt-2">Basic Info</div>
                            </div>
                            <div class="flex-1 h-1 mx-4 bg-blue-600"></div>

                            <!-- Step 2 -->
                            <div class="relative flex flex-col items-center">
                                <div id="step-indicator-2"
                                    class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-medium z-10">
                                    2
                                </div>
                                <div class="text-sm font-medium text-gray-500 mt-2">Pricing</div>
                            </div>
                            <div class="flex-1 h-1 mx-4 bg-gray-200"></div>

                            <!-- Step 3 -->
                            <div class="relative flex flex-col items-center">
                                <div id="step-indicator-3"
                                    class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-medium z-10">
                                    3
                                </div>
                                <div class="text-sm font-medium text-gray-500 mt-2">Details & Media</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.accommodations.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8" id="accommodationForm" novalidate>
                    @csrf

                    <!-- Error display -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                            <div class="font-medium text-red-800">Oops! There were some problems with your submission:</div>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Step 1: Basic Info (visible by default) -->
                    <div id="step-1" class="transition-opacity duration-300">
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Accommodation Name <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-300 @enderror"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Type <span class="text-red-600">*</span>
                                    </label>
                                    <select name="type" id="type"
                                        class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('type') border-red-300 @enderror"
                                        required>
                                        <option value="">Select a type</option>
                                        <option value="hotel" {{ old('type') == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                        <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>Apartment
                                        </option>
                                        <option value="riad" {{ old('type') == 'riad' ? 'selected' : '' }}>Riad</option>
                                        <option value="guesthouse" {{ old('type') == 'guesthouse' ? 'selected' : '' }}>
                                            Guesthouse</option>
                                        <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="city_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        City <span class="text-red-600">*</span>
                                    </label>
                                    <select name="city_id" id="city_id"
                                        class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('city_id') border-red-300 @enderror"
                                        required>
                                        <option value="">Select a city</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}"
                                    class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('address') border-red-300 @enderror"
                                    required>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone
                                    </label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('phone') border-red-300 @enderror">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-300 @enderror">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
                                    Website
                                </label>
                                <input type="url" name="website" id="website" value="{{ old('website') }}"
                                    placeholder="https://example.com"
                                    class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('website') border-red-300 @enderror">
                                @error('website')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Next Step Button -->
                        <div class="mt-8 flex justify-end">
                            <button type="button" id="next-step-1"
                                class="px-8 py-2.5 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center">
                                Continue to Pricing
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Pricing (hidden by default) -->
                    <div id="step-2" class="hidden transition-opacity duration-300">
                        <div class="space-y-6">
                            <div>
                                <label for="price_range" class="block text-sm font-medium text-gray-700 mb-2">
                                    Price Range <span class="text-red-600">*</span>
                                </label>
                                <div class="flex items-center space-x-4">
                                    <select name="price_range" id="price_range"
                                        class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('price_range') border-red-300 @enderror"
                                        required>
                                        <option value="">Select a price range</option>
                                        <option value="budget" {{ old('price_range') == 'budget' ? 'selected' : '' }}>Budget
                                        </option>
                                        <option value="mid-range" {{ old('price_range') == 'mid-range' ? 'selected' : '' }}>
                                            Mid-Range</option>
                                        <option value="luxury" {{ old('price_range') == 'luxury' ? 'selected' : '' }}>Luxury
                                        </option>
                                    </select>
                                    <div
                                        class="price-badge hidden bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Budget</div>
                                    <div
                                        class="price-badge hidden bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Mid-Range</div>
                                    <div
                                        class="price-badge hidden bg-purple-100 text-purple-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Luxury</div>
                                </div>
                                @error('price_range')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price Range Slider -->
                            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                <div class="mb-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">Price Range</h3>
                                    <p class="text-sm text-gray-500">Set the minimum and maximum price per night</p>
                                </div>

                                <!-- Interactive Price Slider -->
                                <div class="mb-8">
                                    <div class="relative pt-6 pb-3">
                                        <div id="price-slider" class="h-2 bg-gray-200 rounded-full">
                                            <div id="price-range" class="absolute h-2 bg-blue-500 rounded-full"></div>
                                            <div id="min-price-handle"
                                                class="absolute w-6 h-6 bg-white border-2 border-blue-500 rounded-full -mt-2 -ml-3 cursor-pointer shadow-md">
                                            </div>
                                            <div id="max-price-handle"
                                                class="absolute w-6 h-6 bg-white border-2 border-blue-500 rounded-full -mt-2 -ml-3 cursor-pointer shadow-md">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>$0</span>
                                        <span>$1000+</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="price_min" class="block text-sm font-medium text-gray-700 mb-2">
                                            Minimum Price <span class="text-red-600">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">$</span>
                                            </div>
                                            <input type="number" name="price_min" id="price_min"
                                                value="{{ old('price_min') }}" min="0" max="1000" step="10"
                                                class="w-full pl-7 bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('price_min') border-red-300 @enderror"
                                                required>
                                        </div>
                                        @error('price_min')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="price_max" class="block text-sm font-medium text-gray-700 mb-2">
                                            Maximum Price <span class="text-red-600">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">$</span>
                                            </div>
                                            <input type="number" name="price_max" id="price_max"
                                                value="{{ old('price_max') }}" min="0" max="1000" step="10"
                                                class="w-full pl-7 bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('price_max') border-red-300 @enderror"
                                                required>
                                        </div>
                                        @error('price_max')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="mt-8 flex justify-between">
                            <button type="button" id="prev-step-2"
                                class="px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Back
                            </button>
                            <button type="button" id="next-step-2"
                                class="px-8 py-2.5 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center">
                                Continue to Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Details & Media (hidden by default) -->
                    <div id="step-3" class="hidden transition-opacity duration-300">
                        <div class="space-y-6">
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="5"
                                    class="w-full bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                                <p class="mt-1 text-sm text-gray-500">Provide a detailed description of the accommodation
                                    (amenities, nearby attractions, etc.)</p>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Images
                                </label>
                                <div id="image-upload-container"
                                    class="bg-gray-50 rounded-xl p-6 border-2 border-dashed border-gray-300 hover:border-blue-500 transition-colors">
                                    <div class="space-y-2 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="image"
                                                class="relative cursor-pointer bg-white rounded-full px-4 py-2 font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 shadow-sm">
                                                <span>Upload images</span>
                                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1 flex items-center">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>

                                <!-- Image Preview -->
                                <div id="image-preview-container"
                                    class="hidden mt-4 bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative w-24 h-24 rounded-lg overflow-hidden">
                                            <img id="preview-image" src="" alt="Preview" class="w-full h-full object-cover">
                                            <button type="button" id="remove-image"
                                                class="absolute top-1 right-1 bg-white rounded-full p-1 shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div>
                                            <p id="image-name" class="text-sm font-medium text-gray-700"></p>
                                            <p id="image-size" class="text-xs text-gray-500"></p>
                                        </div>
                                    </div>
                                </div>

                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 pt-8 border-t border-gray-100 flex justify-between">
                            <button type="button" id="prev-step-3"
                                class="px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Back
                            </button>
                            <div class="space-x-4">
                                <a href="{{ route('admin.accommodations.index') }}"
                                    class="px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50 transition-all duration-200 inline-block">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="px-8 py-2.5 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Create Accommodation
                                </button>

                                <!-- Debug button -->
                                <button type="button" id="debug-submit"
                                    class="px-6 py-2.5 rounded-full bg-gray-600 text-white hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md flex items-center">
                                    Debug Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Multi-step form navigation
            const steps = [
                document.getElementById('step-1'),
                document.getElementById('step-2'),
                document.getElementById('step-3')
            ];

            const indicators = [
                document.getElementById('step-indicator-1'),
                document.getElementById('step-indicator-2'),
                document.getElementById('step-indicator-3')
            ];

            function showStep(stepIndex) {
                steps.forEach((step, index) => {
                    if (index === stepIndex) {
                        step.classList.remove('hidden');
                        step.classList.add('block');
                        step.classList.add('opacity-100');

                        // Update indicator
                        indicators[index].classList.remove('bg-gray-200', 'text-gray-600');
                        indicators[index].classList.add('bg-blue-600', 'text-white');
                    } else {
                        step.classList.add('hidden');
                        step.classList.remove('block');
                        step.classList.remove('opacity-100');

                        // Reset indicator if it's a previous step
                        if (index < stepIndex) {
                            indicators[index].classList.remove('bg-gray-200', 'text-gray-600');
                            indicators[index].classList.add('bg-blue-600', 'text-white');
                        } else {
                            indicators[index].classList.add('bg-gray-200', 'text-gray-600');
                            indicators[index].classList.remove('bg-blue-600', 'text-white');
                        }
                    }
                });

                // Update progress bar
                const progressBars = document.querySelectorAll('.flex-1.h-1');
                progressBars.forEach((bar, index) => {
                    if (index < stepIndex) {
                        bar.classList.remove('bg-gray-200');
                        bar.classList.add('bg-blue-600');
                    } else {
                        bar.classList.add('bg-gray-200');
                        bar.classList.remove('bg-blue-600');
                    }
                });
            }

            // Navigation buttons
            document.getElementById('next-step-1').addEventListener('click', () => {
                showStep(1);
            });

            document.getElementById('prev-step-2').addEventListener('click', () => {
                showStep(0);
            });

            document.getElementById('next-step-2').addEventListener('click', () => {
                showStep(2);
            });

            document.getElementById('prev-step-3').addEventListener('click', () => {
                showStep(1);
            });

            // Price range slider functionality
            const priceSlider = document.getElementById('price-slider');
            const priceRange = document.getElementById('price-range');
            const minPriceHandle = document.getElementById('min-price-handle');
            const maxPriceHandle = document.getElementById('max-price-handle');
            const minPriceInput = document.getElementById('price_min');
            const maxPriceInput = document.getElementById('price_max');

            // Initialize slider values
            let minPrice = minPriceInput.value ? parseInt(minPriceInput.value) : 0;
            let maxPrice = maxPriceInput.value ? parseInt(maxPriceInput.value) : 500;

            function updateSlider() {
                const sliderWidth = priceSlider.offsetWidth;
                const minPos = (minPrice / 1000) * sliderWidth;
                const maxPos = (maxPrice / 1000) * sliderWidth;

                // Update range and handles
                priceRange.style.left = (minPos / sliderWidth * 100) + '%';
                priceRange.style.width = ((maxPos - minPos) / sliderWidth * 100) + '%';
                minPriceHandle.style.left = (minPos / sliderWidth * 100) + '%';
                maxPriceHandle.style.left = (maxPos / sliderWidth * 100) + '%';

                // Update input values
                minPriceInput.value = minPrice;
                maxPriceInput.value = maxPrice;
            }

            // Initialize slider on load
            updateSlider();

            // Handle min price input change
            minPriceInput.addEventListener('input', function () {
                minPrice = parseInt(this.value) || 0;
                if (minPrice > maxPrice) {
                    minPrice = maxPrice;
                    this.value = minPrice;
                }
                updateSlider();
            });

            // Handle max price input change
            maxPriceInput.addEventListener('input', function () {
                maxPrice = parseInt(this.value) || 0;
                if (maxPrice < minPrice) {
                    maxPrice = minPrice;
                    this.value = maxPrice;
                }
                updateSlider();
            });

            // Drag functionality for price handles
            let isDragging = false;
            let currentHandle = null;

            function startDrag(e, handle) {
                isDragging = true;
                currentHandle = handle;
                document.addEventListener('mousemove', doDrag);
                document.addEventListener('mouseup', stopDrag);
                e.preventDefault();
            }

            function doDrag(e) {
                if (!isDragging) return;

                const sliderRect = priceSlider.getBoundingClientRect();
                const sliderWidth = sliderRect.width;

                // Calculate new position within slider bounds
                let newPos = (e.clientX - sliderRect.left);
                if (newPos < 0) newPos = 0;
                if (newPos > sliderWidth) newPos = sliderWidth;

                // Convert position to price (0-1000)
                const newPrice = Math.round((newPos / sliderWidth) * 1000 / 10) * 10;

                if (currentHandle === minPriceHandle) {
                    minPrice = newPrice > maxPrice ? maxPrice : newPrice;
                    minPriceInput.value = minPrice;
                } else {
                    maxPrice = newPrice < minPrice ? minPrice : newPrice;
                    maxPriceInput.value = maxPrice;
                }

                updateSlider();
            }

            function stopDrag() {
                isDragging = false;
                document.removeEventListener('mousemove', doDrag);
                document.removeEventListener('mouseup', stopDrag);
            }

            minPriceHandle.addEventListener('mousedown', function (e) {
                startDrag(e, minPriceHandle);
            });

            maxPriceHandle.addEventListener('mousedown', function (e) {
                startDrag(e, maxPriceHandle);
            });

            // Price range badge updates
            const priceRangeSelect = document.getElementById('price_range');
            const priceBadges = document.querySelectorAll('.price-badge');

            priceRangeSelect.addEventListener('change', function () {
                const selectedRange = this.value;

                // Hide all badges first
                priceBadges.forEach(badge => badge.classList.add('hidden'));

                // Show the appropriate badge
                if (selectedRange) {
                    const index = ['budget', 'mid-range', 'luxury'].indexOf(selectedRange);
                    if (index !== -1) {
                        priceBadges[index].classList.remove('hidden');
                    }
                }
            });

            // Image upload functionality
            const imageInput = document.getElementById('image');
            const imageUploadContainer = document.getElementById('image-upload-container');
            const imagePreviewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('preview-image');
            const imageName = document.getElementById('image-name');
            const imageSize = document.getElementById('image-size');
            const removeButton = document.getElementById('remove-image');

            // Handle drag and drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                imageUploadContainer.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Add visual feedback
            ['dragenter', 'dragover'].forEach(eventName => {
                imageUploadContainer.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                imageUploadContainer.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                imageUploadContainer.classList.add('border-blue-500', 'bg-blue-50');
            }

            function unhighlight() {
                imageUploadContainer.classList.remove('border-blue-500', 'bg-blue-50');
            }

            // Handle file upload
            imageUploadContainer.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length) {
                    imageInput.files = files;
                    updateImagePreview(files[0]);
                }
            }

            // Handle file input change
            imageInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    updateImagePreview(this.files[0]);
                }
            });

            function updateImagePreview(file) {
                // Format file size
                const size = (file.size / 1024).toFixed(2) + ' KB';

                // Update preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    imageName.textContent = file.name;
                    imageSize.textContent = size;

                    imagePreviewContainer.classList.remove('hidden');
                    imageUploadContainer.classList.add('border-blue-500');
                };
                reader.readAsDataURL(file);
            }

            // Handle remove button
            removeButton.addEventListener('click', function () {
                imageInput.value = '';
                imagePreviewContainer.classList.add('hidden');
                imageUploadContainer.classList.remove('border-blue-500');
            });

            // Handle form submission with direct approach
            const form = document.getElementById('accommodationForm');
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                console.log('Form submission started');

                // Make all steps visible during validation (hidden from user)
                const originalStepStates = steps.map(step => ({
                    element: step,
                    wasHidden: step.classList.contains('hidden')
                }));

                steps.forEach(step => step.classList.remove('hidden'));

                // Get all required fields
                const requiredFields = form.querySelectorAll('input[required], select[required]');
                let isValid = true;
                let firstInvalidStep = null;

                // Check validation
                requiredFields.forEach(field => {
                    console.log(`Checking field ${field.name}: ${field.value}`);
                    if (!field.value || field.value.trim() === '') {
                        isValid = false;
                        field.classList.add('border-red-500');

                        // Find which step the field is in
                        const fieldStep = field.closest('[id^="step-"]');
                        if (fieldStep) {
                            const stepIndex = steps.indexOf(fieldStep);
                            if (stepIndex !== -1 && (firstInvalidStep === null || stepIndex < firstInvalidStep)) {
                                firstInvalidStep = stepIndex;
                            }
                        }
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                // Restore original visibility state
                originalStepStates.forEach(state => {
                    if (state.wasHidden) {
                        state.element.classList.add('hidden');
                    }
                });

                if (!isValid) {
                    console.log('Form validation failed');

                    // Show the step with the first error
                    if (firstInvalidStep !== null) {
                        showStep(firstInvalidStep);
                    }

                    alert('Please fill in all required fields before submitting.');
                    return;
                }

                console.log('Form is valid, proceeding with AJAX submission');

                // Show loading state
                const submitBtn = document.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Submitting...';
                    submitBtn.disabled = true;
                }

                const formData = new FormData(form);
                for (const [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                // Try normal form submission
                // No AJAX needed, just manually submit the form
                form.submit();

                // Debug button logic
                document.getElementById('debug-submit').addEventListener('click', function () {
                    console.log('Debug submit clicked');

                    // Set some default values for required fields if empty
                    const requiredFields = form.querySelectorAll('input[required], select[required]');
                    requiredFields.forEach(field => {
                        if (!field.value || field.value.trim() === '') {
                            if (field.tagName === 'SELECT') {
                                if (field.options.length > 1) {
                                    field.selectedIndex = 1; // Select the first non-empty option
                                }
                            } else if (field.type === 'number') {
                                field.value = '100';
                            } else {
                                field.value = 'Test Value';
                            }
                        }
                    });

                    // Show all steps during submission
                    steps.forEach(step => step.classList.remove('hidden'));

                    // Submit the form directly without validation
                    console.log('Submitting form directly...');
                    form.submit();
                });
            });

            // Debug button functionality
            const debugButton = document.getElementById('debug-submit');
            debugButton.addEventListener('click', function () {
                console.log('Debug button clicked');
                const formData = new FormData(form);
                for (const [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }
                alert('Debugging form submission. Check console for details.');
            });
        });
    </script>
@endpush