<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($password)) {
        echo "<div class='alert alert-danger text-center'>All fields are required!</div>";
        header("refresh:2; url=signup.php");
        exit();
    }

    // Check if username already exists
    $checkSql = "SELECT username FROM users WHERE username = :username";
    $stmt = $pdo->prepare($checkSql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<div class='alert alert-warning text-center'>Username already exists!</div>";
        header("refresh:2; url=signup.php");
        exit();
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $insertSql = "INSERT INTO users (name, surname, username, email, password_hash, is_admin) 
                  VALUES (:name, :surname, :username, :email, :password, 0)";
    $insertStmt = $pdo->prepare($insertSql);
    $insertStmt->bindParam(':name', $name);
    $insertStmt->bindParam(':surname', $surname);
    $insertStmt->bindParam(':username', $username);
    $insertStmt->bindParam(':email', $email);
    $insertStmt->bindParam(':password', $passwordHash);

    if ($insertStmt->execute()) {
        echo "<div class='alert alert-success text-center'>Registration successful! Redirecting to login...</div>";
        header("refresh:2; url=signin.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Failed to register. Try again!</div>";
        header("refresh:2; url=signup.php");
        exit();
    }
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="text-white mb-4">Sign Up</h2>
    <form action="signup.php" method="post" class="text-white">
        <div class="mb-3">
            <label for="firstName" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="firstName" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">Surname</label>
            <input type="text" class="form-control" name="surname" id="lastName" placeholder="Enter your surname" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Choose a username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn btn-danger" name="submit">Sign Up</button>
    </form>

    <p class="mt-3">Already have an account? <a href="signin.php">Log in here</a></p>
</div>

<?php include 'footer.php'; ?>
