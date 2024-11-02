<?php 
    include 'database.php';
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
        $password = password_hash(
                                htmlspecialchars($_POST["password"],
                                    ENT_QUOTES,
                                    'UTF-8')
                                    ,PASSWORD_DEFAULT);
        $nim = htmlspecialchars($_POST["nim"], ENT_QUOTES, 'UTF-8');
        $prodi = htmlspecialchars($_POST["prodi"], ENT_QUOTES, 'UTF-8');
        $hobi = htmlspecialchars($_POST["hobi"], ENT_QUOTES, 'UTF-8');
    }


    $in = $conn->prepare("INSERT INTO datamahasiswa (nama,nim,prodi,hobi,password) VALUES (?,?,?,?,?)");
    $in->bind_param("sssss",$username,$nim,$prodi,$hobi,$password);

    if ($in->execute()) {
        header('Location: index.php');
    } else {
        echo "<script>
    alert('Invalid Register');
    window.location.href = 'index.php';
  </script>";
    }

?>