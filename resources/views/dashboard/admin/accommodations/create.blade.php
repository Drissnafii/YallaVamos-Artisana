@extends('layouts.admin')

@section('title', 'Create Accommodation')

@section('header', 'Create New Accommodation')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden">
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
                                    class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300' }}"
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
                                        class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('type') ? 'border-red-300' : 'border-gray-300' }}"
                                        required>
                                        <option value="">Select type</option>
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
                                        class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('city_id') ? 'border-red-300' : 'border-gray-300' }}"
                                        required>
                                        <option value="">Select city</option>
                                        @foreach ($cities as $city)
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
                                    class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('address') ? 'border-red-300' : 'border-gray-300' }}"
                                    required>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="price_range" class="block text-sm font-medium text-gray-700 mb-2">
                                        Price Range <span class="text-red-600">*</span>
                                    </label>
                                    <select name="price_range" id="price_range"
                                        class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('price_range') ? 'border-red-300' : 'border-gray-300' }}"
                                        required>
                                        <option value="">Select price range</option>
                                        <option value="budget" {{ old('price_range') == 'budget' ? 'selected' : '' }}>Budget
                                        </option>
                                        <option value="mid-range" {{ old('price_range') == 'mid-range' ? 'selected' : '' }}>
                                            Mid-range</option>
                                        <option value="luxury" {{ old('price_range') == 'luxury' ? 'selected' : '' }}>Luxury
                                        </option>
                                    </select>
                                    @error('price_range')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="price_min" class="block text-sm font-medium text-gray-700 mb-2">
                                        Min Price <span class="text-red-600">*</span>
                                    </label>
                                    <input type="number" name="price_min" id="price_min" value="{{ old('price_min') }}"
                                        class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('price_min') ? 'border-red-300' : 'border-gray-300' }}"
                                        required>
                                    @error('price_min')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="price_max" class="block text-sm font-medium text-gray-700 mb-2">
                                        Max Price <span class="text-red-600">*</span>
                                    </label>
                                    <input type="number" name="price_max" id="price_max" value="{{ old('price_max') }}"
                                        class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('price_max') ? 'border-red-300' : 'border-gray-300' }}"
                                        required>
                                    @error('price_max')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('description') ? 'border-red-300' : 'border-gray-300' }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Image
                                </label>
                                <input type="file" name="image" id="image"
                                    class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('image') ? 'border-red-300' : 'border-gray-300' }} p-2">
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone
                                    </label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('phone') ? 'border-red-300' : 'border-gray-300' }}">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('email') ? 'border-red-300' : 'border-gray-300' }}">
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
                                    class="w-full bg-white rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors {{ $errors->has('website') ? 'border-red-300' : 'border-gray-300' }}">
                                @error('website')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                        <a href="{{ route('admin.accommodations.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Create Accommodation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Simple multi-step form logic (can be expanded)
            const steps = document.querySelectorAll('[id^="step-"]');
            const nextButton = document.getElementById('next-step');
            const prevButton = document.getElementById('prev-step');
            let currentStep = 0;

            function showStep(stepIndex) {
                steps.forEach((step, index) => {
                    step.classList.toggle('opacity-0', index !== stepIndex);
                    step.classList.toggle('hidden', index !== stepIndex);
                });
                prevButton.classList.toggle('hidden', stepIndex === 0);
                nextButton.textContent = stepIndex === steps.length - 1 ? 'Submit' : 'Next';
            }

            if (nextButton) {
                nextButton.addEventListener('click', () => {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    } else {
                        // Handle form submission if it's the last step
                        document.querySelector('form').submit();
                    }
                });
            }

            if (prevButton) {
                prevButton.addEventListener('click', () => {
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            }

            // Initialize first step
            if (steps.length > 0 && prevButton && nextButton) {
                showStep(currentStep);
            } else if (steps.length > 0) { // If no next/prev buttons, show first step by default
                steps.forEach((step, index) => {
                    step.classList.toggle('hidden', index !== 0);
                });
            }
        </script>
    @endpush
@endsection