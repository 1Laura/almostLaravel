<?php


namespace app\controller;


use app\core\Controller;

class PostsController extends Controller
{

    public function index()
    {
        return $this->render('posts/posts');
    }

}