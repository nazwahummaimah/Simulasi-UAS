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
// UPDATE STATUS + PENGUMUMAN
// =========================
if(isset($_GET['aksi'])){

    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    // AMBIL DATA DOKUMEN
    $ambil = mysqli_query($conn,"
        SELECT *
        FROM dokumen
        WHERE id='$id'
    ");

    $dokumen = mysqli_fetch_array($ambil);

    $pendaftar_id = $dokumen['pendaftar_id'];

    // =========================
    // TERIMA
    // =========================
    if($aksi == 'terima'){

        mysqli_query($conn,"
            UPDATE dokumen
            SET status='Terverifikasi'
            WHERE id='$id'
        ");

        // HAPUS PENGUMUMAN LAMA
        mysqli_query($conn,"
            DELETE FROM pengumuman
            WHERE pendaftar_id='$pendaftar_id'
        ");

        // INSERT PENGUMUMAN
        mysqli_query($conn,"
            INSERT INTO pengumuman(
                pendaftar_id,
                hasil,
                pesan,
                dipublikasikan_pada
            )
            VALUES(
                '$pendaftar_id',
                'Lulus',
                'Selamat! Anda dinyatakan LULUS seleksi penerimaan mahasiswa baru.',
                NOW()
            )
        ");

    }

    // =========================
    // TOLAK
    // =========================
    elseif($aksi == 'tolak'){

        mysqli_query($conn,"
            UPDATE dokumen
            SET status='Ditolak'
            WHERE id='$id'
        ");

        // HAPUS PENGUMUMAN LAMA
        mysqli_query($conn,"
            DELETE FROM pengumuman
            WHERE pendaftar_id='$pendaftar_id'
        ");

        // INSERT PENGUMUMAN
        mysqli_query($conn,"
            INSERT INTO pengumuman(
                pendaftar_id,
                hasil,
                pesan,
                dipublikasikan_pada
            )
            VALUES(
                '$pendaftar_id',
                'Tidak Lulus',
                'Mohon maaf, Anda belum lolos seleksi penerimaan mahasiswa baru.',
                NOW()
            )
        ");
    }

    echo "
    <script>
        alert('Status berhasil diperbarui!');
        window.location='manage_pendaftar.php';
    </script>
    ";
}

// =========================
// QUERY DATA
// =========================
$query = mysqli_query($conn,"
    SELECT
        dokumen.*,
        pendaftar.nama_lengkap,
        pendaftar.no_hp,
        pendaftar.jurusan
    FROM dokumen
    JOIN pendaftar
    ON dokumen.pendaftar_id = pendaftar.id
    ORDER BY dokumen.id DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Review Berkas</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- ICON -->
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

/* TABLE */

.table-box{
    background:white;
    border-radius:25px;
    padding:30px;

    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

.table{
    vertical-align:middle;
}

.table thead{
    background:#2563eb;
    color:white;
}

/* FOTO */

.foto{
    width:60px;
    height:60px;
    border-radius:15px;
    object-fit:cover;
}

/* BADGE */

.badge-status{
    padding:10px 14px;
    border-radius:12px;
    font-size:13px;
    font-weight:600;
}

/* BUTTON */

.btn-action{
    border:none;
    padding:10px 14px;
    border-radius:12px;
    color:white;
    text-decoration:none;
    margin-right:5px;
    display:inline-block;
    transition:0.3s;
}

.btn-action:hover{
    transform:translateY(-3px);
    color:white;
}

.btn-view{
    background:#2563eb;
}

.btn-accept{
    background:#10b981;
}

.btn-reject{
    background:#ef4444;
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
        Pembayaran

    </a>

    <a href="pengumuman.php">

        <i class="fa-solid fa-bullhorn"></i>
        Pengumuman

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
                Review Berkas Mahasiswa
            </h3>

            <p class="text-muted">
                Verifikasi data dan dokumen mahasiswa baru
            </p>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-box">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Foto</th>

                        <th>Nama Lengkap</th>

                        <th>No HP</th>

                        <th>Jurusan</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                <?php
                $no = 1;

                while($data = mysqli_fetch_array($query)){
                ?>

                    <tr>

                        <!-- NO -->
                        <td>

                            <?php echo $no++; ?>

                        </td>

                        <!-- FOTO -->
                        <td>

                            <img src="../uploads/dokumen/<?php echo $data['foto']; ?>"
                                 class="foto">

                        </td>

                        <!-- NAMA -->
                        <td>

                            <?php echo $data['nama_lengkap']; ?>

                        </td>

                        <!-- HP -->
                        <td>

                            <?php echo $data['no_hp']; ?>

                        </td>

                        <!-- JURUSAN -->
                        <td>

                            <?php echo $data['jurusan']; ?>

                        </td>

                        <!-- STATUS -->
                        <td>

                            <?php

                            if($data['status'] == 'Menunggu Verifikasi'){

                                echo "
                                <span class='badge bg-warning text-dark badge-status'>
                                    Menunggu
                                </span>
                                ";

                            } elseif($data['status'] == 'Terverifikasi'){

                                echo "
                                <span class='badge bg-success badge-status'>
                                    Diterima
                                </span>
                                ";

                            } else {

                                echo "
                                <span class='badge bg-danger badge-status'>
                                    Ditolak
                                </span>
                                ";
                            }

                            ?>

                        </td>

                        <!-- AKSI -->
                        <td>

                            <!-- DETAIL -->
                            <a href="detail_pendaftar.php?id=<?php echo $data['id']; ?>"
                               class="btn-action btn-view">

                               <i class="fa-solid fa-eye"></i>

                            </a>

                            <!-- TERIMA -->
                            <a href="?aksi=terima&id=<?php echo $data['id']; ?>"
                               onclick="return confirm('Terima mahasiswa ini?')"
                               class="btn-action btn-accept">

                               <i class="fa-solid fa-check"></i>

                            </a>

                            <!-- TOLAK -->
                            <a href="?aksi=tolak&id=<?php echo $data['id']; ?>"
                               onclick="return confirm('Tolak mahasiswa ini?')"
                               class="btn-action btn-reject">

                               <i class="fa-solid fa-xmark"></i>

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>