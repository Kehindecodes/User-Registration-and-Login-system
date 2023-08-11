<?php

require_once '../../config/database.php';
require_once '../models/UserModel.php';





class AuthController
{
    private $userModel;

    /**
     * Initializes a new instance of the class.
     *
     * @param PDO $pdo The PDO object.
     */
    public function __construct(PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    /**
     * Logs in a user with the provided username and password.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     * @throws Exception if the username or password is empty, or if the username is not found, or if the password is incorrect.
     * @return void
     */
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

    /**
     * Logs out the user by destroying the session, displaying a logout message, and redirecting to the login page.
     *
     * @throws Some_Exception_Class description of exception
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        echo 'You are logged out';
        header('Location: login.php');
    }
}
