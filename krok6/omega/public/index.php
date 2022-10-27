<?php

use App\App;
use App\Request;
use App\Response;

chdir(dirname(__DIR__));

include __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ .'/../config/app.config.php';


$app = new App(include __DIR__ . '/../config/di.container.php',  $config );
$app->run();