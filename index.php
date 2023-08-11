<?php
// Include necessary files and create a PDO connection
// require_once './config/database.php';
// require_once './app/controllers/UserController.php';
// require_once './app/controllers/AuthController.php';

// // Create an instance of UserController with the $pdo instance
// $userController = new UserController($pdo);

// // create an instance of AuthController
// $authController = new AuthController($pdo);

// // Define the routing logic
// $path = $_SERVER['REQUEST_URI'];
// $method = $_SERVER['REQUEST_METHOD'];

// echo $path;

// if ($method === 'POST' && $path === './app/views/register.php') {
//     // Check if the required keys exist in the $_POST array
//     if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
//         $username = $_POST['username'];
//         $email = $_POST['email'];
//         $password = $_POST['password'];

//         try {
//             // call the registerUser method to register the user
//             $userController->registerUser($username, $email, $password);
//         } catch (\Throwable $th) {
//             echo $th->getMessage();
//         }
//     }
// } elseif ($method === 'POST' && $path === '/login') {
//     // Check if the required keys exist in the $_POST array
//     if (isset($_POST['username']) && isset($_POST['password'])) {
//         $email = $_POST['email'];
//         $password = $_POST['password'];
//     }

//     try {
//         $authController->loginUser($email, $password);
//     } catch (\Throwable $th) {
//         //throw $th;
//         echo $th->getMessage();
//     }
// } else {
//     // Handle other routes or show a 404 page
//     echo "404 - Page not found";
// }
