<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.html');
    exit;
}
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
   ]
];
?>

<body>
    <div class="dashboard-container">
        <h1>Welcome, Admin</h1>
        <h2>Email: <?php echo $_SESSION['user']['email']; ?></h2>
        <h2>Username: <?php echo $_SESSION['user']['username']; ?></h2>
        <button class= "button-dashboard"><a href="logout.php">Log out</a></button>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Faculty</th>
                <th>Batch</th>
            </tr>

            <?php
            foreach ($users as $user) {
                if (isset($user['gender']) && isset($user['faculty']) && isset($user['batch'])) {
                    echo "<tr>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['username'] . "</td>";
                    echo "<td>" . $user['gender'] . "</td>";
                    echo "<td>" . $user['faculty'] . "</td>";
                    echo "<td>" . $user['batch'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

</body>

</html>
