<?php include 'config.php'; include 'header.php'; ?>

<?php
require 'config.php'; 

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #fff;
        }

        .navbar {
            background: #000;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e50914;
        }

        .navbar .welcome-text {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .navbar .logout-btn {
            background: #e50914;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .navbar .logout-btn:hover {
            background: #b00610;
        }

        .container {
            display: flex;
            justify-content: center;
            margin: 30px;
        }

        .users-table {
            width: 90%;
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
        }

        .users-table h3 {
            margin-bottom: 15px;
            font-size: 1.5rem;
            color: #e50914;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 0.95rem;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #222;
            color: #e5e5e5;
            font-weight: bold;
        }

        tr:nth-child(even) td {
            background-color: #2a2a2a;
        }

        tr:nth-child(odd) td {
            background-color: #1c1c1c;
        }

        td a {
            color: #e50914;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        td a:hover {
            color: #ff4747;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .users-table {
                width: 100%;
            }

            table, th, td {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="welcome-text">Welcome, <?php echo $_SESSION['username']; ?></div>
    <a class="logout-btn" href="logout.php">Logout</a>
</div>

<div class="container">
    <div class="users-table">
        <h3>All Users</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['surname']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $user['id']; ?>">Edit</a> |
                        <a href="delete.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>


<?php include 'footer.php'; ?>
