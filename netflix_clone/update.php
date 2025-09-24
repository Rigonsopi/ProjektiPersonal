<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (empty($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

// Check if POST data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $year = (int)$_POST['year'];
    $description = trim($_POST['description']);
    $thumbnail = trim($_POST['thumbnail']);

    // Validate required fields
    if (empty($title) || empty($genre) || empty($year) || empty($description) || empty($thumbnail)) {
        echo "<div class='alert alert-danger text-center'>All fields are required!</div>";
        header("refresh:2; url=dashboard.php");
        exit();
    }

    // Update movie in database
    $sql = "UPDATE movies SET title=:title, genre=:genre, year=:year, description=:description, thumbnail=:thumbnail WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':thumbnail', $thumbnail);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}

// Fetch movie to prefill form
if (!isset($_GET['id'])) {
    die("Movie ID not provided.");
}

$id = (int)$_GET['id'];
$sql = "SELECT * FROM movies WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$movie = $stmt->fetch();

if (!$movie) {
    die("Movie not found.");
}

?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="text-white mb-4">Edit Movie</h2>
    <form method="POST" action="update.php" class="text-white">
        <input type="hidden" name="id" value="<?= $movie['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($movie['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" value="<?= htmlspecialchars($movie['genre']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="<?= $movie['year'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($movie['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Thumbnail URL</label>
            <input type="text" name="thumbnail" class="form-control" value="<?= htmlspecialchars($movie['thumbnail']) ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-danger">Update Movie</button>
    </form>
</div>

<?php include 'footer.php'; ?>
