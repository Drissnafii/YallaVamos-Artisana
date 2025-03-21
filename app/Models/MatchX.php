<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchX extends Model
{
    protected $fillable = [
        'date',
        'team1_id',
        'team2_id',
        'score_team1',
        'score_team2',
        'status',
        'stadium_id',
    ];

    // Relationships
    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }

    public function team1()
    {
        return $this->belongsTo(Team::class);
    }

    public function team2()
    {
        return $this->belongsTo(Team::class);
    }

    public function favoriteMatches()
    {
        return $this->hasMany(FavoriteMatch::class);
    }
}
