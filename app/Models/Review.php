<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'series_id',
        'title',
        'content',
        'rating',
        'helpful_count',
        'is_spoiler',
        'is_approved',
        'published_at',
    ];

    protected $casts = [
        'helpful_count' => 'integer',
        'is_spoiler' => 'boolean',
        'is_approved' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
