<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];

$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ],

    [
        'email' => 'tia@gmail.com',
        'username' => 'tiacantik',
        'name' => 'Tia',
        'password' => password_hash('tia123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Kedokteran',
        'batch' => '2024',
    ],

];

$isAdmin = ($user['username'] === 'adminxxx');

if (!$isAdmin) {
    $users = array_filter($users, function($u) use ($user) {
        return $u['username'] === $user['username'];
    });
}
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
    <!-- <div class="overlay"></div> -->
    <div class="dashboard-container">
        <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
        <?php if ($user['username'] != "adminxxx"):?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Faculty</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= isset($user['gender']) ? htmlspecialchars($user['gender']) : 'N/A' ?></td>
                        <td><?= isset($user['faculty']) ? htmlspecialchars($user['faculty']) : 'N/A' ?></td>
                        <td><?= isset($user['batch']) ? htmlspecialchars($user['batch']) : 'N/A' ?></td>
                    </tr>
                </tbody>
            </table>

        <?php else:?>
            <h4 style="color: white;">Email: <?= htmlspecialchars( $user['email'])?>></h4>
            <h4 style="color: white;">username: <?= htmlspecialchars($user['username'])?>></h4>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Faculty</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <?php if($u['username'] != "adminxxx"):?>
                            <tr>
                                <td><?= htmlspecialchars($u['name']) ?></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td><?= htmlspecialchars($u['username']) ?></td>
                                <td><?= isset($u['gender']) ? htmlspecialchars($u['gender']) : 'N/A' ?></td>
                                <td><?= isset($u['faculty']) ? htmlspecialchars($u['faculty']) : 'N/A' ?></td>
                                <td><?= isset($u['batch']) ? htmlspecialchars($u['batch']) : 'N/A' ?></td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif?>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
