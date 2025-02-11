<?php
include('../koneksi/koneksi.php'); 

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_produk = $_GET['id'];

    
    $query = "SELECT gambar FROM produk WHERE id_produk = '$id_produk'";
    $result = mysqli_query($koneksi, $query);
    $product = mysqli_fetch_assoc($result);

    
    if ($product['gambar']) {
        unlink("../uploads/" . $product['gambar']);
    }

    
    $query = "DELETE FROM produk WHERE id_produk = '$id_produk'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location.href='../admin/?adm=produk';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk!');</script>";
    }
} else {
    echo "<script>alert('ID produk tidak tersedia!');</script>";
    exit;
}
?>