<?php

return [
    'api_key' => env('TMDB_API_KEY'),
    'api_base_url' => env('TMDB_API_BASE_URL', 'https://api.themoviedb.org/3'),
    'image_base_url' => env('TMDB_IMAGE_BASE_URL', 'https://image.tmdb.org/t/p'),
    'language' => env('TMDB_LANGUAGE', 'en-US'),
    'region' => env('TMDB_REGION', 'US'),
    'timeout' => env('TMDB_TIMEOUT', 30),
    'image_sizes' => [
        'poster' => ['w92', 'w154', 'w185', 'w342', 'w500', 'w780', 'original'],
        'backdrop' => ['w300', 'w780', 'w1280', 'original'],
        'profile' => ['w45', 'w185', 'h632', 'original'],
        'logo' => ['w45', 'w92', 'w154', 'w185', 'w300', 'w500', 'original'],
    ],
    'batch_size' => env('TMDB_BATCH_SIZE', 20),
    'rate_limit' => env('TMDB_RATE_LIMIT', 40),
];
