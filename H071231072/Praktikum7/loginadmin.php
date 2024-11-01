<?php
session_start();
include 'conn.php'; // Pastikan koneksi database terhubung

// Tampilkan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['loginAdmin'];
    $password = $_POST['passwordAdmin'];
    $role = $_POST['role'];
    
 
    // Query untuk mengambil data pengguna berdasarkan 
    $query = "SELECT * FROM users WHERE username = ?  AND password = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $_SESSION['username'] = $login;
    $_SESSION['role'] = $role;
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        header('location:  index.php');

    } else {
        $error = "Nim atau Password salah!";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center"
    style="background-image: url('aset/bguniv.png'); background-size: cover; background-position: center;">
    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Masuk ke Akun Anda</h2>

        <?php if (isset($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <p><?= $error ?></p>
        </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <input type="text" name="loginAdmin" placeholder="username"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>
            <div>
                <input type="password" name="passwordAdmin" placeholder="Password"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>
            <div>
                <input type="text" name="role" placeholder="ketik admin"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>

            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-red-500 to-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300">Masuk</button>
            <button type="button"
                class="w-full py-3 bg-gradient-to-r from-red-500 to-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300"
                onclick='window.location.href ="login.php"'>
                login mahasiswa
            </button>
        </form>
    </div>
</body>

</html>