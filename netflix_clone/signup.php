<?php include 'config.php'; include 'header.php'; ?>

<h2>Register</h2>
<form method="post" action="signup.php">
  <label>Username: <input type="text" name="username" required></label><br>
  <label>Password: <input type="password" name="password" required></label><br>
  <button type="submit">Register</button>
</form>

<?php include 'footer.php'; ?>
