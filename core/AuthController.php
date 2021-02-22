<?php


namespace app\core;

/**
 * Responsible for handling login and register
 *
 * Class AuthController
 * @package app\core
 */
class AuthController extends Controller
{

    public function login()
    {
        //have abillity to change layout
        $this->setLayout('auth');
        return $this->render('login');

    }

    public function register(Request $request)
    {
        if ($request->isGet()) :
            $this->setLayout('auth');
            return $this->render('register');
        endif;

        if ($request->isPost()) :
            return "Validating form";
        endif;
    }


}