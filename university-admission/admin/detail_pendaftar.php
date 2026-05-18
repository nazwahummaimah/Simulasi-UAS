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
// AMBIL ID
// =========================
$id = $_GET['id'];

// =========================
// QUERY DETAIL
// =========================
$query = mysqli_query($conn,"
    SELECT
        dokumen.*,
        pendaftar.*
    FROM dokumen
    JOIN pendaftar
    ON dokumen.pendaftar_id = pendaftar.id
    WHERE dokumen.id='$id'
");

$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Detail Pendaftar</title>

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

body{
    background:#eef2ff;
    font-family:'Poppins',sans-serif;
}

.card-box{
    background:white;
    border-radius:25px;
    padding:35px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

.title{
    font-weight:700;
    margin-bottom:30px;
}

.label{
    font-weight:600;
    color:#374151;
}

.value{
    color:#6b7280;
    margin-bottom:20px;
}

.foto{
    width:170px;
    height:170px;
    border-radius:20px;
    object-fit:cover;
    border:5px solid #eef2ff;
}

.btn-modern{
    border:none;
    padding:12px 18px;
    border-radius:14px;
    color:white;
    text-decoration:none;
    margin-right:10px;
    display:inline-block;
    transition:0.3s;
}

.btn-modern:hover{
    transform:translateY(-3px);
    color:white;
}

.btn-green{
    background:#10b981;
}

.btn-red{
    background:#ef4444;
}

.btn-blue{
    background:#2563eb;
}

.doc-btn{
    width:100%;
    padding:14px;
    border-radius:16px;
    text-decoration:none;
    color:white;
    display:block;
    text-align:center;
    font-weight:600;
    transition:0.3s;
}

.doc-btn:hover{
    transform:translateY(-3px);
    color:white;
}

.bg1{
    background:#2563eb;
}

.bg2{
    background:#10b981;
}

.bg3{
    background:#f59e0b;
}

.bg4{
    background:#8b5cf6;
}

</style>

</head>

<body>

<div class="container py-5">

    <div class="card-box">

        <h2 class="title">
            Detail Pendaftar Mahasiswa
        </h2>

        <div class="row">

            <!-- FOTO -->
            <div class="col-md-3 text-center mb-4">

                <img src="../uploads/dokumen/<?php echo $data['foto']; ?>"
                     class="foto">

            </div>

            <!-- BIODATA -->
            <div class="col-md-9">

                <div class="row">

                    <div class="col-md-6">

                        <div class="label">
                            Nama Lengkap
                        </div>

                        <div class="value">
                            <?php echo $data['nama_lengkap']; ?>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="label">
                            Nomor Pendaftaran
                        </div>

                        <div class="value">
                            <?php echo $data['nomor_pendaftaran']; ?>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="label">
                            Tanggal Lahir
                        </div>

                        <div class="value">
                            <?php echo $data['tanggal_lahir']; ?>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="label">
                            Nomor HP
                        </div>

                        <div class="value">
                            <?php echo $data['no_hp']; ?>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="label">
                            Jurusan
                        </div>

                        <div class="value">
                            <?php echo $data['jurusan']; ?>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="label">
                            Asal Sekolah
                        </div>

                        <div class="value">
                            <?php echo $data['asal_sekolah']; ?>
                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="label">
                            Alamat
                        </div>

                        <div class="value">
                            <?php echo $data['alamat']; ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <hr class="my-5">

        <!-- DOKUMEN -->
        <h4 class="mb-4">
            Dokumen Upload
        </h4>

        <div class="row">

            <!-- KTP -->
            <div class="col-md-3 mb-3">

                <a href="../uploads/dokumen/<?php echo $data['kartu_identitas']; ?>"
                   target="_blank"
                   class="doc-btn bg1">

                   <i class="fa-solid fa-id-card"></i>
                   Kartu Identitas

                </a>

            </div>

            <!-- IJAZAH -->
            <div class="col-md-3 mb-3">

                <a href="../uploads/dokumen/<?php echo $data['ijazah']; ?>"
                   target="_blank"
                   class="doc-btn bg2">

                   <i class="fa-solid fa-file"></i>
                   Ijazah

                </a>

            </div>

            <!-- TRANSKRIP -->
            <div class="col-md-3 mb-3">

                <a href="../uploads/dokumen/<?php echo $data['transkrip_nilai']; ?>"
                   target="_blank"
                   class="doc-btn bg3">

                   <i class="fa-solid fa-file-lines"></i>
                   Transkrip Nilai

                </a>

            </div>

            <!-- FOTO -->
            <div class="col-md-3 mb-3">

                <a href="../uploads/dokumen/<?php echo $data['foto']; ?>"
                   target="_blank"
                   class="doc-btn bg4">

                   <i class="fa-solid fa-image"></i>
                   Pas Foto

                </a>

            </div>

        </div>

        <hr class="my-5">

        <!-- STATUS -->
        <h4 class="mb-4">
            Verifikasi Seleksi
        </h4>

        <!-- TERIMA -->
        <a href="manage_pendaftar.php?aksi=terima&id=<?php echo $data['id']; ?>"
           class="btn-modern btn-green"
           onclick="return confirm('Terima mahasiswa ini?')">

           <i class="fa-solid fa-check"></i>
           Terima

        </a>

        <!-- TOLAK -->
        <a href="manage_pendaftar.php?aksi=tolak&id=<?php echo $data['id']; ?>"
           class="btn-modern btn-red"
           onclick="return confirm('Tolak mahasiswa ini?')">

           <i class="fa-solid fa-xmark"></i>
           Tolak

        </a>

        <!-- KEMBALI -->
        <a href="manage_pendaftar.php"
           class="btn-modern btn-blue">

           <i class="fa-solid fa-arrow-left"></i>
           Kembali

        </a>

    </div>

</div>

</body>
</html>