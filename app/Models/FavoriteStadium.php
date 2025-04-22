<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteStadium extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'favorite_stadiums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'stadium_id',
    ];

    /**
     * Get the user that owns this favorite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the stadium that is favorited.
     */
    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }
}
