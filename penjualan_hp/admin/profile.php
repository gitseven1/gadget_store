<?php
include("../koneksi/koneksi.php");


$admins = [
    [
        "nama" => "Rizka Nuria Irbah",
        "nim" => "10523039",
        "kelas" => "IS 1",
        "foto" => "rizka.jpg"
    ],
    [
        "nama" => "Gita Sri Maudi",
        "nim" => "10523040",
        "kelas" => "IS 1",
        "foto" => "gita.jpg"
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <style>
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-wrapper {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .profile-card {
            flex: 1;
            max-width: 300px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile-card img {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-card h3 {
            font-size: 1.5rem;
            color: #333;
        }
        .profile-card p {
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1 style="text-align: center;">Profile Admin</h1>
    </header>

    <div class="container">
        <div class="profile-wrapper">
            <?php foreach ($admins as $admin) { ?>
                <div class="profile-card">
                    <img src="../uploads/<?php echo $admin['foto']; ?>" alt="Foto Admin">
                    <h3><?php echo $admin['nama']; ?></h3>
                    <p>NIM: <?php echo $admin['nim']; ?></p>
                    <p>Kelas: <?php echo $admin['kelas']; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
