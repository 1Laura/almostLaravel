<?php

require_once '../vendor/autoload.php';

// cia galima isitraukti helperiu koki kataloga

use app\controller\PostsController;
use app\controller\SiteController;
use app\core\Application;
use app\core\AuthController;

//var_dump(dirname(__DIR__));
//exit();

// env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

//var_dump($config);
//exit();


$app = new Application(dirname(__DIR__), $config);


$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/about', [SiteController::class, 'about']);
//$app->router->get('/about', 'about');
$app->router->get('/contact', [SiteController::class, 'contact']);

//
//$app->router->get('/fn', function(){
//    return 56+74;
//});

//we create post path
$app->router->post('/contact', [SiteController::class, 'handleContact']);


//routes for login and register
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

//sukuriam routa logout
$app->router->get('/logout', [AuthController::class, 'logout']);

// sukuriam routa, nurodom koks kontrolleris valdys
$app->router->get('/posts', [PostsController::class, 'index']);
$app->router->get('/post/{id}', [PostsController::class, 'post']);

//papildomas routas prideti postui
$app->router->get('/post/add', [PostsController::class, 'addPost']);
$app->router->post('/post/add', [PostsController::class, 'addPost']);


$app->router->get('/post/edit/{id}', [PostsController::class, 'editPost']);
$app->router->post('/post/edit/{id}', [PostsController::class, 'editPost']);

//sukuriam routa deletui
$app->router->post('/post/delete/{id}', [PostsController::class, 'deletePost']);
//$app->router->get('/post/delete/{id}', [PostsController::class, 'deletePost']);

$app->run();