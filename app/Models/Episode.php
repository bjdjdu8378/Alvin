<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'tmdb_id',
        'episode_number',
        'name',
        'overview',
        'air_date',
        'runtime',
        'still_path',
        'vote_average',
        'vote_count',
        'synced_at',
    ];

    protected $casts = [
        'air_date' => 'date',
        'vote_average' => 'float',
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['full_still_url'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function getFullStillUrlAttribute()
    {
        if (!$this->still_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w500' . $this->still_path;
    }
}
