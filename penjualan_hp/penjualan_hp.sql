-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Feb 2025 pada 15.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_hp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `nama` varchar(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `username`, `password`, `nama`, `email`, `nomor_hp`, `alamat`) VALUES
(12, 'gita', '$2y$10$.yOblbeBWie3Kb1NDV2ZHOs52iLXuQVtLfezdfMKvxwqOlg/3zW2W', 'Gita', 'gitasrimaudi@gmail.com', '123', 'tdnwehdb');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `merk`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
(2, 'Samsung A35', 'Samsung', 5000000.00, 9, 'SAMSUNG A35.png', '8/256 GB\r\nPurple'),
(3, 'Iphone 13', 'Apple', 11000000.00, 5, 'Iphone 13.png', '128 GB'),
(12, 'Iphone 12', 'Apple', 10000000.00, 4, 'Iphone 12.png', '8/128 GB\r\nPurple'),
(13, 'Oppo Reno 11 Pro', 'Oppo', 5000000.00, 6, 'Oppo Reno 11 Pro.png', '8/128 GB\r\nGold'),
(14, 'Oppo Find N3 Flip', 'Oppo', 15000000.00, 4, 'Oppo Find N3 Flip.png', '12/256 GB\r\nBlack'),
(15, 'Samsung A15', 'Samsung', 3500000.00, 7, 'SAMSUNG A15.png', '8/128 GB\r\nBlue'),
(16, 'Samsung A05', 'Samsung', 3000000.00, 8, 'SAMSUNG A05.png', '6/128 GB\r\nLilac'),
(17, 'Vivo Y30', 'Vivo', 2800000.00, 5, 'Vivo V30.png', '6/128 GB\r\nOcean\r\n'),
(18, 'Vivo V29', 'Vivo', 4500000.00, 5, 'Vivo V29.png', '8/128 GB\r\nRed'),
(19, 'Redmi 12', 'Redmi', 6000000.00, 4, 'Redmi 12.png', '8/256 GB\r\nWhite');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pembeli` int(100) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pembeli`, `id_produk`, `jumlah`, `total_harga`, `tanggal_transaksi`) VALUES
(3, 0, 4, 1, 0.00, '2025-02-11 10:10:58'),
(4, 0, 7, 4, 0.00, '2025-02-11 10:18:39'),
(5, 0, 3, 2, 0.00, '2025-02-11 10:22:06'),
(6, 0, 4, 1, 0.00, '2025-02-11 10:27:42'),
(7, 0, 2, 1, 0.00, '2025-02-11 10:51:06'),
(8, 0, 2, 1, 0.00, '2025-02-11 10:55:06'),
(9, 0, 7, 1, 0.00, '2025-02-11 10:58:18'),
(10, 0, 8, 1, 0.00, '2025-02-11 11:08:17'),
(11, 0, 6, 1, 0.00, '2025-02-11 11:09:16'),
(15, 3, 14, 1, 0.00, '2025-02-11 13:10:44'),
(17, 2, 19, 1, 0.00, '2025-02-11 13:30:11'),
(20, 12, 2, 1, 0.00, '2025-02-11 13:57:56'),
(21, 12, 3, 1, 0.00, '2025-02-11 13:58:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`,`id_pembeli`,`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
