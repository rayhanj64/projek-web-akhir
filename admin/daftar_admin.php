<?php

include '../utility/connect.php';
include '../utility/session.php';
include '../utility/fungsi.php';

//cuma user yg rolenya admin yg boleh akses halaman ini

if($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
}

$nomor = 0;

$sql_admin = "SELECT * FROM users WHERE role = 'admin' ORDER BY nama ASC";
$data_admin = mysqli_query($connect, $sql_admin);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
</head>
<body>
    <!-- 
    isinya tabel buat display data admin, isi kolom:
    1. username
    2. nama
    3. tgl_lahir
    4. gender
    5. tinggi
    6. umur (tgl skrg - tgl lahir)
    7. tombol buat lihat catatan kesehatan per user (arahin ke lihat_catatan.php buat liat detail catatan kesehatan per user berdasarkan id_user)
    -->
    <a href="../index.php">Kembali ke halaman utama</a>
    <br><br>

    <a href="index_admin.php">Lihat Daftar Pengguna</a>
    <br><br>

    <h1>Daftar Admin</h1>
<table>
    <tr>
        <th>Nomor</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Tinggi</th>
        <th>Umur</th>
        <th>Lihat Catatan</th>
    </tr>
    <?php 
    while ($row = mysqli_fetch_assoc($data_admin)) {
    $nomor++;
    $id_user = $row['id_user'];
    $username = $row['username'];
    $nama = $row['nama'];
    $tgl_lahir = $row['tgl_lahir'];
    $tinggi = $row['tinggi'];
    $gender = $row['gender'];
    $aktif = $row['aktif'];
    $umur = hitung_umur($tgl_lahir);
    ?>
    <tr>
        <th><?php echo $nomor; ?></th>
        <th><?php echo $username; ?></th>
        <th><?php echo $nama; ?></th>
        <th><?php echo $tgl_lahir; ?></th>
        <th><?php echo $gender; ?></th>
        <th><?php echo $tinggi; ?> cm</th>
        <th><?php echo $umur; ?> tahun</th>
        <th><a href="lihat_catatan.php?id_user=<?php echo $id_user; ?>&role=admin" class="btn">Lihat Catatan</a></th>
    </tr>

    <?php } ?>

</table>
</body>
</html>