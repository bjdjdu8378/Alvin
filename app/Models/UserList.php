<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    use HasFactory;

    protected $table = 'user_lists';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'slug',
        'is_public',
        'items_count',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'items_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'list_movies');
    }

    public function series()
    {
        return $this->belongsToMany(Series::class, 'list_series');
    }
}
