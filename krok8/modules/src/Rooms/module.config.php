<?php

return [
    'routes'=> [
        'rooms'=> [
            'route'=>'/rooms',
            'action' => [
                'Modules\Rooms\Controller\RoomsController',
                'readRooms',
            ]
        ],
        'room'=> [
            'route'=>'/room',
            'action' => [
                'Modules\Rooms\Controller\RoomsController',
                'readRoom',
            ]
        ]
    ]
];
