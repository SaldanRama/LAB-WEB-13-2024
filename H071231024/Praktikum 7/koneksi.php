<?php
$conn = mysqli_connect("localhost", "root", "", "crud_mahasiswa");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
