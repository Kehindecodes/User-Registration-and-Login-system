<?php

// Define the routes and their corresponding views
$routes = [
    '/' => 'login.php',
    '/login' => 'login.php',
    '/register' => 'register.php',
    '/profile' => 'profile.php',
    '/editProfile' => 'editProfile.php',
    '/logout' => 'logout.php',
];

// Get the requested URL
$requestUri = $_SERVER['REQUEST_URI'];
$baseUri = '/php%20projects/authentication-system'; // Base URL of your project

// Remove the base URI from the request to get the route
$route = substr($requestUri, strlen($baseUri));

// If the route is not in the defined routes,redirect to the 404 page
if (!array_key_exists($route, $routes)) {
    include __DIR__ . '/app/views/404page.php';
}

// Include the corresponding view
$view = $routes[$route];
include __DIR__ . '/app/views/' . $view;


// // handle other routes or show a 404 page

// include __DIR__ . '/app/views/404page.php';
