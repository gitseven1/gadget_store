<?php
include ('../koneksi/koneksi.php');

// Pastikan ada parameter id_transaksi di URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID Transaksi tidak ditemukan!'); window.location='./?adm=transaksiView';</script>";
    exit;
}

$id_transaksi = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$queryTransaksi = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
$resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
$dataTransaksi = mysqli_fetch_assoc($resultTransaksi);

if (!$dataTransaksi) {
    echo "<script>alert('Data transaksi tidak ditemukan!'); window.location='transaksiView.php';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Transaksi</h2>
    <div class="card shadow-lg p-4">
        <form method="post">
            <input type="hidden" name="id_transaksi" value="<?= $dataTransaksi['id_transaksi']; ?>">

            <div class="mb-3">
                <label class="form-label">Pembeli</label>
                <select name="id_pembeli" class="form-select" required>
                    <option value="">-- Pilih Pembeli --</option>
                    <?php
                    $queryPembeli = "SELECT id_pembeli, nama FROM pembeli";
                    $resultPembeli = mysqli_query($koneksi, $queryPembeli);
                    while ($row = mysqli_fetch_assoc($resultPembeli)) {
                        $selected = ($row['id_pembeli'] == $dataTransaksi['id_pembeli']) ? "selected" : "";
                        echo "<option value='{$row['id_pembeli']}' $selected>{$row['nama']}</option>";
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
                        $selected = ($row['id_produk'] == $dataTransaksi['id_produk']) ? "selected" : "";
                        echo "<option value='{$row['id_produk']}' data-harga='{$row['harga']}' $selected>{$row['nama_produk']} - Rp".number_format($row['harga'], 0, ',', '.')."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Satuan</label>
                <input type="text" id="harga" class="form-control" readonly value="">
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input name="jumlah" type="number" id="jumlah" class="form-control" min="1" required value="<?= $dataTransaksi['jumlah']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <input type="text" id="total_harga" class="form-control" readonly value="">
            </div>

            <button type="submit" name="submit" class="btn btn-warning">Simpan Perubahan</button>
            <a href="http://localhost/penjualan_hp/admin/index.php?adm=transaksi" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
        if (isset($_POST["submit"])) {
            $id_transaksi = $_POST["id_transaksi"];
            $id_pembeli = $_POST["id_pembeli"];
            $id_produk = $_POST["id_produk"];
            $jumlah = $_POST["jumlah"];

            // Ambil harga produk
            $queryHarga = "SELECT harga FROM produk WHERE id_produk = '$id_produk'";
            $resultHarga = mysqli_query($koneksi, $queryHarga);
            $dataHarga = mysqli_fetch_assoc($resultHarga);
            $harga = $dataHarga['harga'];

            // Hitung total harga
            $total_harga = $jumlah * $harga;

            // Update data transaksi
            $updateTransaksi = "UPDATE transaksi SET id_pembeli='$id_pembeli', id_produk='$id_produk', jumlah='$jumlah' WHERE id_transaksi='$id_transaksi'";
            $queryUpdate = mysqli_query($koneksi, $updateTransaksi);

            if ($queryUpdate) {
                echo "<script>alert('Transaksi berhasil diperbarui!'); window.location='./?adm=transaksiView';</script>";
            } else {
                echo "<script>alert('Gagal memperbarui transaksi!');</script>";
            }
        }
        ?>
    </div>
</div>

<script>
    // Menampilkan harga satuan saat produk dipilih
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

    // Set harga saat halaman dimuat
    window.onload = function() {
        var selectedOption = document.getElementById('id_produk').options[document.getElementById('id_produk').selectedIndex];
        var harga = selectedOption.getAttribute('data-harga');
        document.getElementById('harga').value = harga;
        hitungTotal();
    };
</script>

</body>
</html>