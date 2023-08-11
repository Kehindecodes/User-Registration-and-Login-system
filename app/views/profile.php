<?php
require_once '../../middleware/AuthMiddleware.php';
require_once '../models/UserModel.php';

session_start();

// check if user is authenticated
AuthMiddleware::requireAuth();


//  get authenticated user
$username = $_SESSION['username'];
$userModel = new User($pdo);
$user = $userModel->getUser($username);

if (!$user) {
    header('Location: login.php');
}







?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- link css -->
    <link rel="stylesheet" href="./app.css">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card profile-card">
                    <div class="card-body">
                        <img src="<?php echo $user['profile_image']; ?>" alt="Profile Image" class="profile-image">
                        <h4 class="profile-name"><?php echo $user['username']; ?>
                            <a href="editProfile.php" class="text-secondary"><i class="fas fa-edit"></i></a>
                        </h4>
                        <p class="bio"><?php echo $user['bio']; ?>

                        </p>
                        <hr>
                        <div class="contact-info">
                            <p><strong> Email:</strong> <?php echo $user['email']; ?></p>
                            <p><strong>Password:</strong> *********</p>
                        </div>
                        <a class="btn btn-danger float-end" id="logoutBtn" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>