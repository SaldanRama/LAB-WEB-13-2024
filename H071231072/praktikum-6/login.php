<?php
require_once 'config.php';

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    
    $user = authenticate($email_or_username, $password);
    
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Invalid email/username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="login-image">
                <img src="Aset/loginbg.png" alt="Login Icon">
            </div>

            <h1 id="login-title">LOGIN</h1>
            <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="emailpass">
                <form method="post">
                    <label for="email_or_username">Email or Username</label>
                    <input type="text" id="email_or_username" name="email_or_username" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Submit</button>
                </form>
                <p>Don't have an account? <a href="#">Register here</a></p>
            </div>
        </div>
    </div>
</body>

</html>