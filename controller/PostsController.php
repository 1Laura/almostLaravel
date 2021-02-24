<?php


namespace app\controller;


use app\core\Controller;
use app\core\Request;
use app\model\PostModel;
use app\model\UserModel;

class PostsController extends Controller
{
    public PostModel $postModel;
    public UserModel $userModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->userModel = new UserModel();
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


    public function post(Request $request, $urlParam = null)
    {

        if ($urlParam['value']) {
            $id = $urlParam['value'];

            //get post with id  = $urlParam['value']
            //get post row
            $post = $this->postModel->getPostById($id);

//            var_dump($post);
            //lets get user data by userId
            $user = $this->userModel->getUserById($post->userId);
            var_dump($user);
            // serve this post details

            $data = [
//                $urlParam['name'] => $urlParam['value']
                'post' => $post,
                'user' => $user
            ];

            return $this->render('posts/singlePost', $data);
        }
        $request->redirect('/posts');
    }


}




//    CREATE TABLE `lara`.`posts` ( `postId` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(150) NOT NULL , `body` TEXT NOT NULL , `created` DATE on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `userId` INT NOT NULL , PRIMARY KEY (`postId`)) ENGINE = InnoDB;

//ALTER TABLE `posts` ADD FOREIGN KEY (`userId`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
