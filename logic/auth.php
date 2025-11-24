<?php
include "../utility/connect.php";
session_start();

//buat login
if (isset($_POST['login'])) {
    //ambil data username & password dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    //cari user berdasarkan username & password
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $hasil = mysqli_query($connect, $query);

    //kalo username gk ada dikick
    if (mysqli_num_rows($hasil) == 0) {
        header("Location: ../login.php?status=login_salah");
        exit;
    }

    //klo ada akunnya, ambil data user
    $user = mysqli_fetch_assoc($hasil);

    //inisiasi session
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    //arahin ke dashboard index
    header("Location: ../index.php");
    exit;
}

// buat register
if (isset($_POST['register'])) {
    //ambil data dari form buat tes pengecekan
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    //cek apakah password dan konfirmasi sama
    if ($password !== $konfirmasi) {
        header("Location: ../register.php?status=password_tidak_sama");
        exit;
    }

    //klo lulus cek pertama, lanjut cek kedua:

    //cek apakah tgl lahir masuk akal (tidak melebihi tgl hari ini)
    //strtotime = fungsi bawaan php buat convert tgl lahir ke integer detik semenjak 1 jan 1970
    //strtotime tgl lahir = detik semenjak 1 jan 1970 sampe tgl lahir user
    //strtotime today = detik semenjak 1 jan 1970 sampe tgl hari ini
    //HARUSNYA tgl lahir user <= tgl hari ini
    $tgl_lahir = $_POST['tgl_lahir'];
    if (strtotime($tgl_lahir) > strtotime('today')) {
        header("Location: ../register.php?status=tgl_lahir_tidak_masuk_akal");
        exit;
    }

    //kalo lulus 2 cek di atas, lanjut proses simpan data user baru
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $tinggi = $_POST['tinggi'];
    $gender = $_POST['gender'];
    $rokok_vape = $_POST['rokok_vape'];
    $obat = $_POST['obat'];

    //query insert into
    $sql_insert = "INSERT INTO users (username, password, nama, tgl_lahir, tinggi, gender, rokok_vape, obat_hipertensi) 
                   VALUES ('$username', '$password', '$nama', '$tgl_lahir', '$tinggi', '$gender', '$rokok_vape', '$obat')";
    $insert = mysqli_query($connect, $sql_insert);

    header("Location: ../login.php");
    exit;
}
?>