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
?>

<div class="container">
    <div class="profile-header">
        <h2>Selamat Datang, <?php echo htmlspecialchars($data['username']); ?>!</h2>
    </div>

    <div class="profile-info">
        <div class="info">
            <h3>Username:</h3>
            <p><?php echo htmlspecialchars($data['username']); ?></p>
        </div>

        <div class="info">
            <h3>Nama:</h3>
            <p><?php echo htmlspecialchars($data['nama']); ?></p>
        </div>
    </div>

    <div class="profile-info">
        <div class="info">
            <h3>Email:</h3>
            <p><?php echo htmlspecialchars($data['email']); ?></p>
        </div>

        <div class="info">
            <h3>Alamat:</h3>
            <p><?php echo htmlspecialchars($data['alamat']); ?></p>
        </div>
    </div>

    <div class="text-center">
        <a href="updateProfile.php" class="button">Update Profil</a>
    </div>
</div>
