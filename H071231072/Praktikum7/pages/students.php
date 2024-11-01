<?php
if (!isset($conn)) {
    die("Koneksi tidak tersedia.");
}
?>

<div class="container mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Mahasiswa</h2>

    <!-- Filter dan Pencarian -->
    <div class="mb-6 flex justify-between items-center">
        <form class="flex items-center space-x-4" action="?page=students" method="GET">
            <input type="hidden" name="page" value="students">
            <div class="relative">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                    class="pl-10 pr-4 py-2 rounded-lg border-2 border-gray-200 focus:border-red-500 focus:ring-0"
                    placeholder="Cari mahasiswa...">
                <span data-feather="search" class="absolute left-3 top-2.5 text-gray-400"></span>
            </div>
            <select name="prodi"
                class="px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-red-500 focus:ring-0">
                <option value="">Semua Program Studi</option>
                <?php
                $prodiList = $conn->query("SELECT DISTINCT prodi FROM mahasiswa ORDER BY prodi");
                while ($prodi = $prodiList->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($prodi['prodi']) . "'>" . 
                         htmlspecialchars($prodi['prodi']) . "</option>";
                }
                ?>
            </select>
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                Filter
            </button>
        </form>
    </div>

    <!-- Tabel Mahasiswa -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">NIM</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Program Studi</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
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
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-700">Edit</a>
                            <a href="proses_hapus.php?id=<?= $row['id'] ?>" class="text-red-600 hover:text-red-700"
                                onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">Hapus</a>
                        </div>
                    </td>

                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>