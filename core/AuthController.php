<?php


namespace app\core;

use app\model\UserModel;

/**
 * Responsible for handling login and register
 *
 * Class AuthController
 * @package app\core
 */
class AuthController extends Controller
{
    public Validation $vld;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->vld = new Validation();
        $this->userModel = new UserModel();
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
            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);
//            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email']);

            // Validate password, nuo 4 iki 10 simboliu
            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 4, 10);

            // Validate confirmPassword
            $data['errors']['confirmPasswordErr'] = $this->vld->validateConfirmPassword($data['confirmPassword']);

            if ($this->vld->ifEmptyErrorsArray($data['errors'])) {

                //hash password // save way to store password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //create user
                if ($this->userModel->register($data)) {
                    //success user added
                    //set flash message
//                    flash('registerSuccess', 'You have registered successfully');
//                    header("Location: " . URLROOT . "/users/login");
                    $request->redirect('/login');
                } else {
                    die('something went wrong in adding user to db');
                }


            }

            return $this->render('register', $data);
        endif;
    }


}