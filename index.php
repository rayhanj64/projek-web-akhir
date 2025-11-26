<?php
include 'utility/session.php';
include 'utility/connect.php';
include 'utility/fungsi.php';

$username = $_SESSION['username'];
$nama = $_SESSION['nama'];
$id_user = $_SESSION['id_user'];
$role = $_SESSION['role'];
$aktif = $_SESSION['aktif'];

//ambil data user dari tabel users
$sql_data_user = "SELECT tgl_lahir, tinggi, gender, rokok_vape, obat_hipertensi FROM users WHERE id_user = '$id_user'";
$data_user = mysqli_query($connect, $sql_data_user);

//fetch data user ke variabel
$row_user = mysqli_fetch_assoc($data_user);
$tinggi = $row_user['tinggi'];
$gender = $row_user['gender'];
$rokok_vape = $row_user['rokok_vape'];
$obat_hipertensi = $row_user['obat_hipertensi'];
$tgl_lahir = $row_user['tgl_lahir'];
$umur = hitung_umur($tgl_lahir);

//ambil data catatan kesehatan user dari tabel catatan
$sql_data_catatan = "SELECT * FROM catatan WHERE id_user = '$id_user' ORDER BY created_at DESC"; 
$data_catatan = mysqli_query($connect, $sql_data_catatan);

//ambil 1 data catatan terbaru dari tabel catatan buat reminder plg atas
$sql_data_catatan_terbaru = "SELECT * FROM catatan WHERE id_user = '$id_user' ORDER BY created_at DESC LIMIT 1";
$data_catatan_terbaru = mysqli_query($connect, $sql_data_catatan_terbaru);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php switch ($aktif): 
      case 1:  ?>

<body>
    <!-- 
    di phpmyadmin ku, database sqlnya tak namain "personal_health_record" . samain aja biar connect.php gk error

    tabel users (akun user + identitas dasar user yg konstan & gk berubah2):
    1. id_user (PK auto increment)
    2. username
    3. password
    4. tinggi (cm)
    5. tgl lahir
    6. gender
    7. nama
    8. role (default = user)
    9. aktif (default = 1, tp bisa disetting admin ke 0 buat ngeban user)
    (klo aktif = 0, index.php g ada isinya selain notif kalo akun dibanned)
    yg diisi user di register.php cuma no 2-7, no 1, 8, 9 dihandle sistem

    sebenarnya agak bingung buat tinggi, enaknya ditaruh di tabel users atau catatan
    gatau username & nama mending sama atau beda
    sebenarnya kepikiran buat pisah tabel users = username & password, & tabel profil = identitas dasar user pake id_user sbg penghubung
    tp biar simpel digabung aja
    sama kepikiran buat password:
    1. diubah ke char atau gmn biar gk kena injeksi sql kayak kemarin yg dijelasin kak wijdan
    2. dihash sekalian pake password_hash(). katanya ngabGPT, hashing tetep gbs mencegah sql injection
    tapi opsional. klo bisa malah keren. klo gbs yaudah gpp

    tabel catatan (catatan kesehatan user yg dinamis & bisa berubah2 tiap kali diisi):
    1. id_user (penghubung users - kesehatan)
    2. created_at
    3. berat (kg)
    4. sistole (mmHg)
    5. diastole (mmHg)
    6. gula_darah (mg/dL)
    7. detak_jantung (bpm)
    8. catatan_harian (catatan yg diinput pake textarea html. satu2nya data yg opsional)
    9. id_catatan (PK auto increment)

    katanya ngabGPT: 
    cara simpan float (berat & tinggi) di database mysql itu pake tipe data DECIMAL
    tapi klo tipe data DECIMAL diimpor ke kodingan php, dia bakal jadi string
    jadi harus diconvert dulu ke float pake fungsi floatval($variabel) buat itung bmi
    cth: $berat = floatval($data['berat']);

    relasi users - kesehatan: one to many (id_user sbg penghubung)

    umur dihitung otomatis pake tgl skrg - tgl lahir

    bmi dihitung otomatis dari berat & tinggi (berat (kg) / (tinggi (m) x tinggi (m)))
    nnt tinggi diconvert dari cm ke m dulu pake (tinggi / 100), baru itung bmi

    sistole & diastole dimasukin bareng jadi tekanan darah (sistole/diastole mmHg)
    (cth: 120/80 mmHg)

    nnt di file index ini:
    1. display semua catatan kesehatan user 
    2. ada tombol 'tambah catatan' buat ngisi tabel catatan no 3-8. no 1,2,9 dihandle sistem

    klo yg login itu admin, di atas sendiri ada tombol buat akses index_admin.php
    admin tetap dianggap kayak user biasa, bisa isi catatan kesehatan sendiri, tapi juga bisa akses folder admin
    
    -->
    <h1>Catatan Kesehatan Pribadi</h1>
    <h2>Selamat Datang, <?php echo $nama; ?>!</h2>

    <?php if ($role == 'admin') { ?>
    <a href="admin/index_admin.php">Masuk ke halaman admin</a><br><br>
    <?php } ?>

    <a href="logic/logout.php">Logout</a><br><br>

    <a href="tambah.php">Tambah Catatan Kesehatan</a>

    <?php if(mysqli_num_rows($data_catatan) > 0) { ?> 
    <!-- cek kalo ada catatan kesehatan gk -->

    <h3>Rekap Kesehatan Terbaru</h3>
    <?php 
        $row_terbaru = mysqli_fetch_assoc($data_catatan_terbaru);
            $berat_terbaru = $row_terbaru['berat'];
            $bmi_terbaru = hitung_bmi($berat_terbaru, $tinggi);
            $kategori_bmi_terbaru = kategori_bmi($bmi_terbaru);
            $sistole_terbaru = $row_terbaru['sistole'];
            $diastole_terbaru = $row_terbaru['diastole'];
            $gula_darah_terbaru = $row_terbaru['gula_darah'];
            $detak_jantung_terbaru = $row_terbaru['detak_jantung'];
            $total_kolesterol_terbaru = $row_terbaru['total_kolesterol'];
            $hdl_kolesterol_terbaru = $row_terbaru['hdl_kolesterol']; ?>
    <table border="1">

        <!-- isi -->
        <tr>
            <td>Kategori BMI</td>
            <td><?php echo kategori_bmi((hitung_bmi($berat_terbaru, $tinggi))); ?></td>
        </tr>
        <tr>
            <td>Tekanan Darah</td>
            <td><?php echo kategori_tekanan_darah($sistole_terbaru, $diastole_terbaru) ?></td>
        </tr>
        <tr>
            <td>Gula Darah</td>
            <td><?php echo kategori_gula_darah($gula_darah_terbaru); ?></td>
        </tr>
        <tr>
            <td>Detak Jantung</td>
            <td><?php echo kategori_detak_jantung($detak_jantung_terbaru); ?></td>
        </tr>
        <tr>
            <td>Kolesterol Total</td>
            <td><?php echo kategori_total_kolesterol($total_kolesterol_terbaru); ?></td>
        </tr>
        <tr>
            <td>HDL Kolesterol</td>
            <td><?php echo kategori_hdl_kolesterol($hdl_kolesterol_terbaru); ?></td>
        </tr>
    </table>
    <?php if ($umur > 30) { ?>
    <br>
    <table border="1">
        <tr>
            <th>Risiko Penyakit Jantung 10 Tahun ke Depan Berdasarkan Framingham Risk Score: 
                <?php echo hitung_FRS($umur, 
                                    $gender, 
                                    $sistole_terbaru, 
                                    $obat_hipertensi, 
                                    $total_kolesterol_terbaru, 
                                    $hdl_kolesterol_terbaru, 
                                    $rokok_vape); ?>
        </th>
        </tr>
    </table>
    <?php } ?>

    <h3>Catatan Kesehatan</h3>

    <?php 
        while ($row = mysqli_fetch_assoc($data_catatan)) {
            $tgl_created = $row['created_at'];
            $berat = $row['berat'];
            $sistole = $row['sistole'];
            $diastole = $row['diastole'];
            $gula_darah = $row['gula_darah'];
            $detak_jantung = $row['detak_jantung'];
            $catatan_harian = $row['catatan_harian'];
            $bmi = hitung_bmi($berat, $tinggi);
            $total_kolesterol = $row['total_kolesterol'];
            $hdl = $row['hdl_kolesterol'];
            $id_catatan = $row['id_catatan'];
        ?>
    <table border="1">
        <!-- judul -->
        <tr>
            <th colspan="2">Tanggal: <?php echo $tgl_created; ?></th>
        </tr>

        <!-- isi -->
        <tr>
            <td>Berat Badan</td>
            <td><?php echo $berat; ?> kg</td>
        </tr>
        <tr>
            <td>BMI</td>
            <td><?php echo $bmi; ?></td>
        </tr>
        <tr>
            <td>Kategori BMI</td>
            <td><?php echo kategori_bmi($bmi); ?></td>
        </tr>
        <tr>
            <td>Tekanan Darah</td>
            <td><?php echo $sistole . '/' . $diastole; ?> mmHg</td>
        </tr>
        <tr>
            <td>Gula Darah</td>
            <td><?php echo $gula_darah; ?> mg/dL</td>
        </tr>
        <tr>
            <td>Detak Jantung</td>
            <td><?php echo $detak_jantung; ?> bpm</td>
        </tr>
        <tr>
            <td>Kolesterol Total</td>
            <td><?php echo $total_kolesterol; ?> mg/dL</td>
        </tr>
        <tr>
            <td>HDL Kolesterol</td>
            <td><?php echo $hdl; ?> mg/dL</td>
        </tr>
        <tr>
            <td>Catatan Harian</td>
            <td><?php echo $catatan_harian; ?></td>
        </tr>
        <tr>
            <th colspan =2><a href="logic/delete_catatan.php?id_catatan=<?php echo $id_catatan ?>">Hapus Catatan</a></th>
        </tr>
    </table>
        <br>
        <?php } ?>

    <?php } else { ?>
    <h3>Belum ada catatan kesehatan yang ditambahkan.</h3>
    <?php } ?>
</body>

    <?php break;
    case 0: ?>

<body>
    <h1>Akun Anda telah dibanned. Silakan hubungi administrator untuk informasi lebih lanjut.</h1>
</body>

    <?php break; 
    endswitch; ?>

</body>
</html>