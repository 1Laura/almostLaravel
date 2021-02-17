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
    /**
     * @var Request
     */
    public Request $request;


    public function __construct($request)
    {
        $this->request = $request;
//        echo "This is Router constructor" . PHP_EOL;
    }


    /**
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
//
//        var_dump($this->routes);
//        exit();
//        var_dump($path);
//        var_dump($method);

        //trying to run a route from routes array
        $callback = $this->routes[$method][$path] ?? false;
        //if there is no such route added, we say not exist

        if ($callback === false):
            echo "Page doesnt exists";
            die();
        endif;

        //if our callback value is string
        //$app->router->get('/about','about);
        if (is_string($callback)) :
            return $this->renderView($callback);
        endif;

        // page does exist we call user function

        return call_user_func($callback);
    }

    public function renderView(string $view)
    {

//        include_once __DIR__ . "/../view/$view.php";
        include_once Application::$ROOT_DIR . "/view/$view.php";
    }

    protected function layoutContent()
    {
        include_once Application::$ROOT_DIR . "/view/layout/main.php";
    }


}