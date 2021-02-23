<?php


namespace app\controller;


use app\core\Controller;
use app\core\Request;
use app\model\PostModel;

class PostsController extends Controller
{
    public PostModel $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }


    public function index(Request $request)
    {
        //gets posts
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts,

        ];

        return $this->render('posts/posts', $data);
    }


}




//    CREATE TABLE `lara`.`posts` ( `postId` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(150) NOT NULL , `body` TEXT NOT NULL , `created` DATE on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `userId` INT NOT NULL , PRIMARY KEY (`postId`)) ENGINE = InnoDB;

//ALTER TABLE `posts` ADD FOREIGN KEY (`userId`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
