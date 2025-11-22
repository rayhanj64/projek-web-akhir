<?php

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
    8. id_catatan (PK auto increment)

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

    sebenarnya agak bingung buat tinggi, enaknya ditaruh di tabel users atau catatan

    nnt di file index ini:
    1. display semua catatan kesehatan user 
    2. ada tombol 'tambah catatan' buat ngisi tabel catatan no 3-7. no 1,2,8 dihandle sistem

    klo yg login itu admin, di atas sendiri ada tombol buat akses index_admin.php
    admin tetap dianggap kayak user biasa, bisa isi catatan kesehatan sendiri, tapi juga bisa akses folder admin
    -->
</body>
</html>