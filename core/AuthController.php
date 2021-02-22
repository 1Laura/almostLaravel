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
    public Validation $vld;

    public function __construct()
    {
        $this->vld = new Validation();
    }

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

            // Validate name
            $data['errors']['nameErr'] = $this->vld->validateName($data['name']);

            // Validate email
//            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);
            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email']);

            // Validate password, nuo 4 iki 10 simboliu
            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 4, 10);

            // Validate confirmPassword
            $data['errors']['confirmPasswordErr'] = $this->vld->validateConfirmPassword($data['confirmPassword']);


//            var_dump($data);
//            exit();


            return $this->render('register', $data);
        endif;
    }


}