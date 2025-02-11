<?php
include('../koneksi/koneksi.php');  // Menghubungkan dengan koneksi.php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Mengambil data produk berdasarkan ID
    $query = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
    $result = mysqli_query($koneksi, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "<script>alert('Produk tidak ditemukan!'); window.location.href='../admin/?adm=produk';</script>";
        exit;
    }

    if (isset($_POST['submit'])) {
        // Mengambil data dari form
        $nama_produk = $_POST['nama_produk'];
        $merk = $_POST['merk'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $gambar = $_FILES['gambar']['name'] ? $_FILES['gambar']['name'] : $product['gambar'];
        $deskripsi = $_POST['deskripsi'];

        // Jika ada gambar baru, upload gambar tersebut
        if ($_FILES['gambar']['name']) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($gambar);
            move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        }

        // Update data produk
        $query = "UPDATE produk SET 
                  nama_produk = '$nama_produk', 
                  merk = '$merk', 
                  harga = '$harga', 
                  stok = '$stok', 
                  gambar = '$gambar', 
                  deskripsi = '$deskripsi' 
                  WHERE id_produk = '$id_produk'";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Produk berhasil diperbarui!'); window.location.href='../admin/?adm=produk';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui produk: " . mysqli_error($koneksi) . "');</script>";
        }
    }
} else {
    echo "<script>alert('ID produk tidak tersedia!'); window.location.href='../admin/?adm=produk';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../css/style.css">  <!-- Pastikan path ke CSS benar -->
</head>
<body>
    <div class="form-container">
        <h2>Edit Produk</h2>
        <form action="produkEdit.php?id=<?php echo $product['id_produk']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" name="nama_produk" id="nama_produk" value="<?php echo $product['nama_produk']; ?>" required>
            </div>

            <div class="form-group">
                <label for="merk">Merk:</label>
                <select name="merk" id="merk" required>
                    <option value="Samsung" <?php if ($product['merk'] == 'Samsung') echo 'selected'; ?>>Samsung</option>
                    <option value="Apple" <?php if ($product['merk'] == 'Apple') echo 'selected'; ?>>Apple</option>
                    <option value="Redmi" <?php if ($product['merk'] == 'Redmi') echo 'selected'; ?>>Redmi</option>
                    <option value="Oppo" <?php if ($product['merk'] == 'Oppo') echo 'selected'; ?>>Oppo</option>
                    <option value="Vivo" <?php if ($product['merk'] == 'Vivo') echo 'selected'; ?>>Vivo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" value="<?php echo $product['harga']; ?>" required>
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" name="stok" id="stok" value="<?php echo $product['stok']; ?>" required>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar (kosongkan jika tidak ingin diubah):</label>
                <input type="file" name="gambar" id="gambar" accept="image/*"><br>
                <img src="../uploads/<?php echo $product['gambar']; ?>" width="100" alt="Gambar Produk"><br>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" required><?php echo $product['deskripsi']; ?></textarea>
            </div>

            <button type="submit" name="submit">Update Produk</button>
        </form>
    </div>
</body>
</html>