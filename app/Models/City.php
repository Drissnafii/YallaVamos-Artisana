<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'latitude',
        'longitude',
    ];


    // Relationships
    public function stadiums()
    {
        return $this->hasMany(Stadium::class);
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function favoriteCities()
    {
        return $this->hasMany(FavoriteCity::class);
    }
}
