<?php

return [
    'routes'=> [
        'rooms'=> [
            'route'=>'/rooms',
            'action' => [
                'Modules\Rooms\Rooms',
                'readRooms',
            ]
        ]
    ]
];
