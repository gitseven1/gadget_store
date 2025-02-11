<?php
include('../koneksi/koneksi.php');  // Menghubungkan dengan koneksi.php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_pembeli = $_GET['id'];

    // Mengambil data pembeli berdasarkan ID
    $query = "SELECT * FROM pembeli WHERE id_pembeli = '$id_pembeli'";
    $result = mysqli_query($koneksi, $query);
    $pembeli = mysqli_fetch_assoc($result);

    if (!$pembeli) {
        echo "Pembeli tidak ditemukan!";
        exit;
    }

    if (isset($_POST['submit'])) {
        // Mengambil data dari form
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $pembeli['password']; // Jika password kosong, tetap gunakan password lama
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $nomor_hp = mysqli_real_escape_string($koneksi, $_POST['nomor_hp']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

        // Update data pembeli
        $query = "UPDATE pembeli SET 
                  username = '$username', 
                  password = '$password', 
                  nama = '$nama', 
                  email = '$email', 
                  nomor_hp = '$nomor_hp', 
                  alamat = '$alamat' 
                  WHERE id_pembeli = '$id_pembeli'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Pembeli berhasil diperbarui!'); window.location.href='../admin/?adm=pembeli';</script>";
} else {
    echo "<script>alert('Gagal memperbarui pembeli. Error: " . mysqli_error($koneksi) . "'); window.location.href='../admin/?adm=pembeli';</script>";
}

    }
} else {
    echo "ID pembeli tidak tersedia!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembeli</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Pastikan path ke CSS benar -->
    <style>
        /* Membuat password bisa dilihat dengan icon dan posisinya rapi */
        .password-container {
            position: relative;
            width: 100%;
            max-width: 300px; /* Mengatur panjang kolom */
        }
        .password-container input[type="password"] {
            width: 100%;
            padding-right: 40px; /* Memberikan ruang untuk ikon mata */
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .password-container .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px; /* Ukuran ikon */
        }

        /* Membesarkan kolom email dan merapikan tampilannya */
        #email {
            width: 100%;
            max-width: 300px; /* Mengatur panjang kolom email */
            padding: 8px;
            font-size: 14px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Pembeli</h2>
        <form action="pembeliEdit.php?id=<?php echo $pembeli['id_pembeli']; ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo $pembeli['username']; ?>" required>
            </div>

            <div class="form-group password-container">
                <label for="password">Password (Kosongkan jika tidak ingin diubah):</label>
                <input type="password" name="password" id="password">
                <span class="show-password" onclick="togglePassword()">&#128065;</span>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" name="nama" id="nama" value="<?php echo $pembeli['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $pembeli['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="nomor_hp">Nomor HP:</label>
                <input type="text" name="nomor_hp" id="nomor_hp" value="<?php echo $pembeli['nomor_hp']; ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" required><?php echo $pembeli['alamat']; ?></textarea>
            </div>

            <button type="submit" name="submit">Update Pembeli</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;
        }
    </script>
</body>
</html>
