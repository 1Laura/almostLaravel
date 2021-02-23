<?php


namespace app\model;


use app\core\Application;
use app\core\Database;

class PostModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }


    // get all posts from posts table
    //return Object Array
    public function getPosts()
    {
        $sql = "SELECT posts.title, posts.body, users.name, users.email, posts.id AS postId, users.id AS userId,
 posts.created AS postCreated, users.created AS userCreated FROM posts INNER JOIN users ON posts.userId = users.id
 ORDER BY posts.created DESC";

        $this->db->query($sql);

        //resutltatui kvieciame sitos db prisijungima, ir jam kvieciam fetch resultata
        $result = $this->db->resultSet();

        return $result;
    }

    public function addPost($data)
    {
        //prepare statement
        $this->db->query("INSERT INTO posts (`title`, `body`, `userId`) VALUES (:title, :body, :userId)");

        //add values//priskirti reiksmes
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':userId', $data['userId']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // will return post row if found
    //return false if not found
    public function getPostById($id)
    {
        $this->db->query("SELECT * FROM posts WHERE id=:id");
        $this->db->bind(':id', $id);

        $row = $this->db->singleRow();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //to update one post
    public function updatePost($data)
    {
        //prepare statement
        $this->db->query("UPDATE posts SET `title`=:title, `body`=:body WHERE id=:postId");

        //add values//priskirti reiksmes
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':postId', $data['postId']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //to delete one post
    public function deletePost($id)
    {
        //prepare statement
        $this->db->query("DELETE FROM `posts` WHERE `posts`.`id` =:postId");

        $this->db->bind(':postId', $id);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }


}