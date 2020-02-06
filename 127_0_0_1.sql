-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2020 at 12:51 PM
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
(39, 'G28z3Dh5IZQwUeq9', '2020-01-23 07:27:48', 'ITJ.1.sad/123124', 'P001', 1000, 1000000, 0, 1000000000, '2020-01-26', 300),
(40, 'wXNa27iDPeGokuUj', '2020-01-21 07:30:18', 'itjas/21312/5125', 'K001', 500, 900000, 0, 450000000, '2020-01-26', 0),
(41, 'TLtjpKorkmPDFECB', '2020-01-21 07:30:39', '125125125', 'K001', 500, 1000000, 0, 500000000, '2020-01-26', 5),
(42, '0HRDB6M25fWV9sxt', '2020-01-29 14:16:23', 'hmmm', 'B001', 1000, 500000, 0, 500000000, '2020-01-29', 0),
(43, 'ipKVQwmfrDNFICBz', '2020-01-29 14:43:02', '1214', 'B001', 50, 2000000, 0, 100000000, '2020-01-29', 0),
(44, 's8F0a32KkDdIuQnf', '2020-02-03 02:26:42', 'ksdfs', 'K001', 500, 20000, 0, 10000000, '2020-02-03', 500),
(45, 's8F0a32KkDdIuQnf', '2020-02-03 02:27:01', 'ksdfs', 'BES0002', 100, 150000, 0, 15000000, '2020-02-03', 100),
(46, 's8F0a32KkDdIuQnf', '2020-02-03 02:29:03', 'ksdfs', 'P001', 200, 100000, 0, 20000000, '2020-02-03', 200);

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
(28, 'OUT0547812', '2020-01-26 07:32:41', 'AHI9857403', 'K001', 600, 1200000, 0, 720000000, '2020-01-26'),
(29, 'OUT0547812', '2020-01-26 07:32:46', 'AHI9857403', 'P001', 500, 1200000, 0, 600000000, '2020-01-26'),
(31, 'OUT0583416', '2020-01-26 11:37:04', 'TNY1903246', 'K001', 300, 1200000, 0, 360000000, '2020-01-26'),
(32, 'OUT9627401', '2020-01-26 11:48:45', 'ZWI8275603', 'P001', 200, 1200000, 0, 240000000, '2020-01-26'),
(33, 'OUT4721695', '2020-01-27 02:41:21', 'FZJ1620974', 'K001', 50, 1200000, 0, 60000000, '2020-01-27'),
(34, 'OUT7260583', '2020-01-27 02:44:39', 'EAQ4782051', 'K001', 40, 1200000, 0, 48000000, '2020-01-27'),
(35, 'OUT1983547', '2020-01-29 14:15:29', 'MOY5089346', 'K001', 5, 1200000, 0, 6000000, '2020-01-29'),
(39, 'OUT9538027', '2020-01-29 15:04:57', 'DYP2690147', 'B001', 1110, 2500000, 0, 2775000000, '2020-01-29'),
(40, 'OUT4586930', '2020-02-03 02:11:59', 'UYK6283491', 'B001', 20, 2500000, 0, 50000000, '2020-02-03'),
(41, 'OUT1967840', '2020-02-03 12:22:24', 'HRK3085921', 'B001', 20, 2500000, 0, 50000000, '2020-02-03'),
(47, 'OUT4673128', '2020-02-03 12:41:11', 'DPI3502714', 'B001', 20, 2500000, 0, 50000000, '2020-02-03');

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
(18, '2020-02-03', 'ksdfs', 'P001', 200, 100000, 200);

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
('BES0002', 1, 1, 0, 'EKZ372', 'BESI BETON', 0, 100000, 0, 10, 'FIFO', 20000, 'default.png', '', 0, '', '2020-01-31 10:20:27'),
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
(31, '2020-01-26 04:00:00', 'AHI9857403', 'K001', 500, 900000, 1200000, 'FIFO'),
(32, '2020-01-26 04:00:00', 'AHI9857403', 'K001', 100, 1000000, 1200000, 'FIFO'),
(33, '2020-01-26 07:00:00', 'AHI9857403', 'P001', 500, 1000000, 1200000, 'FIFO'),
(34, '2020-01-26 06:00:00', 'TNY1903246', 'K001', 300, 1000000, 1200000, 'FIFO'),
(35, '2020-01-26 11:48:48', 'ZWI8275603', 'P001', 200, 1000000, 1200000, 'FIFO'),
(36, '2020-01-27 02:41:26', 'FZJ1620974', 'K001', 50, 1000000, 1200000, 'FIFO'),
(37, '2020-01-27 02:45:04', 'EAQ4782051', 'K001', 40, 1000000, 1200000, 'FIFO'),
(38, '2020-01-29 14:15:42', 'MOY5089346', 'K001', 5, 1000000, 1200000, 'FIFO'),
(42, '2020-01-29 15:05:08', 'DYP2690147', 'B001', 100, 1200000, 2500000, 'FIFO'),
(43, '2020-01-29 15:05:08', 'DYP2690147', 'B001', 1000, 500000, 2500000, 'FIFO'),
(44, '2020-01-29 15:05:08', 'DYP2690147', 'B001', 10, 2000000, 2500000, 'FIFO'),
(45, '2020-02-03 02:12:03', 'UYK6283491', 'B001', 0, 1200000, 2500000, 'FIFO'),
(46, '2020-02-03 02:12:03', 'UYK6283491', 'B001', 20, 2000000, 2500000, 'FIFO'),
(47, '2020-02-03 12:41:16', 'DPI3502714', 'B001', 0, 1200000, 2500000, 'FIFO'),
(48, '2020-02-03 12:41:16', 'DPI3502714', 'B001', 20, 2000000, 2500000, 'FIFO');

-- --------------------------------------------------------

--
-- Table structure for table `master_hutang`
--

CREATE TABLE `master_hutang` (
  `id` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `down_payment` double NOT NULL DEFAULT '0',
  `sisa_pembayaran` double NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
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
(6, 'Wnli8xKPrsBOMjz1', '', 'bebe', '', '', '', '', '', 1, '0000-00-00', '');

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
('0HRDB6M25fWV9sxt', 'hmmm', '2020-01-29 14:16:36', 'EKO076', 500000000, 0, 50000000, 0, 550000000, 1, '2020-01-29', 'lucky15'),
('G28z3Dh5IZQwUeq9', 'ITJ.1.sad/123124', '2020-01-23 07:27:55', 'EKO076', 1000000000, 0, 100000000, 0, 1100000000, 1, '2020-01-26', 'lucky15'),
('ipKVQwmfrDNFICBz', '1214', '2020-01-29 14:43:06', 'EKO076', 100000000, 0, 0, 0, 100000000, 1, '2020-01-29', 'lucky15'),
('s8F0a32KkDdIuQnf', 'ksdfs', '2020-02-03 02:29:08', 'EKZ372', 45000000, 0, 4500000, 0, 49500000, 1, '2020-02-03', 'lucky15'),
('TLtjpKorkmPDFECB', '125125125', '2020-01-21 07:30:43', 'EKZ372', 500000000, 0, 50000000, 0, 550000000, 1, '2020-01-26', 'lucky15'),
('wXNa27iDPeGokuUj', 'itjas/21312/5125', '2020-01-21 07:30:24', 'EKZ372', 450000000, 0, 45000000, 0, 495000000, 1, '2020-01-26', 'lucky15');

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
(1, 'OUT0547812', '2020-01-26 07:33:03', 'AHI9857403', 'LZQ9840', 1320000000, 0, 132000000, 0, 1452000000, 1, NULL, '2020-01-26', 'lucky15', 'lucky15'),
(2, 'OUT9538027', '2020-01-29 15:05:07', 'DYP2690147', 'LZQ9840', 2775000000, 0, 0, 0, 2775000000, 1, NULL, '2020-01-29', 'nosales', 'lucky15'),
(3, 'OUT7260583', '2020-01-27 02:45:04', 'EAQ4782051', 'LZQ9840', 48000000, 0, 0, 0, 48000000, 0, NULL, '2020-01-27', 'nosales', 'lucky15'),
(4, 'OUT4721695', '2020-01-27 02:41:26', 'FZJ1620974', 'LZQ9840', 60000000, 0, 0, 0, 60000000, 1, NULL, '2020-01-27', 'nosales', 'lucky15'),
(5, 'OUT1967840', '2020-02-03 12:22:34', 'HRK3085921', 'LZQ9840', 50000000, 0, 5000000, 0, 55000000, 1, NULL, '2020-02-03', 'nosales', 'lucky15'),
(6, 'OUT1983547', '2020-01-29 14:15:42', 'MOY5089346', 'LZQ9840', 6000000, 0, 600000, 0, 6600000, 1, NULL, '2020-01-29', 'nosales', 'lucky15'),
(7, 'OUT0583416', '2020-01-26 00:00:00', 'TNY1903246', 'LZQ9840', 360000000, 0, 36000000, 0, 396000000, 1, NULL, '2020-01-26', 'lucky15', 'lucky15'),
(8, 'OUT4586930', '2020-02-03 02:12:03', 'UYK6283491', 'LZQ9840', 50000000, 0, 0, 0, 50000000, 1, NULL, '2020-02-03', 'nosales', 'lucky15'),
(9, 'OUT9627401', '2020-01-26 11:48:48', 'ZWI8275603', 'LZQ9840', 240000000, 0, 0, 0, 240000000, 1, NULL, '2020-01-26', 'nosales', 'lucky15'),
(12, 'OUT4673128', '2020-02-03 12:41:16', 'DPI3502714', 'Wnli8xKPrsBOMjz1', 50000000, 0, 5000000, 0, 55000000, 1, NULL, '2020-02-03', 'nosales', 'lucky15');

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
(0, 'K001', -2322, 0, 0, '2020-01-22 15:46:02', ''),
(15, 'P001', 564.5, -1440.5, 0, '2020-01-21 16:22:28', ''),
(16, 'B001', -4595, -15, 0, '2020-01-21 04:28:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_piutang`
--

CREATE TABLE `master_piutang` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `down_payment` double NOT NULL DEFAULT '0',
  `sisa_pembayaran` double NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_piutang`
--

INSERT INTO `master_piutang` (`id`, `no_faktur`, `tanggal_jatuh_tempo`, `down_payment`, `sisa_pembayaran`, `tanggal_input`, `user`) VALUES
(1, 'EAQ4782051', '2020-03-01', 10000000, 38000000, '2020-01-27', 'lucky15');

-- --------------------------------------------------------

--
-- Table structure for table `master_purchase_order`
--

CREATE TABLE `master_purchase_order` (
  `id` int(11) NOT NULL,
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
(3, 'B001', 'SALDO AWAL', 100, 0, 1200000, '2020-01-27 15:07:50', '2020-01-01 00:00:00', 'lucky15'),
(5, 'K001', 'SALDO AWAL', 100, 100, 10000, '2020-01-28 16:22:12', '2020-01-01 00:00:00', 'lucky15'),
(6, 'BES0002', 'SALDO AWAL', 2000, 2000, 100000, '2020-02-03 02:25:31', '2020-01-01 00:00:01', 'lucky15');

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
  `kode_pegawai` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`username`, `kode_pegawai`, `password`, `role`, `nama`, `avatar`, `status`, `timestamp`) VALUES
('desi10', '10002', '123', 'Sales', 'Desi Evilia A', 'avatar-3.jpg', 'logout', '2020-02-06 08:30:18'),
('lucky15', '10001', '123', 'Sales', 'Lucky Anggara', 'avatar-2.jpg', 'logout', '2020-02-06 08:28:38');

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
  `logo_perusahaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_perusahaan`
--

INSERT INTO `setting_perusahaan` (`id`, `nama_perusahaan`, `alamat_perusahaan`, `nomor_telepon`, `nomor_fax`, `alamat_email`, `logo_perusahaan`) VALUES
(1, 'PT. BERKAH BAJA MAKMUR', 'JL. RAYA BANDUNG TASIK LIMBANGAN TIMUR\r\nGARUT, JAWA BARAT', '082119349199', '-', 'berkahbajamakmur@gmail.com', 'logo-perusahaan.png');

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
('OUT4865127', 50000000, 0, 0, 0, 50000000, '2020-02-03 11:28:21'),
('OUT7481392', 50000000, 0, 0, 0, 50000000, '2020-02-03 11:38:16'),
('PO.0662003', 100000, 0, 0, 0, 100000, '2020-02-06 09:29:14'),
('PO.0662015', 100000, 0, 0, 0, 100000, '2020-02-06 11:13:59'),
('PO.0662095', 500000, 0, 50000, 0, 550000, '2020-02-06 10:38:27'),
('s8F0a32KkDdIuQnf', 45000000, 0, 4500000, 0, 49500000, '2020-02-03 01:29:06');

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
  `tanggal_input` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_purchase_order`
--

INSERT INTO `temp_purchase_order` (`id`, `no_order`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`, `status`) VALUES
(30, 'PO.0662015', 'BES0002', 1, 100000, 0, 100000, '2020-02-06', 0);

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

--
-- Dumping data for table `temp_tabel_keranjang_penjualan`
--

INSERT INTO `temp_tabel_keranjang_penjualan` (`id`, `tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `status`, `user`, `is_po`, `tanggal_input`) VALUES
(84, '2020-02-05 14:14:08', 'PO.0552013', 'BES0002', 100, 100000, 0, 10000000, 1, 'lucky15', 0, '2020-02-05 07:14:08'),
(85, '2020-02-05 14:16:00', 'PO.0552067', 'BES0002', 100, 100000, 0, 10000000, 1, 'lucky15', 0, '2020-02-05 07:16:00'),
(87, '2020-02-05 14:18:16', 'PO.0552098', 'BES0002', 1, 100000, 0, 100000, 1, 'lucky15', 0, '2020-02-05 07:18:16'),
(88, '2020-02-05 14:19:21', 'PO.0552092', 'BES0002', 1, 100000, 0, 100000, 1, 'lucky15', 0, '2020-02-05 07:19:21'),
(89, '2020-02-05 14:19:29', 'PO.0552008', 'BES0002', 1, 100000, 0, 100000, 1, 'lucky15', 0, '2020-02-05 07:19:29'),
(90, '2020-02-05 14:22:08', 'PO.0552032', 'BES0002', 1, 100000, 0, 100000, 1, 'lucky15', 0, '2020-02-05 07:22:08'),
(97, '2020-02-06 09:17:36', 'PO.0662061', 'BES0002', 1, 100000, 0, 100000, 1, 'lucky15', 0, '2020-02-06 02:17:36');

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
(1, 'PO.0442041', 1, '2020-02-04 15:35:44', 'dgssdg55654 6546 5465 46 546 546456 546 165465165465', 'lucky15'),
(2, 'PO.0442037', 1, '2020-02-04 16:07:18', 'proses yapss', 'lucky15'),
(3, 'PO.0442062', 1, '2020-02-04 16:15:18', 'Tolong di proses', 'lucky15'),
(4, 'PO.0442067', 1, '2020-02-04 16:21:23', 'Proses Pls', 'lucky15'),
(5, 'PO.0662057', 1, '2020-02-06 08:59:32', 'Proses Ya', 'lucky15'),
(6, 'PO.0662073', 1, '2020-02-06 09:01:42', 'sf', 'desi10'),
(7, 'PO.0662056', 1, '2020-02-06 09:14:22', 'awww', 'lucky15'),
(8, 'PO.0662042', 1, '2020-02-06 11:06:43', 'proses bror', 'lucky15');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `master_hutang`
--
ALTER TABLE `master_hutang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_faktur` (`nomor_transaksi`),
  ADD KEY `no_faktur_2` (`nomor_transaksi`);

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
  ADD KEY `kode_pegawai` (`kode_pegawai`);

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
-- Indexes for table `tabel_perhitungan_order`
--
ALTER TABLE `tabel_perhitungan_order`
  ADD PRIMARY KEY (`no_order`);

--
-- Indexes for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `master_hutang`
--
ALTER TABLE `master_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_piutang`
--
ALTER TABLE `master_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_purchase_order`
--
ALTER TABLE `master_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `timeline_po`
--
ALTER TABLE `timeline_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  ADD CONSTRAINT `hpp` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  ADD CONSTRAINT `saldo_awal` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
