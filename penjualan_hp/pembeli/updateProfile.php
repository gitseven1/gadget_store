<?php
session_start();
include('../koneksi/koneksi.php');

if (!isset($_SESSION['id'])) {
    header("Location: ../admin/login.php");
    exit();
}

$id_pembeli = $_SESSION['id'];
$query = "SELECT * FROM pembeli WHERE id_pembeli = '$id_pembeli'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $update_query = "UPDATE pembeli SET nama = '$nama', email = '$email', alamat = '$alamat' WHERE id_pembeli = '$id_pembeli'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Profil berhasil diperbarui!'); window.location.href = '../pembeli/index.php?adm=profile';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan, coba lagi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile Pembeli</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
    <div class="container">
        <h2>Update Profil</h2>
        <form action="updateProfile.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
            <button type="submit" name="submit">Update Profil</button>
        </form>
    </div>
</body>
</html>
