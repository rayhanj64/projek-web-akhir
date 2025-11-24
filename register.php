<?php

//register username, password. abis itu insert data diri
//baru semuanya di INSERT INTO users
//abis itu arahin ke login.php

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

        <label for="konfirmasi">Konfirmasi Password:</label><br>
        <input type="password" id="konfirmasi" name="konfirmasi" required>
        <br><br>

        <label for="nama">Nama Lengkap:</label><br>
        <input type="text" id="nama" name="nama" required>
        <br><br>

        <label for="tgl_lahir">Tanggal Lahir:</label><br>
        <input type="date" id="tgl_lahir" name="tgl_lahir" required>
        <br><br>

        <label for="tinggi">Tinggi (cm):</label><br>
        <input type="number" id="tinggi" name="tinggi" required>
        <br><br>

        <label for="gender">Jenis Kelamin:</label><br>
        <input type="radio" id="laki-laki" name="gender" value="Laki-laki" required>
        <label for="laki-laki">Laki-laki</label>
        <input type="radio" id="perempuan" name="gender" value="Perempuan">
        <label for="perempuan">Perempuan</label>
        <br><br>

        <label for="rokok_vape">Apakah Anda Perokok / Pengguna Vape ?</label><br>
        <input type="radio" id="ya" name="rokok_vape" value="Ya" required>
        <label for="laki-laki">Ya</label>
        <input type="radio" id="tidak" name="rokok_vape" value="Tidak">
        <label for="perempuan">Tidak</label>
        <br><br>

        <label for="obat">Apakah Sekarang Mengonsumsi Obat Hipertensi ?</label><br>
        <input type="radio" id="ya" name="obat" value="Ya" required>
        <label for="laki-laki">Ya</label>
        <input type="radio" id="tidak" name="obat" value="Tidak">
        <label for="perempuan">Tidak</label>
        <br><br>

        <button type="submit" name="register">Register</button>
        </div>
        <br><br>
        Sudah Punya Akun?
        <a href="login.php">Login Disini</a>
    </form>

</body>
</html>