<?php
include 'utility/connect.php';
//login pake username & password

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="logic/auth.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required>
        <br><br>

        <button type="submit" name="login">Login</button>
        <br><br>
        Belum Punya Akun?
        <a href="register.php">Daftar Disini</a>
    </form>
</body>
</html>