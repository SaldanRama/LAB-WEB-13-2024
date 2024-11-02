<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header('Location: index.php');
    exit;
}

include 'database.php';

$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($searchTerm) {
    $query = $conn->prepare("SELECT * FROM datamahasiswa WHERE nama != 'ADMIN' AND nama LIKE ?");
    $searchTerm = "%$searchTerm%";
    $query->bind_param('s', $searchTerm);
} else {
    $query = $conn->prepare("SELECT * FROM datamahasiswa WHERE nama != 'ADMIN'");
}

$query->execute();
$result = $query->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_Nim'])) {
    $deleteNim = $_POST['delete_Nim'];
    $deleteQuery = $conn->prepare("DELETE FROM datamahasiswa WHERE nim = ?");
    $deleteQuery->bind_param('s', $deleteNim);
    $deleteQuery->execute();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="main">
        <sidebar>
            <h1>Dashboard</h1>
            <div>
                <img src="https://uhweb.unhas.ac.id/wp-content/uploads/2022/09/Logo-Resmi-Unhas-1.png" alt="">
            </div>
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Cari Mahasiswa" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit">Search</button>
            </form>

            <button onclick="window.location.href='logout.php';">Log out</button>

        </sidebar>
        <data>
            <h1>DATA MAHASISWA</h1>
            <div class="wrapper">
                <div class="table">
                    <div class="row header">
                        <div class="cell">
                            Nama
                        </div>
                        <div class="cell">
                            NIM
                        </div>
                        <div class="cell">
                            Prodi
                        </div>
                        <div class="cell">
                            Hobi
                        </div>
                        <div class="cell">
                            Action
                        </div>
                    </div>

                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="row">
                            <div class="cell">
                                <?= ucwords(strtolower($row['nama'])); ?>
                            </div>
                            <div class="cell">
                                <?= $row['nim']; ?>
                            </div>
                            <div class="cell">
                                <?= ucwords(strtolower($row['prodi'])); ?>
                            </div>
                            <div class="cell">
                                <?= $row['hobi']; ?>
                            </div>
                            <div class="cell">
                                <form method="POST">
                                    <input type="hidden" name="delete_Nim" value="<?= $row['nim']; ?>">
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </data>
    </div>

</body>

</html>