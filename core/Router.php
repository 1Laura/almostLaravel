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
     *      ['/contact'=>function return,]
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
        //   12345678910
        //   '/post/{id}'
        if (strpos($path, '{')) {
            $startPos = strpos($path, '{');
            $endPos = strpos($path, '}');
            $argName = substr($path, $startPos + 1, $endPos - $startPos - 1);

            //callback yra masyvas
            $callback['urlParamName'] = $argName;
            $path = substr($path, 0, $startPos - 1);
//            var_dump($path);
//            exit();
        }
        $this->routes['get'][$path] = $callback;
    }

    /**
     * This creates post path and handling in routes array
     *
     * @param $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();

//        var_dump($path);
//        var_dump($method);

        //trying to run a route from routes array
        //ar yra nusetintas path
        $callback = $this->routes[$method][$path] ?? false;

        //if there is no such route added, we say not exist
//        var_dump($this->routes);
//        exit();

        if ($callback === false):
            //path = "/post/1" take argument value1
            //path = "/post" skip path argument take
            //extract 1

            $pathArr = explode('/', ltrim($path, '/'));

//            var_dump($pathArr);

            if (count($pathArr) === 2) {
                $path = '/' . $pathArr[0];
                $urlParam['value'] = $pathArr[1];
            }

            if (count($pathArr) === 3) {
                $path = '/' . $pathArr[0] . '/' . $pathArr[1];
                $urlParam['value'] = $pathArr[2];
            }

            $callback = $this->routes[$method][$path]??null;

//            var_dump($path);
            if (!isset($urlParam['value'])) {
                //404
                $this->response->setResponseCode(404);
                //Application::$app->response->setResponseCode(404);
                return $this->renderView('_404');
            }

        endif;

        //if our callback value is string
        if (is_string($callback)) :
            return $this->renderView($callback);
        endif;

        //if our callback is array, we handle it with class instance
        //jei tai yra masyvas, padarom nauja instansa is callback 0
        //
        if (is_array($callback)) {
            $instance = new $callback[0];
            Application::$app->controller = $instance;
            $callback[0] = Application::$app->controller;

            //check if we have url arguments in callback array
            if (isset($callback['urlParamName'])) {
                //          0 => string 'app\controller\PostsController' (length=30)
                //          1 => string 'post' (length=4)
                //          'urlParamName' => string 'id' (length=2)
                $urlParam['name'] = $callback['urlParamName'];
                //make callback array with 2 members
                array_splice($callback, 2, 1);

            }
        }
//        var_dump($callback);

        // page does exist we call user function
        // callback -> koki controlleri ir koki metoda paleisti, po kablelio yra argumentai
        // $urlParam = [
        //'value'=> 32,
        //'name'=> 'id'
        //];
        return call_user_func($callback, $this->request, $urlParam ?? null);
    }

    /**
     * Renders the page and applies the layout
     *
     * @param string $view
     * @return string|string[]
     */
    public function renderView(string $view, array $params = [])
    {
//        include_once __DIR__ . "/../view/$view.php";
        $layout = $this->layoutContent();
        $page = $this->pageContent($view, $params);
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
        //controller->layout yra savybe
        if (isset(Application::$app->controller)) :
            $layout = Application::$app->controller->layout;
        else :
            $layout = 'main';
        endif;

        //start buffering
        ob_start();
        include_once Application::$ROOT_DIR . "/view/layout/$layout.php";
        //stop and return buffering
        return ob_get_clean();
    }

    /**
     * Returns only the given page HTML content
     * @param $view
     * @return false|string
     */
    protected function pageContent($view, $params)
    {
        //smart way of creating variables dynamically
        // $name = $params['name'];
        //
        foreach ($params as $key => $value) {
            $$key = $value;
//            var_dump($$key);
        }
//        var_dump($params);
//        exit();


        //start buffering
        ob_start();
        include_once Application::$ROOT_DIR . "/view/$view.php";
        //stop and return buffering
        return ob_get_clean();
    }


}