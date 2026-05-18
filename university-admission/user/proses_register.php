<?php
session_start();
include '../config/koneksi.php';

// =========================
// CEK TOMBOL REGISTER
// =========================
if(isset($_POST['register'])) {

    // AMB