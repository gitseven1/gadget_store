<?php
session_start();
session_unset();  // Menghapus semua session
session_destroy();  // Menghancurkan session

// Redirect ke halaman login setelah logout
header("Location: ../admin/login.php");  // Jika pembeli logout, arahkan ke admin login.php
exit();
?>
