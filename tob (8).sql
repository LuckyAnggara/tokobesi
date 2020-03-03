-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2020 at 10:10 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tob`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_biaya`
--

CREATE TABLE `detail_biaya` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `kategori_biaya` int(11) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_biaya`
--

INSERT INTO `detail_biaya` (`id`, `nomor_referensi`, `kategori_biaya`, `keterangan`, `total`, `status`, `user`, `tanggal`) VALUES
(1, 'REF6281730', 1, '24', 123123, 0, 'edwin', '2020-03-03 05:15:58'),
(2, 'REF9284371', 1, 'asdasd', 12313, 0, 'edwin', '2020-03-03 05:57:16'),
(3, 'REF3268971', 1, '213123', 123123, 0, 'edwin', '2020-03-03 06:02:54'),
(4, 'REF7964830', 1, 'asdsd', 123123, 0, 'edwin', '2020-03-03 06:03:36'),
(5, 'REF4567238', 1, 'asdasdasd', 100000, 0, 'edwin', '2020-03-03 07:39:30'),
(6, 'REF4567238', 1, 'asdasdasd', 100000, 0, 'edwin', '2020-03-03 07:39:36'),
(7, 'REF9532714', 1, '123123', 123123, 0, 'edwin', '2020-03-03 07:47:29'),
(8, 'REF9623174', 1, 'sdfsdf', 234234, 0, 'edwin', '2020-03-03 08:06:38'),
(9, 'REF9623174', 1, 'sadds', 12311, 0, 'edwin', '2020-03-03 08:06:45'),
(10, 'REF9623174', 1, 'sadds', 1000000, 0, 'edwin', '2020-03-03 08:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `master_biaya`
--

CREATE TABLE `master_biaya` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_biaya` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_biaya`
--

INSERT INTO `master_biaya` (`id`, `nomor_referensi`, `tanggal`, `total_biaya`, `keterangan`, `status`, `user`) VALUES
(1, 'REF9057863', '2020-03-03 00:00:00', 0, '', 0, 'edwin'),
(2, 'REF6281730', '2020-03-09 00:00:00', 0, '', 0, 'edwin'),
(3, 'REF9284371', '2020-03-09 00:00:00', 0, '', 0, 'edwin'),
(4, 'REF3268971', '2020-03-09 00:00:00', 0, '', 0, 'edwin'),
(5, 'REF7964830', '2020-03-10 00:00:00', 0, '', 0, 'edwin'),
(6, 'REF4567238', '2020-03-11 00:00:00', 0, '', 0, 'edwin'),
(7, 'REF9532714', '2020-03-19 00:00:00', 0, '', 0, 'edwin'),
(8, 'REF9623174', '2020-03-04 00:00:00', 0, '', 0, 'edwin');

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori_biaya`
--

CREATE TABLE `master_kategori_biaya` (
  `id` int(11) NOT NULL,
  `nama_biaya` varchar(255) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_kategori_biaya`
--

INSERT INTO `master_kategori_biaya` (`id`, `nama_biaya`, `keterangan`, `user`, `tanggal_input`) VALUES
(1, 'Listrik', 'Untuk kategori Biaya Listrik', 'dini', '2020-03-03 00:00:00'),
(2, 'Air', 'Untuk kategori biaya air', 'dini', '2020-03-03 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_biaya`
--
ALTER TABLE `detail_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_biaya`
--
ALTER TABLE `master_biaya`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_referensi` (`nomor_referensi`);

--
-- Indexes for table `master_kategori_biaya`
--
ALTER TABLE `master_kategori_biaya`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_biaya`
--
ALTER TABLE `detail_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_biaya`
--
ALTER TABLE `master_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_kategori_biaya`
--
ALTER TABLE `master_kategori_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
