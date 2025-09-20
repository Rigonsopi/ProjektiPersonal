<?php include 'config.php'; include 'header.php'; ?>

<h1>Netflix Clone</h1>

<div class="slider" id="movieSlider">
<?php
$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC LIMIT 10");
foreach ($stmt as $movie): ?>
  <div class="slide">
    <img src="<?= htmlspecialchars($movie['thumbnail']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
    <h3><?= htmlspecialchars($movie['title']) ?></h3>
    <p><?= substr($movie['description'], 0, 100) ?>...</p>
  </div>
<?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
