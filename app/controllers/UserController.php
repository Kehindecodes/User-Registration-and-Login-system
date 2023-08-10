<?php

require_once '../models/UserModel.php';

// create a PDO connection
require_once '../../config/database.php';



class UserController
{


    private $userModel;

    public function __construct(PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }
    /**
     * Registers a new user.
     *
     * @param string $username The username of the user.
     * @param string $email The email address of the user.
     * @param string $password The password of the user.
     * @param PDO $pdo The PDO object for database connection.
     * @throws Exception If the username, email, or password is empty.
     * @throws Exception If the email address is invalid.
     * @throws Exception If the password does not meet the requirements.
     * @throws Exception If the user already exists.
     * @return void
     */
    public function registerUser($username, $email, $password)
    {


        // create an instance of UserModel
        $userModel = $this->userModel;

        // validate input 
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception('Username, email and password are required');
        }
        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address');
        }

        // validate password
        if (strlen($password) < 6) {
            throw new Exception("Password must be at least 6 characters long");
        }
        if (!preg_match('/[A-Z]/', $password)) {
            throw new Exception("Password must contain at least one uppercase letter");
        }
        if (!preg_match('/\d/', $password)) {
            throw new Exception("Password must contain at least one digit");
        }
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            throw new Exception("Password must contain at least one special character");
        }

        // hash password
        $hashedPassword  = password_hash($password, PASSWORD_DEFAULT);

        // check if user already exists
        if ($userModel->getUser($username)) {
            throw new Exception('User already exists');
        }

        // create a new user
        $userModel->createUser($username, $email, $hashedPassword);

        echo 'User created' . '<br>';
    }
}
