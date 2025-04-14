@extends('layouts.admin')

@section('title', 'Schedule New Match')

@section('header', 'Schedule New Match')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.matches.index') }}" class="inline-flex items-center text-orange-600 hover:text-orange-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Matches
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #fff7ed);">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Match Information</h2>
        </div>

        <form action="{{ route('admin.matches.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date & Time <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="date" id="date" value="{{ old('date') }}" class="form-input rounded-md shadow-sm w-full @error('date') border-red-500 @enderror" required>
                    @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stadium_id" class="block text-sm font-medium text-gray-700 mb-1">Stadium <span class="text-red-500">*</span></label>
                    <select name="stadium_id" id="stadium_id" class="form-select rounded-md shadow-sm w-full @error('stadium_id') border-red-500 @enderror" required>
                        <option value="">Select a stadium</option>
                        @foreach($stadiums as $stadium)
                            <option value="{{ $stadium->id }}" {{ old('stadium_id') == $stadium->id ? 'selected' : '' }}>{{ $stadium->name }} ({{ $stadium->city ? $stadium->city->name : 'Unknown' }})</option>
                        @endforeach
                    </select>
                    @error('stadium_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="team1_id" class="block text-sm font-medium text-gray-700 mb-1">Team 1 <span class="text-red-500">*</span></label>
                    <select name="team1_id" id="team1_id" class="form-select rounded-md shadow-sm w-full @error('team1_id') border-red-500 @enderror" required>
                        <option value="">Select team 1</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team1_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                        @endforeach
                    </select>
                    @error('team1_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="team2_id" class="block text-sm font-medium text-gray-700 mb-1">Team 2 <span class="text-red-500">*</span></label>
                    <select name="team2_id" id="team2_id" class="form-select rounded-md shadow-sm w-full @error('team2_id') border-red-500 @enderror" required>
                        <option value="">Select team 2</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team2_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                        @endforeach
                    </select>
                    @error('team2_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status" class="form-select rounded-md shadow-sm w-full @error('status') border-red-500 @enderror" required>
                    <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="live" {{ old('status') == 'live' ? 'selected' : '' }}>Live</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div id="score-section" class="grid grid-cols-1 md:grid-cols-2 gap-6" style="display: none;">
                <div>
                    <label for="score_team1" class="block text-sm font-medium text-gray-700 mb-1">Team 1 Score</label>
                    <input type="number" name="score_team1" id="score_team1" value="{{ old('score_team1', 0) }}" min="0" class="form-input rounded-md shadow-sm w-full @error('score_team1') border-red-500 @enderror">
                    @error('score_team1')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="score_team2" class="block text-sm font-medium text-gray-700 mb-1">Team 2 Score</label>
                    <input type="number" name="score_team2" id="score_team2" value="{{ old('score_team2', 0) }}" min="0" class="form-input rounded-md shadow-sm w-full @error('score_team2') border-red-500 @enderror">
                    @error('score_team2')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="{{ route('admin.matches.index') }}" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded shadow mr-2">Cancel</a>
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded shadow">Schedule Match</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const scoreSection = document.getElementById('score-section');

        // Show/hide score section based on status
        function toggleScoreSection() {
            if (statusSelect.value === 'in_progress' || statusSelect.value === 'completed') {
                scoreSection.style.display = 'grid';
            } else {
                scoreSection.style.display = 'none';
            }
        }

        // Initial check
        toggleScoreSection();

        // Add event listener for changes
        statusSelect.addEventListener('change', toggleScoreSection);

        // Team validation to prevent selecting the same team twice
        const team1Select = document.getElementById('team1_id');
        const team2Select = document.getElementById('team2_id');

        function validateTeamSelections() {
            const team1Value = team1Select.value;
            const team2Value = team2Select.value;

            if (team1Value && team2Value && team1Value === team2Value) {
                alert('Team 1 and Team 2 cannot be the same team');
                team2Select.value = '';
            }
        }

        team1Select.addEventListener('change', validateTeamSelections);
        team2Select.addEventListener('change', validateTeamSelections);
    });
</script>
@endpush
