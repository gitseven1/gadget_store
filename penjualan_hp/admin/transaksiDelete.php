<?php 
include ('../koneksi/koneksi.php');

if (isset($_GET["id"])) {
    $id_transaksi = $_GET["id"];

    // Jalankan query DELETE
    $delTransaksi = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    $resultTransaksi = mysqli_query($koneksi, $delTransaksi);

    if ($resultTransaksi) {
        if (mysqli_affected_rows($koneksi) > 0) {
            echo "<script>alert('Transaksi Berhasil Dihapus'); window.location.href='../admin/?adm=transaksi';</script>";
        } else {
            echo "<script>alert('Transaksi tidak ditemukan atau sudah dihapus sebelumnya!'); window.location.href='../admin/?adm=transaksi';</script>";
        }
    } else {
        echo "<script>alert('Gagal menghapus transaksi! Error: " . mysqli_error($koneksi) . "'); window.location.href='../admin/?adm=transaksi';</script>";
    }
} else {
    echo "<script>alert('ID Transaksi tidak ditemukan!'); window.location.href='../admin/?adm=transaksi';</script>";
}
?>