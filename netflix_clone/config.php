<?php
$host = "localhost";
$dbname = "netflix_clone";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
