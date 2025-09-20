<?php include 'config.php'; include 'header.php'; ?>

<?php
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

<h2>Edit Movie</h2>
<form action="update.php" method="post">
  <input type="hidden" name="id" value="<?= $movie['id'] ?>">
  <label>Title: <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>"></label><br>
  <label>Genre: <input type="text" name="genre" value="<?= htmlspecialchars($movie['genre']) ?>"></label><br>
  <label>Year: <input type="number" name="year" value="<?= $movie['year'] ?>"></label><br>
  <label>Description: <textarea name="description"><?= htmlspecialchars($movie['description']) ?></textarea></label><br>
  <label>Thumbnail URL: <input type="text" name="thumbnail" value="<?= htmlspecialchars($movie['thumbnail']) ?>"></label><br>
  <button type="submit">Update</button>
</form>

<?php include 'footer.php'; ?>
