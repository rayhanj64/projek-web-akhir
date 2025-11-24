<?php

include '../utility/connect.php';

include '../utility/fungsi.php';
//buat fungsi hitung umur

//cuma user yg rolenya admin yg boleh akses halaman ini

// if($_SESSION['role'] != 'admin') {
//     header("Location: ../index.php");
// }

$nomor = 0;

$sql = "SELECT * FROM users WHERE role = 'user' ORDER BY nama ASC";
$data_users = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- 
    isinya tabel buat display data users, isi kolom:
    1. username
    2. nama
    3. tgl_lahir
    4. gender
    5. tinggi
    6. umur (tgl skrg - tgl lahir)
    7. tombol buat ngeban user (set aktif = 0). klo user kebanned, jadi tombol buat unban user (set aktif = 1)
    aktif = 0 berarti user dibanned
    aktif = 1 berarti user gk dibanned
    8. tombol buat lihat catatan kesehatan per user (arahin ke lihat_catatan.php buat liat detail catatan kesehatan per user berdasarkan id_user)
    -->
    <a href="../index.php">Kembali ke halaman utama</a>
<table>
    <tr>
        <th>Nomor</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Tinggi</th>
        <th>Umur</th>
        <th>Ban / Unban</th>
        <th>Lihat Catatan</th>
    </tr>
    <?php 
    while ($row = mysqli_fetch_assoc($data_users)) {
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
        <?php switch ($aktif) {
                case 1: ?>
        <th><a href="ban_unban.php?aktif=<?php echo $aktif; ?>&id_user=<?php echo $id_user ?>" class="btn">Ban User</th>
        <?php   break;
                case 0: ?>
        <th><a href="ban_unban.php?aktif=<?php echo $aktif; ?>&id_user=<?php echo $id_user ?>" class="btn">Unban User</a></th>
        <?php   break; } ?>
        <th><a href="lihat_catatan.php?id_user=<?php echo $id_user; ?>" class="btn">Lihat Catatan</a></th>
    </tr>

    <?php } ?>

</table>
</body>
</html>