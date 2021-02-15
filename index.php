<?php

$app = new Aplication();

$router = new Router();

$router->get('/', function (){
    return "this is home page";
});

$router->get('/about', function (){
    return "this isabout page";
});

$app->run();