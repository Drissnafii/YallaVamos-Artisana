<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteMatch extends Model
{
    public function match()
    {
        return $this->belongsTo(MatchX::class, 'match_id');
    }
}
