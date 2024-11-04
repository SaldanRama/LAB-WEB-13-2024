<?php
include 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nim = $_SESSION['nim'];  
    $new_username = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $new_hobi = htmlspecialchars($_POST['hobi'], ENT_QUOTES);

    $query = $conn->prepare("UPDATE datamahasiswa SET nama = ?, hobi = ? WHERE nim = ?");
    $query->bind_param('sss', $new_username, $new_hobi, $nim);

    if ($query->execute()) {
        $_SESSION['username'] = ucwords(strtolower($new_username));
        $_SESSION['hobi'] = $new_hobi;
        header("Location: mahasiswaview.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>
