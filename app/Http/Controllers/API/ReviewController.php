<?php

namespace App\Http\Controllers\API;

use App\Models\Review;
use App\Models\Movie;
use App\Models\Series;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function movieReviews(Movie $movie, Request $request)
    {
        $reviews = $movie->reviews()
            ->where('is_approved', true)
            ->with('user')
            ->latest('published_at')
            ->paginate($request->input('per_page', 10));

        return response()->json($reviews);
    }

    public function seriesReviews(Series $series, Request $request)
    {
        $reviews = $series->reviews()
            ->where('is_approved', true)
            ->with('user')
            ->latest('published_at')
            ->paginate($request->input('per_page', 10));

        return response()->json($reviews);
    }

    public function createMovieReview(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'rating' => 'nullable|numeric|min:0.5|max:10',
            'is_spoiler' => 'boolean',
        ]);

        $review = $movie->reviews()->create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'rating' => $validated['rating'] ?? null,
            'is_spoiler' => $validated['is_spoiler'] ?? false,
            'published_at' => now(),
        ]);

        return response()->json($review, 201);
    }

    public function createSeriesReview(Request $request, Series $series)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'rating' => 'nullable|numeric|min:0.5|max:10',
            'is_spoiler' => 'boolean',
        ]);

        $review = $series->reviews()->create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'rating' => $validated['rating'] ?? null,
            'is_spoiler' => $validated['is_spoiler'] ?? false,
            'published_at' => now(),
        ]);

        return response()->json($review, 201);
    }

    public function deleteReview(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $review->delete();
        return response()->json(['message' => 'Review deleted'], 200);
    }
}
