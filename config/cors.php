<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Allow Next.js (localhost:3000) and production domains to access API.
    | You can override allowed origins via env CORS_ALLOWED_ORIGINS
    | (comma-separated list).
    |
    */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => explode(',', env('CORS_ALLOWED_ORIGINS', 'http://localhost:3000,https://haiseven.com')),
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    // Using bearer tokens; cookies not required
    'supports_credentials' => false,
];
