<?php
require_once '../../middleware/AuthMiddleware.php';
require_once '../models/UserModel.php';

session_start();

// Check if user is authenticated
AuthMiddleware::requireAuth();

// Get authenticated user
$username = $_SESSION['username'];
$userModel = new User($pdo);
$user = $userModel->getUser($username);

$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $bio = $_POST['bio'];


    if (empty($errors)) {
        // Handle image upload
        $image = $_FILES['profile-image'] ?? null;
        echo '<pre>';
        var_dump($image);
        echo '</pre>';

        $imagePath = '';

        if ($image && $image['tmp_name']) {
            $imagePath = 'uploads/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
        $profileImage = $imagePath;

        // Update user profile
        $updatedUser = $userModel->updateUser($username, $email, $password, $bio, $profileImage);

        // Redirect to profile page
        header('Location: profile.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="edit-body">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card edit-profile-card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit Profile</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <!-- <label for="edit-profile-image">Profile Image</label> -->
                                <input type="file" class="form-control-file profile-image" name="profile-image" id="profile-image">
                            </div>
                            <div class="edit-form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
                            </div>
                            <div class="edit-form-group">
                                <label for="bio">Bio</label>
                                <textarea class="form-control" id="bio" rows="3" name="bio" value="<?php echo $user['bio']; ?>"></textarea>
                            </div>
                            <div class="edit-form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                            </div>
                            <div class="edit-form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>