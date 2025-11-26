<?php
include '../utility/connect.php';

$id_catatan = $_GET['id_catatan'];

$sql_hapus = "DELETE FROM catatan WHERE id_catatan = '$id_catatan'";
$hapus = mysqli_query($connect, $sql_hapus);

header("Location: ../index.php?status=catatan_dihapus");