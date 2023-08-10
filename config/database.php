<?php
$host = 'localhost';
$port = 3306;
$user = 'root';
$password = '';
$dbname = 'users';

// connect to the database 
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully" . "<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
