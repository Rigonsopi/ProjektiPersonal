<?php include 'config.php';
if($_SERVER['REQUEST_METHOD']==='POST') {
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username,password_hash,is_admin) VALUES (?,?,0)");
    $stmt->execute([$_POST['username'], $hash]);
    header("Location: signin.php");
}
