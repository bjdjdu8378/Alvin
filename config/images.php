<?php

return [
    'image_quality' => env('IMAGE_QUALITY', 85),
    'enable_optimization' => env('ENABLE_IMAGE_OPTIMIZATION', true),
    'enable_thumbnails' => env('ENABLE_THUMBNAILS', true),
    'thumbnail_size' => env('THUMBNAIL_SIZE', 200),
    'enable_compression' => env('ENABLE_COMPRESSION', true),
    'compression_quality' => env('COMPRESSION_QUALITY', 75),
    'max_image_size' => env('MAX_IMAGE_SIZE', 10485760),
];
