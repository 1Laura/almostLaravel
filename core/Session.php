<?php


namespace app\core;


class Session
{
    public function __construct()
    {
//        session_destroy();
        session_start();
    }
}