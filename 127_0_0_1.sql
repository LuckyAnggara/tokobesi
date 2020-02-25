-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2020 at 09:51 AM
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
CREATE DATABASE IF NOT EXISTS `tob` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tob`;

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
(56, 102, 10, 'DIcuri'),
(57, 102, 200, 'Di paling'),
(58, 101, 0, ''),
(70, 105, 1000, ''),
(71, 97, 1500, 'gdfgdfgdfgdfg'),
(72, 98, 510, 'jhlhjlhjl'),
(74, 110, 510, 'cvv'),
(75, 113, 100, 'dsfsdfsdf'),
(76, 113, 300, 'dfgdfgdfg'),
(77, 113, 50, 'gfhfghfgh'),
(78, 113, 50, 'gdfgdfgdfgdfg'),
(79, 114, 5, 'hgjghjg'),
(80, 114, 2, 'gfhfghf'),
(81, 114, 3, 'ghfhfgh');

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
  `tanggal_input` date NOT NULL,
  `saldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`, `saldo`) VALUES
(47, '9NCuao2sA60hJ3FH', '2020-02-09 06:39:05', 'betasdas', 'B001', 1000, 95000, 0, 95000000, '2020-02-09', 0),
(48, 'ZrmHLlIg36NazME1', '2020-02-09 09:45:16', 'asfasf', 'B001', 500, 90000, 0, 45000000, '2020-02-09', 0),
(49, 'ZrmHLlIg36NazME1', '2020-02-07 09:45:29', 'asfasf', 'BES0002', 500, 100000, 0, 50000000, '2020-02-09', 0);

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
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(74, 'PO.090220001', '2020-02-09 00:00:00', 'BBM090220001', 'B001', 100, 2500000, 0, 250000000, '2020-02-09'),
(80, 'PO.190220001', '2020-02-19 00:00:00', 'BBM190220001', 'BES0002', 30, 150000, 0, 4500000, '2020-02-19'),
(81, 'OUT6027413', '2020-02-19 10:23:41', 'TYP9063548', 'B001', 500, 2500000, 0, 1250000000, '2020-02-19'),
(82, 'OUT6027413', '2020-02-19 10:23:45', 'TYP9063548', 'BES0002', 30, 150000, 0, 4500000, '2020-02-19'),
(83, 'OUT6027413', '2020-02-19 10:24:39', 'TYP9063548', 'BES0002', 20, 150000, 0, 3000000, '2020-02-19'),
(84, 'OUT6027413', '2020-02-19 10:24:48', 'TYP9063548', 'BES0002', 30, 150000, 0, 4500000, '2020-02-19'),
(85, 'OUT5327968', '2020-02-20 05:22:55', 'EWK4210653', 'B001', 500, 2500000, 0, 1250000000, '2020-02-20'),
(86, 'OUT5327968', '2020-02-20 05:23:02', 'EWK4210653', 'BES0002', 250, 150000, 0, 37500000, '2020-02-20'),
(88, 'PO.200220001', '2020-02-20 00:00:00', 'BBM200220001', 'B001', 200, 2500000, 0, 500000000, '2020-02-20'),
(89, 'PO.200220001', '2020-02-20 00:00:00', 'BBM200220001', 'B001', 100, 2500000, 100000, 249900000, '2020-02-20'),
(91, 'OUT3169027', '2020-02-20 08:25:38', 'BTR8620394', 'B001', 100, 2500000, 10000000, 240000000, '2020-02-20'),
(92, 'OUT3690725', '2020-02-20 08:26:28', 'PED3910482', 'B001', 100, 2500000, 0, 250000000, '2020-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `detail_persediaan`
--

CREATE TABLE `detail_persediaan` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah` double NOT NULL,
  `harga_beli` double NOT NULL,
  `saldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_persediaan`
--

INSERT INTO `detail_persediaan` (`id`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah`, `harga_beli`, `saldo`) VALUES
(11, '2020-01-23', 'ITJ.1.sad/123124', 'P001', 1000, 1000000, 1000),
(12, '2020-01-21', 'itjas/21312/5125', 'K001', 500, 900000, 500),
(13, '2020-01-21', '125125125', 'K001', 500, 1000000, 500),
(14, '2020-01-29', 'hmmm', 'B001', 1000, 500000, 1000),
(15, '2020-01-29', '1214', 'B001', 50, 2000000, 50),
(16, '2020-02-03', 'ksdfs', 'K001', 500, 20000, 500),
(17, '2020-02-03', 'ksdfs', 'BES0002', 100, 150000, 100),
(18, '2020-02-03', 'ksdfs', 'P001', 200, 100000, 200),
(19, '2020-02-09', 'betasdas', 'B001', 1000, 95000, 1000),
(20, '2020-02-09', 'asfasf', 'B001', 500, 90000, 500),
(21, '2020-02-07', 'asfasf', 'BES0002', 500, 100000, 500);

-- --------------------------------------------------------

--
-- Table structure for table `detail_piutang`
--

CREATE TABLE `detail_piutang` (
  `id` int(11) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `nominal_pembayaran` double NOT NULL,
  `sisa_piutang` double NOT NULL,
  `tanggal` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_piutang`
--

INSERT INTO `detail_piutang` (`id`, `nomor_faktur`, `nominal_pembayaran`, `sisa_piutang`, `tanggal`, `user`, `bukti`, `keterangan`, `timestamp`) VALUES
(1, 'PED3910482', 75000000, 200000000, '2020-02-20', 'desi10', '', 'Down Payment', '2020-02-20 08:16:23'),
(4, 'BBM200220001', 200000000, 524900000, '2020-02-20', 'desi10', 'cf3ee1e47985bd5f26757f395c73a60d.jpeg', 'sgsdgdsgs', '2020-02-20 09:37:34'),
(7, 'PED3910482', 200000000, 0, '2020-02-20', 'desi10', '1984b015daed4223145b3cb863b5535d.jpeg', 'Lunas', '2020-02-20 10:47:45');

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
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_retur_pembelian`
--

INSERT INTO `detail_retur_pembelian` (`id`, `id_detail_pembelian`, `nomor_transaksi`, `kode_barang`, `keterangan`, `jumlah_retur`, `harga_retur`, `diskon`, `total_retur`, `user`, `tanggal`) VALUES
(2, 47, 'RTR-betasdas', 'B001', 'fgdfgdfg', 30, 0, 0, 2850000, 'lucky15', '2020-02-20 03:35:57');

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
  `harga_retur` double NOT NULL,
  `diskon` double NOT NULL,
  `total_retur` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_retur_penjualan`
--

INSERT INTO `detail_retur_penjualan` (`id`, `id_detail_penjualan`, `nomor_faktur`, `kode_barang`, `keterangan`, `jumlah_retur`, `harga_retur`, `diskon`, `total_retur`, `user`, `tanggal`) VALUES
(90, 74, 'RTR-BBM090220001', 'B001', 'Rusak', 50, 0, 0, 125000000, 'desi10', '2020-02-24 11:52:15');

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

--
-- Dumping data for table `detail_stok_opname`
--

INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES
(97, 'REF2376045', '2020-02-12 00:00:00', 'B001', 1500, 0, 1500, 0, '', 'lucky15'),
(98, 'REF2376045', '2020-02-12 00:00:00', 'BES0002', 510, 0, 510, 0, '', 'lucky15'),
(99, 'REF2376045', '2020-02-12 00:00:00', 'K001', 0, 0, 0, 0, '', 'lucky15'),
(100, 'REF2376045', '2020-02-12 00:00:00', 'P001', 0, 0, 0, 0, '', 'lucky15'),
(101, 'REF9042536', '2020-02-20 00:00:00', 'B001', 1500, 1400, 100, 0, '', 'lucky15'),
(102, 'REF9042536', '2020-02-20 00:00:00', 'BES0002', 510, 300, 210, 0, '', 'lucky15'),
(103, 'REF9042536', '2020-02-20 00:00:00', 'K001', 0, 0, 0, 0, '', 'lucky15'),
(104, 'REF9042536', '2020-02-20 00:00:00', 'P001', 0, 0, 0, 0, '', 'lucky15'),
(105, 'REF4693258', '2020-02-14 00:00:00', 'B001', 1500, 0, 1500, 0, '', 'lucky15'),
(106, 'REF4693258', '2020-02-14 00:00:00', 'BES0002', 510, 0, 510, 0, '', 'lucky15'),
(107, 'REF4693258', '2020-02-14 00:00:00', 'K001', 0, 0, 0, 0, '', 'lucky15'),
(108, 'REF4693258', '2020-02-14 00:00:00', 'P001', 0, 0, 0, 0, '', 'lucky15'),
(109, 'REF8564302', '2020-02-14 00:00:00', 'B001', 1500, 1500, 0, 0, '', 'lucky15'),
(110, 'REF8564302', '2020-02-14 00:00:00', 'BES0002', 510, 0, 510, 0, '', 'lucky15'),
(111, 'REF8564302', '2020-02-14 00:00:00', 'K001', 0, 0, 0, 0, '', 'lucky15'),
(112, 'REF8564302', '2020-02-14 00:00:00', 'P001', 0, 0, 0, 0, '', 'lucky15'),
(113, 'REF4271368', '2020-02-13 00:00:00', 'B001', 1500, 1000, 500, 0, '', 'lucky15'),
(114, 'REF4271368', '2020-02-13 00:00:00', 'BES0002', 510, 500, 10, 0, '', 'lucky15'),
(115, 'REF4271368', '2020-02-13 00:00:00', 'K001', 0, 0, 0, 0, '', 'lucky15'),
(116, 'REF4271368', '2020-02-13 00:00:00', 'P001', 0, 0, 0, 0, '', 'lucky15'),
(117, 'REF1640859', '2020-02-24 00:00:00', 'B001', 0, 0, 0, 0, '', 'desi10'),
(118, 'REF1640859', '2020-02-24 00:00:00', 'BES0002', 150, 0, 150, 0, '', 'desi10'),
(119, 'REF1640859', '2020-02-24 00:00:00', 'K001', 30, 0, 30, 0, '', 'desi10'),
(120, 'REF1640859', '2020-02-24 00:00:00', 'P001', 0, 0, 0, 0, '', 'desi10');

-- --------------------------------------------------------

--
-- Table structure for table `detail_utang`
--

CREATE TABLE `detail_utang` (
  `id` int(11) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `nominal_pembayaran` double NOT NULL,
  `sisa_utang` double NOT NULL,
  `tanggal` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `tipe_barang` int(11) DEFAULT '0',
  `jenis_barang` int(11) DEFAULT '0',
  `merek_barang` int(11) DEFAULT '0',
  `kode_supplier` varchar(128) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_satuan` double NOT NULL,
  `kode_satuan` int(11) DEFAULT '0',
  `persediaan_minimum` int(11) NOT NULL DEFAULT '0',
  `metode_hpp` varchar(255) NOT NULL,
  `komisi_sales` double NOT NULL DEFAULT '0',
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`) VALUES
('B001', 1, 1, 1, 'EKZ372', 'BESI', 15000, 2500000, 0, 10, 'FIFO', 0, 'Za4l1NCG8EtRVcmT.png', '', 0, '', '2020-01-31 02:48:06'),
('BES0002', 1, 1, 0, 'EKZ372', 'BESI BETON', 0, 150000, 0, 10, 'FIFO', 20000, 'default.png', '', 0, '', '2020-02-08 10:58:42'),
('K001', 1, 1, 1, 'EKZ372', 'KERTAS', 1000000, 1200000, 0, 10, 'FIFO', 500, 'uj84iknmXGLWMdRK.png', '', 0, '', '2020-01-31 02:42:24'),
('P001', 1, 1, 1, 'EKZ372', 'PIPA BESI', 1000000, 1200000, 0, 10, 'FIFO', 0, '1A3ahrCWoTwyU2qm.png', '', 0, '', '2020-01-31 05:08:18');

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
  `harga_pokok` double NOT NULL,
  `harga_jual` double NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_harga_pokok_penjualan`
--

INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `harga_pokok`, `harga_jual`, `keterangan`) VALUES
(67, '2020-02-09 10:14:09', 'BBM090220001', 'B001', 100, 100000, 2500000, 'FIFO'),
(78, '2020-02-19 08:30:48', 'BBM190220001', 'BES0002', 0, 105000, 150000, 'FIFO'),
(79, '2020-02-19 08:30:48', 'BBM190220001', 'BES0002', 30, 100000, 150000, 'FIFO'),
(80, '2020-02-19 10:25:23', 'TYP9063548', 'B001', 0, 100000, 2500000, 'FIFO'),
(81, '2020-02-19 10:25:23', 'TYP9063548', 'B001', 500, 95000, 2500000, 'FIFO'),
(82, '2020-02-19 10:25:23', 'TYP9063548', 'BES0002', 0, 105000, 150000, 'FIFO'),
(83, '2020-02-19 10:25:23', 'TYP9063548', 'BES0002', 30, 100000, 150000, 'FIFO'),
(84, '2020-02-19 10:25:23', 'TYP9063548', 'BES0002', 0, 105000, 150000, 'FIFO'),
(85, '2020-02-19 10:25:23', 'TYP9063548', 'BES0002', 20, 100000, 150000, 'FIFO'),
(86, '2020-02-19 10:25:23', 'TYP9063548', 'BES0002', 0, 105000, 150000, 'FIFO'),
(87, '2020-02-19 10:25:23', 'TYP9063548', 'BES0002', 30, 100000, 150000, 'FIFO'),
(88, '2020-02-20 05:23:19', 'EWK4210653', 'B001', 0, 100000, 2500000, 'FIFO'),
(89, '2020-02-20 05:23:19', 'EWK4210653', 'B001', 500, 95000, 2500000, 'FIFO'),
(90, '2020-02-20 05:23:19', 'EWK4210653', 'BES0002', 0, 105000, 150000, 'FIFO'),
(91, '2020-02-20 05:23:19', 'EWK4210653', 'BES0002', 250, 100000, 150000, 'FIFO'),
(92, '2020-02-20 08:10:30', 'BBM200220001', 'B001', 0, 100000, 2500000, 'FIFO'),
(93, '2020-02-20 08:10:30', 'BBM200220001', 'B001', 200, 90000, 2500000, 'FIFO'),
(94, '2020-02-20 08:10:30', 'BBM200220001', 'B001', 0, 100000, 2500000, 'FIFO'),
(95, '2020-02-20 08:10:30', 'BBM200220001', 'B001', 100, 90000, 2500000, 'FIFO'),
(96, '2020-02-20 08:25:48', 'BTR8620394', 'B001', 0, 100000, 2500000, 'FIFO'),
(97, '2020-02-20 08:25:48', 'BTR8620394', 'B001', 100, 90000, 2500000, 'FIFO'),
(98, '2020-02-20 08:26:49', 'PED3910482', 'B001', 0, 100000, 2500000, 'FIFO'),
(99, '2020-02-20 08:26:50', 'PED3910482', 'B001', 100, 90000, 2500000, 'FIFO');

-- --------------------------------------------------------

--
-- Table structure for table `master_insentif`
--

CREATE TABLE `master_insentif` (
  `id` int(11) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `gross_penjualan` double NOT NULL,
  `insentif` double NOT NULL,
  `total_insentif` double NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_insentif`
--

INSERT INTO `master_insentif` (`id`, `nomor_faktur`, `sales`, `gross_penjualan`, `insentif`, `total_insentif`, `tanggal`, `status`) VALUES
(1, 'BBM090220001', 'lucky15', 250000000, 0.5, 1250000, '2020-02-09 00:00:00', 1),
(3, 'BBM190220001', 'lucky15', 4500000, 0, 50000, '2020-02-19 00:00:00', 99),
(4, 'BBM200220001', 'lucky15', 750000000, 0.5, 3750000, '2020-02-20 00:00:00', 1);

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
(0, 'Null', 'TIDAK ADA JENIS', '', 'lucky15', '2020-01-28 14:54:57'),
(1, 'BSI', 'BESI', 'Jenis Barang ', '', '2020-01-05 05:39:41');

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

--
-- Dumping data for table `master_kartu_persediaan`
--

INSERT INTO `master_kartu_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `tanggal_transaksi`, `jumlah`, `harga`, `total`, `status`) VALUES
(1, 'B001', 'asdasdasd', '2020-01-14', 10, 10000, 100000, 0),
(2, 'B001', 'sdasfasgasga', '2020-01-15', 5, 12000, 60000, 1);

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
(0, 'NULL', 'TIDAK ADA MEREK', 'TIDAK ADA MEREK BARANG', '', '2020-01-05 00:00:00'),
(1, 'ATM', 'ANTAM', 'MEREK BESI', '', '2020-01-05 00:00:00'),
(6, 'KTK', 'KERAKATAU STEEL', 'BESI KRAKATAU STEEL', '', '2020-01-05 08:05:10');

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
  `gambar` varchar(255) NOT NULL,
  `has_user` int(1) NOT NULL DEFAULT '0',
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pegawai`
--

INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gambar`, `has_user`, `user`, `timestamp`) VALUES
(1, '199207152019011001', '3201241241231230011', 'LUCKY', 0, 'SDASDASDASD', 'ASDASDA', 'ASDASDASD', 'ASDASDA', '1992-07-15', '2020-01-01', 'Sarjana', 'Manajer', '08604560', 'BCA - 0468995561', '124124124', 1, '23K1xq4Ft0IQDPYO.png', 1, 'lucky15', '2020-02-19 02:18:12'),
(2, '199207152019011002', '320124124123123', 'DESI E', 0, 'asdlkasjdlkj\r\naskldjlaskjdk\r\naslkdjalskdjl', '', '', '', '1995-08-10', '2020-01-01', 'SARJAN', 'Cashier', '', '124124124', '', 1, 'bYQZxJe2ncz1aPTs.jpg', 1, 'lucky15', '2020-02-19 02:03:04'),
(4, '002', '321412412', 'ASDKJALSKJD', 1, 'PASIR HONJE\r\nPASIR HONJE', 'ASDASD', '40191', 'BANDUNG', '2020-02-12', '2020-02-19', 'ASDASD', 'ASDASD', '124124', 'ASDASD - 124124', '124124', 1, '002.png', 0, 'lucky15', '2020-02-19 02:19:16');

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
(1, 'aD98NsXPRLKdYSir', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
(2, 'GsUZhP0R9kSE7eMf', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
(3, 'LZQ9840', 'rekanan', 'LUCKY ANGGARA', 'Bandung', 'anggara.lucky1992@gmail.com', '082116562811', '12.132.454.3-513.213', 'BNI-012501250-Lucky Anggara', 0, '2020-01-26', 'lucky15'),
(4, 'myvZH97qQfVjnbEu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
(6, 'Wnli8xKPrsBOMjz1', '', 'bebe', '', '', '', '', '', 1, '0000-00-00', ''),
(7, '8kons1dF3fS7irNj', '', 'asfasf', '', '', '', '', '', 1, '0000-00-00', '');

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
  `status_bayar` int(1) NOT NULL,
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_input`, `user`) VALUES
('9NCuao2sA60hJ3FH', 'betasdas', '2020-02-09 06:39:19', 'EKZ372', 95000000, 0, 9500000, 0, 104500000, 1, '2020-02-09', 'lucky15'),
('ZrmHLlIg36NazME1', 'asfasf', '2020-02-07 09:45:40', 'EKZ372', 95000000, 0, 9500000, 0, 104500000, 1, '2020-02-09', 'desi10');

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
  `total_penjualan` double NOT NULL DEFAULT '0',
  `diskon` double DEFAULT '0',
  `pajak_masukan` double NOT NULL DEFAULT '0',
  `ongkir` double NOT NULL DEFAULT '0',
  `grand_total` double NOT NULL DEFAULT '0',
  `status_bayar` int(1) NOT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `tanggal_input` date NOT NULL,
  `sales` varchar(255) NOT NULL DEFAULT 'nosales',
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`) VALUES
(38, 'PO.090220001', '2020-02-09 00:00:00', 'BBM090220001', 'LZQ9840', 250000000, 0, 0, 0, 250000000, 1, NULL, '2020-02-09', 'lucky15', 'desi10'),
(45, 'PO.190220001', '2020-02-19 00:00:00', 'BBM190220001', 'LZQ9840', 4500000, 0, 450000, 0, 4950000, 1, NULL, '2020-02-19', 'lucky15', 'desi10'),
(46, 'OUT6027413', '2020-02-19 10:25:22', 'TYP9063548', '8kons1dF3fS7irNj', 1262000000, 0, 126200000, 0, 1388200000, 1, NULL, '2020-02-19', 'lucky15', 'desi10'),
(47, 'OUT5327968', '2020-02-20 05:23:18', 'EWK4210653', 'LZQ9840', 1287500000, 0, 0, 0, 1287500000, 0, NULL, '2020-02-20', 'lucky15', 'desi10'),
(48, 'PO.200220001', '2020-02-20 00:00:00', 'BBM200220001', 'LZQ9840', 750000000, 100000, 75000000, 0, 824900000, 0, NULL, '2020-02-20', 'lucky15', 'desi10'),
(49, 'OUT3169027', '2020-02-20 08:25:47', 'BTR8620394', 'LZQ9840', 250000000, 10000000, 24000000, 0, 264000000, 1, NULL, '2020-02-20', 'nosales', 'desi10'),
(50, 'OUT3690725', '2020-02-20 08:26:49', 'PED3910482', 'LZQ9840', 250000000, 0, 25000000, 0, 275000000, 1, NULL, '2020-02-20', 'nosales', 'kasir');

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

--
-- Dumping data for table `master_persediaan`
--

INSERT INTO `master_persediaan` (`id`, `kode_barang`, `jumlah_persediaan`, `jumlah_keranjang`, `jumlah_persediaan_sementara`, `tanggal_input`, `no_order_terakhir`) VALUES
(0, 'K001', -2323, 1, 0, '2020-01-22 15:46:02', ''),
(15, 'P001', 564.5, -1440.5, 0, '2020-01-21 16:22:28', ''),
(16, 'B001', -7031, 1221, 0, '2020-01-21 04:28:53', '');

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
  `down_payment` double NOT NULL DEFAULT '0',
  `sisa_piutang` double NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_piutang`
--

INSERT INTO `master_piutang` (`id`, `no_faktur`, `tanggal_jatuh_tempo`, `total_tagihan`, `total_pembayaran`, `down_payment`, `sisa_piutang`, `tanggal_input`, `user`) VALUES
(5, 'EWK4210653', '2020-03-20', 0, 0, 200000000, 1087500000, '2020-02-20', 'desi10'),
(6, 'BBM200220001', '2020-03-25', 0, 200000000, 100000000, 624900000, '2020-02-20', 'desi10'),
(7, 'PED3910482', '2020-04-15', 275000000, 275000000, 75000000, 0, '2020-02-20', 'desi10');

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
  `status_po` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_purchase_order`
--

INSERT INTO `master_purchase_order` (`id`, `tanggal_transaksi`, `no_order`, `sales`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `tanggal_input`, `user`, `admin`, `status_po`) VALUES
(31, '0000-00-00 00:00:00', 'PO.090220001', 'lucky15', 'LZQ9840', 250000000, 0, 0, 0, 250000000, '2020-02-09 10:14:09', 'lucky15', 'desi10', 2),
(38, '0000-00-00 00:00:00', 'PO.190220001', 'lucky15', 'LZQ9840', 4500000, 0, 450000, 0, 4950000, '2020-02-19 08:30:49', 'lucky15', 'desi10', 2),
(39, '0000-00-00 00:00:00', 'PO.200220001', 'lucky15', 'LZQ9840', 750000000, 100000, 75000000, 0, 824900000, '2020-02-20 08:10:30', 'lucky15', 'desi10', 2);

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
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_retur_pembelian`
--

INSERT INTO `master_retur_pembelian` (`id`, `nomor_transaksi_asli`, `nomor_transaksi`, `kode_supplier`, `retur_total`, `retur_diskon`, `retur_pajak`, `retur_grand_total`, `user`, `tanggal`) VALUES
(3, 'betasdas', 'RTR-betasdas', 'EKZ372', 2850000, 0, 285000, 3135000, 'lucky15', '2020-02-20 03:35:57');

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
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_retur_penjualan`
--

INSERT INTO `master_retur_penjualan` (`id`, `nomor_faktur_asli`, `nomor_faktur`, `id_pelanggan`, `retur_total`, `retur_diskon`, `retur_pajak`, `retur_grand_total`, `user`, `tanggal`) VALUES
(13, 'BBM090220001', 'RTR-BBM090220001', 'LZQ9840', 125000000, 0, 12500000, 137500000, 'desi10', '2020-02-24 11:52:14');

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
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_saldo_awal`
--

INSERT INTO `master_saldo_awal` (`id`, `kode_barang`, `nomor_faktur`, `qty_awal`, `saldo_awal`, `harga_awal`, `tanggal_input`, `tanggal_saldo`, `user`) VALUES
(7, 'B001', 'SALDO AWAL', 100, 0, 100000, '2020-02-09 06:32:03', '2020-01-01 00:00:01', 'lucky15'),
(8, 'BES0002', 'SALDO AWAL', 10, 0, 105000, '2020-02-09 09:46:10', '2020-01-01 00:00:01', 'lucky15'),
(9, 'K001', 'SALDO AWAL', 30, 30, 100000, '2020-02-24 16:55:20', '2020-01-01 00:00:01', 'desi10');

-- --------------------------------------------------------

--
-- Table structure for table `master_sales`
--

CREATE TABLE `master_sales` (
  `kode_sales` varchar(255) NOT NULL,
  `kode_pegawai` varchar(255) NOT NULL,
  `nama_sales` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `insentif` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_sales`
--

INSERT INTO `master_sales` (`kode_sales`, `kode_pegawai`, `nama_sales`, `status`, `insentif`) VALUES
('d', '10002', 'Desi', 'Aktif', 0),
('l', '10001', 'Lucky', 'Aktif', 0);

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
(0, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gulaasdasda', '', '2020-01-05 08:20:51'),
(1, 'PTG', 'POTONG', '', '', '0000-00-00 00:00:00'),
(2, 'MTR', 'METER', '', '', '0000-00-00 00:00:00'),
(3, 'CM', 'CENTIMETER', 'Untuk alsdklaskdasd', '', '2020-01-04 08:02:14'),
(4, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gula', '', '2020-01-05 05:24:09');

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
(1, 'nama_perusahaan', 'PT. Lucky Anugrah', '2020-02-21 13:06:14'),
(2, 'alamat_perusahaan', 'ADUH ', '2020-02-21 13:02:23'),
(3, 'nomor_telepon', '082116562811', '2020-02-21 13:02:37'),
(4, 'nomor_fax', '129895925', '2020-02-21 06:11:01'),
(5, 'alamat_email', 'aaskjjaskf@gmail.com', '2020-02-21 06:11:25'),
(6, 'logo_perusahaan', '1JITEv6aepWYlocH.png', '2020-02-21 13:10:14'),
(7, 'prefix_faktur', 'BBM', '2020-02-21 06:11:51'),
(8, 'nomor_faktur', '2', '2020-02-25 08:36:01'),
(9, 'catatan_faktur_cash', 'nlknlkn', '2020-02-21 13:16:00'),
(10, 'catatan_faktur_kredit', 'asss', '2020-02-25 06:34:05'),
(11, 'catatan_retur_jual', 'asdasda', '2020-02-24 11:58:09'),
(12, 'catatan_retur_beli', 'asdasda', '2020-02-24 11:58:09'),
(13, 'password_harga', '2', '2020-02-25 08:33:06'),
(14, 'komisi_sales', '0.5', '2020-02-25 08:34:06'),
(15, 'notifikasi', '1', '2020-02-25 08:50:23'),
(16, 'frekuensi_notifikasi', '', '2020-02-25 08:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `master_stok_opname`
--

CREATE TABLE `master_stok_opname` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user` varchar(255) NOT NULL,
  `spv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_stok_opname`
--

INSERT INTO `master_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `keterangan`, `status`, `user`, `spv`) VALUES
(33, 'REF2376045', '2020-02-14 13:22:31', 'asdasfasf', 99, 'lucky15', 'lucky15'),
(34, 'REF9042536', '2020-02-19 03:23:08', 'aADadASFAS', 2, 'lucky15', 'lucky15'),
(35, 'REF4693258', '1970-01-01 01:00:00', 'kl;kl;', 1, 'lucky15', 'lucky15'),
(36, 'REF8564302', '2020-02-14 14:18:57', 'ghdfhd', 2, 'lucky15', 'lucky15'),
(37, 'REF4271368', '2020-02-14 15:18:24', 'dgsdgsdgsd', 2, 'lucky15', 'lucky15'),
(38, 'REF1640859', '1970-01-01 01:00:00', '', 1, 'desi10', '');

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
('EKO076', 'PT JAYA MAKMUR', 'aksdjlkasjdlkasjdlkaj\r\nasdasdasd\r\nasdasdasdasd', '921839018239081', '12.983.910.2-839.012', 'BCA-192839128-Lucky', 'asdasdasd', '', '2020-01-16 14:43:17'),
('EKZ372', 'GENERAL VENDOR', 'General Vendor', '0', '00.000.000.0-000.000', '--0--', 'General Vendor', '', '2020-01-16 14:43:50'),
('QHQ851', 'PTP', 'TPPTPTTPPTPTPTPT', '123012301203', '11.111.111.1-111.111', 'BCA-12310230122-1231231231', 'paspdapdasdasdasda', '', '2020-01-05 06:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `master_tipe_barang`
--

CREATE TABLE `master_tipe_barang` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_tipe_barang`
--

INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`, `user`, `timestamp`) VALUES
(1, 'INVENTORY', 'TIPE UNTUK BARANG YANG DIJUAL', '', '2020-01-25 03:59:03'),
(2, 'NON-INVENTORY', 'TIPE UNTUK BARANG YANG TIDAK DIJUAL, CONTOH PERALATAN KANTOR', '', '2020-01-25 03:59:03'),
(3, 'JASA', 'TIPE BARANG YANG TIDAK BERUPA, SEPERTI JASA PENGANTAR BARANG, JASA RAKITAN', '', '2020-01-25 03:59:03'),
(4, 'RAKITAN', 'TIPE BARANG BUNDLING, SEPERTI PAKET SEMABAKO', '', '2020-01-25 03:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `username` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `last_activity` datetime NOT NULL,
  `tanggal_create` datetime NOT NULL,
  `isactive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`) VALUES
('desi10', '199207152019011002', '$2y$10$KaPuBy66KgtWC/gbOFLS/O/XcRisL.DJ3iG249CgA8Qswz5VMbuJW', '2', 'Desi Evilia A', 'avatar-3.jpg', 0, '2020-02-25 04:40:27', '2020-02-15 07:56:40', 1),
('kasir', '002', '$2y$10$6FzZiMgxo3PfDoFRL8nGpegZxgpxNlRNpHpCiAH0qzTVskbXV2ktK', '5', 'Kasir', '', 0, '2020-02-25 09:50:40', '0000-00-00 00:00:00', 1),
('lucky15', '199207152019011001', '$2y$10$Xz9yw5OdntM8OAM6OKkFS.H.p4qss7I5/ybwCT5uWAtXK7bRznxGu', '3', 'Lucky Anggara', 'avatar-2.jpg', 0, '2020-02-25 05:19:50', '2020-02-15 07:59:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_utang`
--

CREATE TABLE `master_utang` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_tagihan` double NOT NULL,
  `total_pembayaran` double NOT NULL,
  `down_payment` double NOT NULL DEFAULT '0',
  `sisa_utang` double NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting_perusahaan`
--

CREATE TABLE `setting_perusahaan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `nomor_fax` varchar(255) NOT NULL,
  `alamat_email` varchar(255) NOT NULL,
  `logo_perusahaan` varchar(255) NOT NULL,
  `prefix_faktur` varchar(255) NOT NULL,
  `note_faktur_jual` text NOT NULL,
  `note_faktur_beli` varchar(512) NOT NULL,
  `insentif` double NOT NULL,
  `note_faktur_jual_kredit` varchar(512) NOT NULL,
  `note_retur_faktur_jual` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_perusahaan`
--

INSERT INTO `setting_perusahaan` (`id`, `nama_perusahaan`, `alamat_perusahaan`, `nomor_telepon`, `nomor_fax`, `alamat_email`, `logo_perusahaan`, `prefix_faktur`, `note_faktur_jual`, `note_faktur_beli`, `insentif`, `note_faktur_jual_kredit`, `note_retur_faktur_jual`) VALUES
(1, 'PT. BERKAH BAJA MAKMUR', 'JL. RAYA BANDUNG TASIK LIMBANGAN TIMUR\r\nGARUT, JAWA BARAT', '082119349199', '-', 'berkahbajamakmur@gmail.com', 'logo-perusahaan.png', 'BBM', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0.5, '', '');

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

--
-- Dumping data for table `tabel_diskon`
--

INSERT INTO `tabel_diskon` (`id`, `kode_diskon`, `potongan`, `jumlah_diskon`, `keterangan`) VALUES
(1, 'HAYU10', 10, 10, 'POTONGAN DISKON 10 Persen');

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
(13, 'Laporan', '#', 'fa fa-file-text', ''),
(14, 'Data', '#', 'fa fa-database', 'Kasir'),
(15, 'Keuangan', '#', 'fa fa-money', 'Admin, Supervisor'),
(16, 'Penjualan', '#', 'fa fa-cart-arrow-down', 'Admin'),
(17, 'Persediaan', '#', 'fa fa-window-restore', 'Admin'),
(18, 'Sales', '#', 'fa fa-users', 'Admin'),
(19, 'Pegawai', '#', 'fa fa-users', 'Supervisor'),
(20, 'Settings', 'setting/setting', 'fa fa-gear', 'Manajer');

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_perhitungan_order`
--

INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES
('OUT1960475', 175000000, 0, 17500000, 0, 192500000, '2020-02-20 07:23:46'),
('OUT8074695', 250000000, 10000000, 24000000, 0, 264000000, '2020-02-20 07:25:10'),
('OUT9604258', 50000000, 100000, 0, 0, 49900000, '2020-02-20 07:20:40');

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
(1, 'Kasir', '4,1,14'),
(2, 'Admin', '5,16,2,18,17,10,15'),
(3, 'Sales', '3,8'),
(4, 'Supervisor', '6,9,15,19'),
(5, 'Manager', '7,11,12,20'),
(6, 'Superuser', '');

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
(5, '18', 'Purchase Order', 'manajemen_penjualan/purchaseorderadmin', 'Admin P.O'),
(6, '16', 'Retur Penjualan', 'manajemen_penjualan/returpenjualan', 'Admin Retur Penjualan'),
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
(25, '19', 'Insentif Sales', 'manajemen_pegawai/insentifsales', 'Supervisor Insentif Sales'),
(26, '8', 'Purchase Order', 'manajemen_penjualan/purchaseordersales', 'Sales P.O'),
(27, '8', 'Daftar Purchase Order', 'manajemen_penjualan/purchaseordersales/daftar', 'Sales Daftar P.O'),
(28, '8', 'Insentif', 'manajemen_sales/insentif', 'Sales Insentif Monitor'),
(29, '15', 'Master Piutang', 'manajemen_keuangan/masterpiutang/daftar_piutang', 'Admin Master Piutang'),
(30, '15', 'Master Utang', 'manajemen_keuangan/masterutang/daftar_utang', 'Admin Master Utang'),
(31, '12', 'Insentif Sales', 'manajemen_pegawai/insentifsales', 'Manajer Insentif Sales');

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
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_purchase_order`
--

INSERT INTO `temp_purchase_order` (`id`, `no_order`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`, `user`, `status`) VALUES
(209, 'PO.200220001', 'B001', 200, 2500000, 0, 500000000, '2020-02-20 08:08:36', 'lucky15', 2),
(210, 'PO.200220001', 'B001', 100, 2500000, 100000, 249900000, '2020-02-20 08:08:49', 'lucky15', 2);

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
  `tanggal_input` date NOT NULL
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
  `status` int(11) NOT NULL DEFAULT '0',
  `user` varchar(255) NOT NULL,
  `is_po` int(1) NOT NULL DEFAULT '0',
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(36, 'PO.090220001', 1, '2020-02-09 09:59:56', 'xvsdg', 'lucky15'),
(39, 'PO.190220001', 1, '2020-02-19 08:20:19', 'proses min', 'lucky15'),
(40, 'PO.190220001', 2, '2020-02-19 08:30:49', '<span class=\"text-success\">Approve</span><br>', 'desi10'),
(41, 'PO.200220001', 1, '2020-02-20 08:09:34', 'proses yap', 'lucky15'),
(42, 'PO.200220001', 2, '2020-02-20 08:10:30', '<span class=\"text-success\">Approve</span><br>', 'desi10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_detail_stok_opname`
--
ALTER TABLE `detail_detail_stok_opname`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `master_piutang` (`nomor_faktur`);

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
-- Indexes for table `master_purchase_order`
--
ALTER TABLE `master_purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_po` (`no_order`);

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
  ADD UNIQUE KEY `no_faktur` (`no_faktur`),
  ADD KEY `no_faktur_2` (`no_faktur`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_perusahaan`
--
ALTER TABLE `setting_perusahaan`
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
-- Indexes for table `timeline_po`
--
ALTER TABLE `timeline_po`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_detail_stok_opname`
--
ALTER TABLE `detail_detail_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_retur_pembelian`
--
ALTER TABLE `detail_retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_retur_penjualan`
--
ALTER TABLE `detail_retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `detail_stok_opname`
--
ALTER TABLE `detail_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `detail_utang`
--
ALTER TABLE `detail_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `master_insentif`
--
ALTER TABLE `master_insentif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_pegawai`
--
ALTER TABLE `master_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `master_piutang`
--
ALTER TABLE `master_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_purchase_order`
--
ALTER TABLE `master_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `master_retur_pembelian`
--
ALTER TABLE `master_retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_retur_penjualan`
--
ALTER TABLE `master_retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_setting`
--
ALTER TABLE `master_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master_stok_opname`
--
ALTER TABLE `master_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `master_utang`
--
ALTER TABLE `master_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tabel_role`
--
ALTER TABLE `tabel_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_submenu`
--
ALTER TABLE `tabel_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `timeline_po`
--
ALTER TABLE `timeline_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `pembelian` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_pembelian` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `master_utang` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_utang` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

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
