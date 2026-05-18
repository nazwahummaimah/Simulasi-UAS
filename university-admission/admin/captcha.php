<?php
session_start();

// KARAKTER CAPTCHA
$karakter = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

// ACAK CAPTCHA
$captcha = substr(str_shuffle($karakter), 0, 5);

// SIMPAN SESSION
$_SESSION['captcha_admin'] = $captcha;

// HEADER IMAGE
header('Content-type: image/png');

// BUAT IMAGE
$image = imagecreate(120, 40);

// WARNA
$bg = imagecolorallocate($image, 240, 240, 240);
$text = imagecolorallocate($image, 0, 0, 0);

// TULIS CAPTCHA
imagestring($image, 5, 30, 12, $captcha, $text);

// OUTPUT
imagepng($image);

imagedestroy($image);
?>