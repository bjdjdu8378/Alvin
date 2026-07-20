<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'series_id',
        'tmdb_id',
        'file_path',
        'type',
        'width',
        'height',
        'aspect_ratio',
        'vote_average',
        'vote_count',
        'synced_at',
    ];

    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
        'aspect_ratio' => 'float',
        'vote_average' => 'float',
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['full_url'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function getFullUrlAttribute()
    {
        if (!$this->file_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w500' . $this->file_path;
    }
}
