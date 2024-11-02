<?php
include 'database.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password =
        htmlspecialchars(
            $_POST["password"],
            ENT_QUOTES,
            'UTF-8'
        );
}

$query = $conn->prepare('SELECT * FROM datamahasiswa WHERE nama = ?');

$query->bind_param('s', $username);

$query->execute();

$result = $query->get_result();
$user = $result->fetch_assoc();

if ($user) {

    if (password_verify($password, $user['password'])) {
        if ($user['nama'] === "ADMIN")  {
            $_SESSION['username'] = "admin";
            $_SESSION['role'] = "admin";
            header("Location: adminview.php");
        } else {
            $_SESSION['role'] = "user";
            $_SESSION['username'] = ucwords(strtolower($user['nama']));
            $_SESSION['nim'] = $user['nim'];
            $_SESSION['prodi'] = ucwords(strtolower($user['prodi']));
            $_SESSION['hobi'] = $user['hobi'];
            header("Location: mahasiswaview.php");
            exit();
            
        }
    }else{
        echo "<script>
        alert('Invalid username or password');
        window.location.href = 'index.php';
      </script>";
    }
}  else {
    echo "<script>
        alert('Invalid username or password');
        window.location.href = 'index.php';
      </script>";
}
