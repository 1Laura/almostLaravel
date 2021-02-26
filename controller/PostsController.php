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

            //if there are no such id
            if ($post === false) {
                return $this->render('_404');
            }
//            var_dump($post);
            //lets get user data by userId
            $user = $this->userModel->getUserById($post->userId);
//            var_dump($user);
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

    public function addPost(Request $request)
    {
        //check if get or post
        if ($request->isGet()) :
            //create data
            $data = [
                'userId' => $_SESSION['userId'],
                'title' => '',
                'body' => '',
                'errors' => [
                    'titleErr' => '',
                    'bodyErr' => '',
                ],
            ];
            return $this->render('posts/addPost', $data);
        endif;

        if ($request->isPost()) :
            $data = $request->getBody();
            //validate title
            $data['userId'] = $_SESSION['userId'];
            if (empty($data['title'])) {
                $data['errors']['titleErr'] = 'Please enter a title';
            }
            //validate body
            if (empty($data['body'])) {
                $data['errors']['bodyErr'] = 'Please enter a text';
            }
            //check if there are no errors
            if (empty($data['errors']['titleErr']) && empty($data['errors']['bodyErr'])) {
                if ($this->postModel->addPost($data)) {
                    $request->redirect('/posts');
                } else {
                    die('something went wrong in adding post');
                }
            } else {
                return $this->render('posts/addPost', $data);
            }
            return $this->render('posts/addPost', $data);
        endif;
    }

    public function editPost(Request $request, $urlParam = null)
    {
        //check if get
        if ($request->isGet()) {
            if ($urlParam['value']) {
                $id = $urlParam['value'];
                $postData = $this->postModel->getPostById($id);
//                var_dump($postData);
                $data = [
                    'postId' => $id,
                    'userId' => $_SESSION['userId'],
                    'title' => $postData->title,
                    'body' => $postData->body,
                    'errors' => [
                        'titleErr' => '',
                        'bodyErr' => '',
                    ],
                ];
                return $this->render('posts/editPost', $data);
            }
        }
        //check if post
        if ($request->isPost()) :
            $data = $request->getBody();
            $data['postId'] = $urlParam['value'];

            //validate title
            $data['userId'] = $_SESSION['userId'];
            if (empty($data['title'])) {
                $data['errors']['titleErr'] = 'Please enter a title';
            }
            //validate body
            if (empty($data['body'])) {
                $data['errors']['bodyErr'] = 'Please enter a text';
            }
            //check if there are no errors
            if (empty($data['errors']['titleErr']) && empty($data['errors']['bodyErr'])) {
                if ($this->postModel->updatePost($data)) {
                    $request->redirect('/posts');
                } else {
                    die('something went wrong in updating post');
                }
            } else {
                return $this->render('posts/editPost', $data);
            }
            return $this->render('posts/editPost', $data);
        endif;
    }


    public function deletePost(Request $request, $urlParam = null)
    {
        if ($request->isPost()) {
            $id = $urlParam['value'];
            if ($this->postModel->deletePost($id)) {
                $request->redirect('/posts');
            }
        }

    }
}




//    CREATE TABLE `lara`.`posts` ( `postId` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(150) NOT NULL , `body` TEXT NOT NULL , `created` DATE on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `userId` INT NOT NULL , PRIMARY KEY (`postId`)) ENGINE = InnoDB;

//ALTER TABLE `posts` ADD FOREIGN KEY (`userId`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
