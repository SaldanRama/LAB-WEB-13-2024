<?php
// Check if $conn is initialized and connected
if (!isset($conn)) {
    die("Koneksi tidak tersedia.");
}

// Check if search term is set in GET request
$search = $_GET['search'] ?? '';
?>

<!-- Header with Search -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Dashboard Akademik</h2>
        <p class="text-gray-500">Kelola dan pantau data mahasiswa dengan efisien</p>
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

<!-- Statistics Cards -->
<div class="grid grid-cols-3 gap-6 mb-8">
    <?php
    // Retrieve total students and programs, with error handling
    $totalStudentsQuery = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
    $totalStudents = $totalStudentsQuery ? $totalStudentsQuery->fetch_assoc()['total'] : 0;

    $totalProgramsQuery = $conn->query("SELECT COUNT(DISTINCT prodi) as total FROM mahasiswa");
    $totalPrograms = $totalProgramsQuery ? $totalProgramsQuery->fetch_assoc()['total'] : 0;
    ?>
    <div class="glassmorphism rounded-2xl p-6 card-hover">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Mahasiswa</h3>
            <span data-feather="users" class="text-red-500"></span>
        </div>
        <p class="text-3xl font-bold text-red-600"><?= $totalStudents ?></p>
        <p class="text-sm text-gray-500 mt-2">Mahasiswa aktif dalam database</p>
    </div>
    <div class="glassmorphism rounded-2xl p-6 card-hover">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Program Studi</h3>
            <span data-feather="book" class="text-red-500"></span>
        </div>
        <p class="text-3xl font-bold text-red-600"><?= $totalPrograms ?></p>
        <p class="text-sm text-gray-500 mt-2">Program studi yang tersedia</p>
    </div>
</div>

<!-- Quick Add Student for admin -->

<div class="mb-8">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Tambah Mahasiswa</h3>
    <form action="proses_tambah.php" method="POST" class="space-y-4">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-600 mb-2">Nama</label>
                <input type="text" name="nama" required
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-red-500 focus:ring-0"
                    placeholder="Nama Lengkap">
            </div>
            <div>
                <label class="block text-gray-600 mb-2">NIM</label>
                <input type="text" name="nim" required
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-red-500 focus:ring-0"
                    placeholder="Nomor Induk Mahasiswa">
            </div>
            <div>
                <label class="block text-gray-600 mb-2">Program Studi</label>
                <input type="text" name="prodi" required
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-red-500 focus:ring-0"
                    placeholder="Program Studi">
            </div>
        </div>
        <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">
            Tambah Mahasiswa
        </button>
    </form>
</div>


<!-- Student List -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">NIM</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Program Studi</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>

            </tr>
        </thead>
        <tbody>
            <?php
            // Construct search query with error handling
            $searchQuery = $search ? "WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' OR prodi LIKE '%$search%'" : '';
            $query = "SELECT * FROM mahasiswa $searchQuery ORDER BY nama ASC";
            $result = $conn->query($query);

            if ($result) {
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
            </tr>
            <?php
                endwhile;
            } else {
                echo "<tr><td colspan='4' class='text-center py-4'>Data mahasiswa tidak ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>