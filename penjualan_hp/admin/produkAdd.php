<?php
include('../koneksi/koneksi.php');  // Menghubungkan dengan koneksi.php

if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar']['name'];
    $deskripsi = $_POST['deskripsi'];

    // Menyimpan gambar ke folder 'uploads'
    $target_dir = "../uploads/";  // Pastikan path menuju folder 'uploads' benar
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);  // Membuat folder uploads jika belum ada
    }

    $target_file = $target_dir . basename($gambar);

    // Memindahkan file gambar ke folder 'uploads'
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Menambahkan produk ke database (id_produk tidak perlu disertakan karena auto_increment)
        $query = "INSERT INTO produk (nama_produk, merk, harga, stok, gambar, deskripsi) 
                  VALUES ('$nama_produk', '$merk', '$harga', '$stok', '$gambar', '$deskripsi')";
        if (mysqli_query($koneksi, $query)) {
            // Mengambil ID produk yang baru dimasukkan (tidak digunakan dalam redirect)
            $last_id = mysqli_insert_id($koneksi);
        
            // Redirect ke halaman yang diminta
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='../admin/?adm=produk';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan produk.');</script>";
        }        
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupload gambar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../css/style.css">  <!-- Pastikan path ke CSS benar -->
</head>
<body>
    <div class="form-container">
        <h2>Tambah Produk Baru</h2>
        <form action="produkAdd.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" name="nama_produk" id="nama_produk" required>
            </div>

            <div class="form-group">
                <label for="merk">Merk:</label>
                <select name="merk" id="merk" required>
                    <option value="Samsung">Samsung</option>
                    <option value="Apple">Apple</option>
                    <option value="Redmi">Redmi</option>
                    <option value="Oppo">Oppo</option>
                    <option value="Vivo">Vivo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" required step="any">
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" name="stok" id="stok" required>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" required></textarea>
            </div>

            <button type="submit" name="submit">Tambah Produk</button>
        </form>
    </div>
</body>
</html>

