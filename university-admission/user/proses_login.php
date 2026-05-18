<?php
session_start();
include '../config/koneksi.php';

// =========================
// CEK TOMBOL LOGIN
// =========================
if(isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $captcha = $_POST['captcha'];

    // =========================
    // VALIDASI CAPTCHA
    // =========================
    if(strtolower($captcha) != strtolower($_SESSION['captcha'])) {

        echo "
        <script>
            alert('Captcha salah!');
            window.location='login.php';
        </script>
        ";

        exit;
    }

    // =========================
    // CEK USER
    // =========================
    $query = mysqli_query($conn, "
        SELECT *
        FROM users
        WHERE email='$email'
        AND password='$password'
    ");

    // =========================
    // LOGIN BERHASIL
    // =========================
    if(mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_array($query);

        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        // HAPUS CAPTCHA
        unset($_SESSION['captcha']);

        // LOGIN SESUAI ROLE
        if($data['role'] == 'admin') {

            header('location:../admin/dashboard.php');

        } else {

            header('location:dashboard.php');
        }

    } else {

        echo "
        <script>
            alert('Email atau password salah!');
            window.location='login.php';
        </script>
        ";
    }

} else {

    header('location:login.php');
}
?>