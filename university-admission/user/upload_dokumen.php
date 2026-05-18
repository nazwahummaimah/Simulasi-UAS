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
        alert('Isi form pendaftaran terlebih dahulu!');
        window.location='form_pendaftaran.php';
    </script>
    ";

    exit;
}

$pendaftar_id = $data_pendaftar['id'];

// ============================
// PROSES UPLOAD
// ============================
if(isset($_POST['upload'])){

    // FOLDER
    $folder = "../uploads/dokumen/";

    // CEK FOLDER
    if(!is_dir($folder)){
        mkdir($folder, 0777, true);
    }

    // FOTO
    $foto = time().'_'.$_FILES['foto']['name'];
    $tmp_foto = $_FILES['foto']['tmp_name'];

    // KTP
    $ktp = time().'_'.$_FILES['ktp']['name'];
    $tmp_ktp = $_FILES['ktp']['tmp_name'];

    // IJAZAH
    $ijazah = time().'_'.$_FILES['ijazah']['name'];
    $tmp_ijazah = $_FILES['ijazah']['tmp_name'];

    // TRANSKRIP
    $transkrip = time().'_'.$_FILES['transkrip']['name'];
    $tmp_transkrip = $_FILES['transkrip']['tmp_name'];

    // UPLOAD FILE
    $upload1 = move_uploaded_file(
        $tmp_foto,
        $folder.$foto
    );

    $upload2 = move_uploaded_file(
        $tmp_ktp,
        $folder.$ktp
    );

    $upload3 = move_uploaded_file(
        $tmp_ijazah,
        $folder.$ijazah
    );

    $upload4 = move_uploaded_file(
        $tmp_transkrip,
        $folder.$transkrip
    );

    // CEK UPLOAD
    if($upload1 && $upload2 && $upload3 && $upload4){

        // SIMPAN DATABASE
        $insert = mysqli_query($conn,"
            INSERT INTO dokumen(
                pendaftar_id,
                foto,
                kartu_identitas,
                ijazah,
                transkrip_nilai,
                status
            )
            VALUES(
                '$pendaftar_id',
                '$foto',
                '$ktp',
                '$ijazah',
                '$transkrip',
                'Menunggu Verifikasi'
            )
        ");

        if($insert){

            echo "
            <script>
                alert('Dokumen berhasil diupload!');
                window.location='status_seleksi.php';
            </script>
            ";

        } else {

            echo mysqli_error($conn);
        }

    } else {

        echo "
        <div style='padding:20px;color:red;'>
            Upload file gagal!
        </div>
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

    <title>Upload Dokumen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f4f7fb;
        }

        .upload-card{
            border:none;
            border-radius:25px;
        }

    </style>

</head>

<body>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow upload-card">

                <div class="card-body p-5">

                    <h2 class="fw-bold mb-4">
                        Upload Dokumen
                    </h2>

                    <form method="POST"
                          enctype="multipart/form-data">

                        <!-- FOTO -->
                        <div class="mb-3">

                            <label class="form-label">
                                Pas Foto
                            </label>

                            <input type="file"
                                   name="foto"
                                   class="form-control"
                                   required>

                        </div>

                        <!-- KTP -->
                        <div class="mb-3">

                            <label class="form-label">
                                Kartu Identitas
                            </label>

                            <input type="file"
                                   name="ktp"
                                   class="form-control"
                                   required>

                        </div>

                        <!-- IJAZAH -->
                        <div class="mb-3">

                            <label class="form-label">
                                Ijazah
                            </label>

                            <input type="file"
                                   name="ijazah"
                                   class="form-control"
                                   required>

                        </div>

                        <!-- TRANSKRIP -->
                        <div class="mb-4">

                            <label class="form-label">
                                Transkrip Nilai
                            </label>

                            <input type="file"
                                   name="transkrip"
                                   class="form-control"
                                   required>

                        </div>

                        <button type="submit"
                                name="upload"
                                class="btn btn-primary">

                            Upload Dokumen

                        </button>

                        <a href="dashboard.php"
                           class="btn btn-secondary">

                            Kembali

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>