<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group',
        'flag',
    ];

    // Relationships
    public function matches()
    {
        return $this->hasMany(MatchX::class);
    }

    public function favoriteTeams()
    {
        return $this->hasMany(FavoriteTeam::class);
    }
}
