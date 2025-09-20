<?php include 'config.php'; include 'header.php'; ?>

<?php
if(!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    die("Access denied!");
}

if(isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    $thumbnail = $_POST['thumbnail'];

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
?>

<h2>Dashboard</h2>

<form method="post" action="dashboard.php">
  <h3>Add Movie</h3>
  <label>Title: <input type="text" name="title" required></label><br>
  <label>Genre: <input type="text" name="genre" required></label><br>
  <label>Year: <input type="number" name="year" required></label><br>
  <label>Description: <textarea name="description"></textarea></label><br>
  <label>Thumbnail URL: <input type="text" name="thumbnail"></label><br>
  <button type="submit" name="add_movie">Add Movie</button>
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:The Irishman</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Crime, Drama</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2019</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:Martin Scorsese's epic crime drama follows the life of Frank Sheeran, a hitman involved in organized crime over several decades. It explores loyalty, betrayal, and the toll of a life in crime.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/the-irishman.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:Roma</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Drama</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2018</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:A deeply personal film by Alfonso Cuarón, "Roma" follows the life of a domestic worker in 1970s Mexico City, beautifully capturing both personal and political struggles.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/roma.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:The Trial of the Chicago 7</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Drama, History</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2020</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:A powerful courtroom drama detailing the trial of seven anti-Vietnam War activists accused of inciting riots during the 1968 Democratic National Convention.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/the-trial-of-the-chicago-7.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:Parasite</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Thriller, Drama, Comedy</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2019</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:This South Korean black comedy thriller explores class disparity as a poor family infiltrates the lives of a wealthy household, leading to dark and unexpected consequences.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/parasite.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:The White Tiger</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Drama, Thriller</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2021</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:A gripping story about a poor Indian man who rises through the social ranks, using wit and cunning to break free from the system of exploitation.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/the-white-tiger.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:Marriage Story</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Drama</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2019</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:A heartbreaking and honest portrayal of a couple going through a painful divorce, highlighting the emotional and legal battles they face.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/marriage-story.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:The Old Guard</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Action, Fantasy</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2020</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:A group of immortal mercenaries must fight to protect their secret and survive in a world that seeks to exploit their abilities.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/the-old-guard.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:Spider-Man: Into the Spider-Verse</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Animation, Action, Adventure</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2018</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:This animated superhero film follows Miles Morales, a teenager who joins other Spider-People from alternate universes to stop a dangerous threat to the multiverse.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/spider-man-into-the-spider-verse.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>


<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:Bird Box</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Thriller, Horror, Drama</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2018</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:In a post-apocalyptic world, survivors must avoid seeing mysterious creatures that drive people to suicide, with the main character, Malorie, trying to protect her children.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/bird-box.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
</form>

                                                                                                
<h2>Add New Movies</h2>
<form action="dashboard.php" method="post">
  <label>Title:The Social Dilemma</label><br>
  <input type="text" name="title" required><br><br>

  <label>Genre:Documentary, Drama</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Year:2020</label><br>
  <input type="number" name="year" required><br><br>

  <label>Description:A documentary exploring the dangerous human impact of social networking, featuring insights from former tech insiders on how social media manipulates society.</label><br>
  <textarea name="description"></textarea><br><br>

  <label>Thumbnail:</label><br>
  <input type="text" name="thumbnail" placeholder="https://image.url/the-social-dilemma.jpg"><br><br>

  <input type="submit" name="add movie" value="Add Movie">
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
