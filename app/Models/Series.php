<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tmdb_id',
        'name',
        'slug',
        'original_name',
        'overview',
        'first_air_date',
        'last_air_date',
        'number_of_seasons',
        'number_of_episodes',
        'episode_run_time',
        'popularity',
        'vote_average',
        'vote_count',
        'status',
        'type',
        'tagline',
        'poster_path',
        'backdrop_path',
        'original_language',
        'in_production',
        'synced_at',
    ];

    protected $casts = [
        'first_air_date' => 'date',
        'last_air_date' => 'date',
        'vote_average' => 'float',
        'popularity' => 'float',
        'in_production' => 'boolean',
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = ['full_poster_url', 'full_backdrop_url'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'series_genre');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function networks()
    {
        return $this->belongsToMany(Network::class, 'series_network');
    }

    public function productionCompanies()
    {
        return $this->belongsToMany(ProductionCompany::class, 'series_production_company');
    }

    public function productionCountries()
    {
        return $this->belongsToMany(Country::class, 'series_production_country');
    }

    public function cast()
    {
        return $this->belongsToMany(Actor::class, 'series_cast')
            ->withPivot(['character', 'order'])
            ->orderBy('series_cast.order');
    }

    public function images()
    {
        return $this->hasMany(SeriesImage::class);
    }

    public function videos()
    {
        return $this->hasMany(SeriesVideo::class);
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
        return $this->belongsToMany(User::class, 'user_favorite_series');
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
