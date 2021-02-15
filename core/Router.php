<?php


namespace app\core;


/**
 * Class Router
 *
 * This is where we call controllers and methods.
 *
 * @package app\core
 */
class Router
{
    /**
     * This will hold all routes.
     *
     * routes[
     *  ['get']=>[
     *      ['/'=>function return,],
     *      ['/about'=>function return,]
     *  ],
     *  ['post']=>[
     *      ['/'=>function return,],
     *      ['/about'=>function return,]
     *  ],
     *
     * ];
     *
     * @var array
     */
    protected array $routes = [];


    public function __construct()
    {
        echo "This is Router constructor" . PHP_EOL;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }


    public function resolve()
    {
//        var_dump($this->routes);
        var_dump($_SERVER);
        exit;

    }

}