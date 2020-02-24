-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 11:01 AM
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
-- Table structure for table `master_setting`
--

CREATE TABLE `master_setting` (
  `id` int(11) NOT NULL,
  `nama_setting` varchar(255) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_setting`
--

INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES
(1, 'nama_perusahaan', 'PT. BESI BAJA MAKMUR', '2020-02-21 02:53:13'),
(2, 'alamat_perusahaan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2020-02-21 04:56:34'),
(3, 'nomor_telepon', '0120801285082', '2020-02-21 06:11:01'),
(4, 'nomor_fax', '129895925', '2020-02-21 06:11:01'),
(5, 'alamat_email', 'aaskjjaskf@gmail.com', '2020-02-21 06:11:25'),
(6, 'logo_perusahaan', 'a9gA2hVKwZpJ0yot.jpg', '2020-02-21 08:20:06'),
(7, 'prefix_faktur', 'BBM', '2020-02-21 06:11:51'),
(8, 'nomor_faktur', '1', '2020-02-21 06:13:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_setting`
--
ALTER TABLE `master_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_setting`
--
ALTER TABLE `master_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
