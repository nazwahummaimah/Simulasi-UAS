<?php
session_start();
include '../config/koneksi.php';

// =========================
// CEK LOGIN
// =========================
if(!isset($_SESSION['id'])){
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['id'];

// =========================
// AMBIL DATA PENDAFTAR
// =========================
$pendaftar = mysqli_query($conn,"
    SELECT * FROM pendaftar
    WHERE user_id='$user_id'
");

$data_pendaftar = mysqli_fetch_array($pendaftar);

$pendaftar_id = $data_pendaftar['id'];

// =========================
// CEK SUDAH UPLOAD
// =========================
$cek = mysqli_query($conn,"
    SELECT * FROM pembayaran
    WHERE pendaftar_id='$pendaftar_id'
");

$sudah_upload = mysqli_num_rows($cek);

// =========================
// PROSES UPLOAD
// =========================
if(isset($_POST['submit'])){

    $tanggal = date('Y-m-d');

    $nama_file = $_FILES['bukti']['name'];
    $tmp = $_FILES['bukti']['tmp_name'];

    $upload = move_uploaded_file(
        $tmp,
        "../uploads/pembayaran/".$nama_file
    );

    if($upload){

        mysqli_query($conn,"
            INSERT INTO pembayaran(
                pendaftar_id,
                bukti,
                tanggal,
                status
            )
            VALUES(
                '$pendaftar_id',
                '$nama_file',
                '$tanggal',
                'Menunggu'
            )
        ");

        echo "
        <script>
            alert('Pembayaran berhasil dikirim!');
            window.location='daftar_ulang.php';
        </script>
        ";

    } else {

        echo "
        <script>
            alert('Upload gagal!');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Daftar Ulang</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- FONT AWESOME -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:#eef2ff;
}

.card-box{
    border:none;
    border-radius:30px;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(0,0,0,0.08);
}

.header-box{
    background:linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    );

    color:white;
    padding:35px;
}

.content-box{
    padding:35px;
}

.form-control{
    border-radius:15px;
    padding:14px;
}

.btn-modern{
    border:none;
    border-radius:15px;
    padding:14px;
    font-weight:600;
}

.payment-info{
    background:#f8fafc;
    border-radius:20px;
    padding:25px;
}

.badge-status{
    padding:12px 18px;
    border-radius:15px;
    font-size:14px;
}

</style>

</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card card-box">

                <!-- HEADER -->
                <div class="header-box">

                    <h2 class="fw-bold">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        Daftar Ulang Mahasiswa
                    </h2>

                    <p class="mt-2 mb-0">
                        Upload bukti pembayaran untuk proses daftar ulang.
                    </p>

                </div>

                <!-- CONTENT -->
                <div class="content-box">

                    <!-- INFO PEMBAYARAN -->
                    <div class="payment-info mb-4">

                        <h5 class="fw-bold mb-3">
                            Informasi Pembayaran
                        </h5>

                        <p class="mb-2">
                            <b>Bank :</b> BCA
                        </p>

                        <p class="mb-2">
                            <b>No Rekening :</b> 1234567890
                        </p>

                        <p class="mb-2">
                            <b>Atas Nama :</b> Universitas Admission
                        </p>

                        <p class="mb-0">
                            <b>Total Pembayaran :</b>
                            Rp 2.500.000
                        </p>

                    </div>

                    <?php
                    if($sudah_upload > 0){

                        $bayar = mysqli_fetch_array($cek);
                    ?>

                    <!-- STATUS -->
                    <div class="alert alert-success rounded-4">

                        <h5 class="fw-bold">
                            Pembayaran Sudah Dikirim
                        </h5>

                        <p class="mb-2">
                            Status Pembayaran:
                        </p>

                        <?php

                        if($bayar['status'] == 'Menunggu'){

                            echo "
                            <span class='badge bg-warning text-dark badge-status'>
                                Menunggu Verifikasi
                            </span>
                            ";

                        } elseif($bayar['status'] == 'Terverifikasi'){

                            echo "
                            <span class='badge bg-success badge-status'>
                                Pembayaran Terverifikasi
                            </span>
                            ";

                        } else {

                            echo "
                            <span class='badge bg-danger badge-status'>
                                Pembayaran Ditolak
                            </span>
                            ";
                        }

                        ?>

                    </div>

                    <?php } else { ?>

                    <!-- FORM -->
                    <form method="POST"
                          enctype="multipart/form-data">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Upload Bukti Pembayaran

                            </label>

                            <input type="file"
                                   name="bukti"
                                   class="form-control"
                                   required>

                        </div>

                        <button type="submit"
                                name="submit"
                                class="btn btn-primary btn-modern w-100">

                            <i class="fa-solid fa-upload"></i>
                            Upload Pembayaran

                        </button>

                    </form>

                    <?php } ?>

                    <!-- BACK -->
                    <div class="text-center mt-4">

                        <a href="dashboard.php"
                           class="btn btn-outline-primary rounded-pill px-4">

                           Kembali ke Dashboard

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>