<?php
include ('../koneksi/koneksi.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Transaksi</h2>
    <div class="card shadow-lg p-4">
        <?php
        if (!isset($_POST['submit'])) {
        ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Pembeli</label>
                <select name="id_pembeli" class="form-select" required>
                    <option value="">-- Pilih Pembeli --</option>
                    <?php
                    $queryPembeli = "SELECT id_pembeli, nama FROM pembeli";
                    $resultPembeli = mysqli_query($koneksi, $queryPembeli);
                    while ($row = mysqli_fetch_assoc($resultPembeli)) {
                        echo "<option value='{$row['id_pembeli']}'>{$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="id_produk" id="id_produk" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    <?php
                    $queryProduk = "SELECT id_produk, nama_produk, harga FROM produk";
                    $resultProduk = mysqli_query($koneksi, $queryProduk);
                    while ($row = mysqli_fetch_assoc($resultProduk)) {
                        echo "<option value='{$row['id_produk']}' data-harga='{$row['harga']}'>{$row['nama_produk']} - Rp".number_format($row['harga'], 0, ',', '.')."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Satuan</label>
                <input type="text" id="harga" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input name="jumlah" type="number" id="jumlah" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <input type="text" id="total_harga" class="form-control" readonly>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Tambah Transaksi</button>
            <a href="./?adm=produk" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
        } else {
            $id_pembeli = $_POST["id_pembeli"];
            $id_produk = $_POST["id_produk"];
            $jumlah = $_POST["jumlah"];

            $queryHarga = "SELECT harga FROM produk WHERE id_produk = $id_produk";
            $resultHarga = mysqli_query($koneksi, $queryHarga);
            $dataHarga = mysqli_fetch_assoc($resultHarga);
            $harga = $dataHarga['harga'];

            $total_harga = $jumlah * $harga;

            $insertTransaksi = "INSERT INTO transaksi (id_pembeli, id_produk, jumlah) VALUES ('$id_pembeli', '$id_produk', '$jumlah')";
            $queryTransaksi = mysqli_query($koneksi, $insertTransaksi);

            if ($queryTransaksi) {
                echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location.href='http://localhost/penjualan_hp/pembeli/index.php?adm=transaksiView';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan transaksi!');</script>";
            }
        }
        ?>
    </div>
</div>

<script>
    // Tampilkan harga saat produk dipilih
    document.getElementById('id_produk').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var harga = selectedOption.getAttribute('data-harga');
        document.getElementById('harga').value = harga;
        hitungTotal();
    });

    // Menghitung total harga
    document.getElementById('jumlah').addEventListener('input', function() {
        hitungTotal();
    });

    function hitungTotal() {
        var harga = document.getElementById('harga').value;
        var jumlah = document.getElementById('jumlah').value;
        var total = harga * jumlah;
        document.getElementById('total_harga').value = total;
    }
</script>

</body>
</html>
