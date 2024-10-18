<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
if ($_SESSION['user']['name'] === 'Admin') {
    $users = $_SESSION['users'];
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class= "sparkles"></div>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['user']['name']; ?>!</h1>
        <p>Email: <?php echo $_SESSION['user']['email']; ?></p>
        <p>Username: <?php echo $_SESSION['user']['username']; ?></p>
        <?php if ($_SESSION['user']['name'] != 'Admin'): ?>
            <p>Gender: <?php echo $_SESSION['user']['gender']; ?></p>
            <p>Faculty: <?php echo $_SESSION['user']['faculty']; ?></p>
            <p>Batch: <?php echo $_SESSION['user']['batch']; ?></p>
        <?php else: ?>
            <h2>All Users</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Faculty</th>
                    <th>Batch</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <?php if ($user['name'] != 'Admin'): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                            <td><?php echo $user['faculty']; ?></td>
                            <td><?php echo $user['batch']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <br>
        <a href="?logout" class="logout">Logout</a>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>