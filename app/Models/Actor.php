<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tmdb_id',
        'name',
        'slug',
        'original_name',
        'biography',
        'birthday',
        'deathday',
        'place_of_birth',
        'popularity',
        'profile_path',
        'gender',
        'known_for_department',
        'imdb_id',
        'synced_at',
    ];

    protected $casts = [
        'birthday' => 'date',
        'deathday' => 'date',
        'popularity' => 'float',
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = ['full_profile_url', 'is_alive'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_cast')
            ->withPivot(['character', 'order']);
    }

    public function series()
    {
        return $this->belongsToMany(Series::class, 'series_cast')
            ->withPivot(['character', 'order']);
    }

    public function getFullProfileUrlAttribute()
    {
        if (!$this->profile_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w500' . $this->profile_path;
    }

    public function getIsAliveAttribute()
    {
        return is_null($this->deathday);
    }
}
