<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MatchX;

class Stadium extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
        'address',
        'capacity',
        'image',
        'description',
    ];

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function matches()
    {
        return $this->hasMany(MatchX::class);
    }

    public function favoriteStadiums()
    {
        return $this->hasMany(FavoriteStadium::class);
    }
}
