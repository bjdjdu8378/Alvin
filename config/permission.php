<?php

return [
    'enable_permissions' => true,
    'default_roles' => [
        'admin',
        'editor',
        'viewer',
        'user',
    ],
    'default_permissions' => [
        'view_movies',
        'view_series',
        'view_actors',
        'create_movies',
        'edit_movies',
        'delete_movies',
        'create_series',
        'edit_series',
        'delete_series',
        'manage_users',
        'manage_roles',
        'sync_tmdb',
        'manage_cache',
    ],
    'table_names' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'model_has_roles' => 'model_has_roles',
        'model_has_permissions' => 'model_has_permissions',
        'role_has_permissions' => 'role_has_permissions',
    ],
];
