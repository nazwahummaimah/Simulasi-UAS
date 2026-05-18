<?php
session_start();
include '../config/koneksi.php';

// =========================
// CEK LOGIN ADMIN
// =========================
if(!isset($_SESSION['admin_id'])){
    header('location:login.php');
    exit;
}

// =========================
// TAMBAH PENGUMUMAN
// =========================
if(isset($_POST['simpan'])){

    $pendaftar_id = $_POST['pendaftar_id'];
    $hasil = $_POST['hasil'];
    $pesan = $_POST['pesan'];

    mysqli_query($conn,"
        INSERT INTO pengumuman(
            pendaftar_id,
            hasil,
            pesan,
            dipublikasikan_pada
        )
        VALUES(
            '$pendaftar_id',
            '$hasil',
            '$pesan',
            NOW()
        )
    ");

    echo "
    <script>
        alert('Pengumuman berhasil dibuat!');
        window.location='pengumuman.php';
    </script>
    ";
}

// =========================
// HAPUS PENGUMUMAN
// =========================
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,"
        DELETE FROM pengumuman
        WHERE id='$id'
    ");

    echo "
    <script>
        alert('Pengumuman berhasil dihapus!');
        window.location='pengumuman.php';
    </script>
    ";
}

// =========================
// AMBIL DATA PENDAFTAR
// =========================
$pendaftar = mysqli_query($conn,"
    SELECT * FROM pendaftar
    ORDER BY nama_lengkap ASC
");

// =========================
// AMBIL DATA PENGUMUMAN
// =========================
$data_pengumuman = mysqli_query($conn,"
    SELECT pengumuman.*,
           pendaftar.nama_lengkap
    FROM pengumuman
    LEFT JOIN pendaftar
    ON pengumuman.pendaftar_id = pendaftar.id
    ORDER BY pengumuman.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kelola Pengumuman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">

<style>

*{
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
    background:linear-gradient(180deg,#111827,#1e40af);
    padding:30px 20px;
}

.logo{
    color:white;
    font-size:28px;
    font-weight:700;
    margin-bottom:50px;
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

.main{
    margin-left:280px;
    padding:35px;
}

.topbar{
    background:white;
    padding:25px 30px;
    border-radius:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    margin-bottom:35px;
}

.topbar h3{
    font-weight:700;
}

.card-box{
    background:white;
    border-radius:25px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    margin-bottom:30px;
}

.btn-modern{
    border:none;
    border-radius:14px;
    padding:10px 20px;
    color:white;
}

.btn-blue{
    background:#2563eb;
}

.table{
    vertical-align:middle;
}

.badge-lulus{
    background:#10b981;
}

.badge-gagal{
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

        <h3>
            Kelola Pengumuman
        </h3>

        <p class="text-muted mb-0">
            Buat pengumuman hasil seleksi mahasiswa
        </p>

    </div>

    <!-- FORM -->
    <div class="card-box">

        <h5 class="fw-bold mb-4">
            Tambah Pengumuman
        </h5>

        <form method="POST">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Pilih Mahasiswa
                    </label>

                    <select name="pendaftar_id"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih --
                        </option>

                        <?php
                        while($p = mysqli_fetch_array($pendaftar)){
                        ?>

                        <option value="<?php echo $p['id']; ?>">

                            <?php echo $p['nama_lengkap']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Hasil Seleksi
                    </label>

                    <select name="hasil"
                            class="form-select"
                            required>

                        <option value="Lulus">
                            Lulus
                        </option>

                        <option value="Tidak Lulus">
                            Tidak Lulus
                        </option>

                    </select>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Pesan Pengumuman
                </label>

                <textarea name="pesan"
                          rows="4"
                          class="form-control"
                          required></textarea>

            </div>

            <button type="submit"
                    name="simpan"
                    class="btn btn-modern btn-blue">

                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Pengumuman

            </button>

        </form>

    </div>

    <!-- TABEL -->
    <div class="card-box">

        <h5 class="fw-bold mb-4">
            Data Pengumuman
        </h5>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>No</th>
                        <th>Mahasiswa</th>
                        <th>Hasil</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($d = mysqli_fetch_array($data_pengumuman)){
                    ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>
                            <?php echo $d['nama_lengkap']; ?>
                        </td>

                        <td>

                            <?php
                            if($d['hasil'] == 'Lulus'){
                            ?>

                                <span class="badge badge-lulus">

                                    Lulus

                                </span>

                            <?php } else { ?>

                                <span class="badge badge-gagal">

                                    Tidak Lulus

                                </span>

                            <?php } ?>

                        </td>

                        <td>
                            <?php echo $d['pesan']; ?>
                        </td>

                        <td>

                            <?php
                            echo date(
                                'd M Y H:i',
                                strtotime($d['dipublikasikan_pada'])
                            );
                            ?>

                        </td>

                        <td>

                            <a href="?hapus=<?php echo $d['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus pengumuman?')">

                               <i class="fa-solid fa-trash"></i>

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