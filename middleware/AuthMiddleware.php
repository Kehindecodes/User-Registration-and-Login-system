<?php

class AuthMiddleware
{
    /**
     * Requires authentication for access.
     *
     * @throws Exception Redirects to the login page if user is not authenticated.
     * @return void
     */
    public static function requireAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            // if not logged in redirect to login page
            header('Location: /login');
            exit;
        }
    }
}
