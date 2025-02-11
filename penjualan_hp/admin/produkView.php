<?php
include('../koneksi/koneksi.php');  

$query = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<a href='./?adm=produkAdd' style='display: inline-block; padding: 10px 20px; margin: 10px 0; background-color: green; color: white; text-decoration: none; border-radius: 5px;'>+ Tambah Produk</a>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; margin: 20px 0; border-collapse: collapse;'>
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>";

    while ($product = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$product['id_produk']}</td>
                <td>{$product['nama_produk']}</td>
                <td>{$product['merk']}</td>
                <td>Rp " . number_format($product['harga'], 2) . "</td>
                <td>{$product['stok']}</td>
                <td>{$product['deskripsi']}</td>
                <td><img src='../uploads/{$product['gambar']}' width='100' alt='Gambar Produk'></td>
                <td>
                    <a href='./?adm=produkEdit&id={$product['id_produk']}' style='text-decoration: none; color: blue;'>Edit</a> |
                    <a href='./?adm=produkDelete&id={$product['id_produk']}' style='text-decoration: none; color: red;' onclick='return confirm(\"Yakin ingin menghapus produk?\");'>Delete</a>
                </td>
              </tr>";
    }
    
    echo "</tbody>
        </table>";
} else {
    echo "Tidak ada produk yang ditemukan!";
}
?>
