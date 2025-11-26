<?php

//register username, password. abis itu insert data diri
//baru semuanya di INSERT INTO users
//abis itu arahin ke login.php

include 'utility/connect.php';
//login pake username & password

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        body {
            background: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 22px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            margin-bottom: 5px;
            font-size: 15px;
        }

        .radio-group {
            margin-top: 5px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-reset {
            background: #6b7280;
            color: white;
            margin-right: 10px;
        }

        .link-login {
            margin-top: 20px;
            display: block;
        }

        a {
            color: #1d4ed8;
            text-decoration: none;
            font-weight:bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Akun Baru</h2>

        <form action="logic/auth.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br><br>

            <label for="konfirmasi">Konfirmasi Password:</label>
            <input type="password" id="konfirmasi" name="konfirmasi" required>
            <br><br>

            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>
            <br><br>

            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" required>
            <br><br>

            <label for="tinggi">Tinggi (cm):</label>
            <input type="number" id="tinggi" name="tinggi" required>
            <br><br>

            <label for="gender">Jenis Kelamin:</label><br>
            <input type="radio" id="laki-laki" name="gender" value="Laki-laki" required> Laki-Laki
            <input type="radio" id="perempuan" name="gender" value="Perempuan"> Perempuan
            <br><br>

            <label for="rokok_vape">Apakah Anda Perokok / Pengguna Vape ?</label><br>
            <input type="radio" id="ya" name="rokok_vape" value="Ya" required> Ya
            <input type="radio" id="tidak" name="rokok_vape" value="Tidak"> Tidak
            <br><br>

            <label for="obat">Apakah Sekarang Mengonsumsi Obat Hipertensi ?</label><br>
            <input type="radio" id="ya" name="obat" value="Ya" required> Ya
            <input type="radio" id="tidak" name="obat" value="Tidak"> Tidak
            <br><br>

            <button type="reset" class="btn-reset">Reset</button>
            <button type="submit" name="register" class="btn-primary">Daftar</button>

            </div>
            <br><br>
            Sudah Punya Akun?
            <a href="login.php">Login Disini</a>
        </form>

</body>
</html>