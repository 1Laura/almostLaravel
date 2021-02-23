<?php


namespace app\model;


use app\core\Application;
use app\core\Database;

class UserModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    // finds user by given email========================================================================================
    //return Boolean
    /**
     * @param $email
     * @return bool
     */
    public function findUserByEmail($email): bool
    {
        //check if given email is in database
        // prepare statement/ paruosiam statementa
        $this->db->query("SELECT * FROM users WHERE `email` = :email");

        //add values to statement / priskiriam reiksme
        $this->db->bind(':email', $email);

        // save result in row
        $row = $this->db->singleRow();

        //check if we got some results
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    // register user with given sanitized data==========================================================================
    // return Boolean
    public function register($data): bool
    {
        //prepare statement
        $this->db->query("INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)");

        //add values//priskirti reiksmes
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        // hashed password
        $this->db->bind(':password', $data['password']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // checks in the database for the email and password
    ////tries to verify passwordlogin user
    //return row or false
    public function login($email, $notHashedPass)
    {
        //get the row with given email
        $this->db->query("SELECT * FROM users WHERE `email`= :email");

        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        if ($row) {
            //isssisaugoti slaptazodis is tos eilute kuria gavom
            //eilute, kurioj stulpelis password - PDO bajeris :)
            $hashedPassword = $row->password;
        } else {
            return false;
        }

        // check password
        if (password_verify($notHashedPass, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    // will return user data row if found
    // return false if not found
    public function getUserById($id)
    {
        $this->db->query("SELECT name, email FROM users WHERE id=:id");
        $this->db->bind(':id', $id);

        $row = $this->db->singleRow();

        if ($this->db->rowCount() > 0) {
            return $row;
        }
        return false;
    }


}