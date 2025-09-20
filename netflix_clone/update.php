<?php include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE movies SET title=?, genre=?, year=?, description=?, thumbnail=? WHERE id=?");
    $stmt->execute([
        $_POST['title'],
        $_POST['genre'],
        $_POST['year'],
        $_POST['description'],
        $_POST['thumbnail'],
        $_POST['id']
    ]);

    header("Location: dashboard.php");
    exit();
}
?>