<?php
session_start();
include '../config/koneksi.php';

// =========================
// CEK LOGIN
// =========================
if(!isset($_SESSION['admin_id'])){
    header('location:login.php');
    exit;
}

// =========================
// HITUNG DATA
// =========================
$total_pendaftar = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT * FROM pendaftar
    ")
);

$total_menunggu = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT * FROM dokumen
        WHERE status='Menunggu Verifikasi'
    ")
);

$total_diterima = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT * FROM dokumen
        WHERE status='Terverifikasi'
    ")
);

$total_ditolak = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT * FROM dokumen
        WHERE status='Ditolak'
    ")
);

// =========================
// PEMBAYARAN
// =========================
$total_pembayaran = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT * FROM pembayaran
    ")
);

$total_belum_verif = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT * FROM pembayaran
        WHERE status='Menunggu'
    ")
);

// =========================
// PENGUMUMAN
// =========================
$total_pengumuman = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT * FROM pengumuman
    ")
);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

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
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#eef2ff;
}

/* SIDEBAR */

.sidebar{
    width:280px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;

    background:linear-gradient(
        180deg,
        #111827,
        #1e40af
    );

    padding:30px 20px;
}

.logo{
    color:white;
    font-size:28px;
    font-weight:700;
    margin-bottom:50px;
}

.logo i{
    color:#60a5fa;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:15px;

    text-decoration:none;
    color:#d1d5db;

    padding:15px 18px;

    border-radius:18px;

    margin-bottom:15px;

    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.1);
    color:white;
    transform:translateX(5px);
}

.sidebar a i{
    font-size:18px;
}

/* MAIN */

.main{
    margin-left:280px;
    padding:35px;
}

/* TOPBAR */

.topbar{
    background:white;
    padding:25px 30px;

    border-radius:25px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    box-shadow:0 10px 25px rgba(0,0,0,0.05);

    margin-bottom:35px;
}

.topbar h3{
    font-weight:700;
}

.topbar p{
    color:#6b7280;
}

.profile{
    width:55px;
    height:55px;
    border-radius:50%;
}

/* CARD */

.dashboard-card{
    border:none;
    border-radius:28px;
    overflow:hidden;
    position:relative;
    color:white;
    transition:0.3s;
}

.dashboard-card:hover{
    transform:translateY(-5px);
}

.dashboard-card .card-body{
    padding:30px;
}

.dashboard-card h1{
    font-size:42px;
    font-weight:700;
}

.dashboard-card p{
    margin-top:10px;
    font-size:15px;
}

.dashboard-card i{
    position:absolute;
    right:20px;
    bottom:20px;
    font-size:65px;
    opacity:0.15;
}

/* WARNA */

.card-blue{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
}

.card-green{
    background:linear-gradient(135deg,#10b981,#059669);
}

.card-red{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

.card-yellow{
    background:linear-gradient(135deg,#f59e0b,#d97706);
}

.card-purple{
    background:linear-gradient(135deg,#8b5cf6,#7c3aed);
}

.card-dark{
    background:linear-gradient(135deg,#374151,#111827);
}

/* INFO BOX */

.info-box{
    margin-top:35px;
    background:white;
    border-radius:28px;
    padding:35px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

.info-box h4{
    font-weight:700;
    margin-bottom:15px;
}

.info-box p{
    color:#6b7280;
    line-height:1.8;
}

.quick-btn{
    margin-top:20px;
}

.quick-btn a{
    text-decoration:none;
    padding:12px 20px;
    border-radius:14px;
    margin-right:10px;
    display:inline-block;
    color:white;
}

.btn-blue{
    background:#2563eb;
}

.btn-green{
    background:#10b981;
}

.btn-purple{
    background:#8b5cf6;
}

</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">

        <i class="fa-solid fa-graduation-cap"></i>
        UniAdmin

    </div>

    <a href="dashboard.php">

        <i class="fa-solid fa-chart-line"></i>
        Dashboard

    </a>

    <a href="manage_pendaftar.php">

        <i class="fa-solid fa-users"></i>
        Review Berkas

    </a>

    <a href="pembayaran.php">

        <i class="fa-solid fa-money-check-dollar"></i>
        Verifikasi Pembayaran

    </a>

    <a href="pengumuman.php">

        <i class="fa-solid fa-bullhorn"></i>
        Kelola Pengumuman

    </a>

    <a href="logout.php">

        <i class="fa-solid fa-right-from-bracket"></i>
        Logout

    </a>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>

            <h3>
                Selamat Datang,
                <?php echo $_SESSION['admin_nama']; ?>
            </h3>

            <p>
                University Admission & Enrollment System
            </p>

        </div>

        <img src="https://i.imgur.com/8RKXAIV.png"
             class="profile">

    </div>

    <!-- ROW 1 -->
    <div class="row">

        <!-- PENDAFTAR -->
        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-blue shadow">

                <div class="card-body">

                    <h1>
                        <?php echo $total_pendaftar; ?>
                    </h1>

                    <p>Total Pendaftar</p>

                    <i class="fa-solid fa-user-graduate"></i>

                </div>

            </div>

        </div>

        <!-- MENUNGGU -->
        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-yellow shadow">

                <div class="card-body">

                    <h1>
                        <?php echo $total_menunggu; ?>
                    </h1>

                    <p>Review Berkas</p>

                    <i class="fa-solid fa-clock"></i>

                </div>

            </div>

        </div>

        <!-- DITERIMA -->
        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-green shadow">

                <div class="card-body">

                    <h1>
                        <?php echo $total_diterima; ?>
                    </h1>

                    <p>Diterima</p>

                    <i class="fa-solid fa-circle-check"></i>

                </div>

            </div>

        </div>

        <!-- DITOLAK -->
        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-red shadow">

                <div class="card-body">

                    <h1>
                        <?php echo $total_ditolak; ?>
                    </h1>

                    <p>Ditolak</p>

                    <i class="fa-solid fa-circle-xmark"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- ROW 2 -->
    <div class="row">

        <!-- PEMBAYARAN -->
        <div class="col-md-6 mb-4">

            <div class="card dashboard-card card-purple shadow">

                <div class="card-body">

                    <h1>
                        <?php echo $total_pembayaran; ?>
                    </h1>

                    <p>Total Pembayaran Masuk</p>

                    <i class="fa-solid fa-money-bill-wave"></i>

                </div>

            </div>

        </div>

        <!-- PENGUMUMAN -->
        <div class="col-md-6 mb-4">

            <div class="card dashboard-card card-dark shadow">

                <div class="card-body">

                    <h1>
                        <?php echo $total_pengumuman; ?>
                    </h1>

                    <p>Total Pengumuman</p>

                    <i class="fa-solid fa-bullhorn"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- INFO -->
    <div class="info-box">

        <h4>
            Sistem Administrasi Penerimaan Mahasiswa
        </h4>

        <p>
            Dashboard admin digunakan untuk melakukan
            review berkas pendaftaran mahasiswa,
            approve/reject seleksi,
            verifikasi pembayaran,
            serta mengelola pengumuman resmi universitas.
        </p>

        <div class="quick-btn">

            <a href="manage_pendaftar.php"
               class="btn-blue">

               Review Berkas

            </a>

            <a href="pembayaran.php"
               class="btn-green">

               Verifikasi Pembayaran

            </a>

            <a href="manage_pengumuman.php"
               class="btn-purple">

               Kelola Pengumuman

            </a>

        </div>

    </div>

</div>

</body>
</html>