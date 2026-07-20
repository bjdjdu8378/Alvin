<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tmdb_id',
        'title',
        'slug',
        'original_title',
        'overview',
        'release_date',
        'runtime',
        'budget',
        'revenue',
        'popularity',
        'vote_average',
        'vote_count',
        'status',
        'tagline',
        'poster_path',
        'backdrop_path',
        'original_language',
        'is_adult',
        'homogeneous_page',
        'synced_at',
    ];

    protected $casts = [
        'release_date' => 'date',
        'vote_average' => 'float',
        'popularity' => 'float',
        'is_adult' => 'boolean',
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = ['full_poster_url', 'full_backdrop_url'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function cast()
    {
        return $this->belongsToMany(Actor::class, 'movie_cast')
            ->withPivot(['character', 'order'])
            ->orderBy('movie_cast.order');
    }

    public function crew()
    {
        return $this->belongsToMany(Person::class, 'movie_crew')
            ->withPivot(['job', 'department']);
    }

    public function productionCompanies()
    {
        return $this->belongsToMany(ProductionCompany::class, 'movie_production_company');
    }

    public function productionCountries()
    {
        return $this->belongsToMany(Country::class, 'movie_production_country');
    }

    public function images()
    {
        return $this->hasMany(MovieImage::class);
    }

    public function videos()
    {
        return $this->hasMany(MovieVideo::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function userFavorites()
    {
        return $this->belongsToMany(User::class, 'user_favorite_movies');
    }

    public function userWatchlist()
    {
        return $this->belongsToMany(User::class, 'user_watchlist');
    }

    public function getFullPosterUrlAttribute()
    {
        if (!$this->poster_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w500' . $this->poster_path;
    }

    public function getFullBackdropUrlAttribute()
    {
        if (!$this->backdrop_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w1280' . $this->backdrop_path;
    }
}
