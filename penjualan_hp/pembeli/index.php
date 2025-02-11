<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gadget Store</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <style>
        .title {
            font-size: 3rem;
            color: #fff;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
        #navigator {
            background-color: #333;
            padding: 10px 0;
        }
        #navigator ul.menus {
            list-style-type: none;
            text-align: center;
        }
        #navigator ul.menus li {
            display: inline-block;
            margin-right: 20px;
        }
        #navigator ul.menus li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        #navigator ul.menus li a:hover {
            color: #4CAF50;
        }
        #container {
            padding: 20px;
            text-align: center;
        }
        footer {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <section class="title">GADGET STORE</section>
    </header>
    <!-- Bagian Navigator -->
    <section id="navigator">
        <ul class="menus">
            <li><a href="../pembeli/index.php?adm=home">Home</a></li>
            <li><a href="../pembeli/index.php?adm=produk">Produk</a></li>
            <li><a href="../pembeli/index.php?adm=transaksiView">Riwayat Transaksi</a></li>
            <li><a href="../pembeli/index.php?adm=profile">Profile</a></li>
            <li><a href="../admin/logout.php">Logout</a></li>
        </ul>
    </section>
    <!-- Bagian Konten Utama -->
    <section id="container">
        <?php
        if (empty($_GET)) {
            include("home.php");
        } else {
            if ($_GET["adm"] == "home") {
                include("home.php");
            } elseif ($_GET["adm"] == "produk") {
                include("produkView.php");
            } elseif ($_GET["adm"] == "transaksiView") {
                include("TransaksiView.php");
            } elseif ($_GET["adm"] == "profile") {
                include("profile.php");
            }
        }
        ?>
    </section>
    <footer>
    <font color=#000> Copyright &copy; 2025 - Sistem Penjualan HP <br />
    Developed By <a href="#" target="_new">Rizka & Gita</a> 
    </font>
</footer>

</body>
</html>
