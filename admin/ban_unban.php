<?php
include '../utility/connect.php';

$id_user = $_GET['id_user'];
$aktif = $_GET['aktif'];

switch ($aktif) {
    case '1':
    // klo awalnya aktif = 1 -> skrg set jadi 0 (ban)
    $sql= "UPDATE users SET aktif = 0 WHERE id_user = '$id_user'";
        break;
    
    case '0':
    // klo awalnya aktif = 0 -> skrg set jadi 1 (unban)
    $sql= "UPDATE users SET aktif = 1 WHERE id_user = '$id_user'";
        break;
}  

$ban_unban = mysqli_query($connect, $sql);
return header('Location: index_admin.php');