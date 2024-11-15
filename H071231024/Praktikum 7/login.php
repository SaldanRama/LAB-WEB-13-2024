<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        header("Location: index.php");
    } else {
        $error = "Username atau password salah!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-center justify-center min-h-screen bg-blue-400 p-4">
    <h1 class="text-gray-800 text-[3rem] md:text-[5rem] font-bold">MANAJEMEN DATA<br><span class="text-blue-700">MAHASISWA</span>
    </h1>
    <div class="w-full max-w-md md:max-w-lg">
        <form method="POST" class="bg-transparent shadow-md border-black border rounded-xl px-4 md:px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-black text-lg font-bold mb-2" for="username">Username</label>
                <input class="bg-transparent shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none border-b-2 border-black w-full py-2 px-3 text-black text-lg focus:outline-none focus:border-b-2" id="username" name="username" type="text" required>
            </div>
            <div class="mb-6">
                <label class="block text-black text-lg font-bold mb-2" for="password">Password</label>
                <input class="bg-transparent shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none border-b-2 border-black w-full py-2 px-3 text-black text-lg focus:outline-none focus:border-b-2" id="password" name="password" type="password" required>
            </div>
            <?php if (isset($error)) { echo "<p class='mb-4 p-2 bg-red-800 bg-opacity-75 border border-red-400 text-red-100 rounded'>$error</p>"; } ?>
            <div class="flex flex-col gap-5 items-center justify-between">
                <button class="bg-blue-700 border border-blue-700 w-full hover:bg-blue-900 hover:border-blue-500 text-white font-bold py-2 px-4 rounded" type="submit" name="login">Login</button>
                <a class="w-full text-center bg-green-700 border border-green-700 hover:bg-green-900 hover:border-green-500 text-white font-bold py-2 px-4 rounded" href="register.php">Register</a>
                <a class="w-full text-center bg-yellow-700 border border-yellow-700 hover:bg-yellow-900 hover:border-yellow-500 text-white font-bold py-2 px-4 rounded" href="password.php">Ganti password</a>
            </div>
        </form>
    </div>
</body>
</html>
