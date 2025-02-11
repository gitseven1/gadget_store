<?php
include "../koneksi/koneksi.php";

$query = "SELECT t.id_transaksi, p.nama AS nama_pembeli, pr.nama_produk, pr.gambar, t.jumlah, pr.harga, 
          (t.jumlah * pr.harga) AS total, t.tanggal_transaksi
          FROM transaksi t
          JOIN pembeli p ON t.id_pembeli = p.id_pembeli
          JOIN produk pr ON t.id_produk = pr.id_produk";
$result = mysqli_query($koneksi, $query);
?>

<h2>Daftar Transaksi</h2>
<table border="1">
    <tr>
        <th>ID Transaksi</th>
        <th>Pembeli</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $data['id_transaksi']; ?></td>
            <td><?= $data['nama_pembeli']; ?></td>
            <td><?= $data['nama_produk']; ?></td>
            <td><?= $data['jumlah']; ?></td>
            <td>Rp<?= number_format($data['total'], 2, ',', '.'); ?></td>
            <td><?= $data['tanggal_transaksi']; ?></td>
            <td>
                <a href="transaksiEdit.php?id=<?= $data['id_transaksi']; ?>">Edit</a> | 
                <a href="transaksiDelete.php?id=<?= $data['id_transaksi']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>
