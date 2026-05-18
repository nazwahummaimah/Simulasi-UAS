<?php
session_start();

// 🔥 kalau sudah login, langsung ke dashboard user
if(isset($_SESSION['id'])){
    header("Location: user/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PMB Online - Admission System</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    margin:0;
    background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
    color:white;
    overflow-x:hidden;
}

/* NAVBAR */
.navbar{
    background:transparent;
}

.navbar-brand{
    font-weight:700;
}

/* HERO */
.hero{
    min-height:100vh;
    display:flex;
    align-items:center;
    position:relative;
    padding:60px 0;
}

.hero h1{
    font-size:3.3rem;
    font-weight:800;
}

.hero p{
    opacity:0.85;
}

/* BUTTON */
.btn-modern{
    border-radius:14px;
    padding:12px 22px;
    font-weight:600;
    transition:0.3s;
}

.btn-modern:hover{
    transform:translateY(-5px);
}

/* CARD */
.card-glass{
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.15);
    backdrop-filter:blur(10px);
    border-radius:20px;
    padding:25px;
    transition:0.3s;
    height:100%;
}

.card-glass:hover{
    transform:translateY(-10px);
    background:rgba(255,255,255,0.12);
}

/* ICON */
.icon-box{
    width:60px;
    height:60px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    background:rgba(255,255,255,0.15);
    margin-bottom:15px;
}

/* FLOATING */
.circle{
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,0.08);
    animation:float 6s infinite ease-in-out;
}

.circle1{width:150px;height:150px;top:10%;left:5%;}
.circle2{width:220px;height:220px;bottom:10%;right:10%;}
.circle3{width:90px;height:90px;top:25%;right:20%;}

@keyframes float{
    0%{transform:translateY(0);}
    50%{transform:translateY(-20px);}
    100%{transform:translateY(0);}
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4 py-3">
<div class="container-fluid">

    <a class="navbar-brand text-white">
        <i class="fa-solid fa-graduation-cap"></i> PMB Online
    </a>

    <div class="ms-auto">
        <a href="user/login.php" class="btn btn-light btn-modern me-2">
            Login
        </a>
        <a href="user/register.php" class="btn btn-warning btn-modern">
            Daftar
        </a>
    </div>

</div>
</nav>

<!-- FLOATING SHAPES -->
<div class="circle circle1"></div>
<div class="circle circle2"></div>
<div class="circle circle3"></div>

<!-- HERO -->
<section class="hero">
<div class="container">
    <div class="row align-items-center">

        <!-- TEXT -->
        <div class="col-md-6">

            <h1>
                PMB Online<br>
                <span class="text-warning">Universitas System</span>
            </h1>

            <p class="mt-3 fs-5">
                Sistem penerimaan mahasiswa baru modern.
                Daftar, upload dokumen, dan pantau status secara online tanpa ribet.
            </p>

            <div class="mt-4">
                <a href="user/register.php" class="btn btn-warning btn-modern me-2">
                    <i class="fa-solid fa-user-plus"></i> Mulai Daftar
                </a>

                <a href="user/login.php" class="btn btn-outline-light btn-modern">
                    Login
                </a>
            </div>

        </div>

        <!-- IMAGE -->
        <div class="col-md-6 text-center mt-4 mt-md-0">

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png"
                 style="width:80%; max-width:380px; animation:float 4s ease-in-out infinite;">

        </div>

    </div>
</div>
</section>

<!-- FEATURES -->
<section class="py-5">
<div class="container">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Kenapa PMB Online?</h2>
        <p class="opacity-75">Semua proses pendaftaran jadi lebih mudah dan cepat</p>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card-glass">
                <div class="icon-box">
                    <i class="fa-solid fa-laptop"></i>
                </div>
                <h5>Online System</h5>
                <p class="opacity-75">Daftar dari mana saja tanpa harus datang ke kampus.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-glass">
                <div class="icon-box">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h5>Aman & Terpercaya</h5>
                <p class="opacity-75">Data tersimpan aman di database terstruktur.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-glass">
                <div class="icon-box">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h5>Progress Tracking</h5>
                <p class="opacity-75">Pantau status pendaftaran secara real-time.</p>
            </div>
        </div>

    </div>

</div>
</section>

<!-- CTA -->
<section class="text-center py-5">
<div class="container">

    <h2 class="fw-bold">Siap Jadi Mahasiswa?</h2>
    <p class="opacity-75">Daftarkan diri kamu sekarang dan mulai perjalanan akademikmu</p>

    <a href="user/register.php" class="btn btn-warning btn-modern mt-3">
        Daftar Sekarang
    </a>

</div>
</section>

<!-- FOOTER -->
<footer class="text-center py-4">
    <p class="opacity-75 mb-0">
        © 2026 PMB Online System | Built for Academic Project
    </p>
</footer>

</body>
</html>