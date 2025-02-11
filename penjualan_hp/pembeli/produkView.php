<?php
session_start();
include('../koneksi/koneksi.php');

$queryProduk = "SELECT * FROM produk";
$resultProduk = mysqli_query($koneksi, $queryProduk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/stylesheet.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Selamat Datang di Gadget Store</h2>
        <p class="text-center">Temukan berbagai produk terbaik dengan harga terjangkau</p>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($resultProduk)) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="../uploads/<?= $row['gambar']; ?>" class="card-img-top" alt="Produk">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_produk']; ?></h5>
                            <p class="card-text">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#produkModal<?= $row['id_produk']; ?>">Detail</button>
                            <a href="transaksiAdd.php?id=<?= $row['id_produk']; ?>&redirect=transaksiView" class="btn btn-success">Beli Sekarang</a>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Produk -->
                <div class="modal fade" id="produkModal<?= $row['id_produk']; ?>" tabindex="-1" aria-labelledby="produkModalLabel<?= $row['id_produk']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="produkModalLabel<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="../uploads/<?= $row['gambar']; ?>" class="img-fluid mb-3" style="max-width: 300px;">
                                <h5><strong><?= $row['nama_produk']; ?></strong></h5>
                                <p><?= $row['deskripsi']; ?></p>
                                <p class="fw-bold">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
