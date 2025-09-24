<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="text-white mb-4">Login</h2>
    <form action="loginlogic.php" method="post" class="text-white">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn btn-danger" name="submit">Login</button>

        <p class="mt-3">Don't have an account? <a href="register.php">Sign up here</a></p>
    </form>
</div>

<?php include 'footer.php'; ?>

