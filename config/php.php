<?php

return [
    'display_errors' => env('APP_DEBUG', false),
    'display_startup_errors' => env('APP_DEBUG', false),
    'log_errors' => true,
    'log_errors_max_len' => 1024,
    'ignore_repeated_errors' => false,
    'ignore_repeated_source' => false,
    'error_log' => storage_path('logs/php-errors.log'),
    'memory_limit' => '512M',
    'post_max_size' => '100M',
    'upload_max_filesize' => '100M',
    'max_execution_time' => 120,
    'default_socket_timeout' => 60,
];
