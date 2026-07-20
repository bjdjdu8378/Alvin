<?php

return [
    'scheduler_enabled' => env('SCHEDULER_ENABLED', true),
    'tasks' => [
        'every_5_minutes' => [
            'trending',
            'popular_searches',
            'latest_news',
        ],
        'hourly' => [
            'sync_movies',
            'sync_series',
            'sync_actors',
            'sync_images',
            'sync_videos',
            'sync_logos',
        ],
        'daily' => [
            'full_sync',
            'cache_cleanup',
            'generate_statistics',
            'export_data',
        ],
    ],
];
