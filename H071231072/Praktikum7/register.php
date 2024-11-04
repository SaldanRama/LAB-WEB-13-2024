<?php
include 'conn.php'; // File konfigurasi koneksi database
session_start();

// Cek apakah formulir sudah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $password = ($_POST['password']); // Hash password untuk keamanan

    // Cek apakah NIM sudah ada di database
    $checkQuery = "SELECT nim FROM mahasiswa WHERE nim = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $nim);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Jika NIM sudah ada, tampilkan pesan error
        $error = "NIM sudah terdaftar. Silakan gunakan NIM lain.";
    } else {
        // Query untuk memasukkan data ke database
        $query = "INSERT INTO mahasiswa (nama, nim, prodi, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $name, $nim, $prodi, $password);

        if ($stmt->execute()) {
            // Jika berhasil, arahkan ke halaman login
            header('Location: login.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center"
    style="background-image: url('aset/bguniv.png'); background-size: cover; background-position: center;">
    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Buat Akun Baru</h2>

        <?php if (isset($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <p><?= $error ?></p>
        </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <input type="text" name="nama" placeholder="Nama Lengkap"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>
            <div>
                <input type="text" name="nim" placeholder="NIM"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>
            <div>
                <input type="text" name="prodi" placeholder="Program Studi"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>

            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-red-500 to-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300">Daftar</button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-gray-600">Sudah punya akun?
                <a href="login.php" class="text-blue-500 hover:text-blue-700 font-semibold">Masuk</a>
            </p>
        </div>
    </div>
</body>

</html>