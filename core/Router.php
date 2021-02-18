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
    public Response $response;

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
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
            //404
            $this->response->setResponseCode(404);
//            Application::$app->response->setResponseCode(404);
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

    /**
     * Renders the page and applies the layout
     *
     * @param string $view
     * @return string|string[]
     */
    public function renderView(string $view)
    {
//        include_once __DIR__ . "/../view/$view.php";
        $layout = $this->layoutContent();
        $page = $this->pageContent($view);
//        include_once Application::$ROOT_DIR . "/view/$view.php";
//        var_dump($layout);
        // take layout and replace the {{content}} with the $page content
        return str_replace('{{content}}', $page, $layout);

    }

    /**
     * Returns the layout HTML content
     * @return false|string
     */
    protected function layoutContent()
    {
        //start buffering
        ob_start();
        include_once Application::$ROOT_DIR . "/view/layout/main.php";
        //stop and return buffering
        return ob_get_clean();
    }

    /**
     * Returns only the given page HTML content
     * @param $view
     * @return false|string
     */
    protected function pageContent($view)
    {
        //start buffering
        ob_start();
        include_once Application::$ROOT_DIR . "/view/$view.php";
        //stop and return buffering
        return ob_get_clean();
    }


}