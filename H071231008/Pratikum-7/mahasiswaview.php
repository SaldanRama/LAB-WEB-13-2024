<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Profile</title>
    <link rel="stylesheet" href="viewmahasiswa.css">
</head>
<?php
    session_start();
    include("database.php");
    if (!isset($_SESSION['username']) || $_SESSION['role'] != "user") {
        header('Location: index.php');
        exit;
    }
?>
<body>

    <div class="header">
        <div id="profile-text">
            <h1><?= $_SESSION['username'] ?> Profile</h1>
        </div>
        <div>
            <button onclick="window.location.href='editview.php';">Edit Profile</button>
        </div>
    </div>
    <div class="data-maha">
        <img src="https://uhweb.unhas.ac.id/wp-content/uploads/2022/09/Logo-Resmi-Unhas-1.png" alt="">
        <div>
        <h2><?= $_SESSION['username'] ?></h2>
        <h3><?= $_SESSION['nim'] ?></h4>
        <h4><?= $_SESSION['prodi'] ?></h4>
        <p><?= $_SESSION['username'] ?> adalah mahasiswa Universitas Hasanuddin yang mengambil jurusan <?= $_SESSION['prodi'] ?>. Ia memiliki minat besar dalam <?= $_SESSION['hobi'] ?></p>
        <button onclick="window.location.href='logout.php';">Log out</button>
        </div>
    </div>
</body>
</html>