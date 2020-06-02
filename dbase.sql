-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 02:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

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
CREATE DATABASE IF NOT EXISTS `tob` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tob`;

-- --------------------------------------------------------

--
-- Table structure for table `data_bank`
--

CREATE TABLE `data_bank` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_bank`
--

INSERT INTO `data_bank` (`id`, `nama_bank`, `nomor_rekening`, `timestamp`) VALUES
(1, 'BNI', '12039-1293-192-3', '2020-05-28 08:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `detail_biaya`
--

CREATE TABLE `detail_biaya` (
  `id` int(11) NOT NULL,
  `nomor_jurnal` varchar(255) NOT NULL,
  `kategori_biaya` int(11) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_biaya`
--

INSERT INTO `detail_biaya` (`id`, `nomor_jurnal`, `kategori_biaya`, `keterangan`, `total`, `status`, `user`, `tanggal`, `periode`) VALUES
(2, '31032041', 3, 'Pembayaran uang jalan ', 20000, 0, 'edwin', '2020-03-31 06:16:07', 1),
(3, '10042042', 3, 'Bayar ongkos tol, mang xxxx', 98000, 0, 'edwin', '2020-04-10 06:38:30', 1),
(4, '28052042', 1, '123123', 200000, 0, 'edwin', '2020-05-28 12:29:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_coh`
--

CREATE TABLE `detail_coh` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `saldo` double NOT NULL,
  `nominal` double NOT NULL,
  `jenis` int(1) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_coh`
--

INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES
(11, '1', 2000000, 2000000, 1, 'Saldo Awal', '2020-05-28 10:13:39'),
(12, '2', 1000000, 1000000, 1, 'Saldo Awal', '2020-05-28 10:20:00'),
(13, '1', 1000000, 1000000, 3, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-05-28 10:20:00'),
(14, '2', 1024000, 24000, 1, 'Penjualan Tunai Nomor Faktur : bbmkdr280520003', '2020-05-28 11:06:43'),
(15, '2', 1048000, 24000, 1, 'Penjualan Tunai Nomor Faktur : bbmkdr280520004', '2020-05-28 11:34:30'),
(16, '2', 1096000, 48000, 1, 'Penjualan Tunai Nomor Faktur : bbmkdr280520005', '2020-05-28 11:36:26'),
(17, '2', 1756000, 660000, 1, 'Penjualan : bbmkdr280520006 Pembayaran Melalui Transfer ke  KET : asfasf', '2020-05-28 11:37:56'),
(18, '2', 1852000, 96000, 1, 'Penjualan Nomor Faktur : bbmkdr280520007 Pembayaran Melalui Transfer ke Rekening :  KET : asdasdasdasd ', '2020-05-28 11:39:50'),
(19, '2', 1900000, 48000, 1, 'Penjualan Nomor Faktur : bbmkdr280520008 Pembayaran Melalui Transfer ke Rekening : 1 KET : dasd', '2020-05-28 11:41:07'),
(20, '2', 1924000, 24000, 1, 'Penjualan Nomor Faktur : bbmkdr280520009 Pembayaran Melalui Transfer ke Rekening : \n                        BNI | 12039-1293-192-3 KET : 123123', '2020-05-28 12:16:28'),
(21, '2', 0, 1924000, 2, 'Penyetoran dana', '2020-05-28 12:28:21'),
(22, '1', 2924000, 1924000, 1, 'Dana di setorkan oleh Neng', '2020-05-28 12:28:22'),
(23, '1', 2624000, 300000, 2, 'Debit Pembayaran Gaji Nomor Jurnal : #REF1794823', '2020-05-28 12:28:49'),
(24, '1', 2424000, 200000, 2, 'Debit Biaya LISTRIK Nomor Jurnal : #28052042', '2020-05-28 12:29:11'),
(25, '1', 0, 2424000, 2, 'Penyetoran dana', '2020-05-28 12:30:02'),
(26, '2', 33000, 33000, 1, 'Penjualan Nomor Faktur : bbmkdr280520010 Pembayaran Melalui Transfer ke Rekening : \n                        BNI | 12039-1293-192-3 KET : aaa', '2020-05-28 13:06:33'),
(27, '2', 57000, 24000, 1, 'Penjualan Nomor Faktur : bbmkdr280520011 Pembayaran Melalui Transfer ke Rekening : \n                        BNI | 12039-1293-192-3 KET : aaaaa', '2020-05-28 13:10:09'),
(28, '2', 81000, 24000, 1, 'Penjualan Nomor Faktur : bbmkdr280520012 Pembayaran Melalui Transfer ke Rekening : BNI | 12039-1293-192-3 KET : aaa', '2020-05-28 13:12:02'),
(29, '2', 0, 81000, 2, 'Penyetoran dana', '2020-05-30 12:00:44'),
(30, '1', 81000, 81000, 1, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-05-30 12:00:44'),
(31, '1', 0, 81000, 2, 'Penyetoran dana', '2020-05-30 12:01:20'),
(32, '3', 10000, 10000, 1, 'Saldo Awal', '2020-05-30 12:03:09'),
(33, '4', 100000, 100000, 1, 'Saldo Awal', '2020-05-30 12:04:41'),
(34, '3', 0, 10000, 3, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-05-30 12:04:41'),
(35, '4', 172000, 72000, 1, 'Down Payment (DP) Penjualan Kredit Nomor Faktur : bbmkdr300520013', '2020-05-30 12:05:38'),
(36, '4', 7000, 165000, 2, 'Retur Penjualan Nomor Faktur : bbmkdr280520006', '2020-05-30 12:11:33'),
(38, '4', 0, 7000, 2, 'Penyetoran dana', '2020-06-01 07:59:04'),
(39, '3', 7000, 7000, 1, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-06-01 07:59:04'),
(40, '3', 0, 7000, 2, 'Penyetoran dana', '2020-06-01 07:59:44'),
(41, '5', 100000, 100000, 1, 'Saldo Awal', '2020-06-01 08:00:58'),
(42, '6', 50000, 50000, 1, 'Saldo Awal', '2020-06-01 08:01:32'),
(43, '5', 50000, 50000, 3, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-06-01 08:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `detail_detail_stok_opname`
--

CREATE TABLE `detail_detail_stok_opname` (
  `id` int(11) NOT NULL,
  `id_detail_stok_opname` int(10) NOT NULL,
  `qty` double NOT NULL,
  `keterangan` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_detail_stok_opname`
--

INSERT INTO `detail_detail_stok_opname` (`id`, `id_detail_stok_opname`, `qty`, `keterangan`) VALUES
(1, 386, 0, ''),
(2, 388, 3, 'Rusak');

-- --------------------------------------------------------

--
-- Table structure for table `detail_gaji`
--

CREATE TABLE `detail_gaji` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `gaji_pokok` double NOT NULL,
  `uang_makan` double NOT NULL,
  `bonus` double NOT NULL,
  `total` double NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_gaji`
--

INSERT INTO `detail_gaji` (`id`, `nomor_referensi`, `nip`, `tanggal_pembayaran`, `gaji_pokok`, `uang_makan`, `bonus`, `total`, `status`, `user`, `periode`) VALUES
(72, 'REF7654930', '1', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 'edwin', 1),
(73, 'REF7654930', '123123123', '0000-00-00 00:00:00', 100000, 10000, 0, 110000, 0, 'edwin', 1),
(74, 'REF7654930', '124124', '2020-04-10 06:38:54', 50000, 10000, 0, 60000, 2, 'edwin', 1),
(75, 'REF7654930', '21124124', '2020-04-10 06:38:54', 50000, 10000, 0, 60000, 2, 'edwin', 1),
(76, 'REF7654930', '123123', '2020-04-10 06:38:54', 50000, 10000, 0, 60000, 2, 'edwin', 1),
(77, 'REF7654930', '647476', '0000-00-00 00:00:00', 23424, 24324324, 0, 24347748, 0, 'edwin', 1),
(78, 'REF7654930', '1111', '2020-04-10 06:38:54', 50000, 10000, 0, 60000, 2, 'edwin', 1),
(79, 'REF7654930', '213123', '0000-00-00 00:00:00', 1500000, 200000, 0, 1700000, 0, 'edwin', 1),
(80, 'REF1794823', '1', '2020-05-28 12:28:48', 50000, 10000, 0, 60000, 2, 'edwin', 0),
(81, 'REF1794823', '123123123', '0000-00-00 00:00:00', 100000, 10000, 0, 110000, 0, 'edwin', 0),
(82, 'REF1794823', '124124', '2020-05-28 12:28:48', 50000, 10000, 0, 60000, 2, 'edwin', 0),
(83, 'REF1794823', '21124124', '2020-05-28 12:28:48', 50000, 10000, 0, 60000, 2, 'edwin', 0),
(84, 'REF1794823', '123123', '2020-05-28 12:28:48', 50000, 10000, 0, 60000, 2, 'edwin', 0),
(85, 'REF1794823', '647476', '0000-00-00 00:00:00', 23424, 24324324, 0, 24347748, 0, 'edwin', 0),
(86, 'REF1794823', '1111', '2020-05-28 12:28:48', 50000, 10000, 0, 60000, 2, 'edwin', 0),
(87, 'REF1794823', '213123', '0000-00-00 00:00:00', 1500000, 200000, 0, 1700000, 0, 'edwin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(11) NOT NULL,
  `no_order_pembelian` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `saldo` double NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`, `saldo`, `periode`) VALUES
(1, '2do01Cjnrxve8Rbm', '2020-04-27 00:00:00', 'pembelian-1', 'BES0001', 100, 20000, 0, 2000000, '2020-04-27 00:00:00', 37, 1),
(2, '2do01Cjnrxve8Rbm', '2020-04-27 00:00:00', 'pembelian-1', 'BES0002', 150, 25000, 0, 3750000, '2020-04-27 00:00:00', 119, 1),
(3, 'kF34pMXriyqxQzN1', '2020-05-06 00:00:00', 'pembelian-2', 'BES0001', 20, 300000, 0, 6000000, '2020-05-31 07:19:23', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `no_order_penjualan` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_penjualan` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`, `periode`) VALUES
(1, 'OUT0461835', '2020-04-27 06:16:48', 'bbmkdr270420001', 'BES0001', 20, 24000, 0, 480000, '2020-04-27', 1),
(2, 'OUT6349582', '2020-04-27 06:25:02', 'bbmkdr270420002', 'BES0002', 20, 33000, 0, 660000, '2020-04-27', 1),
(3, 'OUT4398052', '2020-05-28 10:59:47', 'bbmkdr280520003', 'BES0001', 1, 24000, 0, 24000, '2020-05-28', 1),
(4, 'OUT8157369', '2020-05-28 11:34:22', 'bbmkdr280520004', 'BES0001', 1, 24000, 0, 24000, '2020-05-28', 1),
(5, 'OUT6103785', '2020-05-28 11:36:19', 'bbmkdr280520005', 'BES0001', 2, 24000, 0, 48000, '2020-05-28', 1),
(6, 'OUT6734281', '2020-05-28 11:37:41', 'bbmkdr280520006', 'BES0002', 20, 33000, 0, 660000, '2020-05-28', 1),
(7, 'OUT5834216', '2020-05-28 11:39:40', 'bbmkdr280520007', 'BES0001', 4, 24000, 0, 96000, '2020-05-28', 1),
(8, 'OUT6038597', '2020-05-28 11:40:55', 'bbmkdr280520008', 'BES0001', 2, 24000, 0, 48000, '2020-05-28', 1),
(9, 'OUT3182495', '2020-05-28 12:16:16', 'bbmkdr280520009', 'BES0001', 1, 24000, 0, 24000, '2020-05-28', 1),
(10, 'OUT3528071', '2020-05-28 13:06:18', 'bbmkdr280520010', 'BES0002', 1, 33000, 0, 33000, '2020-05-28', 1),
(11, 'OUT5403279', '2020-05-28 13:09:27', 'bbmkdr280520011', 'BES0001', 1, 24000, 0, 24000, '2020-05-28', 1),
(12, 'OUT6548927', '2020-05-28 13:11:53', 'bbmkdr280520012', 'BES0001', 1, 24000, 0, 24000, '2020-05-28', 1),
(13, 'OUT7369240', '2020-05-30 12:05:01', 'bbmkdr300520013', 'BES0001', 30, 24000, 0, 720000, '2020-05-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_persediaan`
--

CREATE TABLE `detail_persediaan` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `saldo` double NOT NULL,
  `debit` double NOT NULL,
  `tanggal_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_persediaan`
--

INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES
(43, 'BES0001', 'bbmkdr310320002', 'pembelian_bersih', 15000, 95, 10, '2020-03-31 06:47:22'),
(44, 'BES0002', 'bbmkdr310320002', 'pembelian_bersih', 20000, 90, 10, '2020-03-31 06:47:22'),
(45, 'BES0001', 'bbmkdr310320002', 'pembelian_bersih', 15000, 95, 10, '2020-03-31 06:49:14'),
(46, 'BES0002', 'bbmkdr310320002', 'pembelian_bersih', 20000, 90, 10, '2020-03-31 06:49:15'),
(47, 'BES0001', 'pembelian-1', 'pembelian_bersih', 20000, 100, 0, '2020-04-27 00:00:00'),
(48, 'BES0001', 'bbmkdr270420001', 'pembelian_bersih', 20000, 80, 20, '2020-04-27 06:16:53'),
(49, 'BES0002', 'bbmkdr270420002', 'pembelian_bersih', 25000, 140, 20, '2020-04-27 06:25:09'),
(50, 'BES0001', 'bbmkdr280520003', 'pembelian_bersih', 20000, 79, 1, '2020-05-28 11:06:43'),
(51, 'BES0001', 'bbmkdr280520004', 'pembelian_bersih', 20000, 78, 1, '2020-05-28 11:34:30'),
(52, 'BES0001', 'bbmkdr280520005', 'pembelian_bersih', 20000, 76, 2, '2020-05-28 11:36:26'),
(53, 'BES0002', 'bbmkdr280520006', 'pembelian_bersih', 25000, 120, 20, '2020-05-28 11:37:55'),
(54, 'BES0001', 'bbmkdr280520007', 'pembelian_bersih', 20000, 72, 4, '2020-05-28 11:39:50'),
(55, 'BES0001', 'bbmkdr280520008', 'pembelian_bersih', 20000, 70, 2, '2020-05-28 11:41:07'),
(56, 'BES0001', 'bbmkdr280520009', 'pembelian_bersih', 20000, 69, 1, '2020-05-28 12:16:28'),
(57, 'BES0002', 'bbmkdr280520010', 'pembelian_bersih', 25000, 119, 1, '2020-05-28 13:06:33'),
(58, 'BES0001', 'bbmkdr280520011', 'pembelian_bersih', 20000, 68, 1, '2020-05-28 13:10:09'),
(59, 'BES0001', 'bbmkdr280520012', 'pembelian_bersih', 20000, 67, 1, '2020-05-28 13:12:01'),
(60, 'BES0001', 'bbmkdr300520013', 'pembelian_bersih', 20000, 37, 30, '2020-05-30 12:05:37'),
(61, 'BES0001', 'pembelian-2', 'pembelian_bersih', 300000, 20, 0, '2020-05-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `detail_piutang`
--

CREATE TABLE `detail_piutang` (
  `id` int(11) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `nominal_pembayaran` double NOT NULL,
  `sisa_piutang` double NOT NULL,
  `tanggal` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_piutang`
--

INSERT INTO `detail_piutang` (`id`, `nomor_faktur`, `nominal_pembayaran`, `sisa_piutang`, `tanggal`, `user`, `bukti`, `keterangan`, `timestamp`, `periode`) VALUES
(1, 'bbmkdr300520013', 72000, 648000, '2020-05-30 12:05:38', 'lucky15', '1', 'Down Payment', '2020-05-30 10:05:38', 1),
(3, 'bbmkdr300520013', 24000, 40800, '2020-05-30 16:12:20', 'lucky15', '', 'Retur Penjualan', '2020-05-30 14:12:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_po`
--

CREATE TABLE `detail_po` (
  `id` int(11) NOT NULL,
  `no_order_po` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_po`
--

INSERT INTO `detail_po` (`id`, `no_order_po`, `tanggal_transaksi`, `kode_barang`, `nama_barang`, `jumlah_pembelian`, `harga_beli`, `total_harga`, `tanggal_input`) VALUES
(8, '200401001', '2020-04-01 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 20, 100000, 20, '2020-04-01'),
(9, '200402006', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 20, 200000, 20, '2020-04-02'),
(10, '200402007', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 20, 100000, 20, '2020-04-02'),
(11, '200402008', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 20, 10000, 20, '2020-04-02'),
(12, '200402001', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 20, 100000, 20, '2020-04-02'),
(13, '200402010', '2020-04-07 00:00:00', 'BES0003', 'BESI BETON POLOS 8 KZBM', 3, 10000, 3, '2020-04-02'),
(14, '200402011', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 3, 6000, 3, '2020-04-02'),
(15, '200402012', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 5, 10, 5, '2020-04-02'),
(16, '200402013', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 5, 5, 5, '2020-04-02'),
(17, '200402014', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 10000, 2, '2020-04-02'),
(18, '200402015', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 10000, 2, '2020-04-02'),
(19, '200402016', '1970-01-01 01:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 10000, 2, '2020-04-02'),
(20, '200402017', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 10000, 2, '2020-04-02'),
(21, '200402018', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 30000, 2, '2020-04-02'),
(22, '200402019', '2020-04-03 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 3, 1000, 3, '2020-04-02'),
(23, '200402020', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 20000, 1, '2020-04-02'),
(24, '200402021', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 20000, 2, '2020-04-02'),
(25, '200402022', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 3, 1000, 3, '2020-04-02'),
(26, '200402023', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 10000, 2, '2020-04-02'),
(27, '200402024', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 123, 2, '2020-04-02'),
(28, '200402025', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 2123, 2, '2020-04-02'),
(29, '200402026', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 22, 1, '2020-04-02'),
(30, '200402027', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 123, 2, '2020-04-02'),
(31, '200402028', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 123, 1, '2020-04-02'),
(32, '200402029', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 0, 1, '2020-04-02'),
(33, '200402030', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 100000, 2, '2020-04-02'),
(34, '200402031', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 123, 1, '2020-04-02'),
(35, '200402032', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 21, 1233, 21, '2020-04-02'),
(36, '200402033', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 123, 2, '2020-04-02'),
(37, '200402034', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 111, 1, '2020-04-02'),
(38, '200402035', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 123, 1, '2020-04-02'),
(39, '200402036', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 1, 0, 1, '2020-04-02'),
(40, '200402037', '2020-04-02 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 23123, 2, '2020-04-02'),
(41, '200403001', '2020-04-03 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 10000, 2, '2020-04-03'),
(42, '200403001', '2020-04-03 00:00:00', 'BES0002', 'BESI BETON POLOS 8 BEH', 3, 10000, 3, '2020-04-03'),
(43, '200407039', '2020-04-07 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 5, 100000, 5, '2020-04-07'),
(44, '200415040', '2020-04-15 00:00:00', 'BES0001', 'BESI BETON POLOS 6 KBM', 2, 16000, 2, '2020-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `detail_po_receive`
--

CREATE TABLE `detail_po_receive` (
  `id` int(11) NOT NULL,
  `no_order_po` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_barang_pembelian`
--

CREATE TABLE `detail_retur_barang_pembelian` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `saldo_tersedia` double NOT NULL,
  `saldo_retur` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_barang_penjualan`
--

CREATE TABLE `detail_retur_barang_penjualan` (
  `id` int(11) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `saldo_tersedia` double NOT NULL,
  `saldo_retur` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_retur_barang_penjualan`
--

INSERT INTO `detail_retur_barang_penjualan` (`id`, `nomor_faktur`, `kode_barang`, `harga_pokok`, `saldo_tersedia`, `saldo_retur`, `keterangan`, `user`, `tanggal_input`, `tanggal_transaksi`, `periode`) VALUES
(1, 'RTR-bbmkdr280520006', 'BES0002', 23000, 5, 5, 'RTR-bbmkdr280520006 - Rusak', 'manajer', '2020-05-30 12:32:42', '2020-05-28 11:37:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_pembelian`
--

CREATE TABLE `detail_retur_pembelian` (
  `id` int(11) NOT NULL,
  `id_detail_pembelian` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `jumlah_retur` double NOT NULL,
  `harga_retur` double NOT NULL,
  `diskon` double NOT NULL,
  `total_retur` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_transaksi` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_penjualan`
--

CREATE TABLE `detail_retur_penjualan` (
  `id` int(11) NOT NULL,
  `id_detail_penjualan` int(11) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `jumlah_retur` double NOT NULL,
  `saldo` double NOT NULL,
  `harga_retur` double NOT NULL,
  `diskon` double NOT NULL,
  `total_retur` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_transaksi` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_retur_penjualan`
--

INSERT INTO `detail_retur_penjualan` (`id`, `id_detail_penjualan`, `nomor_faktur`, `kode_barang`, `keterangan`, `jumlah_retur`, `saldo`, `harga_retur`, `diskon`, `total_retur`, `user`, `tanggal`, `tanggal_transaksi`, `periode`) VALUES
(1, 6, 'RTR-bbmkdr280520006', 'BES0002', 'Rusak', 5, 0, 33000, 0, 165000, 'lucky15', '2020-05-30 10:32:42', '2020-05-28 11:37:55', 1),
(3, 13, 'RTR-bbmkdr300520013', 'BES0001', '', 1, 1, 24000, 0, 24000, 'lucky15', '2020-05-30 14:12:20', '2020-05-30 12:05:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_stok_opname`
--

CREATE TABLE `detail_stok_opname` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `saldo_buku` double NOT NULL,
  `saldo_fisik` double NOT NULL,
  `selisih` double NOT NULL,
  `koreksi` double NOT NULL,
  `nomor_referensi_detail` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_utang`
--

CREATE TABLE `detail_utang` (
  `id` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `nominal_pembayaran` double NOT NULL,
  `sisa_utang` double NOT NULL,
  `tanggal` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_utang`
--

INSERT INTO `detail_utang` (`id`, `nomor_transaksi`, `nominal_pembayaran`, `sisa_utang`, `tanggal`, `user`, `bukti`, `keterangan`, `timestamp`, `periode`) VALUES
(2, 'cobacoba', 0, 150000, '2020-03-27 07:17:46', 'dini', '1', 'Down Payment', '2020-04-27 03:32:33', 1),
(3, 'cobacoba', 30000, 120000, '2020-03-27 00:00:00', 'dini', '', 'Retur Pembelian', '2020-04-27 03:32:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `harga_detail_pembelian`
--

CREATE TABLE `harga_detail_pembelian` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `harga` double NOT NULL,
  `sisa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `kode_barang` varchar(255) NOT NULL,
  `tipe_barang` int(11) DEFAULT 0,
  `jenis_barang` int(11) DEFAULT 0,
  `merek_barang` int(11) DEFAULT 0,
  `kode_supplier` varchar(128) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_satuan` double NOT NULL,
  `harga_kedua` double NOT NULL,
  `harga_ketiga` double NOT NULL,
  `kode_satuan` int(11) DEFAULT 0,
  `persediaan_minimum` int(11) NOT NULL DEFAULT 0,
  `metode_hpp` varchar(255) NOT NULL,
  `komisi_sales` double NOT NULL DEFAULT 0,
  `gambar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES
('BES0001', 1, 3, 4, 'BIR674', 'BESI BETON POLOS 6 KBM', 17404, 24000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-03-01 04:15:57', 0),
('BES0002', 1, 3, 5, 'FCL359', 'BESI BETON POLOS 8 BEH', 28568, 33000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BES0003', 1, 3, 6, 'FCL359', 'BESI BETON POLOS 8 KZBM', 26568, 30000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BES0004', 1, 3, 4, 'OCZ285', 'BESI BETON POLOS 8 KBM', 27188, 33000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BES0005', 1, 3, 4, 'OCZ285', 'BESI BETON POLOS 10 KBM', 39262, 55000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BES0006', 1, 3, 7, 'HWI209', 'BESI BETON POLOS 12 DAS', 56175, 72000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BES0007', 1, 3, 8, 'HWI209', 'BESI BETON ULIR 13 YES', 74375, 89250, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BES0008', 1, 3, 7, 'HWI209', 'BESI BETON ULIR 16 DAS', 101650, 122000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BES0064', 1, 3, 9, 'BIR674', 'BESI BBM PUNYA', 0, 20000, 19000, 18000, 6, 0, 'FIFO', 0, 'BES0064.jpg', 'besi produksi besi baja makmur', 0, 'edwin', '2020-03-01 07:01:56', 0),
('BON0009', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ MTR', 66040, 81000, 0, 0, 7, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 1),
('BON0010', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ 4 MTR', 264160, 324000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BON0011', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ 5MTR', 330200, 405000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BON0012', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ 6MTR', 396240, 486000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BON0013', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ 4MTR', 275880, 340000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BON0014', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ 5 MTR', 344850, 425000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BON0015', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ 6 MTR', 413820, 510000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('BON0016', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ MTR', 68970, 85000, 0, 0, 7, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('CNP0017', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.55 mm', 41820, 49500, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('CNP0018', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.60 mm', 45750, 51500, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('CNP0019', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.65 mm', 44240, 55500, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('CNP0020', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.70 mm', 47730, 61500, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('CNP0021', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.75 mm', 54625, 64000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('CNP0022', 1, 6, 10, 'BIR674', 'CNP 75/35 TL  1.0 mm', 76101, 98000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DEM0023', 1, 7, 11, 'SMV257', 'DEMPUL ISAMU 1 KG', 53500, 64000, 0, 0, 9, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DEM0024', 1, 7, 11, 'SMV257', 'DEMPUL ISAMU 1/4 KG', 20500, 25000, 0, 0, 9, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DEM0025', 1, 7, 12, 'SMV257', 'DEMPUL SANPOLAC 1 KG', 36500, 43800, 0, 0, 9, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DEM0026', 1, 7, 12, 'SMV257', 'DEMPUL SANPOLAC 1/4 KG', 15500, 19000, 0, 0, 9, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DEM0027', 1, 7, 12, 'SMV257', 'DEMPUL SANPOLAC GALON', 122500, 147000, 0, 0, 9, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DIN0028', 1, 8, 13, 'SMV257', 'DINABOLT 10X50', 700, 850, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DIN0029', 1, 8, 13, 'SMV257', 'DINABOLT 10X65', 806, 1000, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DIN0030', 1, 8, 13, 'SMV257', 'DINABOLT 10X77', 962, 1500, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DIN0031', 1, 8, 13, 'SMV257', 'DINABOLT 8X40', 1087, 2000, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('DIN0032', 1, 8, 13, 'SMV257', 'DINABOLT 8X65', 1279, 2000, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('GEN0033', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR COKLAT', 15625, 24000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('GEN0034', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR HIJAU', 15625, 24000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('GEN0035', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR HITAM', 15625, 24000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('GEN0036', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR MERAH', 15625, 24000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('GEN0063', 1, 9, 1, 'BIR674', 'GENTENG', 0, 14000, 15000, 16000, 6, 10, 'FIFO', 0, 'GEN0063.jpg', '', 0, 'edwin', '2020-03-01 06:22:42', 0),
('HOL0037', 1, 10, 9, 'BIR674', 'HOLLO PLAFON 2X4', 9576, 15000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('HOL0038', 1, 10, 9, 'BIR674', 'HOLLO PLAFON 4X4', 12768, 18000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('KAW0040', 1, 12, 15, 'BMX310', 'KAWAT LAS RD 260 @ 2.6 mm', 42000, 0, 0, 0, 10, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('KAW0041', 1, 12, 15, 'BMX310', 'KAWAT LAS RD 260 @ 2.0 mm', 115000, 132000, 0, 0, 10, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('KAW0042', 1, 17, 16, 'HWI209', 'KAWAT TALI BETON ', 60000, 69000, 0, 0, 12, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('KIN0043', 1, 13, 17, 'BMX310', 'KINIK 14\"', 11787, 14000, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('KIN0044', 1, 13, 17, 'BMX310', 'KINIK 4X8', 35000, 40250, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('PAP0039', 1, 11, 14, 'XQO406', 'PAPAN GPYSUM 9mm x 1200mm x 2400 mm', 7000, 8500, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SKR0045', 1, 14, 18, 'ESF053', 'SKRUP RENG 10 X 16', 107, 150, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SKR0046', 1, 14, 18, 'ESF053', 'SKRUP BAJA 10 X 19', 117, 200, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SKR0047', 1, 14, 18, 'ESF053', 'SKRUP GYPSUM 1\"', 46, 75, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SKR0048', 1, 14, 18, 'ESF053', 'SKRUP GYPSUM 1. 1/4\"', 76, 85, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0049', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ mtr', 27010, 34000, 0, 0, 7, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0050', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ 4 MTR', 108040, 136000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0051', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ 5 MTR', 135050, 170000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0052', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ 6 MTR', 162060, 204000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0053', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@ 4 MTR', 135240, 172000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0054', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@ 5 MTR', 169050, 215000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0055', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@ 6 MTR', 202860, 258000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('SPA0056', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@mtr', 33810, 43000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('WD0057', 1, 13, 19, 'BIR674', 'WD 4\"', 2300, 4000, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('WD0058', 1, 13, 19, 'BIR674', 'WD 14\"', 26000, 30000, 0, 0, 11, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('WIR0059', 1, 16, 1, 'DDW516', 'Wire Mesh M6 ', 176457, 240000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('WIR0060', 1, 16, 1, 'DDW516', 'Wire Mesh M8 K', 278080, 400000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('WIR0061', 1, 16, 1, 'DDW516', 'Wire Mesh M8 B ', 328182, 440000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0),
('WIR0062', 1, 16, 1, 'DDW516', 'Wire Mesh M10', 485894, 730000, 0, 0, 8, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);

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
  `user` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_cabang`
--

CREATE TABLE `master_cabang` (
  `id` int(11) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_cabang`
--

INSERT INTO `master_cabang` (`id`, `nama_cabang`, `link`, `alamat`, `nomor_telepon`) VALUES
(1, 'dummy', 'dummy.bbmakmur.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_coh`
--

CREATE TABLE `master_coh` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `nomor_referensi_spv` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `saldo_awal` double NOT NULL,
  `saldo_proses` double NOT NULL,
  `saldo_akhir` double NOT NULL,
  `status` int(1) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_coh`
--

INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES
(4, '1', '', 'edwin', 4, 2000000, 0, 0, 2, 'asdasdasd', '2020-05-28 10:13:16'),
(5, '2', '1', 'lucky15', 1, 1000000, 0, 0, 2, '', '2020-05-28 10:19:41'),
(6, '3', '', 'edwin', 4, 10000, 0, 0, 2, 'dasdasd', '2020-05-30 12:02:43'),
(7, '4', '3', 'lucky15', 1, 100000, 0, 0, 2, 'gfh', '2020-05-30 12:04:04'),
(8, '5', '', 'edwin', 4, 100000, 0, 50000, 1, '', '2020-06-01 08:00:40'),
(9, '6', '5', 'lucky15', 1, 50000, 0, 50000, 1, 'sadasd', '2020-06-01 08:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `master_coh_permintaan`
--

CREATE TABLE `master_coh_permintaan` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `nominal` double NOT NULL,
  `jenis_permintaan` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  `spv` varchar(255) NOT NULL,
  `approval` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_coh_permintaan`
--

INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES
(6, '1', 2000000, 3, 2, 'edwin', '', 'manajer', 3, '2020-05-28 10:13:16'),
(7, '2', 1000000, 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-05-28 10:19:41'),
(8, '2', 1924000, 2, 2, 'manajer', 'edwin', 'edwin', 2, '2020-05-28 12:27:53'),
(9, '1', 2424000, 2, 2, 'edwin', '', 'manajer', 3, '2020-05-28 12:29:39'),
(10, '2', 81000, 2, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-05-30 11:54:29'),
(11, '1', 81000, 2, 2, 'edwin', '', 'manajer', 3, '2020-05-30 12:00:53'),
(12, '2', 0, 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-05-30 12:01:38'),
(13, '1', 0, 5, 2, 'edwin', '', 'manajer', 3, '2020-05-30 12:02:07'),
(14, '3', 10000, 3, 2, 'edwin', '', 'manajer', 3, '2020-05-30 12:02:43'),
(15, '4', 10000, 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-05-30 12:04:04'),
(16, '4', 7000, 2, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-06-01 07:58:46'),
(17, '3', 7000, 2, 2, 'edwin', '', 'manajer', 3, '2020-06-01 07:59:12'),
(18, '4', 0, 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-06-01 07:59:26'),
(19, '3', 0, 5, 2, 'edwin', '', 'manajer', 3, '2020-06-01 08:00:06'),
(20, '5', 100000, 3, 2, 'edwin', '', 'manajer', 3, '2020-06-01 08:00:40'),
(21, '6', 50000, 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-06-01 08:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `master_gaji`
--

CREATE TABLE `master_gaji` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `total_pembayaran` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_gaji`
--

INSERT INTO `master_gaji` (`id`, `tanggal`, `nomor_referensi`, `total_pembayaran`, `keterangan`, `status`, `user`, `periode`) VALUES
(24, '2020-04-10 00:00:00', 'REF7654930', 240000, '', 2, 'edwin', 1),
(25, '2020-05-28 00:00:00', 'REF1794823', 300000, '', 2, 'edwin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_harga_pokok_penjualan`
--

CREATE TABLE `master_harga_pokok_penjualan` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `sisa` double NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_jual` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_harga_pokok_penjualan`
--

INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `sisa`, `harga_pokok`, `harga_jual`, `keterangan`, `jenis_barang`, `tag`, `periode`) VALUES
(1, '2020-04-27 06:16:53', 'bbmkdr270420001', 'BES0001', 20, 80, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(2, '2020-04-27 06:25:08', 'bbmkdr270420002', 'BES0002', 10, 0, 25000, 33000, 'FIFO', 'saldo_awal', 'saldoawal_3', 1),
(3, '2020-04-27 06:25:09', 'bbmkdr270420002', 'BES0002', 10, 140, 25000, 33000, 'FIFO', 'pembelian_bersih', '2', 1),
(4, '2020-05-28 11:06:43', 'bbmkdr280520003', 'BES0001', 1, 79, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(5, '2020-05-28 11:34:30', 'bbmkdr280520004', 'BES0001', 1, 78, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(6, '2020-05-28 11:36:26', 'bbmkdr280520005', 'BES0001', 2, 76, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(7, '2020-05-28 11:37:55', 'bbmkdr280520006', 'BES0002', 0, 0, 25000, 33000, 'FIFO', 'saldo_awal', 'saldoawal_3', 1),
(8, '2020-05-28 11:37:55', 'bbmkdr280520006', 'BES0002', 20, 120, 25000, 33000, 'FIFO', 'pembelian_bersih', '2', 1),
(9, '2020-05-28 11:39:50', 'bbmkdr280520007', 'BES0001', 4, 72, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(10, '2020-05-28 11:41:07', 'bbmkdr280520008', 'BES0001', 2, 70, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(11, '2020-05-28 12:16:28', 'bbmkdr280520009', 'BES0001', 1, 69, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(12, '2020-05-28 13:06:32', 'bbmkdr280520010', 'BES0002', 0, 0, 25000, 33000, 'FIFO', 'saldo_awal', 'saldoawal_3', 1),
(13, '2020-05-28 13:06:32', 'bbmkdr280520010', 'BES0002', 1, 119, 25000, 33000, 'FIFO', 'pembelian_bersih', '2', 1),
(14, '2020-05-28 13:10:09', 'bbmkdr280520011', 'BES0001', 1, 68, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(15, '2020-05-28 13:12:01', 'bbmkdr280520012', 'BES0001', 1, 67, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1),
(16, '2020-05-30 12:05:37', 'bbmkdr300520013', 'BES0001', 30, 37, 20000, 24000, 'FIFO', 'pembelian_bersih', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_insentif`
--

CREATE TABLE `master_insentif` (
  `id` int(11) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `gross_penjualan` double NOT NULL,
  `insentif` double NOT NULL,
  `total_insentif` double NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_barang`
--

CREATE TABLE `master_jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL,
  `kode_jenis_barang` varchar(128) NOT NULL,
  `nama_jenis_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_jenis_barang`
--

INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES
(3, 'BB', 'BESI BETON', 'jenis barang besi beton', 'supervisor', '2020-02-29 08:36:26'),
(5, 'FD', 'FLOORDECK', 'untuk jenis barang floordeck', 'supervisor', '2020-02-29 08:36:31'),
(6, 'BR', 'BAJA RINGAN', 'Jenis Barang baja ringan', 'supervisor', '2020-02-29 08:36:36'),
(7, 'DEMP', 'DEMPUL', 'jenis barang dempul', 'supervisor', '2020-02-29 08:35:12'),
(8, 'BAUD', 'BAUD', 'jenis barang baud', 'supervisor', '2020-02-29 08:35:26'),
(9, 'GTG', 'GENTENG', 'jenis barang genteng', 'supervisor', '2020-02-29 08:36:42'),
(10, 'HL', 'HOLLO', 'jenis barang hollo', 'supervisor', '2020-02-29 08:36:46'),
(11, 'GYP', 'GYPSUM', 'jenis barang gypsum', 'supervisor', '2020-02-29 08:36:22'),
(12, 'KL', 'KAWAT LAS', 'jenis barang kawat las', 'supervisor', '2020-02-29 08:37:06'),
(13, 'BP', 'BATU POTONG', 'jenis barang batu potong', 'supervisor', '2020-02-29 08:37:21'),
(14, 'SKR', 'SKRUP', 'jenis barang skrup', 'supervisor', '2020-02-29 08:37:37'),
(15, 'AR', 'ATAP RINGAN', 'jenis barang atap ringan', 'supervisor', '2020-02-29 08:38:00'),
(16, 'WM', 'WIREMESH', 'jenis barang wiremesh', 'supervisor', '2020-02-29 08:38:11'),
(17, 'KB', 'KAWAT BETON', 'untuk jenis kawat beton', 'supervisor', '2020-02-29 10:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `master_kartu_persediaan`
--

CREATE TABLE `master_kartu_persediaan` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jumlah` double NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori_biaya`
--

CREATE TABLE `master_kategori_biaya` (
  `id` int(11) NOT NULL,
  `nama_biaya` varchar(255) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_kategori_biaya`
--

INSERT INTO `master_kategori_biaya` (`id`, `nama_biaya`, `keterangan`, `user`, `tanggal_input`, `status`) VALUES
(1, 'LISTRIK', 'Untuk kateg', 'edwin', '2020-03-04 07:50:39', 0),
(3, 'ONGKOS', 'asdasd', 'edwin', '2020-03-04 07:53:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_merek_barang`
--

CREATE TABLE `master_merek_barang` (
  `id_merek_barang` int(11) NOT NULL,
  `kode_merek_barang` varchar(128) NOT NULL,
  `nama_merek_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_merek_barang`
--

INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES
(1, 'NONE', 'TANPA MEREK', '', 'supervisor', '2020-02-29 00:00:00'),
(4, 'KBM', 'KBM', '', 'supervisor', '2020-02-29 08:38:31'),
(5, 'BEH', 'BEH', '', 'supervisor', '2020-02-29 08:38:41'),
(6, 'KZBM', 'KZBM', '', 'supervisor', '2020-02-29 08:38:49'),
(7, 'DAS', 'DAS', '', 'supervisor', '2020-02-29 08:38:57'),
(8, 'YES', 'YES', '', 'supervisor', '2020-02-29 08:39:02'),
(9, 'BBM', 'BBM', '', 'supervisor', '2020-02-29 08:39:08'),
(10, 'BBMT', 'BBM TRUSS', '', 'supervisor', '2020-02-29 08:39:26'),
(11, 'ISAMU', 'ISAMU', '', 'supervisor', '2020-02-29 08:39:36'),
(12, 'SANPOLAC', 'SANPOLAC', '', 'supervisor', '2020-02-29 08:39:48'),
(13, 'WOWO', 'WOWO', '', 'supervisor', '2020-02-29 08:39:58'),
(14, 'APLUS', 'APLUS', '', 'supervisor', '2020-02-29 08:40:17'),
(15, 'NS', 'NIKO STEEL', '', 'supervisor', '2020-02-29 08:40:29'),
(16, 'BWG21', 'BWG 21', '', 'supervisor', '2020-02-29 08:41:37'),
(17, 'KINIK', 'KINIK', '', 'supervisor', '2020-02-29 08:41:50'),
(18, 'PROFIT', 'PROFIT', '', 'supervisor', '2020-02-29 08:41:59'),
(19, 'WD', 'WD', '', 'supervisor', '2020-02-29 08:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `master_pegawai`
--

CREATE TABLE `master_pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `status_gaji` int(1) NOT NULL,
  `gaji_pokok` double NOT NULL,
  `uang_makan` double NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `has_user` int(1) NOT NULL DEFAULT 0,
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pegawai`
--

INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `status_gaji`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES
(1, '1', '0', 'Neng Yuliantin', 1, 'Jl Raya Limbangan', '', '', 'Garut', '2018-12-01', '2020-02-01', '', 'Direktur', '0', '0-0', '0', 1, 0, 50000, 10000, 'SpDT0P752ut6lZHE.jpeg', 1, '', '2020-03-31 00:26:16'),
(10, '123123123', '123123123123', 'LUCKY ANGGARA', 0, 'BANDUNG', 'BANDUNG', 'BANDUNG', 'BANDUNG', '1992-07-15', '2020-03-01', 'SARJANA', 'KASIR', '082116562811', 'BNI - 0468995561', '12312312312', 1, 1, 100000, 10000, '123123123.jpg', 1, 'manajer', '2020-03-31 00:21:42'),
(11, '124124', '1241241', 'DINI', 1, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-18', '2020-03-01', 'SMA', 'ADMIN', '08800', 'BNI - 080808', '123123', 1, 0, 50000, 10000, 'default.jpg', 1, 'manajer', '2020-03-17 21:34:29'),
(12, '21124124', '124124124', 'HADIYAN', 0, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-09', '2020-03-01', '0', 'SALES', '0808080', 'ASAS - 54654654', '21313', 1, 0, 50000, 10000, 'zHvecxlT95JgSsdk.png', 1, 'manajer', '2020-03-31 00:28:26'),
(13, '123123', '1231231', 'EDWIN', 0, 'JAKARTA', 'JAKARTA', 'JAKARTA', 'JAKARTA', '2020-03-26', '2020-03-01', 'MAGISTER', 'SUPERVISOR', '9128491248', 'BA - 31231', '213123', 1, 0, 50000, 10000, '123123.jpg', 1, 'manajer', '2020-03-01 23:07:10'),
(14, '647476', '54345354354', 'GJHGJHG', 0, 'HGDGHDHGD', 'GDGFDGFQ', 'HGDGHDH', 'DGFDGFD', '2020-03-20', '2020-03-06', 'GFHGFG', 'GDGHDHG', '67456456', 'GFHGF - 345354', '564564654564', 1, 1, 23424, 24324324, '647476.png', 0, 'manajer', '2020-03-31 00:21:45'),
(15, '1111', '123123', 'DESI', 1, '123123', '12312', '3123', '123', '2020-03-16', '2020-03-18', '123123', 'KASIR', '123123', 'BNI - 123123', 'ASDASD', 1, 0, 50000, 10000, 'default.jpg', 1, 'manajer', '2020-03-17 21:34:35'),
(16, '213123', '123123', 'QWEQWEQWE', 1, 'QWEQWEQ', 'QWEQ', 'QWEQW', 'EQWE', '2020-03-12', '2020-03-24', 'QWEQWE', 'QWEQWE', '213123', '123123 - 12323', '123123', 1, 1, 1500000, 200000, 'default.jpg', 0, 'manajer', '2020-03-31 01:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `master_pelanggan`
--

CREATE TABLE `master_pelanggan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `tipe_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `status_pelanggan` int(11) NOT NULL,
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pelanggan`
--

INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES
(1, 'E9DrUzjt8lAcsNu0', '', 'lucky', 'asda', '', 'asd', '', '', 1, '0000-00-00', ''),
(2, 'pbhy78RH0NqfY5GF', '', '22', '', '', '', '', '', 1, '0000-00-00', ''),
(4, 'hZonWQIws8NtPmlX', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
(5, 'fL3ly8wOgdNBTQci', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
(6, 'U3iRGhTn6uSaCMO2', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
(7, '8tA0scwEmXOUYvrW', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
(8, 'Q3mdZwEsM1KUxgoX', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
(9, 'R2TQ3USPsE16cmfb', '', '11', '', '', '', '', '', 1, '0000-00-00', ''),
(10, 'GT6C8eShvuR2irLY', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
(11, '1S0xEKIjTJOfZL5P', '', 'asd', '', '', '', '', '', 1, '0000-00-00', ''),
(12, 'DiF5zgx8ujn04kZK', '', 'desi', '12312', '', '123', '', '', 1, '0000-00-00', ''),
(13, 'XyFxLKNV4wduO526', '', 'Lucky', 'asdasdasdasd', '', '2141241', '', '', 1, '0000-00-00', ''),
(14, 'HWW1875', 'general', 'AAAAA', '11', 'aaa@gmail.com', '111', '11.111.111.1-111.111', '111-111111-111', 0, '2020-03-05', 'lucky15'),
(15, '7FIhWcKzNrqiEOnf', '', 'sdasd', 'asdasd', '', '', '', '', 1, '0000-00-00', ''),
(16, 'SM1QV09uoD5NF3HE', '', 'Lucky', 'asd', '', '', '', '', 1, '0000-00-00', ''),
(17, 'CpgEnflkPVbwKAIT', '', 'SFSASF', 'ASFASF', '', 'ASF', '', '', 1, '0000-00-00', ''),
(18, 'CZI9xi5Dy6qfrlGL', '', 'Lucky', 'Pasir Honje', '', '01203124', '', '', 1, '0000-00-00', ''),
(19, '7t5dq9Pm2jgfQVOx', '', 'Dini', 'Lewat', '', 'sdas', '', '', 1, '0000-00-00', ''),
(20, '84s7cRkvFtu6JhpA', '', 'asdasdas', '', '', '', '', '', 1, '0000-00-00', ''),
(21, '1A4mrlCKGISNtDFM', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
(22, 'e4O8CbzmsSyaZ0oI', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
(23, 'fOBW0QxiV14SjzUK', '', 'asdasd', '', '', '', '', '', 1, '0000-00-00', ''),
(24, '1CiwT5JcdkIKjGqb', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
(25, 'Repdf4lZsYGMoEAJ', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
(26, 'Kk7rTyzUOAQCjLD2', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
(27, '9lS0BmxXrcMILywt', '', 'asa', '', '', '', '', '', 1, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_pembelian`
--

CREATE TABLE `master_pembelian` (
  `no_order_pembelian` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `total_pembelian` double NOT NULL,
  `diskon` double NOT NULL,
  `pajak_keluaran` double NOT NULL,
  `ongkir` double NOT NULL,
  `grand_total` double NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status_bayar` int(1) NOT NULL,
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `lampiran`, `status_bayar`, `tanggal_input`, `user`, `periode`) VALUES
('2do01Cjnrxve8Rbm', 'pembelian-1', '2020-04-27 00:00:00', 'BIR674', 5750000, 0, 0, 0, 5750000, '', 1, '2020-04-27', 'dini', 1),
('kF34pMXriyqxQzN1', 'pembelian-2', '2020-05-06 00:00:00', 'BIR674', 6000000, 0, 0, 0, 6000000, '', 1, '2020-05-31', 'dini', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_penerimaan_po`
--

CREATE TABLE `master_penerimaan_po` (
  `id` int(11) NOT NULL,
  `no_order_po` varchar(255) NOT NULL,
  `kode_cabang` varchar(255) NOT NULL,
  `tanggal_terima` datetime NOT NULL,
  `total` double NOT NULL,
  `biaya_lainnya` double NOT NULL,
  `grand_total` double NOT NULL,
  `keterangan` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_penjualan`
--

CREATE TABLE `master_penjualan` (
  `id` int(11) NOT NULL,
  `no_order_penjualan` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `total_penjualan` double NOT NULL DEFAULT 0,
  `diskon` double DEFAULT 0,
  `pajak_masukan` double NOT NULL DEFAULT 0,
  `ongkir` double NOT NULL DEFAULT 0,
  `grand_total` double NOT NULL DEFAULT 0,
  `status_bayar` int(1) NOT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `tanggal_input` date NOT NULL,
  `sales` varchar(255) NOT NULL DEFAULT 'nosales',
  `user` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `no_polisi` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`, `keterangan`, `no_polisi`, `periode`) VALUES
(1, 'OUT0461835', '2020-04-27 06:16:53', 'bbmkdr270420001', 'HWW1875', 480000, 0, 0, 0, 480000, 1, NULL, '2020-04-27', 'nosales', 'lucky15', '', '123123', 1),
(2, 'OUT6349582', '2020-04-27 06:25:08', 'bbmkdr270420002', '84s7cRkvFtu6JhpA', 660000, 0, 0, 0, 660000, 1, NULL, '2020-04-27', 'nosales', 'lucky15', '', '', 1),
(3, 'OUT4398052', '2020-05-28 11:06:42', 'bbmkdr280520003', '1A4mrlCKGISNtDFM', 24000, 0, 0, 0, 24000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', '123123', '', 1),
(4, 'OUT8157369', '2020-05-28 11:34:29', 'bbmkdr280520004', 'HWW1875', 24000, 0, 0, 0, 24000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', ' KET : asdasd', '', 1),
(5, 'OUT6103785', '2020-05-28 11:36:25', 'bbmkdr280520005', 'e4O8CbzmsSyaZ0oI', 48000, 0, 0, 0, 48000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', ' KET : 124', '', 1),
(6, 'OUT6734281', '2020-05-28 11:37:55', 'bbmkdr280520006', 'HWW1875', 660000, 0, 0, 0, 660000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', ' KET : asfasf', '', 1),
(7, 'OUT5834216', '2020-05-28 11:39:50', 'bbmkdr280520007', 'HWW1875', 96000, 0, 0, 0, 96000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', ' KET : asdasdasdasd ', '', 1),
(8, 'OUT6038597', '2020-05-28 11:41:06', 'bbmkdr280520008', 'fOBW0QxiV14SjzUK', 48000, 0, 0, 0, 48000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', '1 KET : dasd', '', 1),
(9, 'OUT3182495', '2020-05-28 12:16:27', 'bbmkdr280520009', '1CiwT5JcdkIKjGqb', 24000, 0, 0, 0, 24000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', 'BNI | 12039-1293-192-3 KET : 123123', '', 1),
(10, 'OUT3528071', '2020-05-28 13:06:32', 'bbmkdr280520010', 'Repdf4lZsYGMoEAJ', 33000, 0, 0, 0, 33000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', '\n                        BNI | 12039-1293-192-3 KET : aaa', '', 1),
(11, 'OUT5403279', '2020-05-28 13:10:09', 'bbmkdr280520011', 'Kk7rTyzUOAQCjLD2', 24000, 0, 0, 0, 24000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', '\n                        BNI | 12039-1293-192-3 KET : aaaaa', '', 1),
(12, 'OUT6548927', '2020-05-28 13:12:01', 'bbmkdr280520012', '9lS0BmxXrcMILywt', 24000, 0, 0, 0, 24000, 1, NULL, '2020-05-28', 'nosales', 'lucky15', 'BNI | 12039-1293-192-3 KET : aaa', '', 1),
(13, 'OUT7369240', '2020-05-30 12:05:37', 'bbmkdr300520013', 'HWW1875', 720000, 0, 0, 0, 720000, 0, NULL, '2020-05-30', 'nosales', 'lucky15', ' KET : ', '123asda23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_periode`
--

CREATE TABLE `master_periode` (
  `id` int(11) NOT NULL,
  `periode` varchar(255) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_periode`
--

INSERT INTO `master_periode` (`id`, `periode`, `periode_awal`, `periode_akhir`) VALUES
(1, '2020', '2020-01-01', '2020-12-31'),
(2, '2021', '2021-01-01', '2021-12-31'),
(5, '2022', '2020-05-01', '2020-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `master_persediaan`
--

CREATE TABLE `master_persediaan` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(128) NOT NULL,
  `jumlah_persediaan` double NOT NULL,
  `jumlah_keranjang` double NOT NULL,
  `jumlah_persediaan_sementara` double NOT NULL COMMENT 'temporary jumlah persediaan setelah di pesan',
  `tanggal_input` datetime NOT NULL,
  `no_order_terakhir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_piutang`
--

CREATE TABLE `master_piutang` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_tagihan` double NOT NULL,
  `total_pembayaran` double NOT NULL,
  `down_payment` double NOT NULL DEFAULT 0,
  `sisa_piutang` double NOT NULL DEFAULT 0,
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_piutang`
--

INSERT INTO `master_piutang` (`id`, `no_faktur`, `tanggal_jatuh_tempo`, `total_tagihan`, `total_pembayaran`, `down_payment`, `sisa_piutang`, `tanggal_input`, `user`, `periode`) VALUES
(1, 'bbmkdr300520013', '2020-06-01', 720000, 96000, 72000, 624000, '2020-05-30', 'lucky15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_po`
--

CREATE TABLE `master_po` (
  `id` int(20) NOT NULL,
  `no_order_po` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `cabang` varchar(255) NOT NULL,
  `total_pembelian` double NOT NULL,
  `biaya_lainnya` double NOT NULL,
  `grand_total` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_po`
--

INSERT INTO `master_po` (`id`, `no_order_po`, `tanggal_transaksi`, `cabang`, `total_pembelian`, `biaya_lainnya`, `grand_total`, `keterangan`, `status`, `tanggal_input`, `user`) VALUES
(38, '200403001', '2020-04-03 00:00:00', 'pusat', 50000, 0, 50000, '1231231231', 1, '2020-04-03', 'dini'),
(39, '200407039', '2020-04-07 00:00:00', 'kdr', 500000, 0, 500000, 'aasdasdasdad', 1, '2020-04-07', 'dini'),
(40, '200415040', '2020-04-15 00:00:00', 'dummy', 32000, 0, 32000, '', 1, '2020-04-15', 'dini');

-- --------------------------------------------------------

--
-- Table structure for table `master_purchase_order`
--

CREATE TABLE `master_purchase_order` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `total_penjualan` double NOT NULL,
  `diskon` double NOT NULL,
  `pajak_masukan` double NOT NULL,
  `ongkir` double NOT NULL,
  `grand_total` double NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `admin` varchar(255) NOT NULL,
  `status_po` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_purchase_order`
--

INSERT INTO `master_purchase_order` (`id`, `tanggal_transaksi`, `no_order`, `sales`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `tanggal_input`, `user`, `admin`, `status_po`) VALUES
(1, '0000-00-00 00:00:00', 'PO.090320001', 'hadi', 'HWW1875', 525000, 0, 52500, 0, 577500, '2020-03-20 02:12:55', 'hadi', 'dini', 99),
(2, '0000-00-00 00:00:00', 'PO.260320001', 'hadi', 'HWW1875', 105000, 0, 0, 0, 105000, '2020-03-26 11:28:55', 'hadi', 'dini', 2);

-- --------------------------------------------------------

--
-- Table structure for table `master_receive_po`
--

CREATE TABLE `master_receive_po` (
  `id` int(11) NOT NULL,
  `dari` varchar(255) NOT NULL,
  `no_order_po` varchar(255) NOT NULL,
  `total_pembelian` double NOT NULL,
  `biaya_lainnya` double NOT NULL,
  `grand_total` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_retur_pembelian`
--

CREATE TABLE `master_retur_pembelian` (
  `id` int(11) NOT NULL,
  `nomor_transaksi_asli` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `retur_total` double NOT NULL,
  `retur_diskon` double NOT NULL,
  `retur_pajak` double NOT NULL,
  `retur_grand_total` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_transaksi` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_retur_penjualan`
--

CREATE TABLE `master_retur_penjualan` (
  `id` int(11) NOT NULL,
  `nomor_faktur_asli` varchar(255) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `retur_total` double NOT NULL,
  `retur_diskon` double NOT NULL,
  `retur_pajak` double NOT NULL,
  `retur_grand_total` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_transaksi` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_retur_penjualan`
--

INSERT INTO `master_retur_penjualan` (`id`, `nomor_faktur_asli`, `nomor_faktur`, `id_pelanggan`, `retur_total`, `retur_diskon`, `retur_pajak`, `retur_grand_total`, `user`, `tanggal`, `tanggal_transaksi`, `periode`) VALUES
(1, 'bbmkdr280520006', 'RTR-bbmkdr280520006', 'HWW1875', 165000, 0, 0, 165000, 'lucky15', '2020-05-30 10:11:33', '2020-05-28 11:37:55', 1),
(4, 'bbmkdr300520013', 'RTR-bbmkdr300520013', 'HWW1875', 24000, 0, 0, 24000, 'lucky15', '2020-05-30 14:12:20', '2020-05-30 12:05:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_saldo_awal`
--

CREATE TABLE `master_saldo_awal` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `qty_awal` double NOT NULL,
  `saldo_awal` double NOT NULL,
  `harga_awal` double NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `tanggal_saldo` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_saldo_awal`
--

INSERT INTO `master_saldo_awal` (`id`, `kode_barang`, `nomor_faktur`, `qty_awal`, `saldo_awal`, `harga_awal`, `tanggal_input`, `tanggal_saldo`, `user`, `periode`) VALUES
(1, 'BES0001', 'SALDO AWAL', 10, 0, 15000, '2020-03-31 05:44:58', '2020-01-01 00:00:01', 'dini', 2),
(2, 'BES0003', 'SALDO AWAL', 10, 10, 24000, '2020-03-31 06:51:28', '2020-01-01 00:00:01', 'dini', 1),
(3, 'BES0002', 'SALDO AWAL', 10, 0, 25000, '2020-04-27 05:36:59', '2020-01-01 00:00:01', 'dini', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_sales`
--

CREATE TABLE `master_sales` (
  `kode_sales` varchar(255) NOT NULL,
  `kode_pegawai` varchar(255) NOT NULL,
  `nama_sales` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `insentif` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_satuan_barang`
--

CREATE TABLE `master_satuan_barang` (
  `id_satuan` int(11) NOT NULL,
  `kode_satuan` varchar(255) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_satuan_barang`
--

INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES
(6, 'BTG', 'BATANG', 'untuk produk batangan', 'supervisor', '2020-02-29 08:20:49'),
(7, 'MTR', 'METER', 'Untuk satuan meter', 'supervisor', '2020-02-29 08:21:02'),
(8, 'LBR', 'LEMBAR', 'Untuk satuan lembar', 'supervisor', '2020-02-29 08:21:17'),
(9, 'KLG', 'KALENG', 'untuk satuan kaleng', 'supervisor', '2020-02-29 08:23:05'),
(10, 'DUS', 'DUS', 'untuk satuan dus', 'supervisor', '2020-02-29 08:23:19'),
(11, 'PCS', 'PIECES', 'untuk satuan pieces', 'supervisor', '2020-02-29 08:23:31'),
(12, 'KG', 'KILOGRAM', 'untuk satuan kilogram', 'supervisor', '2020-02-29 08:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `master_setting`
--

CREATE TABLE `master_setting` (
  `id` int(11) NOT NULL,
  `nama_setting` varchar(255) NOT NULL,
  `value` varchar(1024) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_setting`
--

INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES
(1, 'nama_perusahaan', 'Besi Baja Makmur Kadungora', '2020-02-29 21:50:43'),
(2, 'alamat_perusahaan', 'Jl Raya Kadungora No asdasdasd asdasdasd asdasdasd asdasdas asdasdasd', '2020-03-09 05:23:15'),
(3, 'nomor_telepon', '085555555', '2020-02-29 21:50:43'),
(4, 'nomor_fax', '0808080', '2020-02-29 21:50:43'),
(5, 'alamat_email', 'bbmkadungora@gmail.com', '2020-02-29 21:50:43'),
(6, 'logo_perusahaan', 'CGolT90mbZB4urfW.png', '2020-03-31 00:06:04'),
(7, 'prefix_faktur', 'bbmkdr', '2020-02-29 21:51:14'),
(8, 'nomor_faktur', '3', '2020-02-29 21:51:14'),
(9, 'catatan_faktur_cash', 'No Rek BCA : 148-098-0570\nNo Rek BNI : 033-078-6610\nNo Rek Mandiri : 177-00-00494-655\nNo Rek BRI : 0025-01-000778-56-6\na.n Bpk. Aten Aripin', '2020-03-05 04:15:21'),
(10, 'catatan_faktur_kredit', 'asss', '2020-02-24 23:34:05'),
(11, 'catatan_retur_jual', 'asdasda', '2020-02-24 04:58:09'),
(12, 'catatan_retur_beli', 'asdasda', '2020-02-24 04:58:09'),
(13, 'password_harga', '5', '2020-02-29 06:57:52'),
(14, 'komisi_sales', '0.5', '2020-02-29 21:51:28'),
(15, 'notifikasi', '2', '2020-05-30 12:23:07'),
(16, 'frekuensi_notifikasi', '60', '2020-05-31 03:44:26'),
(17, 'threshold_bonus', '1000', '2020-03-03 05:38:45'),
(18, 'bonus_senior', '15000', '2020-03-03 05:45:01'),
(19, 'bonus_junior', '10000', '2020-03-03 05:45:01'),
(20, 'database', '2019', '2020-03-21 23:14:07'),
(21, 'kode_perusahaan', 'kdr', '2020-04-01 03:55:49'),
(22, 'periode', '1', '2020-04-27 05:46:37'),
(23, 'token_api', 'VFvUKkYCYgqo1pbK2FQcv0iwvV0cMNxSb0oDFX93uBvngUUKhRmzpIoiSEckbaGMuzsgWgwk4WD', '2020-05-28 05:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `master_stok_opname`
--

CREATE TABLE `master_stok_opname` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user` varchar(255) NOT NULL,
  `spv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_supplier`
--

CREATE TABLE `master_supplier` (
  `kode_supplier` varchar(128) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(128) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `nomor_rekening` text NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_supplier`
--

INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES
('BIR674', 'PRODUKSI ', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:24:44'),
('BMX310', 'PAK MUMU', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:25:31'),
('DDW516', 'PT NEWLAND STEEL', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:25:56'),
('ESF053', 'PROFIT', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:57:03'),
('FCL359', 'PT SMS STEEL', '-', '0', '', '0-BANK--', '-', 'supervisor', '2020-02-29 09:23:56'),
('HWI209', 'BBS', '-', '-', '__.___.___._-___.___', '-----', '-', 'supervisor', '2020-02-29 09:24:29'),
('OCZ285', 'PT HUAXING INSUSTRIES', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:24:15'),
('SMV257', 'LANGGENG JAYA TEKNIK', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:24:57'),
('VQT270', 'PMB', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:26:24'),
('XQO406', 'PT KUDA BERLIAN MEGAH', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `master_tipe_barang`
--

CREATE TABLE `master_tipe_barang` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_tipe_barang`
--

INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`, `user`, `timestamp`) VALUES
(1, 'INVENTORY', 'TIPE UNTUK BARANG YANG DIJUAL', '', '2020-01-24 20:59:03'),
(2, 'NON-INVENTORY', 'TIPE UNTUK BARANG YANG TIDAK DIJUAL, CONTOH PERALATAN KANTOR', '', '2020-01-24 20:59:03'),
(3, 'JASA', 'TIPE BARANG YANG TIDAK BERUPA, SEPERTI JASA PENGANTAR BARANG, JASA RAKITAN', '', '2020-01-24 20:59:03'),
(4, 'RAKITAN', 'TIPE BARANG BUNDLING, SEPERTI PAKET SEMABAKO', '', '2020-01-24 20:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `username` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `status` int(1) NOT NULL,
  `last_activity` datetime NOT NULL,
  `tanggal_create` datetime NOT NULL,
  `isactive` int(1) NOT NULL DEFAULT 1,
  `is_del` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES
('desi', '1111', '$2y$10$FlUdr83tMeM4QuJQLae1OO3/v3NW9CAQNKEnWv9hPNfFzaVvW/iOO', '3', 'DESI', 'default.jpg', 0, '2020-03-19 03:54:20', '0000-00-00 00:00:00', 1, 0),
('dini', '124124', '$2y$10$RrwCvrb/WuSCU/JAHKr.2.A7f7WpsPc5qBKhH7.PZx.kua5bxKr8a', '2', 'DINI', 'default.jpg', 0, '2020-05-28 14:18:26', '0000-00-00 00:00:00', 1, 0),
('edwin', '123123', '$2y$10$oi6qEP4bxeYkrUK5YCvhFe8a4PBCVriLudVjVxMvqQPPYCy.xKF9u', '4', 'EDWIN', 'default.jpg', 0, '2020-06-01 08:01:35', '0000-00-00 00:00:00', 1, 0),
('hadi', '21124124', '$2y$10$.Zz5dNGxi92mm.vF2/W59OWdBQEkYEIAjgnf01FkeUNal0jg2Lzf.', '3', 'HADI', 'default.jpg', 0, '2020-05-28 10:10:34', '0000-00-00 00:00:00', 1, 0),
('lucky15', '123123123', '$2y$10$3HBFxWoWL9yHhbW1zegPteGL2ZtN4bPiBTTGEwkFifMu7djwD2Q0S', '1', 'LUCKY ANGGARA', 'default.jpg', 0, '2020-06-01 08:01:20', '0000-00-00 00:00:00', 1, 0),
('manajer', '1', '$2y$10$Z.wVyoe9feypSG31/yGrhulh1abnvFshzx6nUSQBq5yZlmlVUeiLO', '5', 'Neng', 'BlKX5UiRh9Hj3ZAO.jpeg', 0, '2020-06-01 08:01:02', '2020-03-01 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_utang`
--

CREATE TABLE `master_utang` (
  `id` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_tagihan` double NOT NULL,
  `total_pembayaran` double NOT NULL,
  `down_payment` double NOT NULL DEFAULT 0,
  `sisa_utang` double NOT NULL DEFAULT 0,
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_utang`
--

INSERT INTO `master_utang` (`id`, `nomor_transaksi`, `tanggal_jatuh_tempo`, `total_tagihan`, `total_pembayaran`, `down_payment`, `sisa_utang`, `tanggal_input`, `user`, `periode`) VALUES
(2, 'cobacoba', '2020-04-27', 150000, 30000, 0, 120000, '2020-03-27', 'dini', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `dari` varchar(255) NOT NULL,
  `ke` varchar(255) NOT NULL,
  `pesan` varchar(512) NOT NULL,
  `link` varchar(255) NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES
(52, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 04:53:50'),
(53, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 1, 0, '2020-03-21 04:54:20'),
(54, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 04:55:07'),
(55, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 04:55:42'),
(56, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 15:09:00'),
(57, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 15:15:39'),
(58, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:30:06'),
(59, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:49:34'),
(60, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:50:24'),
(61, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:51:47'),
(62, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:54:30'),
(63, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-25 05:09:10'),
(64, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-25 05:09:53'),
(65, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 07:11:07'),
(66, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 07:11:50'),
(67, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 07:12:10'),
(68, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 07:12:33'),
(69, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 07:13:00'),
(70, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 07:13:37'),
(71, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 11:43:26'),
(72, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 11:44:22'),
(73, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 11:45:09'),
(74, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-27 11:45:37'),
(75, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-30 03:24:10'),
(76, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-30 03:25:03'),
(77, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-30 04:41:56'),
(78, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:18:15'),
(79, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:19:03'),
(80, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:19:29'),
(81, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:22:14'),
(82, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:29:31'),
(83, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:30:07'),
(84, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:38:18'),
(85, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 05:56:16'),
(86, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-31 07:18:27'),
(87, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-04-01 04:53:11'),
(88, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-04-01 04:55:57'),
(89, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-04-10 06:37:41'),
(90, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-04-10 06:40:38'),
(91, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-04-10 06:41:39'),
(92, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-04-27 06:12:28'),
(93, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-04-27 06:13:06'),
(94, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-28 10:13:39'),
(95, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-28 10:20:00'),
(96, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-28 12:28:22'),
(97, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-28 12:30:02'),
(98, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-30 12:00:45'),
(99, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-30 12:01:20'),
(100, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-30 12:02:00'),
(101, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-30 12:02:29'),
(102, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-30 12:03:09'),
(103, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-05-30 12:04:41'),
(104, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-06-01 07:59:04'),
(105, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-06-01 07:59:44'),
(106, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-06-01 08:00:02'),
(107, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-06-01 08:00:24'),
(108, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-06-01 08:00:58'),
(109, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-06-01 08:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_akses`
--

CREATE TABLE `tabel_akses` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_diskon`
--

CREATE TABLE `tabel_diskon` (
  `id` int(11) NOT NULL,
  `kode_diskon` varchar(15) NOT NULL,
  `potongan` int(11) NOT NULL,
  `jumlah_diskon` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_keranjang_belanja`
--

CREATE TABLE `tabel_keranjang_belanja` (
  `id` int(11) NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_total` double NOT NULL,
  `status` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_menu`
--

CREATE TABLE `tabel_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `link` varchar(512) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_menu`
--

INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES
(1, 'Penjualan', '#', 'fa fa-cart-arrow-down', 'Kasir'),
(2, 'Pembelian', '#', 'fa fa-cart-plus', 'Admin'),
(3, 'Dashboard', 'dashboard/sales', 'mdi mdi-view-dashboard', 'Sales'),
(4, 'Dashboard', 'dashboard/kasir', 'mdi mdi-view-dashboard', 'Kasir'),
(5, 'Dashboard', 'dashboard/admin', 'mdi mdi-view-dashboard', 'Dashboard Admin'),
(6, 'Dashboard', 'dashboard/supervisor', 'mdi mdi-view-dashboard', 'Dashboard Supervisor'),
(7, 'Dashboard', '#', 'mdi mdi-view-dashboard', 'Dashboard Manager'),
(8, 'Sales', '#', 'fa fa-user-o', 'Sales'),
(9, 'Persediaan', '#', 'fa fa-window-restore', 'Supervisor'),
(10, 'Data', '#', 'fa fa-database', 'Admin'),
(11, 'Pegawai', '#', 'fa fa-users', 'Manajer'),
(12, 'Keuangan', '#', 'fa fa-money', 'Manajer'),
(13, 'Laporan', '#', 'fa fa-file-text', 'Manajer'),
(14, 'Data', '#', 'fa fa-database', 'Kasir'),
(15, 'Keuangan', '#', 'fa fa-money', 'Admin'),
(16, 'Penjualan', '#', 'fa fa-cart-arrow-down', 'Admin'),
(17, 'Persediaan', '#', 'fa fa-window-restore', 'Admin'),
(18, 'Sales', '#', 'fa fa-users', 'Admin'),
(19, 'Pegawai', '#', 'fa fa-users', 'Supervisor'),
(20, 'Settings', 'setting/setting', 'fa fa-gear', 'Manajer'),
(21, 'Transaksi', '#', 'fa fa-money', 'Supervisor'),
(22, 'Data', '#', 'fa fa-database', 'Supervisor'),
(23, 'Transaksi', '#', 'fa fa-cart-arrow-down', 'Manajer'),
(24, 'Keuangan', '#', 'fa fa-money', 'Supervisor'),
(25, 'Keuangan', '', 'fa fa-money', 'Kasir Keuangan');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_perhitungan_order`
--

CREATE TABLE `tabel_perhitungan_order` (
  `no_order` varchar(255) NOT NULL,
  `total_keranjang` double NOT NULL,
  `diskon` double NOT NULL,
  `pajak` double NOT NULL,
  `ongkir` double NOT NULL,
  `grand_total` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_perhitungan_order`
--

INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES
('200401006', 20, 0, 0, 0, 20, '2020-04-01 04:02:53'),
('200402013', 25, 0, 0, 0, 25, '2020-04-01 20:16:40'),
('2do01Cjnrxve8Rbm', 5750000, 0, 0, 0, 5750000, '2020-04-27 03:11:37'),
('kF34pMXriyqxQzN1', 6000000, 0, 0, 0, 6000000, '2020-05-31 05:19:23'),
('OUT0316792', 24000, 0, 0, 0, 24000, '2020-05-28 09:48:24'),
('OUT0634195', 24000, 0, 0, 0, 24000, '2020-05-28 10:18:53'),
('OUT1673089', 24000, 0, 0, 0, 24000, '2020-05-28 10:15:41'),
('OUT1759048', 24000, 0, 0, 0, 24000, '2020-05-28 08:42:58'),
('OUT2761905', 24000, 0, 0, 0, 24000, '2020-05-28 08:41:08'),
('OUT2975613', 24000, 0, 0, 0, 24000, '2020-05-28 08:20:27'),
('OUT3082519', 24000, 0, 0, 0, 24000, '2020-05-28 08:41:21'),
('OUT3671028', 24000, 0, 0, 0, 24000, '2020-05-28 08:32:35'),
('OUT4076928', 24000, 0, 0, 0, 24000, '2020-05-28 08:28:30'),
('OUT4206879', 24000, 0, 0, 0, 24000, '2020-05-28 11:10:46'),
('OUT4879365', 24000, 0, 0, 0, 24000, '2020-05-28 09:51:51'),
('OUT5183972', 24000, 0, 0, 0, 24000, '2020-05-28 08:31:58'),
('OUT5281049', 24000, 0, 0, 0, 24000, '2020-05-28 09:47:49'),
('OUT6792543', 24000, 0, 0, 0, 24000, '2020-05-28 08:54:16'),
('OUT7295436', 24000, 0, 0, 0, 24000, '2020-05-28 09:46:29'),
('OUT8102739', 24000, 0, 0, 0, 24000, '2020-05-28 09:50:55'),
('OUT8927103', 24000, 0, 0, 0, 24000, '2020-05-28 08:29:19'),
('OUT9058316', 24000, 0, 0, 0, 24000, '2020-05-28 08:27:40'),
('OUT9178206', 24000, 0, 0, 0, 24000, '2020-05-28 11:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_role`
--

CREATE TABLE `tabel_role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL,
  `menu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_role`
--

INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES
(1, 'Kasir', '4,1,14,25'),
(2, 'Admin', '5,16,2,17,15'),
(3, 'Sales', '3,8'),
(4, 'Supervisor', '6,21,9,10,24'),
(5, 'Manager', '7,23,9,12,11,13,20'),
(6, 'Superuser', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_submenu`
--

CREATE TABLE `tabel_submenu` (
  `id` int(11) NOT NULL,
  `main_menu` varchar(255) NOT NULL,
  `nama_submenu` varchar(255) NOT NULL,
  `link` varchar(512) NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_submenu`
--

INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES
(1, '1', 'Transaksi Penjualan', 'manajemen_penjualan/penjualanbarang', 'Kasir Penjualan Barang'),
(2, '1', 'Daftar Transaksi', 'manajemen_penjualan/daftartransaksipenjualan', 'Kasir Daftar Penjualan'),
(5, '16', 'Purchase Order', 'manajemen_penjualan/purchaseorderadmin', 'Admin P.O'),
(7, '16', 'Daftar Retur Penjualan', 'manajemen_penjualan/returpenjualan/daftar_retur', 'Admin Retur Penjualan Daftar'),
(8, '2', 'Transaksi Pembelian', 'manajemen_pembelian/pembelianbarang', 'Admin Pembelian Barang'),
(9, '2', 'Daftar Transaksi', 'manajemen_pembelian/daftartransaksipembelian', 'Admin Daftar Pembelian Barang'),
(10, '2', 'Retur Pembelian', 'manajemen_pembelian/returpembelian', 'Admin Retur Pembelian'),
(11, '2', 'Daftar Retur Pembelian', 'manajemen_pembelian/returpembelian/daftar_retur', 'Admin Daftar Retur Pembelian'),
(12, '9', 'Master Persediaan', 'manajemen_persediaan/masterpersediaan', 'Supervisor Master Persediaan'),
(13, '9', 'Kartu Persediaan', 'manajemen_persediaan/kartupersediaan', 'Supervisor Kartu Persediaan'),
(14, '17', 'Saldo Awal Persediaan', 'manajemen_persediaan/saldoawalpersediaan', 'Admin Saldo Awal Persediaan'),
(15, '17', 'Stok Opname', 'manajemen_persediaan/stokopname', 'Admin Stok Opname'),
(16, '9', 'Stok Opname', 'manajemen_persediaan/reviewstokopname', 'Supervisor Review Stok Opname'),
(17, '10', 'Master Barang', 'manajemen_barang/masterbarang', 'Admin Master Barang'),
(18, '10', 'Master Satuan Barang', 'manajemen_data/mastersatuan ', 'Admin Satuan Barang'),
(19, '10', 'Master Jenis Barang', 'manajemen_data/masterjenisbarang', 'Admin Jenis Barang'),
(20, '10', 'Master Merek Barang', 'manajemen_data/mastermerekbarang', 'Admin Merek Barang'),
(21, '14', 'Master Pelanggan', 'manajemen_data/masterpelanggan', 'Kasir Master Pelanggan'),
(22, '10', 'Master Supplier', 'manajemen_data/mastersupplier', 'Admin Master Supplier'),
(23, '11', 'Master User', 'manajemen_pegawai/masteruser', 'Manager Master User'),
(24, '11', 'Master Pegawai', 'manajemen_pegawai/masterpegawai', 'Manager Master Pegawai'),
(25, '22', 'Master Barang', 'manajemen_barang/masterbarang', 'Supervisor Data Barang'),
(26, '8', 'Purchase Order', 'manajemen_penjualan/purchaseordersales', 'Sales P.O'),
(27, '8', 'Daftar Purchase Order', 'manajemen_penjualan/purchaseordersales/daftar', 'Sales Daftar P.O'),
(28, '8', 'Insentif', 'manajemen_sales/insentif', 'Sales Insentif Monitor'),
(29, '15', 'Master Piutang', 'manajemen_keuangan/masterpiutang/daftar_piutang', 'Admin Master Piutang'),
(30, '15', 'Master Utang', 'manajemen_keuangan/masterutang/daftar_utang', 'Admin Master Utang'),
(31, '12', 'Insentif Sales', 'manajemen_pegawai/insentifsales', 'Manajer Insentif Sales'),
(32, '21', 'Daftar Transaksi Penjualan', 'manajemen_penjualan/daftartransaksipenjualan', ''),
(33, '21', 'Daftar Transaksi Pembelian', 'manajemen_pembelian/daftartransaksipembelian', ''),
(34, '23', 'Daftar Penjualan', 'manajemen_penjualan/daftartransaksipenjualan', 'Manajer Daftar Transaksi Penjualan'),
(35, '23', 'Daftar Pembelian', 'manajemen_pembelian/daftartransaksipembelian', 'Manajer Daftar Transaksi Pembelian'),
(36, '12', 'Master Utang', '	\r\nmanajemen_keuangan/masterutang/daftar_utang', 'Manajer Master Utang'),
(37, '12', 'Master Piutang', '	\r\nmanajemen_keuangan/masterpiutang/daftar_piutang', 'Manajer Master Piutang'),
(39, '24', 'Master Gaji', 'manajemen_keuangan/mastergaji/', 'Supervisor Master Gaji'),
(40, '24', 'Master Biaya', 'manajemen_keuangan/masterbiaya/', 'Supervisor Master Biaya'),
(41, '10', 'Master Kategori Biaya', 'manajemen_data/masterkategoribiaya', 'Supervisor Kategori Biaya'),
(42, '9', 'Transfer Retur Barang', 'manajemen_persediaan/returpersediaan', 'Supervisor Transfer Retur Barang'),
(43, '13', 'Laporan Laba / Rugi Usaha', 'laporan/laba', 'Manajer Laporan Laba / Rugi'),
(44, '24', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Supervisor COH'),
(45, '12', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Manajer Master Kas'),
(46, '25', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Kasir Master Dana COH'),
(47, '1', 'Daftar Pending Transaksi', 'manajemen_penjualan/pendingtransaksi', 'Kasir Pending Transaksi'),
(48, '13', 'Laporan Laba Penjualan', 'laporan/labapenjualan/', 'Manajer Laporan Utang / Piutang'),
(49, '23', 'Daftar Retur Penjualan', 'manajemen_penjualan/returpenjualan/daftar_retur', 'Manajer Daftar Retur Penjualan'),
(50, '23', 'Daftar Retur Pembelian', 'manajemen_pembelian/returpembelian/daftar_retur', 'Manajer Daftar Retur Pembelian'),
(51, '13', 'Laporan Pengeluaran', 'laporan/pengeluaran', 'Manajer Laporan Pengeluaran'),
(52, '13', 'Laporan Penjualan', 'laporan/penjualan', 'Manajer Laporan Penjualan'),
(53, '1', 'Retur Penjualan', 'manajemen_penjualan/returpenjualan', 'Kasir Retur Penjualan'),
(54, '13', 'Laporan Utang / Piutang', 'laporan/utangpiutang', 'Manajer Laporan Utang Piutang'),
(55, '13', 'Laporan Persediaan', 'laporan/laporanpersediaan', 'Manajer Laporan Persediaan'),
(56, '13', 'Laporan Sales', 'laporan/sales', 'Manajer Laporan Sales');

-- --------------------------------------------------------

--
-- Table structure for table `temp_purchase_order`
--

CREATE TABLE `temp_purchase_order` (
  `id` int(11) NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_penjualan` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_tabel_keranjang_pembelian`
--

CREATE TABLE `temp_tabel_keranjang_pembelian` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `no_order_pembelian` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_tabel_keranjang_penjualan`
--

CREATE TABLE `temp_tabel_keranjang_penjualan` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `no_order_penjualan` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_penjualan` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user` varchar(255) NOT NULL,
  `is_po` int(1) NOT NULL DEFAULT 0,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `periode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_tabel_keranjang_po`
--

CREATE TABLE `temp_tabel_keranjang_po` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `no_order_po` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_tabel_keranjang_po`
--

INSERT INTO `temp_tabel_keranjang_po` (`id`, `tanggal_transaksi`, `no_order_po`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `total_harga`, `tanggal_input`) VALUES
(29, '1970-01-01 01:00:00', '200401006', 'BES0003', 1, 20, 20, '2020-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `timeline_po`
--

CREATE TABLE `timeline_po` (
  `id` int(11) NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `pesan` text NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeline_po`
--

INSERT INTO `timeline_po` (`id`, `no_order`, `urutan`, `tanggal`, `pesan`, `user`) VALUES
(1, 'PO.090320001', 1, '2020-03-09 05:14:18', 'Proses', 'hadi'),
(2, 'PO.090320001', 2, '2020-03-20 02:12:55', '<span class=\"text-danger\">Reject</span><br>', 'dini'),
(3, 'PO.260320001', 1, '2020-03-26 11:24:40', 'dfsdf', 'hadi'),
(4, 'PO.260320001', 2, '2020-03-26 11:28:55', '<span class=\"text-success\">Approve</span><br>', 'dini');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_bank`
--
ALTER TABLE `data_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_biaya`
--
ALTER TABLE `detail_biaya`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_transaksi` (`nomor_jurnal`);

--
-- Indexes for table `detail_coh`
--
ALTER TABLE `detail_coh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_coh` (`nomor_referensi`);

--
-- Indexes for table `detail_detail_stok_opname`
--
ALTER TABLE `detail_detail_stok_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_gaji` (`nomor_referensi`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pembelian` (`nomor_transaksi`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan` (`nomor_faktur`),
  ADD KEY `nomor_faktur` (`nomor_faktur`);

--
-- Indexes for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_piutang` (`nomor_faktur`);

--
-- Indexes for table `detail_po`
--
ALTER TABLE `detail_po`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_order_po` (`no_order_po`);

--
-- Indexes for table `detail_po_receive`
--
ALTER TABLE `detail_po_receive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_order_po` (`no_order_po`);

--
-- Indexes for table `detail_retur_barang_pembelian`
--
ALTER TABLE `detail_retur_barang_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_retur_barang_penjualan`
--
ALTER TABLE `detail_retur_barang_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_retur` (`nomor_faktur`);

--
-- Indexes for table `detail_retur_pembelian`
--
ALTER TABLE `detail_retur_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retur_master` (`nomor_transaksi`);

--
-- Indexes for table `detail_retur_penjualan`
--
ALTER TABLE `detail_retur_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retur_master` (`nomor_faktur`);

--
-- Indexes for table `detail_stok_opname`
--
ALTER TABLE `detail_stok_opname`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stokopname` (`nomor_referensi`);

--
-- Indexes for table `detail_utang`
--
ALTER TABLE `detail_utang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_piutang` (`nomor_transaksi`);

--
-- Indexes for table `harga_detail_pembelian`
--
ALTER TABLE `harga_detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `tipe_barang` (`tipe_barang`,`jenis_barang`,`merek_barang`),
  ADD KEY `satuan` (`kode_satuan`),
  ADD KEY `merek_barang_join` (`merek_barang`),
  ADD KEY `jenis_barang_join` (`jenis_barang`),
  ADD KEY `kode_supplier` (`kode_supplier`);

--
-- Indexes for table `master_biaya`
--
ALTER TABLE `master_biaya`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_referensi` (`nomor_referensi`);

--
-- Indexes for table `master_cabang`
--
ALTER TABLE `master_cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_coh`
--
ALTER TABLE `master_coh`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_referensi` (`nomor_referensi`);

--
-- Indexes for table `master_coh_permintaan`
--
ALTER TABLE `master_coh_permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_referensi` (`nomor_referensi`);

--
-- Indexes for table `master_gaji`
--
ALTER TABLE `master_gaji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_referensi` (`nomor_referensi`),
  ADD KEY `nomor_referensi_2` (`nomor_referensi`);

--
-- Indexes for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_faktur` (`nomor_faktur`);

--
-- Indexes for table `master_insentif`
--
ALTER TABLE `master_insentif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_faktur` (`nomor_faktur`);

--
-- Indexes for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`),
  ADD UNIQUE KEY `kode_jenis` (`kode_jenis_barang`);

--
-- Indexes for table `master_kartu_persediaan`
--
ALTER TABLE `master_kartu_persediaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_kategori_biaya`
--
ALTER TABLE `master_kategori_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_merek_barang`
--
ALTER TABLE `master_merek_barang`
  ADD PRIMARY KEY (`id_merek_barang`);

--
-- Indexes for table `master_pegawai`
--
ALTER TABLE `master_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `master_pembelian`
--
ALTER TABLE `master_pembelian`
  ADD PRIMARY KEY (`no_order_pembelian`),
  ADD UNIQUE KEY `nomor_transaksi` (`nomor_transaksi`);

--
-- Indexes for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`),
  ADD UNIQUE KEY `no_order_penjualan` (`no_order_penjualan`);

--
-- Indexes for table `master_periode`
--
ALTER TABLE `master_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_persediaan`
--
ALTER TABLE `master_persediaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `master_piutang`
--
ALTER TABLE `master_piutang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`),
  ADD KEY `no_faktur_2` (`no_faktur`);

--
-- Indexes for table `master_po`
--
ALTER TABLE `master_po`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_order_po` (`no_order_po`);

--
-- Indexes for table `master_purchase_order`
--
ALTER TABLE `master_purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_po` (`no_order`);

--
-- Indexes for table `master_receive_po`
--
ALTER TABLE `master_receive_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_retur_pembelian`
--
ALTER TABLE `master_retur_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_faktur` (`nomor_transaksi`);

--
-- Indexes for table `master_retur_penjualan`
--
ALTER TABLE `master_retur_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_faktur` (`nomor_faktur`);

--
-- Indexes for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saldo_awal` (`kode_barang`);

--
-- Indexes for table `master_sales`
--
ALTER TABLE `master_sales`
  ADD PRIMARY KEY (`kode_sales`);

--
-- Indexes for table `master_satuan_barang`
--
ALTER TABLE `master_satuan_barang`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `master_setting`
--
ALTER TABLE `master_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_stok_opname`
--
ALTER TABLE `master_stok_opname`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_referensi` (`nomor_referensi`);

--
-- Indexes for table `master_supplier`
--
ALTER TABLE `master_supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `master_tipe_barang`
--
ALTER TABLE `master_tipe_barang`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `master_utang`
--
ALTER TABLE `master_utang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_faktur` (`nomor_transaksi`),
  ADD KEY `no_faktur_2` (`nomor_transaksi`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_akses`
--
ALTER TABLE `tabel_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_diskon`
--
ALTER TABLE `tabel_diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_keranjang_belanja`
--
ALTER TABLE `tabel_keranjang_belanja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_order` (`no_order`);

--
-- Indexes for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_perhitungan_order`
--
ALTER TABLE `tabel_perhitungan_order`
  ADD PRIMARY KEY (`no_order`);

--
-- Indexes for table `tabel_role`
--
ALTER TABLE `tabel_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_submenu`
--
ALTER TABLE `tabel_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_order` (`no_order`);

--
-- Indexes for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_tabel_keranjang_po`
--
ALTER TABLE `temp_tabel_keranjang_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline_po`
--
ALTER TABLE `timeline_po`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_bank`
--
ALTER TABLE `data_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_biaya`
--
ALTER TABLE `detail_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_coh`
--
ALTER TABLE `detail_coh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `detail_detail_stok_opname`
--
ALTER TABLE `detail_detail_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_po`
--
ALTER TABLE `detail_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `detail_po_receive`
--
ALTER TABLE `detail_po_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_retur_barang_pembelian`
--
ALTER TABLE `detail_retur_barang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_retur_barang_penjualan`
--
ALTER TABLE `detail_retur_barang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_retur_pembelian`
--
ALTER TABLE `detail_retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_retur_penjualan`
--
ALTER TABLE `detail_retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_stok_opname`
--
ALTER TABLE `detail_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_utang`
--
ALTER TABLE `detail_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_biaya`
--
ALTER TABLE `master_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_cabang`
--
ALTER TABLE `master_cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_coh`
--
ALTER TABLE `master_coh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_coh_permintaan`
--
ALTER TABLE `master_coh_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `master_gaji`
--
ALTER TABLE `master_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master_insentif`
--
ALTER TABLE `master_insentif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `master_kategori_biaya`
--
ALTER TABLE `master_kategori_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_merek_barang`
--
ALTER TABLE `master_merek_barang`
  MODIFY `id_merek_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `master_pegawai`
--
ALTER TABLE `master_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_periode`
--
ALTER TABLE `master_periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_piutang`
--
ALTER TABLE `master_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_po`
--
ALTER TABLE `master_po`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `master_purchase_order`
--
ALTER TABLE `master_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_receive_po`
--
ALTER TABLE `master_receive_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_retur_pembelian`
--
ALTER TABLE `master_retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_retur_penjualan`
--
ALTER TABLE `master_retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_satuan_barang`
--
ALTER TABLE `master_satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_setting`
--
ALTER TABLE `master_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `master_stok_opname`
--
ALTER TABLE `master_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_utang`
--
ALTER TABLE `master_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tabel_akses`
--
ALTER TABLE `tabel_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tabel_role`
--
ALTER TABLE `tabel_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_submenu`
--
ALTER TABLE `tabel_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_po`
--
ALTER TABLE `temp_tabel_keranjang_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `timeline_po`
--
ALTER TABLE `timeline_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_coh`
--
ALTER TABLE `detail_coh`
  ADD CONSTRAINT `master_coh` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_coh` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  ADD CONSTRAINT `master_gaji` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_gaji` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `penjualan` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  ADD CONSTRAINT `master_piutang` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_piutang` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_retur_barang_penjualan`
--
ALTER TABLE `detail_retur_barang_penjualan`
  ADD CONSTRAINT `master_retur` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_retur_penjualan` (`nomor_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_retur_pembelian`
--
ALTER TABLE `detail_retur_pembelian`
  ADD CONSTRAINT `master` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_retur_pembelian` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_retur_penjualan`
--
ALTER TABLE `detail_retur_penjualan`
  ADD CONSTRAINT `retur_master` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_retur_penjualan` (`nomor_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_stok_opname`
--
ALTER TABLE `detail_stok_opname`
  ADD CONSTRAINT `stokopname` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_stok_opname` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_utang`
--
ALTER TABLE `detail_utang`
  ADD CONSTRAINT `master_utang` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_utang` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_coh_permintaan`
--
ALTER TABLE `master_coh_permintaan`
  ADD CONSTRAINT `coh` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_coh` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  ADD CONSTRAINT `hpp` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_piutang`
--
ALTER TABLE `master_piutang`
  ADD CONSTRAINT `master_penjualan` FOREIGN KEY (`no_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  ADD CONSTRAINT `saldo_awal` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_user`
--
ALTER TABLE `master_user`
  ADD CONSTRAINT `nip` FOREIGN KEY (`nip`) REFERENCES `master_pegawai` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  ADD CONSTRAINT `master_po` FOREIGN KEY (`no_order`) REFERENCES `master_purchase_order` (`no_order`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
