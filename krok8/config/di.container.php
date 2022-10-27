<?php

use Pimple\Container;
use App\Request;
use App\Response;
use App\Router;
use App\Module;
use App\Db;
use App\Dispatcher;

use Monolog\Logger;
use Monolog\Handler\StreamHandler as MonologHandlerStreamHandler;

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

$container['db'] = function ($c) {
    $conf = $c['config']['db'];
    return new Db($conf['host'], $conf['username'], $conf['password'], $conf['db_name'], $conf['charset']);
};

$container['dispatcher'] = function ($c) {
    return new Dispatcher();
};

$container['logger'] = function ($c) {
    $logger = new Logger('Omega');
    $logger->pushHandler(new MonologHandlerStreamHandler('data/log/monolog.txt'));
    return $logger;
};

return $container;