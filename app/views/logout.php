<?php
session_start();
require_once __DIR__ . '/../../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../models/UserModel.php';


// check if user is authenticated
AuthMiddleware::requireAuth();

// destroy the session
session_destroy();

// redirect to the login page
header('Location: /php%20projects/authentication-system/');
exit();
