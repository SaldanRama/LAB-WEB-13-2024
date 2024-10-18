<?php
session_start();

// Data pengguna
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
];

function is_existing_user($email, $username) {
    global $users;
    foreach ($users as $user) {
        if ($user['email'] === $email || $user['username'] === $username) {
            return true;
        }
    }
    return false;
}

function register_user($name, $username, $email, $password, $gender, $faculty, $batch) {
    global $users;
    $new_user = [
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'gender' => $gender,
        'faculty' => $faculty,
        'batch' => $batch
    ];
    $users[] = $new_user;
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $faculty = $_POST['faculty'];
    $batch = $_POST['batch'];

    if (is_existing_user($email, $username)) {
        $error = "Email atau Username sudah digunakan!";
    } else {
        register_user($name, $username, $email, $password, $gender, $faculty, $batch);
        $_SESSION['user'] = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'gender' => $gender,
            'faculty' => $faculty,
            'batch' => $batch
        ];
        header('Location: dashboard.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class= "sparkles"></div>
    <div class="container">
        <h1>Register</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <input type="text" name="faculty" placeholder="Faculty" required><br>
            <input type="text" name="batch" placeholder="Batch Year" required><br>
            <input type="submit" name="register" value="Register">
        </form>
        <p style="text-align: center; margin-top: 10px;">
            <a href="login.php">Already have an account?</a>
        </p>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>