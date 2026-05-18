<?php
session_start();
include __DIR__ . '/../config/koneksi.php';

if(!isset($_SESSION['id'])) {
    header('location:../login.php');
    exit;
}

$user_id = $_SESSION['id'];

/* =========================
   AMBIL PENGUMUMAN USER
========================= */
$query = mysqli_query($conn,"
    SELECT *
    FROM pengumuman
    WHERE pendaftar_id='$user_id'
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengumuman Seleksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body{
            background:#f4f7fb;
            font-family:Arial;
        }

        .card-box{
            border:none;
            border-radius:20px;
        }

        .header-box{
            background:linear-gradient(135deg,#0d3b66,#1d5fa8);
            color:white;
            border-radius:20px;
            padding:25px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-light bg-white shadow-sm px-4">
    <span class="navbar-brand fw-bold text-primary">
        Admission System
    </span>

    <div>
        Halo, <b><?= $_SESSION['nama']; ?></b>
        <a href="dashboard.php" class="btn btn-sm btn-secondary ms-2">Dashboard</a>
    </div>
</nav>

<div class="container mt-5">

    <!-- HEADER -->
    <div class="header-box mb-4">
        <h2 class="fw-bold">
            Pengumuman Hasil Seleksi
        </h2>
        <p class="mb-0">
            Cek status kelulusan kamu di sini
        </p>
    </div>

    <!-- CARD -->
    <div class="card shadow card-box">

        <div class="card-body p-4">

            <?php if(!$data){ ?>

                <div class="alert alert-warning">
                    ⏳ Pengumuman belum tersedia. Silakan cek kembali nanti.
                </div>

            <?php } else { ?>

                <!-- STATUS -->
                <?php if($data['hasil'] == 'lulus'){ ?>

                    <div class="alert alert-success">
                        🎉 SELAMAT! Anda DINYATAKAN <b>LULUS SELEKSI</b>
                    </div>

                <?php } else { ?>

                    <div class="alert alert-danger">
                        ❌ Maaf, Anda <b>tidak lulus seleksi</b>.
                    </div>

                <?php } ?>

                <!-- PESAN -->
                <h5 class="mt-3">Pesan dari Panitia:</h5>
                <p class="text-muted">
                    <?= $data['pesan']; ?>
                </p>

                <!-- TANGGAL -->
                <small class="text-secondary">
                    Dipublikasikan pada: <?= $data['dipublikasikan_pada']; ?>
                </small>

                <hr>

                <!-- ACTION -->
                <?php if($data['hasil'] == 'lulus'){ ?>
                    <a href="daftar_ulang.php" class="btn btn-danger">
                        Lanjut Daftar Ulang
                    </a>
                <?php } else { ?>
                    <a href="dashboard.php" class="btn btn-secondary">
                        Kembali ke Dashboard
                    </a>
                <?php } ?>

            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>