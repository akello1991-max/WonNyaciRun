<?php
return [
    'x' => [
        'username' => env('X_USERNAME') ?: 'AkaoGloriah',
        'bearer_token' => env('X_BEARER_TOKEN') === 'your_x_bearer_token_here' ? null : env('X_BEARER_TOKEN'),
    ],
];
