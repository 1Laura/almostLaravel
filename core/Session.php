<?php


namespace app\core;


class Session
{
    public function __construct()
    {
//        session_destroy();
        session_start();
    }

    /**
     * checks is user is logged in
     *
     * @return bool
     */
    public static function isUserLoggedIn(): bool
    {
        if (isset($_SESSION['userId'])) {
            return true;
        }
        return false;
    }

}