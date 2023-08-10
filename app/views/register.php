<?php
require_once '../controllers/UserController.php';
require_once '../../config/database.php';


// Create an instance of UserController with the $pdo instance
$userController = new UserController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required keys exist in the $_POST array
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // call the registerUser method to register the user
            $userController->registerUser($username, $email, $password);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Create an Account</h4>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required value="<?php echo $username; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required value="<?php echo $password; ?>">
                            </div>
                            <div class=" text-center">
                                <button type="submit" class="btn btn-primary btn-block w-100">Register</button>
                            </div>

                            <p class="text-center mt-3">Already have an account? <a href="#">Log in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>