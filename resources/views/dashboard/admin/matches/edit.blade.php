@extends('layouts.admin')

@section('title', 'Edit Match')

@section('header', 'Edit Match')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.matches.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Matches
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="bg-gradient-to-b from-white to-green-50 shadow-lg rounded-xl overflow-hidden border border-gray-100">
            <div class="p-8 border-b border-gray-100 bg-white bg-opacity-70 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Edit Match: {{ $match->team1 ? $match->team1->name : 'TBD' }} vs {{ $match->team2 ? $match->team2->name : 'TBD' }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">Update the match details below</p>
                </div>
                <span class="px-4 py-1.5 inline-flex text-sm leading-5 font-semibold rounded-full
                    {{ $match->status == 'scheduled' ? 'bg-blue-100 text-blue-800' :
                    ($match->status == 'in_progress' ? 'bg-green-100 text-green-800' :
                    ($match->status == 'completed' ? 'bg-purple-100 text-purple-800' :
                    ($match->status == 'postponed' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))) }}">
                    {{ ucfirst(str_replace('_', ' ', $match->status)) }}
                </span>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.matches.update', $match) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Date/Time and Stadium -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="date" class="block text-sm font-medium text-gray-700">
                            Date & Time <span class="text-red-600">*</span>
                        </label>
                        <input type="datetime-local" 
                               name="date" 
                               id="date" 
                               value="{{ old('date', $match->date ? date('Y-m-d\TH:i', strtotime($match->date)) : '') }}" 
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('date') border-red-300 ring-red-100 @enderror" 
                               required>
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="stadium_id" class="block text-sm font-medium text-gray-700">
                            Stadium <span class="text-red-600">*</span>
                        </label>
                        <select name="stadium_id" 
                                id="stadium_id" 
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('stadium_id') border-red-300 ring-red-100 @enderror" 
                                required>
                            <option value="">Select a stadium</option>
                            @foreach($stadiums as $stadium)
                                <option value="{{ $stadium->id }}" {{ old('stadium_id', $match->stadium_id) == $stadium->id ? 'selected' : '' }}>
                                    {{ $stadium->name }} ({{ $stadium->city ? $stadium->city->name : 'Unknown' }})
                                </option>
                            @endforeach
                        </select>
                        @error('stadium_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Teams Section -->
                <div class="bg-white bg-opacity-50 rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        Team Selection
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="team1_id" class="block text-sm font-medium text-gray-700">
                                Home Team <span class="text-red-600">*</span>
                            </label>
                            <select name="team1_id" 
                                    id="team1_id" 
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('team1_id') border-red-300 ring-red-100 @enderror" 
                                    required>
                                <option value="">Select home team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ old('team1_id', $match->team1_id) == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('team1_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="team2_id" class="block text-sm font-medium text-gray-700">
                                Away Team <span class="text-red-600">*</span>
                            </label>
                            <select name="team2_id" 
                                    id="team2_id" 
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('team2_id') border-red-300 ring-red-100 @enderror" 
                                    required>
                                <option value="">Select away team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ old('team2_id', $match->team2_id) == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('team2_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Match Status -->
                <div class="space-y-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">
                        Status <span class="text-red-600">*</span>
                    </label>
                    <select name="status" 
                            id="status" 
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('status') border-red-300 ring-red-100 @enderror" 
                            required>
                        <option value="scheduled" {{ old('status', $match->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="in_progress" {{ old('status', $match->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $match->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="postponed" {{ old('status', $match->status) == 'postponed' ? 'selected' : '' }}>Postponed</option>
                        <option value="cancelled" {{ old('status', $match->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Score Section -->
                <div id="score-section" class="bg-white bg-opacity-50 rounded-xl p-6 shadow-sm border border-gray-100" style="{{ ($match->status == 'in_progress' || $match->status == 'completed') ? '' : 'display: none;' }}">
                    <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        Match Score
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="score_team1" class="block text-sm font-medium text-gray-700">
                                Home Team Score
                            </label>
                            <input type="number" 
                                   name="score_team1" 
                                   id="score_team1" 
                                   value="{{ old('score_team1', $match->score_team1 ?? 0) }}" 
                                   min="0" 
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('score_team1') border-red-300 ring-red-100 @enderror">
                            @error('score_team1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="score_team2" class="block text-sm font-medium text-gray-700">
                                Away Team Score
                            </label>
                            <input type="number" 
                                   name="score_team2" 
                                   id="score_team2" 
                                   value="{{ old('score_team2', $match->score_team2 ?? 0) }}" 
                                   min="0" 
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('score_team2') border-red-300 ring-red-100 @enderror">
                            @error('score_team2')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.matches.index') }}" 
                           class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all shadow-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Update Match
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const scoreSection = document.getElementById('score-section');
        const team1Select = document.getElementById('team1_id');
        const team2Select = document.getElementById('team2_id');

        // Show/hide score section based on status
        function toggleScoreSection() {
            if (statusSelect.value === 'in_progress' || statusSelect.value === 'completed') {
                scoreSection.style.display = 'block';
            } else {
                scoreSection.style.display = 'none';
            }
        }

        // Initial check
        toggleScoreSection();

        // Add event listener for changes
        statusSelect.addEventListener('change', toggleScoreSection);

        // Team validation to prevent selecting the same team twice
        function validateTeamSelections() {
            const team1Value = team1Select.value;
            const team2Value = team2Select.value;

            if (team1Value && team2Value && team1Value === team2Value) {
                // Visual indicator for error
                team2Select.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                
                // Toast notification instead of alert
                const errorToast = document.createElement('div');
                errorToast.className = 'fixed bottom-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg transition-all duration-500 transform translate-y-0';
                errorToast.innerHTML = `
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Error:</span>
                        <span class="ml-1">Home team and Away team cannot be the same</span>
                    </div>
                `;
                document.body.appendChild(errorToast);
                
                // Reset the second selection
                team2Select.value = '';
                
                // Remove error class and toast after a delay
                setTimeout(() => {
                    team2Select.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                    errorToast.classList.add('translate-y-full', 'opacity-0');
                    setTimeout(() => {
                        document.body.removeChild(errorToast);
                    }, 500);
                }, 3000);
            }
        }

        team1Select.addEventListener('change', validateTeamSelections);
        team2Select.addEventListener('change', validateTeamSelections);
    });
</script>
@endpush
