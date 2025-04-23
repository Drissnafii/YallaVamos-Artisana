<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
        'background_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the profile photo URL.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return Storage::url($this->profile_photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the background image URL.
     *
     * @return string|null
     */
    public function getBackgroundImageUrlAttribute()
    {
        if ($this->background_image) {
            return Storage::url($this->background_image);
        }

        return null;
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Get all favorite matches for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoriteMatches()
    {
        return $this->hasMany(FavoriteMatch::class);
    }

    /**
     * Get all favorite cities for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoriteCities()
    {
        return $this->hasMany(FavoriteCity::class);
    }

    /**
     * Get all favorite stadiums for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoriteStadiums()
    {
        return $this->hasMany(FavoriteStadium::class);
    }

    /**
     * Get all favorite teams for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoriteTeams()
    {
        return $this->hasMany(FavoriteTeam::class);
    }

    /**
     * Get all articles authored by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Get the identifier that will be stored in the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key-value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
