<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
 
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-4">
    <h1 class="text-white mb-4">Netflix Clone</h1>

    <div id="movieSlider" class="row g-3">
        <?php
        $stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC LIMIT 10");
        foreach ($stmt as $movie): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card bg-dark text-white h-100">
                    <img src="<?= htmlspecialchars($movie['thumbnail']) ?>" class="card-img-top" alt="<?= htmlspecialchars($movie['title']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
                        <p class="card-text"><?= substr($movie['description'], 0, 100) ?>...</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>
