<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'favorite_cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'city_id',
    ];

    /**
     * Get the city that is favorited.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the user that owns this favorite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
