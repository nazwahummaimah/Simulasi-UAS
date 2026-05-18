<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );

    $password = md5($_POST['password']);

    $captcha = $_POST['captcha'];

    // =========================
    // CEK CAPTCHA
    // =========================
    if($captcha != $_SESSION['captcha_admin']){

        echo "
        <script>
            alert('Captcha salah!');
            window.location='login.php';
        </script>
        ";

        exit;
    }

    // =========================
    // CEK LOGIN ADMIN
    // =========================
    $query = mysqli_query($conn,"
        SELECT *
        FROM admin
        WHERE username='$username'
        AND password='$password'
    ");

    $cek = mysqli_num_rows($query);

    if($cek > 0){

        $data = mysqli_fetch_array($query);

        $_SESSION['admin_id'] = $data['id'];

        $_SESSION['admin_nama'] = $data['nama'];

        echo "
        <script>
            alert('Login berhasil!');
            window.location='dashboard.php';
        </script>
        ";

    } else {

        echo "
        <script>
            alert('Username atau password salah!');
            window.location='login.php';
        </script>
        ";
    }
}
?>