<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['id'])) {
    header('location:login.php');
}

// =========================
// AMBIL PENGUMUMAN
// =========================
$pengumuman = mysqli_query($conn,"
    SELECT * FROM pengumuman
    ORDER BY id DESC
    LIMIT 5
");

// =========================
// CEK PROGRESS
// =========================
$user_id = $_SESSION['id'];

$progress = 0;

// FORM
$cek_form = mysqli_query($conn,"
    SELECT * FROM pendaftar
    WHERE user_id='$user_id'
");

if(mysqli_num_rows($cek_form) > 0){
    $progress += 50;
}

// DOKUMEN
$cek_dokumen = mysqli_query($conn,"
    SELECT * FROM dokumen
    JOIN pendaftar
    ON dokumen.pendaftar_id = pendaftar.id
    WHERE pendaftar.user_id='$user_id'
");

if(mysqli_num_rows($cek_dokumen) > 0){
    $progress += 50;
}

// STATUS
$status_progress = '';

if($progress == 0){

    $status_progress = 'Belum Memulai';

} elseif($progress == 50){

    $status_progress = 'Pendaftaran Sebagian';

} else {

    $status_progress = 'Pendaftaran Lengkap';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Mahasiswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#eef3ff;
        }

        .welcome-box{
            background:linear-gradient(
                135deg,
                #1e3a8a,
                #2563eb,
                #3b82f6
            );

            color:white;
            border-radius:30px;
            padding:45px;
            position:relative;
            overflow:hidden;

            box-shadow:0 15px 35px rgba(37,99,235,0.25);
        }

        .menu-card{
            border:none;
            border-radius:25px;
            transition:0.4s;
            overflow:hidden;
            background:white;
        }

        .menu-card:hover{
            transform:translateY(-8px);
            box-shadow:0 15px 35px rgba(0,0,0,0.08);
        }

        .menu-card .card-body{
            padding:30px;
        }

        .icon-box{
            width:75px;
            height:75px;
            border-radius:22px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:30px;
            margin-bottom:20px;
        }

        .status-box{
            background:white;
            border-radius:25px;
            padding:30px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
        }

        .announcement-card{
            border:none;
            border-radius:22px;
            overflow:hidden;
            transition:0.3s;
        }

        .announcement-card:hover{
            transform:translateY(-4px);
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
        }

        .announcement-header{
            background:linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            color:white;
            padding:18px 22px;
        }

        .announcement-body{
            padding:22px;
            background:white;
        }

        .badge-news{
            background:#dbeafe;
            color:#2563eb;
            padding:8px 14px;
            border-radius:50px;
            font-size:12px;
            font-weight:600;
        }

        .progress{
            height:28px;
            border-radius:20px;
            overflow:hidden;
        }

        .btn-modern{
            border:none;
            border-radius:12px;
            padding:10px 18px;
            font-weight:500;
        }

    </style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-3">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold text-primary" href="#">
            <i class="fa-solid fa-graduation-cap"></i>
            Admission System
        </a>

        <div class="d-flex align-items-center">

            <span class="me-3">

                Halo,
                <b><?php echo $_SESSION['nama']; ?></b>

            </span>

            <a href="logout.php"
               class="btn btn-danger btn-modern">

               <i class="fa-solid fa-right-from-bracket"></i>
               Logout

            </a>

        </div>

    </div>

</nav>

<div class="container py-5">

    <!-- WELCOME -->
    <div class="welcome-box mb-5">

        <h1 class="fw-bold">
            Selamat Datang 👋
        </h1>

        <p class="mt-3 fs-5 mb-0">

            Selamat datang di sistem penerimaan mahasiswa baru.
            Lengkapi seluruh proses admission kamu dengan mudah.

        </p>

    </div>

    <!-- MENU -->
    <div class="row">

        <!-- FORM -->
        <div class="col-md-3 mb-4">

            <div class="card menu-card shadow-sm">

                <div class="card-body">

                    <div class="icon-box bg-primary text-white">

                        <i class="fa-solid fa-file-lines"></i>

                    </div>

                    <h5 class="fw-bold">
                        Form Pendaftaran
                    </h5>

                    <p class="text-muted">
                        Lengkapi data diri mahasiswa.
                    </p>

                    <a href="form_pendaftaran.php"
                       class="btn btn-primary btn-modern">

                       Isi Form

                    </a>

                </div>

            </div>

        </div>

        <!-- UPLOAD -->
        <div class="col-md-3 mb-4">

            <div class="card menu-card shadow-sm">

                <div class="card-body">

                    <div class="icon-box bg-success text-white">

                        <i class="fa-solid fa-upload"></i>

                    </div>

                    <h5 class="fw-bold">
                        Upload Dokumen
                    </h5>

                    <p class="text-muted">
                        Upload berkas persyaratan.
                    </p>

                    <a href="upload_dokumen.php"
                       class="btn btn-success btn-modern">

                       Upload

                    </a>

                </div>

            </div>

        </div>

        <!-- STATUS -->
        <div class="col-md-3 mb-4">

            <div class="card menu-card shadow-sm">

                <div class="card-body">

                    <div class="icon-box bg-warning text-white">

                        <i class="fa-solid fa-chart-line"></i>

                    </div>

                    <h5 class="fw-bold">
                        Status Seleksi
                    </h5>

                    <p class="text-muted">
                        Lihat hasil admission kamu.
                    </p>

                    <a href="status_seleksi.php"
                       class="btn btn-warning text-white btn-modern">

                       Lihat Status

                    </a>

                </div>

            </div>

        </div>

        <!-- DAFTAR ULANG -->
        <div class="col-md-3 mb-4">

            <div class="card menu-card shadow-sm">

                <div class="card-body">

                    <div class="icon-box bg-danger text-white">

                        <i class="fa-solid fa-repeat"></i>

                    </div>

                    <h5 class="fw-bold">
                        Daftar Ulang
                    </h5>

                    <p class="text-muted">
                        Konfirmasi ulang setelah diterima.
                    </p>

                    <a href="daftar_ulang.php"
                       class="btn btn-danger btn-modern">

                       Daftar Ulang

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- PROGRESS -->
    <div class="status-box mb-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">

                <i class="fa-solid fa-chart-simple text-primary"></i>
                Progress Pendaftaran

            </h4>

            <span class="badge-news">

                <?php echo $status_progress; ?>

            </span>

        </div>

        <div class="progress">

            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                 style="width:<?php echo $progress; ?>%">

                 <?php echo $progress; ?>%

            </div>

        </div>

        <div class="row mt-4">

            <!-- FORM -->
            <div class="col-md-6 mb-3">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h6 class="fw-bold">
                                    Form Pendaftaran
                                </h6>

                                <small class="text-muted">

                                    Lengkapi biodata mahasiswa

                                </small>

                            </div>

                            <?php
                            if(mysqli_num_rows($cek_form) > 0){
                            ?>

                                <span class="badge bg-success p-2">

                                    <i class="fa-solid fa-check"></i>
                                    Selesai

                                </span>

                            <?php } else { ?>

                                <span class="badge bg-danger p-2">

                                    <i class="fa-solid fa-xmark"></i>
                                    Belum

                                </span>

                            <?php } ?>

                        </div>

                    </div>

                </div>

            </div>

            <!-- DOKUMEN -->
            <div class="col-md-6 mb-3">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h6 class="fw-bold">
                                    Upload Dokumen
                                </h6>

                                <small class="text-muted">

                                    Upload seluruh persyaratan

                                </small>

                            </div>

                            <?php
                            if(mysqli_num_rows($cek_dokumen) > 0){
                            ?>

                                <span class="badge bg-success p-2">

                                    <i class="fa-solid fa-check"></i>
                                    Selesai

                                </span>

                            <?php } else { ?>

                                <span class="badge bg-danger p-2">

                                    <i class="fa-solid fa-xmark"></i>
                                    Belum

                                </span>

                            <?php } ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- PENGUMUMAN -->
    <div class="status-box">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">

                <i class="fa-solid fa-bullhorn text-primary"></i>
                Pengumuman Terbaru

            </h4>

        </div>

        <?php
        if(mysqli_num_rows($pengumuman) > 0){
            while($p = mysqli_fetch_array($pengumuman)){
        ?>

        <div class="announcement-card shadow-sm mb-4">

            <div class="announcement-header">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0 fw-bold">

                        <?php echo $p['judul']; ?>

                    </h5>

                    <small>

                        <?php
                        echo date(
                            'd M Y',
                            strtotime($p['tanggal'])
                        );
                        ?>

                    </small>

                </div>

            </div>

            <div class="announcement-body">

                <p class="text-muted mb-0"
                   style="line-height:1.9;">

                    <?php echo $p['isi']; ?>

                </p>

            </div>

        </div>

        <?php
            }
        } else {
        ?>

        <div class="alert alert-info rounded-4">

            Belum ada pengumuman terbaru.

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>