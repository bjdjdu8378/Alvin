<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'is_active',
        'email_verified_at',
        'last_login_at',
        'tmdb_account_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function favoriteMovies()
    {
        return $this->belongsToMany(Movie::class, 'user_favorite_movies');
    }

    public function favoriteSeries()
    {
        return $this->belongsToMany(Series::class, 'user_favorite_series');
    }

    public function watchlist()
    {
        return $this->belongsToMany(Movie::class, 'user_watchlist');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function lists()
    {
        return $this->hasMany(UserList::class);
    }
}
