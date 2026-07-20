<?php

namespace App\Http\Controllers\API;

use App\Models\Movie;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = QueryBuilder::for(Movie::class)
            ->allowedFilters([
                AllowedFilter::exact('tmdb_id'),
                AllowedFilter::partial('title'),
                AllowedFilter::partial('overview'),
                'release_date',
            ])
            ->allowedSorts(['title', 'release_date', 'vote_average', 'popularity', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate($request->input('per_page', 15));

        return response()->json($movies);
    }

    public function show(Movie $movie)
    {
        $movie->load(['genres', 'cast', 'crew', 'productionCompanies', 'images', 'videos']);
        return response()->json($movie);
    }

    public function trending()
    {
        $movies = Movie::orderBy('popularity', 'desc')
            ->limit(20)
            ->get();

        return response()->json($movies);
    }

    public function topRated()
    {
        $movies = Movie::where('vote_count', '>', 100)
            ->orderBy('vote_average', 'desc')
            ->limit(20)
            ->get();

        return response()->json($movies);
    }

    public function upcoming()
    {
        $movies = Movie::where('release_date', '>', now())
            ->orderBy('release_date')
            ->limit(20)
            ->get();

        return response()->json($movies);
    }
}
