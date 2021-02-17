<?php
require_once '../vendor/autoload.php';

use app\core\Application;

$app = new Application();


$app->router->get('/', function () {
    return "this is home page";
});

//
$app->router->get('/about', function () {
    return "this is about page";
});

$app->run();