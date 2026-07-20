<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionCompany extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tmdb_id',
        'name',
        'slug',
        'logo_path',
        'origin_country',
        'synced_at',
    ];

    protected $casts = [
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['full_logo_url'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_production_company');
    }

    public function series()
    {
        return $this->belongsToMany(Series::class, 'series_production_company');
    }

    public function getFullLogoUrlAttribute()
    {
        if (!$this->logo_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w500' . $this->logo_path;
    }
}
