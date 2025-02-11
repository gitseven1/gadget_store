<?php
include('../koneksi/koneksi.php');  // Menghubungkan dengan koneksi.php

$query = "SELECT * FROM pembeli";  // Ambil semua data pembeli
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembeli</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Pastikan path ke CSS benar -->
</head>
<body>
    <div class="table-container">
        <h2>Daftar Pembeli</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID Pembeli</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pembeli = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $pembeli['id_pembeli']; ?></td>
                        <td><?php echo $pembeli['username']; ?></td>
                        <td><?php echo $pembeli['nama']; ?></td>
                        <td><?php echo $pembeli['email']; ?></td>
                        <td><?php echo $pembeli['nomor_hp']; ?></td>
                        <td><?php echo $pembeli['alamat']; ?></td>
                        <td>
                            <a href="pembeliEdit.php?id=<?php echo $pembeli['id_pembeli']; ?>">Edit</a> |
                            <a href="pembeliDelete.php?id=<?php echo $pembeli['id_pembeli']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pembeli ini?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
