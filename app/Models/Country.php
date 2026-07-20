<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'iso_3166_1',
        'name',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_production_country');
    }

    public function series()
    {
        return $this->belongsToMany(Series::class, 'series_production_country');
    }
}
