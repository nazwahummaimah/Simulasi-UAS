<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "university_admission"
);

if(!$conn){
    die("Koneksi gagal");
}
?>