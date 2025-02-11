<?php
$host = "localhost";
$username = "root";
$password = "";
$nama_db = "penjualan_hp";  // Ganti dengan nama database yang sesuai

$koneksi = mysqli_connect($host, $username, $password, $nama_db) or die("Koneksi MySQL gagal!");
?>
