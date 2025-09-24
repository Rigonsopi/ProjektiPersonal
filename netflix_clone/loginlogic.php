<?php
session_start();
require 'config.php';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Please fill in all fields!";
        header("refresh:2; url=signin.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();

        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password!";
            header("refresh:2; url=signin.php");
            exit();
        }
    } else {
        echo "User not found!";
        header("refresh:2; url=signin.php");
        exit();
    }
}
?>
