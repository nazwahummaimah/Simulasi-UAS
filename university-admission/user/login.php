<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f4f7fb;
        }

        .login-card{
            border:none;
            border-radius:20px;
            overflow:hidden;
        }

        .left-side{
            background:#0d3b66;
            color:white;
            padding:50px;
            height:100%;
        }

        .right-side{
            padding:50px;
        }

        .btn-login{
            background:#0d3b66;
            color:white;
            border:none;
            border-radius:10px;
            padding:12px;
        }

        .btn-login:hover{
            background:#092845;
        }

    </style>

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card shadow-lg login-card">

                <div class="row g-0">

                    <!-- LEFT -->
                    <div class="col-md-5">

                        <div class="left-side">

                            <h1 class="fw-bold">
                                University Admission
                            </h1>

                            <p class="mt-4">
                                Sistem pendaftaran mahasiswa baru
                                berbasis online.
                            </p>

                            <hr>

                            <ul>
                                <li>Pendaftaran Online</li>
                                <li>Seleksi Berkas</li>
                                <li>Pengumuman Hasil</li>
                                <li>Daftar Ulang</li>
                            </ul>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-md-7">

                        <div class="right-side">

                            <h2 class="fw-bold mb-4">
                                Login
                            </h2>

                            <form action="proses_login.php"
                                  method="POST">

                                <!-- EMAIL -->
                                <div class="mb-3">

                                    <label>Email</label>

                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           required>

                                </div>

                                <!-- PASSWORD -->
                                <div class="mb-3">

                                    <label>Password</label>

                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           required>

                                </div>

                                <!-- CAPTCHA -->
                                <div class="mb-3">

                                    <label>Captcha</label>

                                    <?php include 'captcha.php'; ?>

                                    <input type="text"
                                           name="captcha"
                                           class="form-control mt-2"
                                           placeholder="Masukkan captcha"
                                           required>

                                </div>

                                <!-- BUTTON -->
                                <button type="submit"
                                        name="login"
                                        class="btn btn-login w-100">

                                    Login

                                </button>

                            </form>

                            <div class="text-center mt-4">

                                Belum punya akun?

                                <a href="register.php">
                                    Register
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>