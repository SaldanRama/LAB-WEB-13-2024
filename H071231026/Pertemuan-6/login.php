<?php
session_start();

// Data pengguna admin
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
        'batch' => '2002',
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
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_email_or_username = $_POST['email_or_username'];
    $input_password = $_POST['password'];

    foreach ($users as $user) {
        if (($user['email'] === $input_email_or_username || $user['username'] === $input_email_or_username) 
        && password_verify($input_password, $user['password'])) {
            $_SESSION['user'] = $user;
            if ($_SESSION['user']['name'] === 'Admin') {
                $_SESSION['users'] = $users;
            }
            header('Location: dashboard.php');
            exit();
        }
    }
    $error = 'Invalid login credentials';
}

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- Tampilan setelah login -->
    <div class= "sparkles"></div>
    <div class="container">
        <?php if (!isset($_SESSION['user'])): ?>
            <h1>LOGIN</h1>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="post">
                <input type="text" name="email_or_username" placeholder="Email or Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="submit" name="login" value="Submit">
            </form>
            <p style="text-align: left; margin-top: 10px;">
                Don't have an account? 
            <a href="register.php" style="color: pink; text-decoration: underline;">
                Register here.
            </a>
            </p>

        <?php else: ?>
            <h2>Welcome, <?php echo $_SESSION['user']['name']; ?>!</h2>
            <p>Email: <?php echo $_SESSION['user']['email']; ?></p>
            <p>Username: <?php echo $_SESSION['user']['username']; ?></p>
            <?php if ($_SESSION['user']['name'] != 'Admin'): ?>
                <p>Gender: <?php echo $_SESSION['user']['gender']; ?></p>
                <p>Faculty: <?php echo $_SESSION['user']['faculty']; ?></p>
                <p>Batch: <?php echo $_SESSION['user']['batch']; ?></p>
            <?php else: ?>
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
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>