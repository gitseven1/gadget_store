<?php
session_start();
include('../koneksi/koneksi.php');  // Menyambung dengan koneksi database

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];  // Pilih antara Admin atau Pembeli

    if ($role == 'admin') {
        // Jika memilih admin, langsung login tanpa verifikasi
        $_SESSION['id'] = "admin";  
        $_SESSION['username'] = "Admin";
        header("Location: ../admin/index.php");
        exit();
    } else {
        // Jika memilih pembeli, lakukan verifikasi username & password
        $query = "SELECT * FROM pembeli WHERE username = '$username'";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);

        if ($data && password_verify($password, $data['password'])) {
            // Jika login berhasil, buat session
            $_SESSION['id'] = $data['id_pembeli'];  
            $_SESSION['username'] = $data['username'];

            // Arahkan ke halaman pembeli
            header("Location: ../pembeli/index.php");  
            exit();
        } else {
            echo "<script>alert('Username atau password salah!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">  <!-- Pastikan path ke CSS benar -->
    <style>
        /* Membuat password bisa dilihat dengan icon dan posisinya rapi */
        .password-container {
            position: relative;
            width: 100%;
            max-width: 300px; /* Menentukan lebar kolom password */
        }
        .password-container input[type="password"] {
            width: 100%;
            padding-right: 40px;  /* Memberikan ruang untuk ikon mata */
            font-size: 18px;
            height: 40px;  /* Membuat kolom password lebih tinggi */
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .password-container .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;  /* Ukuran ikon mata */
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
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <span class="show-password" onclick="togglePassword()">👁️</span>
            </div>

            <div class="form-group">
                <label for="role">Login sebagai:</label>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="pembeli">Pembeli</option>
                </select>
            </div>

            <button type="submit" name="submit">Login</button>
        </form>
        <p style="text-align: center; margin-top: 10px;">
            Belum punya akun? <a href="register.php" style="color: #4CAF50; font-weight: bold;">Sign Up</a>
        </p>
    </div>

    <script>
        // Fungsi untuk toggle password visibility
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;
        }
    </script>
</body>
</html>
