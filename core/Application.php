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

    public function __construct()
    {
//        echo "This is Application constructor";
        $this->router = new Router();
    }


    public function run()
    {
        $this->router->resolve();
    }

}