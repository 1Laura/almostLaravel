<?php

require_once '../vendor/autoload.php';

use app\core\Application;

//var_dump(dirname(__DIR__));
//exit();


$app = new Application(dirname(__DIR__));


$app->router->get('/', 'home');

$app->router->get('/about', 'about');


$app->run();