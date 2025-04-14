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
        'price_range',
        'description',
        'image',
        'phone',
        'email',
        'website',
    ];

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
