<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tmdb_id',
        'name',
        'slug',
        'profile_path',
        'gender',
        'synced_at',
    ];

    protected $casts = [
        'synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['full_profile_url'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_crew');
    }

    public function getFullProfileUrlAttribute()
    {
        if (!$this->profile_path) {
            return null;
        }
        return config('tmdb.image_base_url') . '/w500' . $this->profile_path;
    }
}
