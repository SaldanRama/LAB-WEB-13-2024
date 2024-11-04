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


        <!-- Header with Search -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Dashboard Mahasiswa</h2>
                <p class="text-gray-500">Data Mahasiswa</p>
            </div>
            <form class="flex items-center space-x-2" action="?page=dashboard" method="GET">
                <input type="hidden" name="page" value="dashboard">
                <div class="relative">
                    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                        class="w-96 pl-10 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-0"
                        placeholder="Cari berdasarkan nama, NIM, atau program...">
                    <span data-feather="search" class="absolute left-3 top-3.5 text-gray-400"></span>
                </div>
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700">
                    Cari
                </button>
            </form>
        </div>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">NIM</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Program Studi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <!-- <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                $searchQuery = $search ? "WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' OR prodi LIKE '%$search%'" : '';
                $query = "SELECT * FROM mahasiswa $searchQuery ORDER BY nama ASC";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()):
                ?>
                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                    <span class="text-red-600 font-medium">
                                        <?= strtoupper(substr($row['nama'], 0, 1)) ?>
                                    </span>
                                </div>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($row['nama']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600"><?= htmlspecialchars($row['nim']) ?></td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-600">
                                <?= htmlspecialchars($row['prodi']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-600">
                                Aktif
                            </span>
                        </td>


                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    feather.replace();
    </script>
</body>

</html>