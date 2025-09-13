<?php include 'config.php';
if($_SERVER['REQUEST_METHOD']==='POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if($user && password_verify($_POST['password'], $user['password_hash'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
    } else {
        echo "Invalid login. <a href='signin.php'>Try again</a>";
    }
}
