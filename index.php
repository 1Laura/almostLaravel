<?php
require_once "vendor/autoload.php";

use app\core\Application;
use app\core\Router;


$app = new Application();


$router = new Router();



//$router = new Router();
//
//$router->get('/', function (){
//    return "this is home page";
//});
//
//$router->get('/about', function (){
//    return "this isabout page";
//});
//
//$app->run();