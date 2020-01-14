-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 12:36 PM
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
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `kode_satuan`, `persediaan_minimum`, `gambar`, `keterangan`, `status_jual`, `tanggal_input`) VALUES
('B001', 1, 1, 1, 'EKO076', 'BESI BETON', 100000, 150000, 0, 10, '4ncH9fP3EgXaRBQU.jpg', 'gdfgdfgdfg', 1, '2020-01-14 04:32:43'),
('B002', 1, 1, 6, 'EKO076', 'BRIGHT GAS 10KG', 90000, 100000, 0, 10, 'B002.jpg', '', 1, '2020-01-13 07:52:25'),
('O001', 1, 1, 1, 'QHQ851', 'OTANI PAPER 57X224', 10000, 15000, 0, 10, 'default.jpg', '', 1, '2020-01-13 05:41:12'),
('S001', 1, NULL, NULL, NULL, 'SPANDEK V2', 0, 100000, 1, 0, 'default.jpg', 'asdasdasd', 1, '2020-01-05 00:00:00'),
('S002', 1, 1, 1, 'EKO076', 'BAJA', 100000, 120000, 1, 10, 'S002.jpg', '', 1, '2020-01-10 07:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_barang`
--

CREATE TABLE `master_jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL,
  `kode_jenis_barang` varchar(128) NOT NULL,
  `nama_jenis_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_jenis_barang`
--

INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `tanggal_input`) VALUES
(0, 'NULL', 'TIDAK', 'TIDAK ADA JENIS BARANG', '2020-01-05 08:11:36'),
(1, 'BSI', 'BESI', 'Jenis Barang ', '2020-01-05 05:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `master_merek_barang`
--

CREATE TABLE `master_merek_barang` (
  `id_merek_barang` int(11) NOT NULL,
  `kode_merek_barang` varchar(128) NOT NULL,
  `nama_merek_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_merek_barang`
--

INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `tanggal_input`) VALUES
(0, 'NULL', 'TIDAK ADA MEREK', 'TIDAK ADA MEREK BARANG', '2020-01-05 00:00:00'),
(1, 'ATM', 'ANTAM', 'MEREK BESI', '2020-01-05 00:00:00'),
(6, 'KTK', 'KERAKATAU STEEL', 'BESI KRAKATAU STEEL', '2020-01-05 08:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `master_pembelian`
--

CREATE TABLE `master_pembelian` (
  `no_order_pembelian` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `total_pembelian` double NOT NULL,
  `diskon` double NOT NULL,
  `pajak_keluaran` double NOT NULL,
  `ongkir` double NOT NULL,
  `grand_total` double NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal_input` date NOT NULL,
  `user_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `status`, `tanggal_input`, `user_input`) VALUES
('cweUjIYVA6OmM7ug', '142', 'QHQ851', 121, 0, 0, 0, 121, 0, '0000-00-00', 'udin'),
('g7VaID5qyekKmSnR', '3', 'QHQ851', 10, 0, 0, 0, 10, 0, '0000-00-00', 'udin'),
('hWjPp0Gyo8mBN7eI', '152', 'EKO076', 12000, 0, 0, 0, 12000, 0, '0000-00-00', 'udin'),
('HY7mOIEZMdWSXjLy', '1424', 'EKO076', 100000, 0, 10000, 0, 110000, 0, '0000-00-00', 'udin'),
('MHf95LBn70DaUAKd', '4', 'QHQ851', 160, 0, 0, 0, 160, 0, '0000-00-00', 'udin'),
('Oh8vZ3W9cDbisQxm', '12', 'EKO076', 1, 0, 0, 0, 1, 0, '0000-00-00', 'udin'),
('piPhj3WelYDavmOz', 'uaoudasiudo', 'EKO076', 95000000, 0, 9500000, 0, 104500000, 0, '0000-00-00', 'udin'),
('UkneNuBDYy6odrh8', '15', 'QHQ851', 0, 0, 0, 0, 0, 0, '0000-00-00', 'udin'),
('unP5jGqKkMtIxEYB', 'hyuyhuy', 'EKO076', 700000, 0, 70000, 0, 770000, 0, '0000-00-00', 'udin'),
('uQR70EFvfasmUNCM', '1', 'EKO076', 0, 0, 0, 0, 0, 0, '0000-00-00', 'udin'),
('VpGEZkbrCjR1AlLz', '2', 'QHQ851', 0, 0, 0, 0, 0, 0, '0000-00-00', 'udin'),
('YKHvJ3wzZNtMmlnW', 'ITJASJF', 'EKO076', 1200000, 0, 0, 0, 1200000, 0, '0000-00-00', 'udin');

-- --------------------------------------------------------

--
-- Table structure for table `master_persediaan`
--

CREATE TABLE `master_persediaan` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(128) NOT NULL,
  `jumlah_persediaan` int(15) NOT NULL,
  `jumlah_keranjang` double NOT NULL,
  `jumlah_persediaan_sementara` int(15) NOT NULL COMMENT 'temporary jumlah persediaan setelah di pesan',
  `tanggal_input` datetime NOT NULL,
  `no_order_terakhir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_persediaan`
--

INSERT INTO `master_persediaan` (`id`, `kode_barang`, `jumlah_persediaan`, `jumlah_keranjang`, `jumlah_persediaan_sementara`, `tanggal_input`, `no_order_terakhir`) VALUES
(9, 'B001', 9, 7, 0, '2020-01-14 04:31:00', ''),
(11, 'S002', 5, 0, 0, '2020-01-07 07:42:46', ''),
(12, 'O001', 90, 10, 0, '2020-01-13 05:26:11', ''),
(13, 'B002', 910, 90, 0, '2020-01-13 07:55:04', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_satuan_barang`
--

CREATE TABLE `master_satuan_barang` (
  `id_satuan` int(11) NOT NULL,
  `kode_satuan` varchar(255) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_satuan_barang`
--

INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `tanggal_input`) VALUES
(0, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gulaasdasda', '2020-01-05 08:20:51'),
(1, 'PTG', 'POTONG', '', '0000-00-00 00:00:00'),
(2, 'MTR', 'METER', '', '0000-00-00 00:00:00'),
(3, 'CM', 'CENTIMETER', 'Untuk alsdklaskdasd', '2020-01-04 08:02:14'),
(4, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gula', '2020-01-05 05:24:09');

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
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_supplier`
--

INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `tanggal_input`) VALUES
('EKO076', 'PT JAYA MA', 'aksdjlkasjdlkasjdlkaj\r\nasdasdasd\r\nasdasdasdasd', '921839018239081', '12.983.910.2-839.012', 'BCA-192839128-Lucky', 'asdasdasd', '2020-01-04 05:03:53'),
('QHQ851', 'PTP', 'TPPTPTTPPTPTPTPT', '123012301203', '11.111.111.1-111.111', 'BCA-12310230122-1231231231', 'paspdapdasdasdasda', '2020-01-05 06:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `master_tipe_barang`
--

CREATE TABLE `master_tipe_barang` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_tipe_barang`
--

INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`) VALUES
(1, 'INVENTORY', 'TIPE UNTUK BARANG YANG DIJUAL'),
(2, 'NON-INVENTORY', 'TIPE UNTUK BARANG YANG TIDAK DIJUAL, CONTOH PERALATAN KANTOR'),
(3, 'JASA', 'TIPE BARANG YANG TIDAK BERUPA, SEPERTI JASA PENGANTAR BARANG, JASA RAKITAN'),
(4, 'RAKITAN', 'TIPE BARANG BUNDLING, SEPERTI PAKET SEMABAKO');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `ket`) VALUES
(22, 'blablablabla'),
(23, 'blablablabla'),
(24, 'blablablabla'),
(25, 'blablablabla'),
(26, 'blablablabla'),
(27, 'blablablabla'),
(28, 'blablablabla'),
(29, 'blablablabla'),
(30, 'blablablabla'),
(31, 'blablablabla'),
(32, 'blablablabla'),
(33, 'blablablabla'),
(34, 'blablablabla'),
(35, 'blablablabla');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_setting` varchar(255) NOT NULL,
  `isi_setting` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_setting`, `isi_setting`) VALUES
(1, 'PAJAK', '1'),
(2, 'nama_perusahaan', 'PT. BERKAH BAJA MAKMUR');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_daftar_belanja`
--

CREATE TABLE `tabel_daftar_belanja` (
  `no_order` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `total_keranjang` double NOT NULL DEFAULT '0',
  `diskon` double DEFAULT '0',
  `pajak` double NOT NULL DEFAULT '0',
  `ongkir` double NOT NULL DEFAULT '0',
  `grand_total` double NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_daftar_belanja`
--

INSERT INTO `tabel_daftar_belanja` (`no_order`, `id_pelanggan`, `no_faktur`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `status`, `tanggal_input`) VALUES
('0576891342', '4545', 'SAP2417569', 600000, 60000, 0, 10000, 550000, 1, '2020-01-12'),
('0875416329', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00'),
('1836970425', 'axh4DCyH08YUwLdn', 'VYT6091524', 1080000, 108000, 0, 10000, 1090000, 1, '2020-01-09'),
('3075169284', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00'),
('4105798326', '4545', 'VUP8650792', 1440000, 144000, 0, 15000, 1425000, 1, '2020-01-09'),
('4561798032', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00'),
('4670213895', '4545', 'FSQ8107263', 900000, 90000, 0, 0, 810000, 1, '2020-01-14'),
('5368720914', 'EBvRN8HfInbOQjmr', '', 0, 0, 0, 0, 0, 0, '0000-00-00'),
('6250378419', 'qT4Mw9RBYQ6IU0g7', 'DVA8956203', 4320000, 432000, 0, 15000, 4335000, 1, '2020-01-09'),
('7620398451', '5NY1mgZO04jeqAzR', 'WXO3196547', 1080000, 108000, 0, 200000, 1172000, 1, '2020-01-11'),
('7853160429', '4545', 'ZRD2596871', 360000, 36000, 0, 10000, 334000, 1, '2020-01-13'),
('8159627340', '4545', 'DIT5926478', 2400000, 0, 0, 15000, 2415000, 1, '2020-01-10'),
('8374169052', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00'),
('8913450276', '4545', 'RGX9753810', 9000000, 0, 0, 0, 9000000, 1, '2020-01-13'),
('9082164735', '4545', 'UHX6154903', 150000, 15000, 0, 10000, 145000, 1, '2020-01-13'),
('9410532876', 'pJH3GtjYyxCEPcK9', '', 0, 0, 0, 0, 0, 0, '0000-00-00'),
('9567418032', '4545', 'CQU0372481', 120000, 12000, 0, 0, 120000, 1, '2020-01-09'),
('9803125467', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00'),
('9861243570', '4545', 'VYZ4572301', 120000, 0, 0, 15000, 105000, 1, '2020-01-09');

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_keranjang_belanja`
--

INSERT INTO `tabel_keranjang_belanja` (`id`, `no_order`, `kode_barang`, `jumlah_pembelian`, `harga_total`, `timestamp`) VALUES
(6, '0875416329', 'J001', 1000, 15000000, '2020-01-07 03:27:05'),
(7, '3075169284', 'J001', 11, 165000, '2020-01-07 05:50:19'),
(8, '9803125467', 'J001', 1, 15000, '2020-01-07 05:52:11'),
(9, '4561798032', 'J001', 11, 165000, '2020-01-07 05:55:48'),
(10, '8374169052', 'S002', 5, 600000, '2020-01-07 06:59:15'),
(11, '5368720914', 'S002', 11, 1320000, '2020-01-08 05:58:38'),
(12, '5368720914', 'J001', 12, 180000, '2020-01-08 05:58:38'),
(15, '9410532876', 'S002', 11, 1320000, '2020-01-08 06:43:02'),
(16, '9567418032', 'S002', 1, 120000, '2020-01-09 00:42:34'),
(18, '4105798326', 'S002', 12, 1440000, '2020-01-09 05:02:12'),
(19, '9861243570', 'S002', 1, 120000, '2020-01-09 05:04:31'),
(23, '6250378419', 'S002', 16, 1920000, '2020-01-09 05:10:10'),
(24, '6250378419', 'S002', 20, 2400000, '2020-01-09 05:10:10'),
(26, '1836970425', 'S002', 9, 1080000, '2020-01-09 05:12:20'),
(27, '8159627340', 'S002', 10, 1200000, '2020-01-10 06:45:05'),
(28, '8159627340', 'S002', 10, 1200000, '2020-01-10 06:45:05'),
(29, '7620398451', 'S002', 9, 1080000, '2020-01-11 05:46:20'),
(30, '0576891342', 'S002', 5, 600000, '2020-01-12 09:21:16'),
(31, '7853160429', 'B001', 2, 360000, '2020-01-13 02:41:25'),
(32, '9082164735', 'O001', 10, 150000, '2020-01-13 04:27:57'),
(33, '8913450276', 'B002', 90, 9000000, '2020-01-13 06:56:02'),
(34, '4670213895', 'B001', 5, 900000, '2020-01-14 03:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_keranjang_temp`
--

CREATE TABLE `tabel_keranjang_temp` (
  `id` int(11) NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_total` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_keranjang_temp`
--

INSERT INTO `tabel_keranjang_temp` (`id`, `no_order`, `id_pelanggan`, `kode_barang`, `jumlah_pembelian`, `harga_total`, `timestamp`) VALUES
(57, '0916235847', '4545', 'B002 ', 50, 250000, '2020-01-03 00:38:00'),
(93, '9852034617', '0', 'S002', 1, 120000, '2020-01-08 08:49:08'),
(96, '9861243570', '4545', 'S002', 1, 120000, '2020-01-09 05:04:25'),
(99, '1836970425', '0', 'S002', 9, 1080000, '2020-01-09 05:11:22'),
(102, '1063425987', '4545', 'S002', 1, 120000, '2020-01-10 07:05:08'),
(103, '7620398451', '0', 'S002', 9, 1080000, '2020-01-11 05:46:01'),
(107, '0576891342', '4545', 'S002', 5, 600000, '2020-01-12 09:21:06'),
(108, '7853160429', '0', 'B001', 2, 360000, '2020-01-13 02:40:34'),
(109, '5943720681', '0', 'B001', 2, 360000, '2020-01-13 03:04:48'),
(111, '8913450276', '4545', 'B002', 90, 9000000, '2020-01-13 06:55:40'),
(112, '4670213895', '4545', 'B001', 5, 900000, '2020-01-14 03:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pelanggan`
--

CREATE TABLE `tabel_pelanggan` (
  `id_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_pelanggan`
--

INSERT INTO `tabel_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `nomor_telepon`, `status`) VALUES
('4545', 'Lucky Anggara', 'Jl Angrek 2 no 10 RT 09 RW 02 Kel. Karet Kuningan Kec. Setiabudi', '082116562811', 0),
('5NY1mgZO04jeqAzR', 'Desi Bau', 'oasjdkasjdl', '131231', 1),
('axh4DCyH08YUwLdn', 'novaz', 'l.koko', '123556', 1),
('EBvRN8HfInbOQjmr', '455', '', '', 1),
('hEtVpMjr9u8SZGL5', 'novaz', 'jl koko', '123456', 1),
('pJH3GtjYyxCEPcK9', 'Lucky', 'Jl Angrek 2 no 10 RT 09 RW 02 Kel. Karet Kuningan Kec. Setiabudi', '082116562811', 1),
('qT4Mw9RBYQ6IU0g7', 'novaz', 'jl koko', '123456', 1);

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
('0576891342', 600000, 60000, 0, 10000, 550000, '2020-01-12 09:21:15'),
('4670213895', 900000, 90000, 0, 0, 810000, '2020-01-14 03:27:06'),
('7853160429', 360000, 36000, 0, 10000, 334000, '2020-01-13 02:41:23'),
('8913450276', 9000000, 0, 0, 0, 9000000, '2020-01-13 06:55:59'),
('9082164735', 150000, 15000, 0, 10000, 145000, '2020-01-13 04:27:54'),
('hWjPp0Gyo8mBN7eI', 12000, 0, 0, 0, 12000, '2020-01-12 15:28:12'),
('piPhj3WelYDavmOz', 95000000, 0, 9500000, 0, 104500000, '2020-01-13 06:54:36'),
('unP5jGqKkMtIxEYB', 700000, 0, 70000, 0, 770000, '2020-01-14 03:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `temp_tabel_keranjang_pembelian`
--

CREATE TABLE `temp_tabel_keranjang_pembelian` (
  `id` int(11) NOT NULL,
  `no_order_pembelian` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_tabel_keranjang_pembelian`
--

INSERT INTO `temp_tabel_keranjang_pembelian` (`id`, `no_order_pembelian`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(1, '22', 'B001', 1, 10000, 0, 10000, '2020-01-10'),
(116, 'hWjPp0Gyo8mBN7eI', 'B001', 12, 1000, 1000, 11000, '2020-01-12'),
(118, 'piPhj3WelYDavmOz', 'B002', 1000, 95000, 0, 95000000, '2020-01-13'),
(119, 'unP5jGqKkMtIxEYB', 'B001', 5, 140000, 0, 700000, '2020-01-14');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`),
  ADD UNIQUE KEY `kode_jenis` (`kode_jenis_barang`);

--
-- Indexes for table `master_merek_barang`
--
ALTER TABLE `master_merek_barang`
  ADD PRIMARY KEY (`id_merek_barang`);

--
-- Indexes for table `master_pembelian`
--
ALTER TABLE `master_pembelian`
  ADD PRIMARY KEY (`no_order_pembelian`),
  ADD UNIQUE KEY `nomor_transaksi` (`nomor_transaksi`);

--
-- Indexes for table `master_persediaan`
--
ALTER TABLE `master_persediaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

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
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_daftar_belanja`
--
ALTER TABLE `tabel_daftar_belanja`
  ADD PRIMARY KEY (`no_order`);

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
-- Indexes for table `tabel_keranjang_temp`
--
ALTER TABLE `tabel_keranjang_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_pelanggan`
--
ALTER TABLE `tabel_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tabel_perhitungan_order`
--
ALTER TABLE `tabel_perhitungan_order`
  ADD PRIMARY KEY (`no_order`);

--
-- Indexes for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_merek_barang`
--
ALTER TABLE `master_merek_barang`
  MODIFY `id_merek_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_persediaan`
--
ALTER TABLE `master_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_satuan_barang`
--
ALTER TABLE `master_satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_tipe_barang`
--
ALTER TABLE `master_tipe_barang`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabel_diskon`
--
ALTER TABLE `tabel_diskon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabel_keranjang_belanja`
--
ALTER TABLE `tabel_keranjang_belanja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tabel_keranjang_temp`
--
ALTER TABLE `tabel_keranjang_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD CONSTRAINT `jenis_barang_join` FOREIGN KEY (`jenis_barang`) REFERENCES `master_jenis_barang` (`id_jenis_barang`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `kode_supplier_join` FOREIGN KEY (`kode_supplier`) REFERENCES `master_supplier` (`kode_supplier`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `merek_barang_join` FOREIGN KEY (`merek_barang`) REFERENCES `master_merek_barang` (`id_merek_barang`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `satuan_barang_join` FOREIGN KEY (`kode_satuan`) REFERENCES `master_satuan_barang` (`id_satuan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tipe_barang_join` FOREIGN KEY (`tipe_barang`) REFERENCES `master_tipe_barang` (`id_tipe`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `master_persediaan`
--
ALTER TABLE `master_persediaan`
  ADD CONSTRAINT `master_persediaan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tabel_keranjang_belanja`
--
ALTER TABLE `tabel_keranjang_belanja`
  ADD CONSTRAINT `no_order_join` FOREIGN KEY (`no_order`) REFERENCES `tabel_daftar_belanja` (`no_order`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
