<?php


namespace app\controller;


use app\core\Application;

class SiteController
{

    public static function about()
    {
        return Application::$app->router->renderView('about');
    }

    /**
     * This handles Home page get request
     *
     * @return string|string[]
     */
    public static function home()
    {
        $params = [
            'name' => 'AlmostLara',
            'subtitle'=>"This is a nice way to learn PHP"
        ];
        return Application::$app->router->renderView('home', $params);
    }

    /**
     * This serves the contact form view
     *
     * @return string
     */
    public static function contact()
    {
        // "This should be a form";
        //lets render view
        return Application::$app->router->renderView('contact');
    }


    /**
     * This is were we handle post contact form
     *
     * @return string
     */
    public static function handleContact()
    {
        return "Handling form site controller";
    }

}