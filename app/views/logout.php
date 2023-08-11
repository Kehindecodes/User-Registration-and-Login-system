<?php 
session_start();
require_once '../../middleware/AuthMiddleware.php';
require_once '../models/UserModel.php';


// check if user is authenticated
AuthMiddleware::requireAuth();

// destroy the session
session_destroy();

// redirect to the login page
header('Location: login.php');
exit();
