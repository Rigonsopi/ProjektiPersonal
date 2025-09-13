<?php include 'config.php'; include 'header.php'; ?>
<?php
require 'config.php'; // lidhja me databazën

if(isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    $thumbnail = $_POST['thumbnail'];

    // PDO prepare statement për siguri
    $stmt = $pdo->prepare("INSERT INTO movies (title, genre, year, description, thumbnail) VALUES (:title, :genre, :year, :description, :thumbnail)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':thumbnail', $thumbnail);

    if($stmt->execute()) {
        echo "<p style='color:green'>Movie added successfully!</p>";
    } else {
        echo "<p style='color:red'>Error adding movie!</p>";
    }
}
if(!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    die("Access denied!");
}
?>

<h2>Dashboard</h2>

<form method="post" action="signup.php">
  <h3>Add Movie</h3>
  <label>Title: <input type="text" name="title" required></label><br>
  <label>Genre: <input type="text" name="genre" required></label><br>
  <label>Year: <input type="number" name="year" required></label><br>
  <label>Description: <textarea name="description"></textarea></label><br>
  <label>Thumbnail URL: <input type="text" name="thumbnail"></label><br>
  <button type="submit" name="addMovie">Add Movie</button>
</form>

<hr>

<h3>Movie List</h3>
<table border="1">
<tr><th>ID</th><th>Title</th><th>Genre</th><th>Year</th><th>Actions</th></tr>
<?php
$stmt = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
foreach ($stmt as $row): ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= htmlspecialchars($row['title']) ?></td>
  <td><?= htmlspecialchars($row['genre']) ?></td>
  <td><?= $row['year'] ?></td>
  <td>
    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this movie?')">Delete</a>
  </td>
</tr>
<?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
