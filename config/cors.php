<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['GET', 'POST', 'OPTIONS'],
    'allowed_origins' => ['*'],  // Specifica l'origine frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
