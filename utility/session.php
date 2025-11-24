<?php
//start session
session_start();

//isset buat cek ada isinya atau gk, outputnya true / false
//klo gk ada isinya, bakal diarahin ke login.php
if (!isset($_SESSION['id_user'])){
    header("location: login.php?status=login_dulu");
    die();
}