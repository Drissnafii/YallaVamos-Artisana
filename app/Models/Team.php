<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'flag',
        'code',
        'description',
        'group', 
        'is_qualified',
    ];

    // Relationships
    public function homeMatches()
    {
        return $this->hasMany(MatchX::class, 'team1_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(MatchX::class, 'team2_id');
    }

    public function favoriteTeams()
    {
        return $this->hasMany(FavoriteTeam::class);
    }

    // Helper methods
    public function getAllMatches()
    {
        return MatchX::where('team1_id', $this->id)
            ->orWhere('team2_id', $this->id)
            ->orderBy('date', 'desc');
    }

    // Status helpers
    public function getMatchesPlayed()
    {
        return $this->getAllMatches()
            ->where('status', 'completed')
            ->count();
    }

    public function getWins()
    {
        $wins = 0;

        // Wins as team1
        $wins += $this->homeMatches()
            ->where('status', 'completed')
            ->whereRaw('score_team1 > score_team2')
            ->count();

        // Wins as team2
        $wins += $this->awayMatches()
            ->where('status', 'completed')
            ->whereRaw('score_team2 > score_team1')
            ->count();

        return $wins;
    }

    public function getDraws()
    {
        $draws = 0;

        // Draws as team1
        $draws += $this->homeMatches()
            ->where('status', 'completed')
            ->whereRaw('score_team1 = score_team2')
            ->count();

        // Draws as team2
        $draws += $this->awayMatches()
            ->where('status', 'completed')
            ->whereRaw('score_team1 = score_team2')
            ->count();

        return $draws;
    }

    public function getLosses()
    {
        $losses = 0;

        // Losses as team1
        $losses += $this->homeMatches()
            ->where('status', 'completed')
            ->whereRaw('score_team1 < score_team2')
            ->count();

        // Losses as team2
        $losses += $this->awayMatches()
            ->where('status', 'completed')
            ->whereRaw('score_team2 < score_team1')
            ->count();

        return $losses;
    }

    public function getGoalsScored()
    {
        $goals = 0;

        // Goals as team1
        $homeGoals = $this->homeMatches()
            ->where('status', 'completed')
            ->sum('score_team1');

        // Goals as team2
        $awayGoals = $this->awayMatches()
            ->where('status', 'completed')
            ->sum('score_team2');

        return $homeGoals + $awayGoals;
    }

    public function getGoalsConceded()
    {
        $goals = 0;

        // Goals conceded as team1
        $homeGoalsConceded = $this->homeMatches()
            ->where('status', 'completed')
            ->sum('score_team2');

        // Goals conceded as team2
        $awayGoalsConceded = $this->awayMatches()
            ->where('status', 'completed')
            ->sum('score_team1');

        return $homeGoalsConceded + $awayGoalsConceded;
    }

    // Get goal difference
    public function getGoalDifference()
    {
        return $this->getGoalsScored() - $this->getGoalsConceded();
    }

    // Get points (3 for win, 1 for draw)
    public function getPoints()
    {
        return ($this->getWins() * 3) + $this->getDraws();
    }
}
