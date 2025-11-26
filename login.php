<?php
include 'utility/connect.php';
//login pake username & password

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 380px;
            background: white;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            text-align: center;
        }

        .icon-cloud {
            font-size: 40px;
            color: #1e88ff;
            margin-bottom: 10px;
        }

        h2 {
            margin: 0;
            font-size: 22px;
            color: #333;
            font-weight: bold;
        }

        p.subtitle {
            font-size: 14px;
            color: #666;
            margin-top: 6px;
            margin-bottom: 30px;
        }

        .input-group {
            text-align: left;
            margin-bottom: 25px;
        }

        .input-icon {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #ccc;
            padding: 10px 5px;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-bottom: 1px solid #1e88ff;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            background: #1e88ff;
            color: white;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn:hover {
            background: #0d6efd;
        }

        .link-daftar {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }

        .link-daftar a {
            color: #1e88ff;
            text-decoration: none;
            font-weight: bold;
        }

        .link-daftar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="center">
    <div class="card">
        <div class="icon-cloud">
            <svg width="42" height="42" viewBox="0 0 24 24" fill="#1e88ff" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 18H6a4 4 0 010-8 5.5 5.5 0 0110.7-1.6A4.5 4.5 0 0119 18z"/>
            </svg>
        </div>

        <h2>Selamat Datang!</h2>
        <form action="logic/auth.php" method="POST">

        <div class="input-group">
        <label class="input-icon" for="username">Username</label>
        <input type="text" id="username" name="username" required>
        </div>

        <div class="input-group">
        <label class="input-icon" for="password">Password</label>
        <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn">Login</button>

        <div class="link-daftar">
        Belum Punya Akun? <a href="register.php">Daftar disini</a>
        </div>

</form>