<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteTeam extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
    ];

    // Relationships
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
