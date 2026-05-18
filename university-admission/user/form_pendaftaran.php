<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['id'])) {
    header('location:login.php');
}

// =========================
// SIMPAN DATA
// =========================
if(isset($_POST['submit'])) {

    $user_id = $_SESSION['id'];

    $nomor_pendaftaran = "ADM".rand(1000,9999);

    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);

    $tanggal_lahir = $_POST['tanggal_lahir'];

    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);

    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);

    $asal_sekolah = mysqli_real_escape_string($conn, $_POST['asal_sekolah']);

    mysqli_query($conn, "
        INSERT INTO pendaftar(
            user_id,
            nomor_pendaftaran,
            nama_lengkap,
            tanggal_lahir,
            alamat,
            no_hp,
            jurusan,
            asal_sekolah
        )
        VALUES(
            '$user_id',
            '$nomor_pendaftaran',
            '$nama_lengkap',
            '$tanggal_lahir',
            '$alamat',
            '$no_hp',
            '$jurusan',
            '$asal_sekolah'
        )
    ");

    echo "
    <script>
        alert('Pendaftaran berhasil!');
        window.location='dashboard.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>

    <title>Form Pendaftaran</title>

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
          rel='stylesheet'>
</head>

<body class='bg-light'>

<div class='container mt-5 mb-5'>

    <div class='card shadow border-0 rounded-4'>

        <div class='card-body p-5'>

            <h2 class='mb-4'>
                Form Pendaftaran Mahasiswa
            </h2>

            <form method='POST'>

                <div class='mb-3'>

                    <label>Nama Lengkap</label>

                    <input type='text'
                           name='nama_lengkap'
                           class='form-control'
                           required>

                </div>

                <div class='mb-3'>

                    <label>Tanggal Lahir</label>

                    <input type='date'
                           name='tanggal_lahir'
                           class='form-control'
                           required>

                </div>

                <div class='mb-3'>

                    <label>Alamat</label>

                    <textarea name='alamat'
                              class='form-control'
                              required></textarea>

                </div>

                <div class='mb-3'>

                    <label>No HP</label>

                    <input type='text'
                           name='no_hp'
                           class='form-control'
                           required>

                </div>

                <div class='mb-3'>

                    <label>Jurusan</label>

                    <select name='jurusan'
                            class='form-control'
                            required>

                        <option value=''>
                            -- Pilih Jurusan --
                        </option>

                        <option>
                            Teknik Informatika
                        </option>

                        <option>
                            Sistem Informasi
                        </option>

                        <option>
                            Manajemen
                        </option>

                        <option>
                            Akuntansi
                        </option>

                    </select>

                </div>

                <div class='mb-3'>

                    <label>Asal Sekolah</label>

                    <input type='text'
                           name='asal_sekolah'
                           class='form-control'
                           required>

                </div>

                <button type='submit'
                        name='submit'
                        class='btn btn-primary'>

                    Submit Pendaftaran

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>