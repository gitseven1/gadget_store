<?php
// File: config.php
// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db = "penjualan_hp";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Gadget Store</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css" />
    <style>
        /* Menyesuaikan ukuran font judul dan memperbesar */
        .title {
            font-size: 3rem;  /* Ukuran font lebih kecil sedikit */
            color: #fff;      /* Warna font putih */
            text-align: center;
            margin-top: 20px;
            font-weight: bold; /* Membuat teks lebih tebal */
        }
    </style>
</head>
<body>
<header>
    <section class="title">GADGET STORE</section>
</header>

<section id="navigator">
    <ul class="menus">
        <li><a href="./?adm=home">Home</a></li>
        <li><a href="./?adm=produk">Produk</a></li>
        <li><a href="./?adm=pembeli">Pembeli</a></li>
        <li><a href="./?adm=transaksi">Transaksi</a></li>
        <li><a href="./?adm=profile">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>  <!-- Tombol Logout -->
    </ul>
</section>

<section id="container">
    <?php
    if (empty($_GET)) {
        include("home.php");  // Halaman awal yang ditampilkan adalah home.php
    } else {
        if ($_GET["adm"] == "home") {
            include("home.php");
        } elseif ($_GET["adm"] == "produk") {
            include("produkView.php");
        } elseif ($_GET["adm"] == "produkAdd") {
            include("produkAdd.php");
        } elseif ($_GET["adm"] == "produkEdit") {
            include("produkEdit.php");
        } elseif ($_GET["adm"] == "produkDelete") {
            include("produkDelete.php");
        } elseif ($_GET["adm"] == "transaksi") {
            include("transaksiView.php");
        } elseif ($_GET["adm"] == "transaksiEdit") {
            include("transaksiEdit.php");
        } elseif ($_GET["adm"] == "transaksiDelete") {
            include("transaksiDelete.php");
        } elseif ($_GET["adm"] == "pembeli") {
            include("pembeliView.php");
        } elseif ($_GET["adm"] == "pembeliAdd") {
            include("pembeliAdd.php");
        } elseif ($_GET["adm"] == "pembeliEdit") {
            include("pembeliEdit.php");
        } elseif ($_GET["adm"] == "pembeliDelete") {
            include("pembeliDelete.php");
        } elseif ($_GET["adm"] == "profile") {
            include("profile.php");
        }
    }
    ?>
</section>

<footer>
    <font color=#000> Copyright &copy; 2025 - Sistem Penjualan HP <br />
    Developed By <a href="index.php?adm=profile" target="_new">Rizka & Gita</a> 
    </font>
</footer>

</body>
</html>
