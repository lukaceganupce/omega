<?php

use App\App;
use App\Request;
use App\Response;

chdir(dirname(__DIR__));

include __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ .'/../config/app.config.php';

$request = Request::createFromGlobal();
$response = new Response();

$app = new App($config, $request, $response);
$app->run();