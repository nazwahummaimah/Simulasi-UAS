<?php
session_start();
include '../config/koneksi.php';

// ============================
// CEK LOGIN
// ============================
if(!isset($_SESSION['id'])){
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['id'];

// ============================
// AMBIL DATA PENDAFTAR
// ============================
$query_pendaftar = mysqli_query($conn,"
    SELECT * FROM pendaftar
    WHERE user_id='$user_id'
");

$data_pendaftar = mysqli_fetch_array($query_pendaftar);

if(!$data_pendaftar){

    echo "
    <script>
        alert('Data pendaftaran tidak ditemukan!');
        window.location='dashboard.php';
    </script>
    ";

    exit;
}

$pendaftar_id = $data_pendaftar['id'];

// ============================
// AMBIL DATA DOKUMEN
// ============================
$query_dokumen = mysqli_query($conn,"
    SELECT *
    FROM dokumen
    WHERE pendaftar_id='$pendaftar_id'
    ORDER BY id DESC
");

$data = mysqli_fetch_array($query_dokumen);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Status Seleksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f4f7fb;
        }

        .status-card{
            border:none;
            border-radius:25px;
        }

    </style>

</head>

<body>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow status-card">

                <div class="card-body p-5">

                    <h2 class="fw-bold mb-4">
                        Status Seleksi
                    </h2>

                    <?php if($data){ ?>

                        <table class="table table-bordered align-middle">

                            <tr>

                                <th width="35%">
                                    Status Seleksi
                                </th>

                                <td>

                                    <?php

                                    if($data['status'] == 'Menunggu Verifikasi'){

                                        echo "
                                        <span class='badge bg-warning text-dark p-2'>
                                            Menunggu Verifikasi
                                        </span>
                                        ";

                                    }elseif($data['status'] == 'Terverifikasi'){

                                        echo "
                                        <span class='badge bg-success p-2'>
                                            Lolos Seleksi
                                        </span>
                                        ";

                                    }else{

                                        echo "
                                        <span class='badge bg-danger p-2'>
                                            Ditolak
                                        </span>
                                        ";
                                    }

                                    ?>

                                </td>

                            </tr>

                            <tr>

                                <th>Pas Foto</th>

                                <td>

                                    <a href="../uploads/dokumen/<?php echo $data['foto']; ?>"
                                       target="_blank">

                                        Lihat File

                                    </a>

                                </td>

                            </tr>

                            <tr>

                                <th>Kartu Identitas</th>

                                <td>

                                    <a href="../uploads/dokumen/<?php echo $data['kartu_identitas']; ?>"
                                       target="_blank">

                                        Lihat File

                                    </a>

                                </td>

                            </tr>

                            <tr>

                                <th>Ijazah</th>

                                <td>

                                    <a href="../uploads/dokumen/<?php echo $data['ijazah']; ?>"
                                       target="_blank">

                                        Lihat File

                                    </a>

                                </td>

                            </tr>

                            <tr>

                                <th>Transkrip Nilai</th>

                                <td>

                                    <a href="../uploads/dokumen/<?php echo $data['transkrip_nilai']; ?>"
                                       target="_blank">

                                        Lihat File

                                    </a>

                                </td>

                            </tr>

                        </table>

                    <?php } else { ?>

                        <div class="alert alert-warning">

                            Dokumen belum diupload.

                        </div>

                    <?php } ?>

                    <a href="dashboard.php"
                       class="btn btn-secondary mt-3">

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>