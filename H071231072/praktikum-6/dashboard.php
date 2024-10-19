<?php
require_once 'config.php';

        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit();
        }

        $user = $_SESSION['user'];
        $is_admin = is_admin($user);
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Dashboard <?php echo $is_admin ? 'admin' : 'user'; ?></h1>
        <h1>Welcome, <?php echo $user['name']; ?>!</h1>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Username: <?php echo $user['username']; ?></p>
        <?php if (!$is_admin): ?>
        <p>Gender: <?php echo $user['gender']; ?></p>
        <p>Faculty: <?php echo $user['faculty']; ?></p>
        <p>Batch: <?php echo $user['batch']; ?></p>
        <?php endif; ?>

        <?php if ($is_admin): ?>
        <h3>All Users</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Faculty</th>
                <th>Batch</th>
            </tr>
            <?php foreach ($users as $u): ?>
            <?php if ($u['email'] !== 'admin@gmail.com'): ?>
            <tr>
                <td><?php echo $u['name']; ?></td>
                <td><?php echo $u['email']; ?></td>
                <td><?php echo $u['username']; ?></td>
                <td><?php echo $u['gender']; ?></td>
                <td><?php echo $u['faculty']; ?></td>
                <td><?php echo $u['batch']; ?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>

</html>