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
    public Router $router;
    public Request $request;

    public function __construct()
    {
//        echo "This is Application constructor";
        $this->request = new Request();
        $this->router = new Router($this->request);
    }


    public function run()
    {
        echo $this->router->resolve();
    }

}