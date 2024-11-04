<?php
session_start();

// Check if the user is logged in
// if (!isset($_SESSION['mahasiswa'])) {
//     echo "User belum login. Redirecting ke halaman login.";
//     header('Location: login.php');
//     exit;
// }

include 'conn.php';

// Check database connection
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
} else {
    echo "Koneksi ke database berhasil.";
}

// Determine active page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Safe search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE nama LIKE ? OR nim LIKE ? OR prodi LIKE ?");
    $searchWildcard = "%" . $search . "%";
    $stmt->bind_param("sss", $searchWildcard, $searchWildcard, $searchWildcard);
} else {
    $stmt = $conn->prepare("SELECT * FROM mahasiswa");
}

// $query = 'SELECT * FROM users WHERE role = ? ';
// $stmt = $conn->prepare($query);
//     $stmt->bind_param("s", $_SESSION[use]);
//     $stmt->execute();
//     $result = $stmt->get_result();
    
// // Retrieve current user session
// $currentUser = $_SESSION['mahasiswa'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Akademik | SI Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8f9fa;
    }

    .glassmorphism {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-hover {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <!-- Side Navigation -->
    <div class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-red-800 to-[#000080] text-white p-6">
        <div class="mb-10">
            <h1 class="text-2xl font-bold">Sistem Akademik</h1>
            <p class="text-red-200 text-sm">Manajemen Mahasiswa</p>
        </div>

        <nav class="space-y-4">
            <a href="?page=dashboard"
                class="flex items-center space-x-3 p-3 rounded-lg <?= $page === 'dashboard' ? 'bg-red-700' : 'hover:bg-red-700' ?>">
                <span data-feather="grid"></span>
                <span>Beranda</span>
            </a>
            <a href="?page=students"
                class="flex items-center space-x-3 p-3 rounded-lg <?= $page === 'students' ? 'bg-red-700' : 'hover:bg-red-700' ?>">
                <span data-feather="users"></span>
                <span>Mahasiswa</span>
            </a>
        </nav>

        <div class="absolute bottom-0 left-0 w-full p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center">
                    <span data-feather="user"></span>
                </div>
                <div>
                    <p class="font-medium"></p>
                    <p class="text-sm text-red-200">
                    </p>
                </div>
            </div>
            <a href="logout.php" class="flex items-center space-x-2 text-red-200 hover:text-white">
                <span data-feather="log-out"></span>
                <span>Keluar</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <?php
        // Include file according to $page value
        $pageFile = "pages/{$page}.php";
        if (file_exists($pageFile)) {
            include $pageFile;
        } else {
            echo "<h2>Halaman tidak ditemukan!</h2>";
        }
        ?>
    </div>
    <script>
    feather.replace();
    </script>
</body>

</html>