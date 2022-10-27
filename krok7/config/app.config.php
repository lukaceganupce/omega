<?php

return [
    'db' => [
        'db_name' => 'omega',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ],
    'module' => [
        'Rooms',
    ],

    'routes' => [
        'page1' => [
            'route' => '/page1',
            'action' => [
                'App\View',
                'page1'
            ]
        ],
        'page2' => [
            'route' => '/page2',
            'action' => [
                'App\View',
                'page2'
            ]
        ]
    ]
];