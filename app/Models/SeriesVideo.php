<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesVideo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'series_id',
        'tmdb_id',
        'name',
        'key',
        'type',
        'site',
        'size',
        'iso_639_1',
        'iso_3166_1',
        'official',
        'published_at',
    ];

    protected $casts = [
        'size' => 'integer',
        'official' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['video_url'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function getVideoUrlAttribute()
    {
        if ($this->site === 'YouTube') {
            return 'https://www.youtube.com/watch?v=' . $this->key;
        }
        return null;
    }
}
