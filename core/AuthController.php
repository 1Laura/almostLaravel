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
//        $this->setLayout('auth');
        return $this->render('login');

    }

    public function register(Request $request)
    {
        if ($request->isGet()) :
//            $this->setLayout('auth');
            //create cata
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'errors' => [
                    'nameErr' => '',
                    'emailErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => '',
                ],
                'currentPage' => 'register'
            ];


            return $this->render('register', $data);
        endif;

        if ($request->isPost()) :
            //request is post and we need to pull user data
            $data = $request->getBody();

//            var_dump($data);
//            exit();


            return $this->render('register', $data);
        endif;
    }


}