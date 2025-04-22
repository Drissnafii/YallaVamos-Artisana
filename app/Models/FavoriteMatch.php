<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteMatch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'favorite_matches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'match_id',
    ];

    /**
     * Get the match that is favorited.
     */
    public function match()
    {
        return $this->belongsTo(MatchX::class, 'match_id');
    }

    /**
     * Get the user that owns this favorite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
