<?php

use Pimple\Container;
use App\Request;
use App\Response;

$container = new Container();

$container['request'] = function($c) {
    return Request::createFromGlobal();
};

$container['response'] = function($c) {
    return new Response();
};

return $container;