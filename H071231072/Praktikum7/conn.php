<?php
// Tentukan Kredential DB
$server_name = 'localhost';
$username = 'root';
$password = '';
$database = 'tp7';

// Koneksikan DB
$conn = new mysqli($server_name, $username, $password, $database,3306);

// Cek Keberhasilan Koneksi
if($conn->connect_error) {
    die("Koneksi Gagal: ". $conn->connect_error);
}