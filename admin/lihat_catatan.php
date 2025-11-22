<?php

include '../utility/connect.php';

//cuma user yg rolenya admin yg boleh akses halaman ini

// if($_SESSION['role'] != 'admin') {
//     header("Location: ../index.php");
// }

$id_user = $_GET['id_user'];

$nomor = 0;

$sql = "SELECT * FROM catatan WHERE id_user = '$id_user' ORDER BY created_at DESC";
$data_catatan = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index_admin.php">Kembali ke halaman admin</a>
<table>
    <tr>
        <th>Nomor</th>
        <th>Tanggal</th>
        <th>Berat</th>
        <th>Tekanan Darah</th>
        <th>Gula Darah</th>
        <th>Detak Jantung</th>
        <th>Catatan Harian</th>
    </tr>
    <?php 
    while ($row = mysqli_fetch_assoc($data_catatan)) {
    $nomor++;
    $tgl_created = $row['created_at'];
    $berat = $row['berat'];
    $sistole = $row['sistole'];
    $diastole = $row['diastole'];
    $gula_darah = $row['gula_darah'];
    $detak_jantung = $row['detak_jantung'];
    $catatan_harian = $row['catatan_harian'];
    ?>
    <tr>
        <th><?php echo $nomor; ?></th>
        <th><?php echo $tgl_created; ?></th>
        <th><?php echo $berat; ?> kg</th>
        <th><?php echo $sistole ?>/<?php echo $diastole; ?> mmHg</th>
        <th><?php echo $gula_darah; ?> mg/dL</th>
        <th><?php echo $detak_jantung; ?> bpm</th>
        <th><?php echo $catatan_harian; ?></th>
    </tr>

    <?php } ?>

</table>
</body>
</html>