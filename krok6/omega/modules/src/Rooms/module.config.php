<?php

return [
    'routes'=> [
        'rooms'=> [
            'route'=>'/rooms',
            'action' => [
                'Modules\Rooms\Rooms',
                'readRooms',
            ]
        ],
        'room'=> [
            'route'=>'/room',
            'action' => [
                'Modules\Rooms\Rooms',
                'readRoom',
            ]
        ]
    ]
];
