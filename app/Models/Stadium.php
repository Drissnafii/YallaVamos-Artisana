<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $table = 'stadiums';

    protected $fillable = [
        'name',
        'city_id',
        'capacity',
        'year_built',
        'status',
        'address',
        'description',
        'image',
        'latitude',
        'longitude',
    ];

    // Status constants for clarity
    public const STATUS_ACTIVE = 'active';
    public const STATUS_UNDER_CONSTRUCTION = 'under_construction';
    public const STATUS_RENOVATION = 'renovation';
    public const STATUS_INACTIVE = 'inactive';

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function matches()
    {
        return $this->hasMany(MatchX::class);
    }

    // Get upcoming matches at this stadium
    public function upcomingMatches()
    {
        return $this->matches()
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');
    }

    // Get past matches at this stadium
    public function pastMatches()
    {
        return $this->matches()
            ->where('date', '<', now())
            ->orderBy('date', 'desc');
    }

    // Custom accessor to get a formatted capacity (for display purposes)
    public function getFormattedCapacityAttribute()
    {
        return number_format($this->capacity);
    }

    // Custom accessor to get a clean status label
    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    // Define possible statuses for form select options
    public static function statusOptions()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_UNDER_CONSTRUCTION => 'Under Construction',
            self::STATUS_RENOVATION => 'Under Renovation',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }
}
