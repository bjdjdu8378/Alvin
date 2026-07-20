<?php

namespace App\Http\Controllers\API;

use App\Models\Actor;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ActorController extends Controller
{
    public function index(Request $request)
    {
        $actors = QueryBuilder::for(Actor::class)
            ->allowedFilters([
                AllowedFilter::exact('tmdb_id'),
                AllowedFilter::partial('name'),
                AllowedFilter::partial('biography'),
            ])
            ->allowedSorts(['name', 'popularity', 'birthday', 'created_at'])
            ->defaultSort('-popularity')
            ->paginate($request->input('per_page', 15));

        return response()->json($actors);
    }

    public function show(Actor $actor)
    {
        $actor->load(['movies', 'series']);
        return response()->json($actor);
    }

    public function popular()
    {
        $actors = Actor::orderBy('popularity', 'desc')
            ->limit(20)
            ->get();

        return response()->json($actors);
    }
}
