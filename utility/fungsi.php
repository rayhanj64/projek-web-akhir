<?php

// 1) Tekanan Darah (mengikuti ACC/AHA 2017 dan update): 
function kategori_tekanan_darah($sistole, $diastole) {
    // Hipotensi (umum dipakai <90/<60)
    if ($sistole < 90 || $diastole < 60) {
        return "Tekanan Darah Rendah (Hipotensi)";
    }

    // Stage 2: SBP >= 140 OR DBP >= 90
    if ($sistole >= 140 || $diastole >= 90) {
        return "Hipertensi Tingkat 2";
    }

    // Stage 1: SBP 130-139 OR DBP 80-89
    if ($sistole >= 130 || $diastole >= 80) {
        return "Hipertensi Tingkat 1";
    }

    // Elevated: SBP 120-129 AND DBP < 80
    if ($sistole >= 120 && $sistole < 130 && $diastole < 80) {
        return "Pra-hipertensi (Elevated)";
    }

    // Normal: SBP <120 AND DBP <80
    return "Normal";
}

// 2) Gula Darah Sewaktu (Random) — mengikuti ADA & PERKENI pedoman Indonesia.
function kategori_gula_darah($gula_darah) {
    if ($gula_darah < 70) return "Hipoglikemia - Butuh tindakan segera";
    elseif ($gula_darah < 140) return "Normal";
    elseif ($gula_darah < 200) return "Kadar abnormal - Perlu evaluasi lebih lanjut";
    else return "Kadar tinggi - Kemungkinan diabetes, perlu konfirmasi";
}

// 3) Detak Jantung Istirahat (Resting Heart Rate)
function kategori_detak_jantung($detak_jantung) {
    // Catatan: atlet / orang sangat fit dapat punya resting <60 tanpa patologi.
    if ($detak_jantung < 60) return "Bradikardia - Jika bukan atlet, konsultasi dokter";
    elseif ($detak_jantung <= 100) return "Normal";
    else return "Takikardia - Konsultasi dokter";
}

// 4) Kolesterol: Total + HDL (NCEP ATP III)
function kategori_total_kolesterol($total_kolesterol) {
    if ($total_kolesterol < 200) return "Normal";
    elseif ($total_kolesterol < 240) return "Mendekati Batas Ambang - Perlu perhatian";
    else return "Tinggi - Berisiko tinggi penyakit jantung";
}

function kategori_hdl_kolesterol($hdl_kolesterol) {
    if ($hdl_kolesterol < 40) return "Rendah - Berisiko tinggi penyakit jantung.";
    elseif ($hdl_kolesterol < 60) return "Normal";
    else return "Tinggi - Pertahankan!";
}

function hitung_umur($tgl_lahir) {
    $tgl_lahir = new DateTime($tgl_lahir);
    $skrg = new DateTime('today');
    $umur = $skrg->diff($tgl_lahir)->y;
    return $umur;
}

function hitung_bmi($berat, $tinggi) {
    //tinggi diubah ke meter
    $tinggi_meter = $tinggi / 100;
    $tinggi_kuadrat = $tinggi_meter * $tinggi_meter;
    $bmi = $berat / $tinggi_kuadrat;
    return round($bmi,2);
}

function kategori_bmi($bmi) {
    if ($bmi < 18.5) return "Kurus";
    elseif ($bmi >= 18.5 && $bmi < 24.9) return "Normal";
    elseif ($bmi >= 25 && $bmi < 29.9) return "Gemuk";
    else return "Obesitas";
}

function hitung_FRS($umur, $gender, $sistole, $obat_hipertensi, $kolesterol, $hdl, $rokok_vape) {
    //nilai poin berdasarkan tabel FRS

    //FRS khusus buat umur 30 keatas
    if ($umur < 30) return "FRS hanya berlaku untuk umur 30 tahun ke atas.";

    $poin = 0;

    //1. umur
    if ($gender == 'Laki-laki') {
        //laki-laki
        if ($umur <= 34) $poin += -9;
        elseif ($umur <= 39) $poin += -4;
        elseif ($umur <= 44) $poin += 0;
        elseif ($umur <= 49) $poin += 3;
        elseif ($umur <= 54) $poin += 6;
        elseif ($umur <= 59) $poin += 8;
        elseif ($umur <= 64) $poin += 10;
        elseif ($umur <= 69) $poin += 11;
        elseif ($umur <= 74) $poin += 12;
        else $poin += 13;
    } else {
        //perempuan
        if ($umur <= 34) $poin += -7;
        elseif ($umur <= 39) $poin += -3;
        elseif ($umur <= 44) $poin += 0;
        elseif ($umur <= 49) $poin += 3;
        elseif ($umur <= 54) $poin += 6;
        elseif ($umur <= 59) $poin += 8;
        elseif ($umur <= 64) $poin += 10;
        elseif ($umur <= 69) $poin += 12;
        elseif ($umur <= 74) $poin += 14;
        else $poin += 16;
    }
    
    //2. rokok / vape
    if ($rokok_vape == 'Ya') {
        //perokok / vaper laki-laki
        if ($gender == 'Laki-laki') {
            if ($umur <= 39) $poin += 8;
            elseif ($umur <= 49) $poin += 5;
            elseif ($umur <= 59) $poin += 3;
            elseif ($umur <= 69) $poin += 1;
            else $poin += 1;
        //perokok / vaper perempuan
        } else {
            if ($umur <= 39) $poin += 9;
            elseif ($umur <= 49) $poin += 7;
            elseif ($umur <= 59) $poin += 4;
            elseif ($umur <= 69) $poin += 2;
            else $poin += 1;
        }
    }
    //klo gk rokok / vape yaudah, gk nambah poin

    //3. hdl kolesterol, gk peduli umur & gender, paling simple
    if ($hdl > 60) $poin += -1;
    elseif ($hdl >= 50) $poin += 0;
    elseif ($hdl >= 40) $poin += 1;
    else $poin += 2;

    //4. total kolesterol
    if ($gender == 'Laki-laki') {
        //laki-laki
        if ($umur <= 39) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 4;
            elseif ($kolesterol <= 239) $poin += 7;
            elseif ($kolesterol <= 279) $poin += 9;
            else $poin += 11;
        } elseif ($umur <= 49 ) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 3;
            elseif ($kolesterol <= 239) $poin += 5;
            elseif ($kolesterol <= 279) $poin += 6;
            else $poin += 8;
        } elseif ($umur <= 59 ) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 2;
            elseif ($kolesterol <= 239) $poin += 3;
            elseif ($kolesterol <= 279) $poin += 4;
            else $poin += 5;
        } elseif ($umur <= 69 ) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 1;
            elseif ($kolesterol <= 239) $poin += 1;
            elseif ($kolesterol <= 279) $poin += 2;
            else $poin += 3;
        } else {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 0;
            elseif ($kolesterol <= 239) $poin += 0;
            elseif ($kolesterol <= 279) $poin += 1;
            else $poin += 1;
        }
    } else {
        //perempuan
        if ($umur <= 39) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 4;
            elseif ($kolesterol <= 239) $poin += 8;
            elseif ($kolesterol <= 279) $poin += 11;
            else $poin += 13;
        } elseif ($umur <= 49 ) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 3;
            elseif ($kolesterol <= 239) $poin += 6;
            elseif ($kolesterol <= 279) $poin += 8;
            else $poin += 10;
        } elseif ($umur <= 59 ) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 2;
            elseif ($kolesterol <= 239) $poin += 4;
            elseif ($kolesterol <= 279) $poin += 5;
            else $poin += 7;
        } elseif ($umur <= 69 ) {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 1;
            elseif ($kolesterol <= 239) $poin += 2;
            elseif ($kolesterol <= 279) $poin += 3;
            else $poin += 4;
        } else {
            if ($kolesterol < 160) $poin += 0;
            elseif ($kolesterol <= 199) $poin += 1;
            elseif ($kolesterol <= 239) $poin += 1;
            elseif ($kolesterol <= 279) $poin += 2;
            else $poin += 2;
        }
    }

    //5. sistole & obat hipertensi
    if ($gender = 'Laki-laki') {
        //laki-laki
        if ($obat_hipertensi = 'Ya') {
            //dengan obat hipertensi
            if ($sistole < 120) $poin += 0;
            elseif ($sistole <= 129) $poin += 1;
            elseif ($sistole <= 139) $poin += 2;
            elseif ($sistole <= 159) $poin += 2;
            else $poin += 3;
        } else {
            //tanpa obat hipertensi
            if ($sistole < 120) $poin += 0;
            elseif ($sistole <= 129) $poin += 0;
            elseif ($sistole <= 139) $poin += 1;
            elseif ($sistole <= 159) $poin += 2;
            else $poin += 3;
        }
    } else {
        //perempuan
        if ($obat_hipertensi = 'Ya') {
            //dengan obat hipertensi
            if ($sistole < 120) $poin += 0;
            elseif ($sistole <= 129) $poin += 3;
            elseif ($sistole <= 139) $poin += 4;
            elseif ($sistole <= 159) $poin += 5;
            else $poin += 6;
        } else {
            //tanpa obat hipertensi
            if ($sistole < 120) $poin += 0;
            elseif ($sistole <= 129) $poin += 1;
            elseif ($sistole <= 139) $poin += 2;
            elseif ($sistole <= 159) $poin += 3;
            else $poin += 4;
        }
    }

    //6. konklusi: hitung risiko berdasarkan total poin
    if ($gender == 'Laki-laki') {
        //laki-laki
        if ($poin < 0) return "<1%";
        elseif ($poin <= 4) return "1%";
        elseif ($poin <= 6) return "2%";
        elseif ($poin == 7) return "3%";
        elseif ($poin == 8) return "4%";
        elseif ($poin == 9) return "5%";
        elseif ($poin == 10) return "6%";
        elseif ($poin == 11) return "8%";
        elseif ($poin == 12) return "10%";
        elseif ($poin == 13) return "12%";
        elseif ($poin == 14) return "16%";
        elseif ($poin == 15) return "20%";
        elseif ($poin == 16) return "25%";
        else return ">30%";
    } else {
        //perempuan
        if ($poin < 9) return "<1%";
        elseif ($poin <= 12) return "1%";
        elseif ($poin <= 14) return "2%";
        elseif ($poin == 15) return "3%";
        elseif ($poin == 16) return "4%";
        elseif ($poin == 17) return "5%";
        elseif ($poin == 18) return "6%";
        elseif ($poin == 19) return "8%";
        elseif ($poin == 20) return "11%";
        elseif ($poin == 21) return "14%";
        elseif ($poin == 22) return "17%";
        elseif ($poin == 23) return "22%";
        else return ">30%"; 
    }
}