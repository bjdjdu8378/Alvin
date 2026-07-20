<?php

namespace App\Http\Controllers\API;

use App\Models\Series;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = QueryBuilder::for(Series::class)
            ->allowedFilters([
                AllowedFilter::exact('tmdb_id'),
                AllowedFilter::partial('name'),
                AllowedFilter::partial('overview'),
                'first_air_date',
            ])
            ->allowedSorts(['name', 'first_air_date', 'vote_average', 'popularity', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate($request->input('per_page', 15));

        return response()->json($series);
    }

    public function show(Series $series)
    {
        $series->load(['genres', 'seasons', 'networks', 'cast', 'images', 'videos']);
        return response()->json($series);
    }

    public function trending()
    {
        $series = Series::orderBy('popularity', 'desc')
            ->limit(20)
            ->get();

        return response()->json($series);
    }

    public function topRated()
    {
        $series = Series::where('vote_count', '>', 50)
            ->orderBy('vote_average', 'desc')
            ->limit(20)
            ->get();

        return response()->json($series);
    }

    public function seasons(Series $series)
    {
        return response()->json($series->seasons()->with('episodes')->get());
    }
}
