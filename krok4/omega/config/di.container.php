<?php

use Pimple\Container;
use App\Request;
use App\Response;
use App\Router;

$container = new Container();

$container['request'] = function($c) {
    return Request::createFromGlobal();
};

$container['response'] = function($c) {
    return new Response();
};

$container['router'] = function ($c) {
    return new Router(!isset($c['config']['routes'])? : $c['config']['routes']);
};

return $container;