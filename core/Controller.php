<?php


namespace app\core;


/**
 * Class Controller
 *
 * our base contoller class
 *
 * @package app\core
 */
class Controller
{
    public string $layout = 'main';

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }


    /**
     * We render the view with params
     *
     * @param string $view
     * @param array $params
     * @return string|string[]
     */
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);

    }

}