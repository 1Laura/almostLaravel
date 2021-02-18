<?php


namespace app\core;


/**
 * Class Application
 *
 * This is main application
 *
 * @package app\core
 */
class Application
{

    /**
     * This is instance of Router class
     *
     * We will need routing in all our application. So we will have it as a property;
     *
     * @var Router
     */
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    //a way to get this app's properties and methods where we need them
    public static Application $app;

    public function __construct($rootPath)
    {
        //static property assignment
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
    }


    public function run()
    {
        echo $this->router->resolve();
    }

}