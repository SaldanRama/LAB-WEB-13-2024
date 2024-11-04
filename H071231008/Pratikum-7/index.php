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
    <link rel="stylesheet" href="Login.css">
</head>

<body>
    <div class="login-box">
        <form action="login.php" method="post">
            <img src="media/OBJECTS.png" alt="">
            <H1>Welcome Backk!</H1>
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="password" name="password" required>
            </div>
            <button type="submit">LOGIN</button>
            <a href="register.php">register</a>
        </form>
    </div>
</body>

</html>