-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2021 at 01:34 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(128) NOT NULL,
  `jumlah_pakaian` int(11) NOT NULL,
  `jumlah_berat` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_laundry`
--

INSERT INTO `data_laundry` (`id`, `nama_pelanggan`, `jumlah_pakaian`, `jumlah_berat`, `harga`, `tanggal`) VALUES
(5, 'bayus', 80, 90, 100000, '2021-06-14'),
(6, 'jackos', 20, 10, 50000, '2021-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesan_laundry`
--

CREATE TABLE `detail_pesan_laundry` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pesan_id` int(11) NOT NULL,
  `isi_balasan` text NOT NULL,
  `tanggal` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesan_laundry`
--

INSERT INTO `detail_pesan_laundry` (`id`, `user_id`, `pesan_id`, `isi_balasan`, `tanggal`) VALUES
(1, 14, 1, 'testt', '2021-06-11 17:00:00'),
(4, 14, 2, 'Test reply lagih', '2021-06-11 17:00:00'),
(5, 11, 2, 'test reply admin', '2021-06-11 17:00:00'),
(6, 14, 2, 'woi', '2021-06-11 17:00:00'),
(7, 11, 2, 'woi gan', '2021-06-11 17:00:00'),
(8, 11, 2, 'yaudah gan', '2021-06-11 17:00:00'),
(9, 14, 3, 'udah belum laundrynya mas ?? \r\n', '2021-06-11 17:00:00'),
(10, 11, 3, 'sudah selesai', '2021-06-11 17:00:00'),
(11, 11, 4, 'ada yang bisa saya kami bantu ?\r\n', '2021-08-09 04:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_laundry`
--

CREATE TABLE `pesan_laundry` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan_laundry`
--

INSERT INTO `pesan_laundry` (`id`, `user_id`, `isi_pesan`, `status`, `tanggal`) VALUES
(1, 14, 'tess ting ea', 'Selesai', '2021-06-12'),
(3, 14, 'Kepastian data laundry\r\n', 'Selesai', '2021-06-12'),
(4, 13, 'SAYA', 'Open', '2021-08-09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(7, 'dobby alamsyah', 'dobby13@gmail.com', 'default.jpg', '$2y$10$Wn2d4gKL2iev.PMiin.GWODQb1wTeO4Eex5MPTBuGKFJgaGS3N.Mu', 2, 1, 1604949070),
(8, 'akmal', 'akmalaris13@gmail.com', 'default.jpg', '$2y$10$JxwRb.AJPzdxYX7OVD5e.egn3ZSfpI3z2TRa6/3JT.t4tmKn2QJfS', 1, 1, 1606466098),
(9, 'andre', 'andre35@gmail.com', 'default.jpg', '$2y$10$uBeo/xxmv2hds0YJeKT2tuY769K/pIlevFaCG6JvnxRR0f4G.mfSi', 2, 1, 1606901296),
(10, 'valen', 'valen10@gmail.com', 'default.jpg', '$2y$10$dxBOTpT1kCPFw7q5XThEWuPejEDPGSuuqU8mLqosFOIif407eg/.u', 1, 1, 1606913287),
(11, 'evanmusic', 'evanmusi21@gmail.com', 'Reed_(Arknights)_full_2790189.jpg', '$2y$10$TSG9WrCjiaZjkC.kntlLOu1DDBryPvJupSh0FzL8OcbJ7elGyRynG', 1, 1, 1616733652),
(13, 'Kiki', 'kikiharis12@gmail.com', 'MHW_Icerbone.jpg', '$2y$10$uo9ATNwtpRaxK53p4B1BEeA59WFUzh//ZJG9Qv.j.SIKKRDpuygcC', 2, 1, 1622498367),
(14, 'Tuanzigod', 'zigod13@gmail.com', 'MHW_Icerbone1.jpg', '$2y$10$kMRARHB7HM0Ij2S.KbnQN.x7gBkb2SD6cZ/JVMoUSEtnQy7G2SnW6', 2, 1, 1623472954);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_pesan_laundry`
--
ALTER TABLE `detail_pesan_laundry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pesan_laundry`
--
ALTER TABLE `pesan_laundry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
