<?php
include_once("config.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $year = trim($_POST['year']);
    $description = trim($_POST['description']);
    $thumbnail = trim($_POST['thumbnail']);

    if (empty($title) || empty($genre) || empty($year) || empty($description)) {
        header("Location: edit.php?id=$id&error=empty_fields");
        exit();
    }

    $sql = "UPDATE movies 
            SET title=:title, genre=:genre, year=:year, description=:description, thumbnail=:thumbnail 
            WHERE id=:id";

    $prep = $pdo->prepare($sql);
    $prep->bindParam(':id', $id);
    $prep->bindParam(':title', $title);
    $prep->bindParam(':genre', $genre);
    $prep->bindParam(':year', $year);
    $prep->bindParam(':description', $description);
    $prep->bindParam(':thumbnail', $thumbnail);

    $prep->execute();

    header("Location: dashboard.php?success=movie_updated");
    exit();
}

if (!isset($_GET['id'])) {
    die("Movie ID missing");
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id=?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    die("Movie not found");
}
?>

<?php include 'header.php'; ?>

<h2>Edit Movie</h2>

<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?= $movie['id'] ?>">
    
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>"><br>

    <label>Genre:</label>
    <input type="text" name="genre" value="<?= htmlspecialchars($movie['genre']) ?>"><br>

    <label>Year:</label>
    <input type="number" name="year" value="<?= htmlspecialchars($movie['year']) ?>"><br>

    <label>Description:</label>
    <textarea name="description"><?= htmlspecialchars($movie['description']) ?></textarea><br>

    <label>Thumbnail URL:</label>
    <input type="text" name="thumbnail" value="<?= htmlspecialchars($movie['thumbnail']) ?>"><br>

    <button type="submit" name="update">Update</button>
</form>

<?php include 'footer.php'; ?>
