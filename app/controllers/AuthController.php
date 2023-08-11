<?php

require_once '../../config/database.php';
require_once '../models/UserModel.php';





class AuthController
{
    private $userModel;

    public function __construct(PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function loginUser($username, $password)
    {
        $userModel = $this->userModel;
        // validate input
        if (empty($username) || empty($password)) {
            throw new Exception('Username and password are required');
        }
        //  validate username
        $user = $userModel->getUser($username);
        if ($username !== $user['username']) {
            throw new Exception('username not found');
        }
        // validate password
        if (!password_verify($password, $user['password'])) {
            throw new Exception('Incorrect password');
        } else {

            // password correct, create session 
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo 'You are logged in';
            header('Location: profile.php');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        echo 'You are logged out';
        header('Location: login.php');
    }
}
