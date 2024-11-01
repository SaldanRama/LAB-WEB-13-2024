<?php
// Mulai sesi untuk menampilkan pesan atau status operasi
session_start();

// Detail koneksi ke database
$host = 'localhost'; // Ganti dengan host database Anda
$user = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$database = 'tp7'; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah data telah dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form tambah mahasiswa
    $nama = $conn->real_escape_string($_POST['nama']);
    $nim = $conn->real_escape_string($_POST['nim']);
    $prodi = $conn->real_escape_string($_POST['prodi']);

    // Validasi sederhana jika salah satu field kosong
    if (empty($nama) || empty($nim) || empty($prodi)) {
        $_SESSION['message'] = "Semua kolom harus diisi!";
        $_SESSION['message_type'] = "error";
        header("Location: index.php?page=dashboard");
        exit();
    }

    // Query untuk menambah data mahasiswa
    $query = "INSERT INTO mahasiswa (nama, nim, prodi) VALUES ('$nama', '$nim', '$prodi')";

    // Eksekusi query dan tangkap hasilnya
    if ($conn->query($query) === TRUE) {
        $_SESSION['message'] = "Mahasiswa berhasil ditambahkan!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Terjadi kesalahan: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }

    // Redirect kembali ke halaman dashboard
    header("Location: index.php?page=dashboard");
    exit();
} else {
    // Jika akses langsung ke file ini tanpa metode POST, alihkan ke dashboard
    header("Location: index.php?page=dashboard");
    exit();
}

// Tutup koneksi
$conn->close();
?>