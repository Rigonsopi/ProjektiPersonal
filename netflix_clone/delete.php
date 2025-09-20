<?php include 'config.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM movies WHERE id=?");
    $stmt->execute([$_GET['id']]);
}

header("Location: dashboard.php");
exit();
?>