-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 10:19 AM
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
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_gaji`
--

INSERT INTO `detail_gaji` (`id`, `nomor_referensi`, `nip`, `tanggal_pembayaran`, `gaji_pokok`, `uang_makan`, `bonus`, `total`, `status`, `user`) VALUES
(1, 'REF7830542', '1', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 0),
(2, 'REF7830542', '123123123', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 0),
(3, 'REF7830542', '124124', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 0),
(4, 'REF7830542', '21124124', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 0),
(5, 'REF7830542', '123123', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 0);

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `harga_kedua` double NOT NULL,
  `harga_ketiga` double NOT NULL,
  `kode_satuan` int(11) DEFAULT '0',
  `persediaan_minimum` int(11) NOT NULL DEFAULT '0',
  `metode_hpp` varchar(255) NOT NULL,
  `komisi_sales` double NOT NULL DEFAULT '0',
  `gambar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES
('BES0001', 1, 3, 4, NULL, 'BESI BETON POLOS 6 KBM', 17404, 24000, 0, 0, 6, 0, 'FIFO', 0, 'default.jpg', '', 0, 'supervisor', '2020-03-01 04:15:57', 0),
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
-- Table structure for table `master_gaji`
--

CREATE TABLE `master_gaji` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `total_pembayaran` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_gaji`
--

INSERT INTO `master_gaji` (`id`, `tanggal`, `nomor_referensi`, `total_pembayaran`, `keterangan`, `status`, `user`) VALUES
(1, '2020-03-02 00:00:00', 'REF8602795', 0, '', 0, 'edwin'),
(2, '2020-03-02 00:00:00', 'REF7830542', 0, 'sad', 0, 'edwin');

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
  `gaji_pokok` double NOT NULL,
  `uang_makan` double NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `has_user` int(1) NOT NULL DEFAULT '0',
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pegawai`
--

INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES
(1, '1', '0', 'Neng Yuliantin', 1, 'Jl Raya Limbangan', '', '', 'Garut', '2020-02-29', '2020-02-29', '', 'Direktur', '0', '0-0', '0', 1, 50000, 10000, 'SpDT0P752ut6lZHE.jpeg', 1, '', '2020-03-02 06:07:02'),
(10, '123123123', '123123123123', 'LUCKY ANGGARA', 0, 'BANDUNG', 'BANDUNG', 'BANDUNG', 'BANDUNG', '1992-07-15', '2020-03-01', 'SARJANA', 'KASIR', '082116562811', 'BNI - 0468995561', '12312312312', 1, 50000, 10000, '123123123.jpg', 1, 'manajer', '2020-03-02 06:07:05'),
(11, '124124', '1241241', 'DINI', 1, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-18', '2020-03-01', 'SMA', 'ADMIN', '08800', 'BNI - 080808', '123123', 1, 50000, 10000, 'default.jpg', 0, 'manajer', '2020-03-02 06:07:07'),
(12, '21124124', '124124124', 'HADI', 0, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-09', '2020-03-01', 'SARJANA', 'SALES', '0808080', 'ASAS - 54654654', '21313', 1, 50000, 10000, '21124124.jpg', 1, 'manajer', '2020-03-02 06:07:09'),
(13, '123123', '1231231', 'EDWIN', 0, 'JAKARTA', 'JAKARTA', 'JAKARTA', 'JAKARTA', '2020-03-26', '2020-03-01', 'MAGISTER', 'SUPERVISOR', '9128491248', 'BA - 31231', '213123', 1, 50000, 10000, '123123.jpg', 1, 'manajer', '2020-03-02 06:07:10');

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
  `user` varchar(255) NOT NULL
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
  `down_payment` double NOT NULL DEFAULT '0',
  `sisa_piutang` double NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'nama_perusahaan', 'Besi Baja Makmur Kadungora', '2020-03-01 04:50:43'),
(2, 'alamat_perusahaan', 'Jl Raya Kadungora No ....', '2020-03-01 04:50:43'),
(3, 'nomor_telepon', '085555555', '2020-03-01 04:50:43'),
(4, 'nomor_fax', '0808080', '2020-03-01 04:50:43'),
(5, 'alamat_email', 'bbmkadungora@gmail.com', '2020-03-01 04:50:43'),
(6, 'logo_perusahaan', 't7bQeA3qsT28E9F0.png', '2020-03-01 04:50:37'),
(7, 'prefix_faktur', 'bbmkdr', '2020-03-01 04:51:14'),
(8, 'nomor_faktur', '3', '2020-03-01 04:51:14'),
(9, 'catatan_faktur_cash', 'catatan', '2020-03-01 04:51:14'),
(10, 'catatan_faktur_kredit', 'asss', '2020-02-25 06:34:05'),
(11, 'catatan_retur_jual', 'asdasda', '2020-02-24 11:58:09'),
(12, 'catatan_retur_beli', 'asdasda', '2020-02-24 11:58:09'),
(13, 'password_harga', '5', '2020-02-29 13:57:52'),
(14, 'komisi_sales', '0.5', '2020-03-01 04:51:28'),
(15, 'notifikasi', '2,3', '2020-02-25 14:18:42'),
(16, 'frekuensi_notifikasi', '20', '2020-02-25 14:24:49');

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
(5, 'REF7542908', '2020-03-02 00:00:00', '23123', 0, 'edwin', '');

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
  `avatar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `status` int(1) NOT NULL,
  `last_activity` datetime NOT NULL,
  `tanggal_create` datetime NOT NULL,
  `isactive` int(1) NOT NULL DEFAULT '1',
  `is_del` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES
('dini', '124124', '$2y$10$RrwCvrb/WuSCU/JAHKr.2.A7f7WpsPc5qBKhH7.PZx.kua5bxKr8a', '2', 'DINI', 'default.jpg', 0, '2020-03-01 14:14:41', '0000-00-00 00:00:00', 1, 0),
('edwin', '123123', '$2y$10$oi6qEP4bxeYkrUK5YCvhFe8a4PBCVriLudVjVxMvqQPPYCy.xKF9u', '4', 'EDWIN', 'default.jpg', 0, '2020-03-01 14:07:58', '0000-00-00 00:00:00', 1, 0),
('hadi', '21124124', '$2y$10$.Zz5dNGxi92mm.vF2/W59OWdBQEkYEIAjgnf01FkeUNal0jg2Lzf.', '3', 'HADI', 'default.jpg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
('lucky15', '123123123', '$2y$10$3HBFxWoWL9yHhbW1zegPteGL2ZtN4bPiBTTGEwkFifMu7djwD2Q0S', '1', 'LUCKY ANGGARA', 'default.jpg', 0, '2020-03-02 06:02:42', '0000-00-00 00:00:00', 1, 0),
('manajer', '1', '$2y$10$KaPuBy66KgtWC/gbOFLS/O/XcRisL.DJ3iG249CgA8Qswz5VMbuJW', '5', 'Neng', 'default.jpg', 0, '2020-03-01 14:01:42', '2020-03-01 00:00:00', 1, 0);

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
(15, 'Keuangan', '#', 'fa fa-money', 'Admin'),
(16, 'Penjualan', '#', 'fa fa-cart-arrow-down', 'Admin'),
(17, 'Persediaan', '#', 'fa fa-window-restore', 'Admin'),
(18, 'Sales', '#', 'fa fa-users', 'Admin'),
(19, 'Pegawai', '#', 'fa fa-users', 'Supervisor'),
(20, 'Settings', 'setting/setting', 'fa fa-gear', 'Manajer'),
(21, 'Transaksi', '#', 'fa fa-money', 'Supervisor'),
(22, 'Data', '#', 'fa fa-database', 'Supervisor'),
(23, 'Transaksi', '#', 'fa fa-cart-arrow-down', 'Manajer');

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
(2, 'Admin', '5,16,2,17,15'),
(3, 'Sales', '3,8'),
(4, 'Supervisor', '6,21,9,10'),
(5, 'Manager', '7,23,9,12,11,20'),
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
(37, '12', 'Master Piutang', '	\r\nmanajemen_keuangan/masterpiutang/daftar_piutang', 'Manajer Master Piutang');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_detail_stok_opname`
--
ALTER TABLE `detail_detail_stok_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
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
-- Indexes for table `master_gaji`
--
ALTER TABLE `master_gaji`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_retur_pembelian`
--
ALTER TABLE `detail_retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_retur_penjualan`
--
ALTER TABLE `detail_retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_stok_opname`
--
ALTER TABLE `detail_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_utang`
--
ALTER TABLE `detail_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_gaji`
--
ALTER TABLE `master_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `master_merek_barang`
--
ALTER TABLE `master_merek_barang`
  MODIFY `id_merek_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `master_pegawai`
--
ALTER TABLE `master_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_piutang`
--
ALTER TABLE `master_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_purchase_order`
--
ALTER TABLE `master_purchase_order`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_satuan_barang`
--
ALTER TABLE `master_satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_setting`
--
ALTER TABLE `master_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master_stok_opname`
--
ALTER TABLE `master_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_utang`
--
ALTER TABLE `master_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_akses`
--
ALTER TABLE `tabel_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tabel_role`
--
ALTER TABLE `tabel_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_submenu`
--
ALTER TABLE `tabel_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `timeline_po`
--
ALTER TABLE `timeline_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `master_utang` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_utang` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

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
