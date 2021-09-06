-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2021 at 07:08 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbok_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_laundry`
--

CREATE TABLE `data_laundry` (
  `id` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `jumlah_pakaian` int NOT NULL,
  `jumlah_berat` int NOT NULL,
  `id_paket` int NOT NULL,
  `status_laundry` enum('Dalam antrian','Diproses','Selesai','Dibatalkan','Diambil') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_pembayaran` enum('Belum lunas','Lunas') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_laundry`
--

INSERT INTO `data_laundry` (`id`, `id_pelanggan`, `jumlah_pakaian`, `jumlah_berat`, `id_paket`, `status_laundry`, `status_pembayaran`, `tanggal`) VALUES
(1, 2, 10, 3, 2, 'Dalam antrian', 'Belum lunas', '2021-09-05'),
(2, 2, 4, 1, 2, 'Diambil', 'Lunas', '2021-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesan_laundry`
--

CREATE TABLE `detail_pesan_laundry` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pesan_id` int NOT NULL,
  `isi_balasan` text NOT NULL,
  `tanggal` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paket_laundry`
--

CREATE TABLE `paket_laundry` (
  `id_paket` int NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `harga_paket` int NOT NULL,
  `keterangan_paket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paket_laundry`
--

INSERT INTO `paket_laundry` (`id_paket`, `nama_paket`, `harga_paket`, `keterangan_paket`) VALUES
(1, 'Gosok', 7000, 'ubah keterangan'),
(2, 'Berug 123', 10000, 'berug gannnnnnnnnnnn');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_laundry`
--

CREATE TABLE `pesan_laundry` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Berug', 'me@rafipriatna.id', 'default.jpg', '$2y$10$Tmka8G4lRn.A34f2UBYkieAVGZi7lzMpSuJsnq2DQ7.67H1ZXL7N2', 1, 1, 1630850395),
(2, 'Pelanggan', 'pelanggan@rafipriatna.id', 'default.jpg', '$2y$10$y5BKYPNBTDHxke.rZ5nGIuAl34DhYw9srn5nO1YMYMIV2SOpeKe56', 2, 1, 1630853147);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_laundry`
--
ALTER TABLE `data_laundry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pesan_laundry`
--
ALTER TABLE `detail_pesan_laundry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_laundry`
--
ALTER TABLE `paket_laundry`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pesan_laundry`
--
ALTER TABLE `pesan_laundry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_laundry`
--
ALTER TABLE `data_laundry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pesan_laundry`
--
ALTER TABLE `detail_pesan_laundry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paket_laundry`
--
ALTER TABLE `paket_laundry`
  MODIFY `id_paket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan_laundry`
--
ALTER TABLE `pesan_laundry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
