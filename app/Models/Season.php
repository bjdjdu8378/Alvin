<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'series_id',
        'tmdb_id',
        'season_number',
        'name',
        'overview',
        'air_date',
        'episode_count',
        'poster_path',
        'synced_at',
    ];

    protected $casts = [
        'air_date' => 'date',
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = ['full_poster_url'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function getFullPosterUrlAttribute()
    {
        if (!$this->poster_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w500' . $this->poster_path;
    }
}
