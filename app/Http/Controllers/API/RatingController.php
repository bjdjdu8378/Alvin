<?php

namespace App\Http\Controllers\API;

use App\Models\Rating;
use App\Models\Movie;
use App\Models\Series;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rateMovie(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:0.5|max:10',
        ]);

        $rating = Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'movie_id' => $movie->id,
            ],
            [
                'rating' => $validated['rating'],
                'voted_at' => now(),
            ]
        );

        return response()->json($rating, 201);
    }

    public function rateSeries(Request $request, Series $series)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:0.5|max:10',
        ]);

        $rating = Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'series_id' => $series->id,
            ],
            [
                'rating' => $validated['rating'],
                'voted_at' => now(),
            ]
        );

        return response()->json($rating, 201);
    }

    public function getUserRatings()
    {
        $ratings = Rating::where('user_id', auth()->id())
            ->with(['movie', 'series'])
            ->get();

        return response()->json($ratings);
    }
}
