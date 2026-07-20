<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\SeriesController;
use App\Http\Controllers\API\ActorController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\ReviewController;

Route::prefix('v1')->group(function () {
    // Authentication routes (public)
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Public routes
    Route::prefix('movies')->group(function () {
        Route::get('/', [MovieController::class, 'index']);
        Route::get('/trending', [MovieController::class, 'trending']);
        Route::get('/top-rated', [MovieController::class, 'topRated']);
        Route::get('/upcoming', [MovieController::class, 'upcoming']);
        Route::get('/{movie}', [MovieController::class, 'show']);
        Route::get('/{movie}/reviews', [ReviewController::class, 'movieReviews']);
    });

    Route::prefix('series')->group(function () {
        Route::get('/', [SeriesController::class, 'index']);
        Route::get('/trending', [SeriesController::class, 'trending']);
        Route::get('/top-rated', [SeriesController::class, 'topRated']);
        Route::get('/{series}', [SeriesController::class, 'show']);
        Route::get('/{series}/seasons', [SeriesController::class, 'seasons']);
        Route::get('/{series}/reviews', [ReviewController::class, 'seriesReviews']);
    });

    Route::prefix('actors')->group(function () {
        Route::get('/', [ActorController::class, 'index']);
        Route::get('/popular', [ActorController::class, 'popular']);
        Route::get('/{actor}', [ActorController::class, 'show']);
    });

    // Protected routes
    Route::middleware('jwt')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/profile', [AuthController::class, 'profile']);
            Route::post('/refresh', [AuthController::class, 'refresh']);
        });

        Route::prefix('ratings')->group(function () {
            Route::get('/', [RatingController::class, 'getUserRatings']);
            Route::post('/movies/{movie}', [RatingController::class, 'rateMovie']);
            Route::post('/series/{series}', [RatingController::class, 'rateSeries']);
        });

        Route::prefix('reviews')->group(function () {
            Route::post('/movies/{movie}', [ReviewController::class, 'createMovieReview']);
            Route::post('/series/{series}', [ReviewController::class, 'createSeriesReview']);
            Route::delete('/{review}', [ReviewController::class, 'deleteReview']);
        });
    });
});
