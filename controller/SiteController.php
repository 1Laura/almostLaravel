<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{


    /**
     * This handles Home page get request
     *
     * @return string|string[]
     */
    public function home()
    {
        $params = [
            'name' => 'AlmostLara',
            'subtitle' => "This is a nice way to learn PHP"
        ];
        return $this->render('home', $params);
    }

    public function about()
    {
        $params = [
            'version' => '1.0.0',

        ];
        return $this->render('about', $params);
    }

    /**
     * This serves the contact form view
     *
     * @return string
     */
    public function contact()
    {
        // "This should be a form";
        //lets render view
        return $this->render('contact');
    }


    /**
     * This is were we handle post contact form
     *
     * @return string
     */
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
//        var_dump($body);
//        exit();

        return "Handling form site controller handleContact method";

    }

}