<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
$firstName = $role == 'admin' ? 'admin' : explode(' ', mysqli_fetch_assoc(mysqli_query($conn, "SELECT Nama FROM mahasiswa WHERE username='{$_SESSION['username']}'"))['Nama'])[0];


$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if ($role == 'admin') {
    $totalMahasiswaResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa");
    $totalMahasiswaRow = mysqli_fetch_assoc($totalMahasiswaResult);
    $totalMahasiswaData = $totalMahasiswaRow['total'];
    $totalMahasiswaPages = ceil($totalMahasiswaData / $limit);

    $mahasiswaQuery = "SELECT * FROM mahasiswa WHERE role='user' ORDER BY NIM ASC LIMIT $limit OFFSET $offset";
    $mahasiswaResult = mysqli_query($conn, $mahasiswaQuery);
} else {
    $username = $_SESSION['username'];
    $totalOtherResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa WHERE username != '$username' AND role='user'");
    $totalOtherRow = mysqli_fetch_assoc($totalOtherResult);
    $totalOtherData = $totalOtherRow['total'];
    $totalOtherPages = ceil($totalOtherData / $limit);

    $mahasiswaQuery = "SELECT * FROM mahasiswa WHERE username='$username' ORDER BY NIM ASC";
    $otherMahasiswaQuery = "SELECT * FROM mahasiswa WHERE username != '$username' AND role='user' ORDER BY NIM ASC LIMIT $limit OFFSET $offset";
    $otherMahasiswaResult = mysqli_query($conn, $otherMahasiswaQuery);
    $mahasiswaResult = mysqli_query($conn, $mahasiswaQuery);
}

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    if ($role == 'admin') {
        $mahasiswaQuery = "SELECT * FROM mahasiswa WHERE (NIM LIKE '%$keyword%' OR Nama LIKE '%$keyword%' OR Program_Studi LIKE '%$keyword%') AND role='user'";
    } else {
        $mahasiswaQuery = "SELECT * FROM mahasiswa WHERE (NIM LIKE '%$keyword%' OR Nama LIKE '%$keyword%' OR Program_Studi LIKE '%$keyword%') AND username='$username'";
    }
    $mahasiswaResult = mysqli_query($conn, $mahasiswaQuery);
}

if (isset($_POST['reset'])) {
    if ($role == 'admin') {
        $mahasiswaQuery = "SELECT * FROM mahasiswa WHERE role='user'";
    } else {
        $mahasiswaQuery = "SELECT * FROM mahasiswa WHERE username='$username'";
    }
    $mahasiswaResult = mysqli_query($conn, $mahasiswaQuery);
}

if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $checkNIM = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE NIM='$nim'");
    $checkUser = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE username='$username'");
    if (mysqli_num_rows($checkNIM) > 0) {
        $error = "NIM sudah ada!";
    } elseif (mysqli_num_rows($checkUser) > 0) {
        $error = "Username sudah ada!";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO mahasiswa (NIM, Nama, Program_Studi, username, password, role) VALUES ('$nim', '$nama', '$program_studi', '$username', '$password', 'user')");
        if ($insert) {
            header("Location: index.php");
        } else {
            $error = "Gagal menambahkan data!";
        }
    }
}

if (isset($_GET['edit'])) {
    $edit_nim = $_GET['edit'];
    $editResult = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE NIM='$edit_nim'");
    $editData = mysqli_fetch_assoc($editResult);
}

if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $username = $_POST['username'];

    $checkUser = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE username='$username'");
    if (mysqli_num_rows($checkUser) > 0) {
        $error = "Username sudah ada!";
    } else {
        $update = mysqli_query($conn, "UPDATE mahasiswa SET Nama='$nama', Program_Studi='$program_studi', username='$username' WHERE NIM='$nim'");
        if ($update) {
            header("Location: index.php");
        } else {
            $error = "Gagal mengupdate data!";
        }
    }
}

if (isset($_GET['hapus'])) {
    $hapus_nim = $_GET['hapus'];
    $delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE NIM='$hapus_nim'");
    if ($delete) {
        header("Location: index.php");
    }
}

$showTambahForm = isset($_GET['tambah']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validateForm() {
            var form = document.forms["mahasiswaForm"];
            var nim = form["nim"] ? form["nim"].value : null;
            var nama = form["nama"].value;
            var program_studi = form["program_studi"].value;
            var username = form["username"].value;
            var password = form["password"] ? form["password"].value : null;

            var nimPattern = /^[A-Z]{1}[0-9]{9}$/;
            var namePattern = /^[A-Za-z\s]+$/;
            var usernamePattern = /^[a-zA-Z0-9_]{5,20}$/;
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (nim && !nim.match(nimPattern)) {
                alert("NIM harus terdiri dari 10 karakter, karakter pertama harus huruf besar, sisanya angka!");
                return false;
            }
            if (!nama.match(namePattern)) {
                alert("Nama hanya boleh berisi huruf!");
                return false;
            }
            if (!program_studi.match(namePattern)) {
                alert("Program Studi hanya boleh berisi huruf!");
                return false;
            }
            if (!username.match(usernamePattern)) {
                alert("Username harus:\n- Panjang 5-20 karakter\n- Hanya boleh berisi huruf, angka, dan underscore\n- Tidak boleh mengandung spasi");
                return false;
            }
            if (password && !password.match(passwordPattern)) {
                alert("Password harus:\n- Minimal 8 karakter\n- Mengandung minimal 1 huruf besar\n- Mengandung minimal 1 huruf kecil\n- Mengandung minimal 1 angka\n- Mengandung minimal 1 karakter khusus (@$!%*?&)");
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="min-h-screen bg-blue-400">
    <div class="container mx-auto px-4 ">

        <?php if ($role == 'admin'): ?>
            <h1 class="text-gray-800 text-center md:text-left text-[2rem] lg:text-[5rem] font-bold">Selamat datang, <span class="text-blue-700"><?= $firstName; ?></span></h1>
            <div class="mb-9">
                <form method="POST" class="mb-4 mt-4 flex flex-col md:flex-row items-center gap-3">
                    <input class="w-full md:w-2/5 bg-transparent shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none border-b-2 border-black py-2 px-3 text-black text-lg focus:outline-none focus:border-b-2 placeholder-black" type="text" name="keyword" placeholder="Cari mahasiswa...">
                    <button class="w-full md:w-24 bg-green-700 border border-green-700 hover:bg-green-900 hover:border-green-500 text-white font-bold py-2 px-4 rounded" type="submit" name="cari">Cari</button>
                    <button class="w-full md:w-24 bg-gray-800 border border-gray-700 hover:bg-gray-900 hover:border-gray-500 text-white font-bold py-2 px-4 rounded" type="submit" name="reset">Reset</button>
                </form>
            </div>



            <?php if (isset($editData)): ?>
                <form name="mahasiswaForm" onsubmit="return validateForm()" method="POST" class="bg-transparent text-white mb-4 mt-4 shadow-md border-2 border-yellow-900 rounded px-4 py-4 max-w-lg">
                    <h2 class="text-xl font-bold mb-4">Edit Data Mahasiswa</h2>
                    <input type="hidden" name="nim" value="<?= $editData['NIM']; ?>">
                    <div class="mb-2">
                        <label for="nama" class="block text-white text-lg font-bold mb-2">Nama</label>
                        <input class="w-full bg-transparent shadow appearance-none border-b-2 border-white py-2 px-3 text-white text-lg focus:outline-none focus:border-b-2" type="text" name="nama" value="<?= $editData['Nama']; ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="program_studi" class="block text-white text-lg font-bold mb-2">Program Studi</label>
                        <input class="w-full bg-transparent shadow appearance-none border-b-2 border-white py-2 px-3 text-white text-lg focus:outline-none focus:border-b-2" type="text" name="program_studi" value="<?= $editData['Program_Studi']; ?>" required>
                    </div>
                    <?php if (isset($error)) { echo "<div class='mb-4 p-2 bg-red-100 border border-red-400 text-red-700 rounded'>$error</div>"; } ?>
                    <button class="bg-yellow-900 border border-yellow-700 hover:bg-yellow-700 hover:border-yellow-500 text-white font-bold py-2 px-4 rounded" type="submit" name="update">Update</button>
                    <a href="index.php" class="bg-gray-900 border border-gray-700 hover:bg-gray-700 hover:border-gray-500 text-white font-bold py-2 px-4 rounded">Batal</a>
                </form>

            <?php elseif ($showTambahForm): ?>
                <form name="mahasiswaForm" onsubmit="return validateForm()" method="POST" class="bg-transparent text-white mb-4 mt-4 shadow-md border-2 border-green-900 rounded px-4 py-4 max-w-lg">
                    <h2 class="text-xl font-bold mb-4">Tambah Data Mahasiswa</h2>
                    <div class="mb-2">
                        <label for="nim" class="block text-white text-lg font-bold mb-2">NIM</label>
                        <input class="w-full bg-transparent shadow appearance-none border-b-2 border-white py-2 px-3 text-white text-lg focus:outline-none focus:border-b-2" type="text" name="nim" required>
                    </div>
                    <div class="mb-2">
                        <label for="nama" class="block text-white text-sm font-bold mb-2">Nama</label>
                        <input class="w-full bg-transparent shadow appearance-none border-b-2 border-white py-2 px-3 text-white text-lg focus:outline-none focus:border-b-2" type="text" name="nama" required>
                    </div>
                    <div class="mb-2">
                        <label for="program_studi" class="block text-white 0 text-lg font-bold mb-2">Program Studi</label>
                        <input class="w-full bg-transparent shadow appearance-none border-b-2 border-white py-2 px-3 text-white text-lg focus:outline-none focus:border-b-2" type="text" name="program_studi" required>
                    </div>
                    <div class="mb-2">
                        <label for="username" class="block text-white text-lg font-bold mb-2">Username</label>
                        <input class="w-full bg-transparent shadow appearance-none border-b-2 border-white py-2 px-3 text-white text-lg focus:outline-none focus:border-b-2" type="text" name="username" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="block text-white text-lg font-bold mb-2">Password</label>
                        <input class="w-full bg-transparent shadow appearance-none border-b-2 border-white py-2 px-3 text-white text-lg focus:outline-none focus:border-b-2" type="password" name="password" required>
                    </div>
                    <?php if (isset($error)) { echo "<div class='mb-4 p-2 bg-red-100 border border-red-400 text-red-700 rounded'>$error</div>"; } ?>
                    <button class="bg-blue-900 border border-blue-700 hover:bg-blue-700 hover:border-blue-500 text-white font-bold py-2 px-4 rounded" type="submit" name="tambah">Tambah</button>
                    <a href="index.php" class="bg-gray-900 border border-gray-700 hover:bg-gray-700 hover:border-gray-500 text-white font-bold py-2 px-4 rounded">Batal</a>
                </form>
            <?php else: ?>
                <div class="mb-7">
                    <a href="index.php?tambah" class="bg-green-700 border border-green-700 hover:bg-green-900 hover:border-green-500 text-white font-bold py-2 px-4 rounded mt-8">Tambah Mahasiswa</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($role == 'admin'): ?>
            <h3 class="text-xl mb-4 text-center mt-8 text-black">Data Mahasiswa:</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded">
                    <thead class="text-white text-left border-b-2 border-t-2">
                        <tr class="bg-slate-800">
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">NIM</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Program Studi</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-blue-600 text-white">
                        <?php
                        $no = $offset + 1; 
                        while ($row = mysqli_fetch_assoc($mahasiswaResult)): ?>
                            <tr class="odd:bg-blue-900 even:bg-transparent">
                                <td class="border-b-[1px] border-dashed px-4 py-4"><?= $no++; ?></td>
                                <td class="border-b-[1px] border-dashed px-4 py-4"><?= htmlspecialchars($row['NIM']); ?></td>
                                <td class="border-b-[1px] border-dashed px-4 py-4"><?= htmlspecialchars($row['Nama']); ?></td>
                                <td class="border-b-[1px] border-dashed px-4 py-4"><?= htmlspecialchars($row['Program_Studi']); ?></td>
                                <td class="border-b-[1px] border-dashed px-4 py-4 flex flex-col md:flex-row gap-2">
                                    <a href="index.php?edit=<?= $row['NIM']; ?>" class="bg-yellow-700 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    <a href="index.php?hapus=<?= $row['NIM']; ?>" onclick="return confirm('Apakah Anda yakin?')" class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex space-x-2">
                        <?php if ($page > 1): ?>
                            <li>
                                <a href="index.php?page=<?= $page - 1; ?>" class="bg-gray-900 border border-gray-700 hover:bg-gray-700 hover:border-gray-500 text-white font-bold py-2 px-4 rounded">Prev</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalMahasiswaPages; $i++): ?>
                            <li>
                                <a href="index.php?page=<?= $i; ?>" class="bg-gray-800 border border-gray-700 hover:bg-gray-900 hover:border-gray-500 text-white font-bold py-2 px-4 rounded <?= $page == $i ? 'bg-blue-500 text-white' : ''; ?>">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalMahasiswaPages): ?>
                            <li>
                                <a href="index.php?page=<?= $page + 1; ?>" class="bg-gray-800 border border-gray-700 hover:bg-gray-900 hover:border-gray-500 text-white font-bold py-2 px-4 rounded">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

        <?php else: ?>
            <h1 class="text-white text-center text-[5rem] font-bold">Selamat datang, <span class="bg-gradient-to-tl from-slate-800 via-violet-500 to-zinc-400 bg-clip-text text-transparent"><?= $firstName; ?></span></h1>
            <h3 class="text-xl mt-5 mb-4 text-center fade-in-scale text-gray-600">Informasi Kamu:</h3>
            <div class="flex justify-center items-center">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl fade-in-scale">
                    <?php 
                    $userData = mysqli_fetch_assoc($mahasiswaResult);
                    ?>
                    <div class="bg-transparent p-4 rounded-xl text-xl border-slate-500 border-y-4">
                        <p class="text-center p-4 mb-1 text-blue-600 font-bold">NIM</p>
                        <p class="text-center rounded-md p-4 italic text-white">
                            <?= htmlspecialchars($userData['NIM']) ?>
                        </p>
                    </div>
                    <div class="bg-transparent p-4 rounded-xl text-xl border-slate-500 border-y-4">
                        <p class="text-center p-4 mb-1 text-blue-600 font-bold">NAMA</p>
                        <p class="text-center rounded-md p-4 italic text-white">
                            <?= htmlspecialchars($userData['Nama']) ?>
                        </p>
                    </div>
                    <div class="bg-transparent p-4 rounded-xl text-xl border-slate-500 border-y-4">
                        <p class="text-center p-4 mb-1 text-blue-600 font-bold">PROGRAM STUDI</p>
                        <p class="text-center rounded-md p-4 italic text-white">
                            <?= htmlspecialchars($userData['Program_Studi']) ?>
                        </p>
                    </div>
                    <div class="bg-transparent p-4 rounded-xl text-xl border-slate-500 border-y-4">
                        <p class="text-center p-4 mb-1 text-blue-600 font-bold">USERNAME</p>
                        <p class="text-center rounded-md p-4 italic text-white">
                            <?= htmlspecialchars($userData['username']) ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <h3 class="text-xl mb-4 text-center mt-8 text-gray-600">Data Mahasiswa Lainnya:</h3>
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white shadow-md rounded mb-8">
                    <thead class="text-white text-left border-b-2 border-t-2">
                        <tr class="bg-slate-800">
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">NIM</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Program Studi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#070b11] text-white">
                        <?php
                        $no = $offset + 1; 
                        while ($row = mysqli_fetch_assoc($otherMahasiswaResult)): ?>
                            <tr class="odd:bg-slate-900 even:bg-transparent">
                                <td class="border-b-[1px] border-dashed px-4 py-2"><?= $no++; ?></td>
                                <td class="border-b-[1px] border-dashed px-4 py-2"><?= htmlspecialchars($row['NIM']); ?></td>
                                <td class="border-b-[1px] border-dashed px-4 py-2"><?= htmlspecialchars($row['Nama']); ?></td>
                                <td class="border-b-[1px] border-dashed px-4 py-2"><?= htmlspecialchars($row['Program_Studi']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex space-x-2">
                        <?php if ($page > 1): ?>
                            <li>
                                <a href="index.php?page=<?= $page - 1; ?>" class="bg-gray-900 border border-gray-700 hover:bg-gray-700 hover:border-gray-500 text-white font-bold py-2 px-4 rounded">Prev</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalOtherPages; $i++): ?>
                            <li>
                                <a href="index.php?page=<?= $i; ?>" class="bg-gray-900 border border-gray-700 hover:bg-gray-700 hover:border-gray-500 text-white font-bold py-2 px-4 rounded <?= $page == $i ? 'bg-blue-500 text-white' : ''; ?>">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalOtherPages): ?>
                            <li>
                                <a href="index.php?page=<?= $page + 1; ?>" class="bg-gray-900 border border-gray-700 hover:bg-gray-700 hover:border-gray-500 text-white font-bold py-2 px-4 rounded">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>

        <div class="mt-7 flex justify-center align-items">
            <a href="logout.php" class="w-36 text-center bg-red-700 border border-red-700 hover:bg-red-900 hover:border-red-500 text-white font-bold py-2 px-4 rounded">Logout</a>
        </div>

    </div>
</body>
</html>
