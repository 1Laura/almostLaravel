<?php


namespace app\controller;


use app\core\Application;

class SiteController
{
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