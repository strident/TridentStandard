<?php

return [
    'caching' => [
        'default' => 'memcached',
        'memcached' => [
            'host' => 'localhost',
            'port' => 11211
        ]
    ],
    'database' => [
        'default' => [
            'host' => 'localhost',
            'username' => 'tifa',
            'password' => '',
            'port' => '3306',
            'database' => 'Test'
        ]
    ],
    'security' => [
        'forms' => [
            'csrf_secret' => 'GI5_lvR)pWp5(RQOBO5k#sOmX6sYxW9F'
        ]
    ],
    'twig' => [
        'cache_dir' => __DIR__.'/../cache/twig'
    ]
];
