<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $fillable = [
        'name',
        'city_id',
        'address',
        'type',
        'price_min',
        'price_max',
        'description',
        'image',
    ];

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
