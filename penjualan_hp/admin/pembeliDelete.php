<?php
include('../koneksi/koneksi.php');  // Menghubungkan dengan koneksi.php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_pembeli = $_GET['id'];

    // Menghapus data pembeli berdasarkan ID
    $query = "DELETE FROM pembeli WHERE id_pembeli = '$id_pembeli'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pembeli berhasil dihapus!'); window.location.href='../admin/?adm=pembeli';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pembeli.'); window.location.href='../admin/?adm=pembeli';</script>";
    }
} else {
    echo "<script>alert('ID pembeli tidak tersedia!'); window.location.href='../admin/?adm=pembeli';</script>";
    exit;
}
?>
