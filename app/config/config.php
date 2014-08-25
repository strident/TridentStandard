<?php

$dbHost = '';
$dbPort = '';
$dbUser = '';
$dbPass = '';
$dbName = '';

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
            'host'     => $dbHost,
            'port'     => $dbPort,
            'username' => $dbUser,
            'password' => $dbPass,
            'database' => $dbName
        ]
    ],
    'migrations' => [
        'paths' => [
            'migrations' => __DIR__.'/../migrations'
        ],
        'environments' => [
            'default_migration_table' => 'migrations_tracking',
            'default_database' => 'dev',
            'prod' => [
                'adapter' => 'mysql',
                'host'    => $dbHost,
                'name'    => $dbName,
                'user'    => $dbUser,
                'pass'    => $dbPass,
                'port'    => $dbPort,
                'charset' => 'utf8'
            ],
            'dev' => [
                'adapter' => 'mysql',
                'host'    => $dbHost,
                'name'    => $dbName,
                'user'    => $dbUser,
                'pass'    => $dbPass,
                'port'    => $dbPort,
                'charset' => 'utf8'
            ]
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
