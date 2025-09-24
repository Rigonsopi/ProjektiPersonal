<?php
session_start();
include_once('config.php');

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $tempPass = trim($_POST['password']);

    // Validate inputs
    if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($tempPass)) {
        echo "All fields are required!";
        header("refresh:2; url=register.php");
        exit();
    }

    // Check if username exists
    $checkSql = "SELECT username FROM users WHERE username = :username";
    $stmt = $pdo->prepare($checkSql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Username already exists!";
        header("refresh:2; url=register.php");
        exit();
    }

    // Hash password
    $password = password_hash($tempPass, PASSWORD_DEFAULT);

    // Insert new user
    $insertSql = "INSERT INTO users (name, surname, username, email, password_hash) 
                  VALUES (:name, :surname, :username, :email, :password)";
    $insertStmt = $pdo->prepare($insertSql);
    $insertStmt->bindParam(':name', $name);
    $insertStmt->bindParam(':surname', $surname);
    $insertStmt->bindParam(':username', $username);
    $insertStmt->bindParam(':email', $email);
    $insertStmt->bindParam(':password', $password);

    if ($insertStmt->execute()) {
        echo "Registration successful! Redirecting to login...";
        header("refresh:2; url=signin.php");
        exit();
    } else {
        echo "Failed to register. Try again!";
        header("refresh:2; url=register.php");
        exit();
    }
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="text-white mb-4">Register</h2>
    <form method="post" action="register.php" class="text-white">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Surname</label>
            <input type="text" name="surname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-danger">Register</button>
    </form>
</div>

<?php include 'footer.php'; ?>
