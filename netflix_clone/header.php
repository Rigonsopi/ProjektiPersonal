<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Netflix Clone</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <nav>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user'])): ?>
      <?php if ($_SESSION['user']['is_admin'] == 1): ?>
        <a href="dashboard.php">Dashboard</a>
      <?php endif; ?>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="signin.php">Login</a>
      <a href="register.php">Register</a>
    <?php endif; ?>
  </nav>
</header>
<main>
