<?php 
include ('../koneksi/koneksi.php');

if (isset($_GET["id"])) {
    $id_transaksi = $_GET["id"];

    $delTransaksi = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    $resultTransaksi = mysqli_query($koneksi, $delTransaksi);

    if ($resultTransaksi) {
        echo "<script>alert('Transaksi Berhasil Dihapus'); window.location.href='index.php?adm=transaksiView';</script>";
    } else {
        echo "<script>alert('Transaksi Gagal Dihapus'); window.location.href='index.php?adm=transaksiView';</script>";
    }
    exit;
} else {
    echo "<script>alert('Transaksi Gagal Dihapus!'); window.location.href='index.php?adm=transaksiView';</script>";
    exit;
}
?>
