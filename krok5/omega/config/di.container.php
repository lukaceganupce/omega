<?php

use Pimple\Container;
use App\Request;
use App\Response;
use App\Router;
use App\Module;

$container = new Container();

$container['module'] = function ($c) {
    return new Module();
};

$container['request'] = function($c) {
    return Request::createFromGlobal();
};

$container['response'] = function($c) {
    return new Response();
};

$container['router'] = function ($c) {
    return new Router( $c['module']->loadModules($c['config']['module'], !isset($c['config']['routes'])? : $c['config']['routes']));
};

return $container;