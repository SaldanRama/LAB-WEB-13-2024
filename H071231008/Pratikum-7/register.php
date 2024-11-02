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
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="login-box">
        <form action="registercontrol.php" method="post">
            <img src="media/OBJECTS.png" alt="">
            <H1>Join Us!</H1>
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="password" name="password" required>
            </div>
            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="text" placeholder="nim" name="nim" required>
            </div>
            <div class="input-container">
                <input class="input-field" type="prodi" placeholder="prodi" name="prodi" require>
            </div>
            <div class="input-container">
                <input class="input-field" type="hobi" placeholder="hobi" name="hobi" required>
            </div>
            <button type="submit">register</button>
            <a href="index.php">Login</a>
        </form>
    </div>
</body>

</html>