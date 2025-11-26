<?php
include 'utility/session.php';
include 'utility/connect.php';

// cek dulu, user udah login apa belum
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$pesan = "";

// proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $berat          = $_POST['berat'] ?? '';
    $sistole        = $_POST['sistole'] ?? '';
    $diastole       = $_POST['diastole'] ?? '';
    $gula_darah     = $_POST['gula_darah'] ?? '';
    $detak_jantung  = $_POST['detak_jantung'] ?? '';
    $catatan_harian = $_POST['catatan_harian'] ?? '';
    $total_kolesterol = $_POST['total_kolesterol'] ?? '';
    $hdl_kolesterol   = $_POST['hdl_kolesterol'] ?? '';

    // validasi sederhana
    if ($berat === '' || $sistole === '' || $diastole === '' || $gula_darah === '' || $detak_jantung === '') {
        $pesan = "Semua field kecuali Catatan Harian wajib diisi.";
    } else {

        $sql = "INSERT INTO catatan 
                    (id_user, created_at, berat, sistole, diastole, gula_darah, detak_jantung, catatan_harian, total_kolesterol, hdl_kolesterol)
                VALUES 
                    (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param(
                $stmt,
                "diiiiisii",
                $id_user,
                $berat,
                $sistole,
                $diastole,
                $gula_darah,
                $detak_jantung,
                $catatan_harian,
                $total_kolesterol,
                $hdl_kolesterol
            );

            if (mysqli_stmt_execute($stmt)) {
                // berhasil insert, bisa diarahkan balik ke index.php
                header("Location: index.php?status=catatan_berhasil");
                exit;
            } else {
                $pesan = "Gagal menambah catatan: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            $pesan = "Gagal mempersiapkan query.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Catatan Kesehatan</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    >
    <style>
        body {
            background-color: #f5f7fb;
        }
        .card {
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Tambah Catatan Kesehatan</h5>
                </div>

                <div class="card-body">

                    <?php if ($pesan !== "") { ?>
                        <div class="alert alert-danger py-2">
                            <?php echo htmlspecialchars($pesan); ?>
                        </div>
                    <?php } ?>

                    <form action="" method="post">
                        <!-- Berat -->
                        <div class="mb-3">
                            <label class="form-label" for="berat">Berat Badan (kg):</label>
                            <input type="number" step="0.1" class="form-control" id="berat" name="berat" required>
                        </div>

                        <!-- Sistolik -->
                        <div class="mb-3">
                            <label class="form-label" for="sistole">Tekanan Darah Sistolik (mmHg):</label>
                            <input type="number" class="form-control" id="sistole" name="sistole" required>
                        </div>

                        <!-- Diastolik -->
                        <div class="mb-3">
                            <label class="form-label" for="diastole">Tekanan Darah Diastolik (mmHg):</label>
                            <input type="number" class="form-control" id="diastole" name="diastole" required>
                        </div>

                        <!-- Gula darah -->
                        <div class="mb-3">
                            <label class="form-label" for="gula_darah">Gula Darah (mg/dL):</label>
                            <input type="number" class="form-control" id="gula_darah" name="gula_darah" required>
                        </div>

                        <!-- Detak jantung -->
                        <div class="mb-3">
                            <label class="form-label" for="detak_jantung">Detak Jantung (bpm):</label>
                            <input type="number" class="form-control" id="detak_jantung" name="detak_jantung" required>
                        </div>

                        <!-- Total Kolesterol -->
                        <div class="mb-3">
                            <label class="form-label" for="total_kolesterol">
                                Kolesterol Total (mg/dL) <small class="text-muted"></small>:
                            </label>
                            <input type="number" class="form-control" id="total_kolesterol" name="total_kolesterol" 
                                   min="0" step="1" placeholder="contoh: 180" required>
                        </div>

                        <!-- HDL Kolesterol -->
                        <div class="mb-3">
                            <label class="form-label" for="hdl_kolesterol">
                                HDL Kolesterol (mg/dL) <small class="text-muted"></small>:
                            </label>
                            <input type="number" class="form-control" id="hdl_kolesterol" name="hdl_kolesterol" 
                                   min="0" step="1" placeholder="contoh: 55" required>
                        </div>

                        <!-- Catatan harian -->
                        <div class="mb-3">
                            <label class="form-label" for="catatan_harian">Catatan Harian (opsional):</label>
                            <textarea class="form-control" id="catatan_harian" name="catatan_harian" rows="4"></textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                            </div>
                            <a href="index.php" class="btn btn-outline-dark btn-sm">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>