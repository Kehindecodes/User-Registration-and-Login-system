<?php

require_once __DIR__ . '/../../config/database.php';


class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }



    /**
     * Creates a new user in the database.
     *
     * @param string $username The username of the user.
     * @param string $email The email address of the user.
     * @param string $password The password of the user.
     * @throws Some_Exception_Class If there is an error executing the database query.
     * @return void
     */
    public function createUser(string $username, string $email, string $password)
    {



        $statement =  $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        // execute the query
        $statement->execute();
    }

    /**
     * Retrieves a user from the database based on their username.
     *
     * @param string $username The username of the user to retrieve.
     * @throws PDOException If an error occurs while executing the database query.
     * @return array|null The fetched user data as an associative array, or null if no user is found.
     */
    public function getUser(string $username)
    {
        // retrieve user data  based on their username from the database
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * Updates a user in the database.
     *
     * @param string $username The username of the user to update.
     * @param string $email The new email of the user.
     * @param string $password The new password of the user.
     * @param string $bio The new bio of the user.
     * @throws Some_Exception_Class Description of exception (if any).
     * @return void
     */
    public function updateUser(string $username, string $email, string $password, string $bio, string $image)
    {
        // update user with that username in the database
        $statement = $this->pdo->prepare("UPDATE users SET email = :email, password = :password, bio = :bio, profile_image = :image WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':bio', $bio);
        $statement->bindValue(':image', $image);
        $statement->execute();
    }
}
