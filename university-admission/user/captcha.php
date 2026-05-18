<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// KARAKTER CAPTCHA
$karakter = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';

// ACAK CAPTCHA
$captcha = substr(str_shuffle($karakter), 0, 6);

// SIMPAN KE SESSION
$_SESSION['captcha'] = $captcha;

?>

<div style="
    background:#f1f5f9;
    border:2px solid #dbe4ee;
    border-radius:10px;
    padding:15px;
    text-align:center;
    font-size:28px;
    font-weight:bold;
    letter-spacing:5px;
    color:#0d3b66;
    font-family:Arial;
    user-select:none;
">
    <?php echo $captcha; ?>
</div>