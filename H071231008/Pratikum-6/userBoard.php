<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;   
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php echo $user['name']; ?></h1>
        <h2>Email: <?php echo $user['email']; ?></h2>
        <h2>Username: <?php echo $user['username']; ?></h2>
        <h3>Gender: <?php echo $user['gender']; ?></h3>
        <h3>Faculty: <?php echo $user['faculty']; ?></h3>
        <h3>Batch: <?php echo $user['batch']; ?></h3>
        <button class= "button-dashboard"><a href="logout.php">Log Out</a></button>
    </div>
</body>
</html>