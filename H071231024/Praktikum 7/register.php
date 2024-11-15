<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $program_studi = $_POST['program_studi'];

    $checkNIM = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE NIM='$nim'");
    $checkUsername = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE username='$username'");

    if (mysqli_num_rows($checkNIM) > 0) {
        $error = "NIM sudah terdaftar!";
    } elseif (mysqli_num_rows($checkUsername) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $insert_mahasiswa = mysqli_query($conn, "INSERT INTO mahasiswa (username, password, role, NIM, Nama, Program_Studi) 
            VALUES ('$username', '$password', 'user', '$nim', '$nama', '$program_studi')");

        if ($insert_mahasiswa) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Pendaftaran gagal! " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var nama = document.getElementById("nama").value;
            var nim = document.getElementById("nim").value;
            var programStudi = document.getElementById("program_studi").value;

            var usernamePattern = /^[a-zA-Z0-9]{4,}$/;
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            var namePattern = /^[A-Za-z\s]+$/;
            var nimPattern = /^[A-Z]{1}[0-9]{9}$/;
            var programStudiPattern = /^[A-Za-z\s]+$/;

            if (!username.match(usernamePattern)) {
                alert("Username harus alfanumerik dan minimal 4 karakter!");
                return false;
            }

            if (!password.match(passwordPattern)) {
                alert("Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol!");
                return false;
            }

            if (!nama.match(namePattern)) {
                alert("Nama hanya boleh berisi huruf dan spasi!");
                return false;
            }

            if (!nim.match(nimPattern)) {
                alert("NIM harus terdiri dari 10 karakter, karakter pertama harus huruf besar, sisanya angka!");
                return false;
            }

            if (!programStudi.match(programStudiPattern)) {
                alert("Program Studi hanya boleh berisi huruf dan spasi!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-center justify-center min-h-screen bg-blue-400 p-4">
    <h1 class="text-gray-800 text-[3rem] md:text-[5rem] font-bold">REGISTER<br><span class="bg-blue-700 bg-clip-text text-transparent">MAHASISWA</span></h1>
    <div class="w-full max-w-xl">
        <form method="POST" onsubmit="return validateForm()" class="bg-transparent shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-black text-xl font-bold mb-2" for="username">Username</label>
                <input class="bg-transparent text-lg shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none w-full py-2 px-3 text-black border-b-2 focus:outline-none focus:border-b-2" id="username" name="username" type="text" required>
                <p class="text-[0.7rem] text-black mt-4">Minimal 4 karakter dan hanya boleh huruf dan angka (alfanumerik).</p>
            </div>
            <div class="mb-4">
                <label class="block text-black text-xl font-bold mb-2" for="password">Password</label>
                <input class="bg-transparent text-lg shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none w-full py-2 px-3 text-black border-b-2 focus:outline-none focus:border-b-2" id="password" name="password" type="password" required>
                <p class="text-[0.7rem] text-black mt-4">Minimal 8 karakter, harus mengandung huruf besar, huruf kecil, angka, dan simbol.</p>
            </div>
            <div class="mb-4">
                <label class="block text-black text-xl font-bold mb-2" for="nama">Nama</label>
                <input class="bg-transparent text-lg shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none w-full py-2 px-3 text-black border-b-2 focus:outline-none focus:border-b-2" id="nama" name="nama" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-black text-xl font-bold mb-2" for="nim">NIM</label>
                <input class="bg-transparent text-lg shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none w-full py-2 px-3 text-black border-b-2 focus:outline-none focus:border-b-2" id="nim" name="nim" type="text" required>
                <p class="text-[0.7rem] text-black mt-4">Terdiri dari 10 karakter, karakter pertama harus huruf besar, sisanya harus berupa angka.</p>
            </div>
            <div class="mb-4">
                <label class="block text-black text-xl font-bold mb-2" for="program_studi">Program Studi</label>
                <input class="bg-transparent text-lg shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none w-full py-2 px-3 text-black border-b-2 focus:outline-none focus:border-b-2" id="program_studi" name="program_studi" type="text" required>
            </div>
            <?php if (isset($error)) { ?>
                <div class="mb-4 p-2 bg-red-100 border border-red-400 text-red-700 rounded">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
            <div class="flex gap-5 items-center justify-between">
                <button class="w-full text-center bg-green-700 border border-green-700 hover:bg-green-900 hover:border-green-500 text-white font-bold py-2 px-4 rounded" type="submit" name="register">Register</button>
                <a class="w-full text-center bg-blue-700 border border-blue-700 hover:bg-blue-900 hover:border-blue-500 text-white font-bold py-2 px-4 rounded" href="login.php">Login</a>
            </div>
        </form>
    </div>
</body>
</html>