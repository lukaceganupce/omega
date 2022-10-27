<?php

return [
  'routes'=> [
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