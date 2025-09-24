<?php
session_start();
include 'config.php';

// Ensure user is logged in
if(empty($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

// Handle form submission
if(isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $year = (int)$_POST['year'];
    $description = trim($_POST['description']);

    // Handle file upload
    if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
        $uploadDir = 'uploads/'; // Make sure this folder exists
        $fileName = time() . '_' . basename($_FILES['thumbnail']['name']);
        $targetFile = $uploadDir . $fileName;

        // Optional: check file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if(!in_array($_FILES['thumbnail']['type'], $allowedTypes)) {
            die("Only JPG, PNG, GIF images are allowed.");
        }

        if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $targetFile)) {
            $thumbnail = $targetFile;
        } else {
            die("Failed to upload image.");
        }
    } else {
        die("No image uploaded.");
    }

    // Save movie in database
    $stmt = $pdo->prepare("INSERT INTO movies (title, genre, year, description, thumbnail) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $genre, $year, $description, $thumbnail]);

    header("Location: dashboard.php");
    exit();
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="text-white mb-4">Add New Movie</h2>
    <form action="addmovie.php" method="post" enctype="multipart/form-data" class="text-white">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Movie Poster</label>
            <input type="file" name="thumbnail" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-danger">Add Movie</button>
    </form>
</div>

<?php include 'footer.php'; ?>
