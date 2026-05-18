<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#0d3b66;
        }

        .login-card{
            border:none;
            border-radius:25px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="row vh-100 justify-content-center align-items-center">

        <div class="col-md-5">

            <div class="card shadow login-card">

                <div class="card-body p-5">

                    <h2 class="fw-bold text-center mb-4">
                        Login Admin
                    </h2>

                    <form method="POST"
                          action="proses_login.php">

                        <!-- USERNAME -->
                        <div class="mb-3">

                            <label class="form-label">
                                Username
                            </label>

                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   required>

                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>

                        </div>

                        <!-- CAPTCHA -->
                        <div class="mb-3">

                            <label class="form-label">
                                Captcha
                            </label>

                            <br>

                            <img src="captcha.php"
                                 class="mb-2 border rounded">

                            <input type="text"
                                   name="captcha"
                                   class="form-control"
                                   placeholder="Masukkan captcha"
                                   required>

                        </div>

                        <button type="submit"
                                name="login"
                                class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>