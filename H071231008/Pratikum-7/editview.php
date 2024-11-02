<!DOCTYPE html>
<html lang="en">
<?php
    include("database.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="edit-box">
        <form action="editprofile.php" method="post">
            <H1>Edit Your Data</H1>

            <div class="input-container">
                <input class="input-field" type="text" placeholder="Edit Nama" name="nama" required>
            </div>

            <div class="input-container">
                <input class="input-field" type="text" placeholder="Edit Hobi" name="hobi" required>
            </div>

            <button type="submit">EDIT</button>
            <a href="mahasiswaview.php">cancel</a>
        </form>

    </div>
</body>

</html>