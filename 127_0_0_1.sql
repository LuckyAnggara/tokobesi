-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 09:53 AM
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
  `tanggal_transaksi` date NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(17, 'AsnGN04Q29dOa7PZ', '2020-01-01', 'IN.191293', 'P001', 200, 1600000, 0, 320000000, '2020-01-19'),
(18, 's18nYcxUTr4Bi5Ig', '2020-01-02', 'IN22', 'P001', 10, 1600000, 0, 16000000, '2020-01-19'),
(19, 'ghKyux6fq0OSpJV9', '2020-01-03', 'IN20', 'P001', 30, 1750000, 0, 52500000, '2020-01-19'),
(20, 'GItYuFki0SpPKgq8', '2020-01-20', 'ccc', 'P001', 1000, 20000, 0, 20000000, '2020-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `no_order_penjualan` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
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
(50, 'OUT2549136', '2020-01-19', 'SAY9542867', 'P001', 10, 2000000, 0, 20000000, '2020-01-19'),
(51, 'OUT0169275', '2020-01-20', 'LDQ3519028', 'P001', 2, 2000000, 5000, 3995000, '2020-01-20'),
(52, 'OUT2031946', '2020-01-20', 'FAU0839176', 'P001', 5, 2000000, 0, 10000000, '2020-01-20'),
(53, 'OUT4912587', '2020-01-20', 'KLO3692741', 'P001', 50, 2000000, 0, 100000000, '2020-01-20'),
(54, 'OUT2465831', '2020-01-20', 'WMU4593167', 'P001', 30, 2000000, 0, 60000000, '2020-01-20'),
(55, 'OUT0769812', '2020-01-20', 'IGZ5764280', 'P001', 50, 2000000, 0, 100000000, '2020-01-20'),
(56, 'OUT7861425', '2020-01-20', 'TSA7380415', 'P001', 20, 15000, 0, 300000, '2020-01-20'),
(57, 'OUT2856397', '2020-01-20', 'LDD7921048', 'P001', 50, 2000000, 0, 100000000, '2020-01-20'),
(58, 'OUT2856397', '2020-01-20', 'LDD7921048', 'P001', 20, 2000000, 0, 40000000, '2020-01-20'),
(60, 'OUT7852691', '2020-01-20', 'TUR6245037', 'P001', 6, 2000000, 0, 12000000, '2020-01-20'),
(61, 'OUT7852691', '2020-01-20', 'TUR6245037', 'P001', 2, 2000000, 0, 4000000, '2020-01-20'),
(63, 'OUT8136072', '2020-01-20', 'GYD0964325', 'P001', 7, 2000000, 0, 14000000, '2020-01-20'),
(64, 'OUT5923874', '2020-01-20', 'GIT4596728', 'P001', 4, 2000000, 0, 8000000, '2020-01-20'),
(65, 'OUT5923874', '2020-01-20', 'GIT4596728', 'P001', 4, 2000000, 0, 8000000, '2020-01-20'),
(67, 'OUT1809374', '2020-01-20', 'XGY0126483', 'P001', 10, 2000000, 0, 20000000, '2020-01-20'),
(68, 'OUT5406982', '2020-01-20', 'KJN5126894', 'P001', 5, 2000000, 0, 10000000, '2020-01-20'),
(69, 'OUT2651084', '2020-01-20', 'FTC2410368', 'P001', 5, 2000000, 0, 10000000, '2020-01-20'),
(70, 'OUT7281406', '2020-01-20', 'ZDS7125063', 'P001', 5, 2000000, 0, 10000000, '2020-01-20'),
(71, 'OUT2091736', '2020-01-20', 'UHB6532841', 'P001', 5, 2000000, 0, 10000000, '2020-01-20'),
(72, 'OUT9127056', '2020-01-20', 'SWD0268513', 'P001', 7, 2000000, 0, 14000000, '2020-01-20');

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

--
-- Dumping data for table `harga_detail_pembelian`
--

INSERT INTO `harga_detail_pembelian` (`id`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `qty`, `harga`, `sisa`) VALUES
(1, '2020-01-19', 'A', 'P001', 5, 1, 5),
(2, '2020-01-20', 'b', 'P001', 5, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `harga_detail_penjualan`
--

CREATE TABLE `harga_detail_penjualan` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_jual` double NOT NULL
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
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `kode_satuan`, `persediaan_minimum`, `gambar`, `keterangan`, `status_jual`, `tanggal_input`) VALUES
('P001', 1, 1, 1, 'EKZ372', 'PIPA BESI', 1500000, 2000000, 0, 10, 'P001.jpg', '', 1, '2020-01-19 12:01:40');

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
-- Table structure for table `master_pelanggan`
--

CREATE TABLE `master_pelanggan` (
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

INSERT INTO `master_pelanggan` (`id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES
('0qmMHT73CRnvVYZF', '', 'Lucky', '', '', '', '', '', 1, '0000-00-00', ''),
('0RkolLHMyST6zQrx', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('2erbhNsg0VnjZmI5', '', 'asd', 'asdasd', '', 'asdasdad', '', '', 1, '0000-00-00', ''),
('37f0VxohtwDXSQiI', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('5CVDdqlTjaiSzbhs', '', '4', '', '', '', '', '', 1, '0000-00-00', ''),
('5GmrF34ZUbyBoLIt', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('7LJeN3WE1jAgq4nV', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('CxYQdtbijfo4H5qK', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('d3J7sjXyeCLGK4aM', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('DNL6124', 'general', 'LUCKY', 'asd', '', '120491204', '12.222.222.2-222.222', 'a-a-a', 0, '2020-01-16', '1000'),
('eq6LR8gZhrcf5zDE', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('eWTm7KiUwVdn4Yqu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('gQhVk9PMzwcEH3up', '', 'RED', 'AA', '', 'AA', '', '', 1, '0000-00-00', ''),
('h9tc7QlRayJGMEAH', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('HiZzSDOtmELdlVrk', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('JZ1K3VYjIGvpmgP6', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('K2uQDrPMyxJBvq5R', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Lf4k2o8DWgpBsSwd', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('MK7Aj8JYWVtTxcyu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('o2iY3WQ0g5JGsOmb', '', 'asdasd', '', '', '', '', '', 1, '0000-00-00', ''),
('PCjViRn8Xk31hpmd', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Qn5YkIDPLlxj9gqG', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('qnwcGf6lu3eBTWdS', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('rAHVIgPqSvbCKtNL', '', 'ss', '', '', '', '', '', 1, '0000-00-00', ''),
('rvy7ShaG19pPqdxc', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('TFtYbkIJB4EUOMAy', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('UDY3572', 'rekanan', 'DESI EVILIA', 'Limbangan', 'kerjaan.desi@qmail.com', '082116562811', '92.912.959.1-028.509', 'BCA-91509125-Desi Evilia', 0, '2020-01-18', '1000'),
('uQqUxCanR58Jho6y', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('VbBMo29UwzGTEukg', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('WFI6032', 'rekanan', 'LUCKY ANGGARA', 'Pasir Honje No 37 RT 02 RW 14', '', '082116562811', '70.313.243.2-400.000', 'BNI-0468995561-Lucky Anggara', 0, '2020-01-16', '1000'),
('wGf4sSa9kCOtx6KT', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Xo3zZ0By2SlIfVtu', '', 'as', '', '', '', '', '', 1, '0000-00-00', ''),
('z48UQSGksIWe1ibx', '', '4', '', '', '', '', '', 1, '0000-00-00', ''),
('zDEOaH58oVXd2lP0', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('ZXu2DhVlBTyHLN7b', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('zYRx6V07SIj2EG1r', '', '4', '', '', '', '', '', 1, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_pembelian`
--

CREATE TABLE `master_pembelian` (
  `no_order_pembelian` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `total_pembelian` double NOT NULL,
  `diskon` double NOT NULL,
  `pajak_keluaran` double NOT NULL,
  `ongkir` double NOT NULL,
  `grand_total` double NOT NULL,
  `status_bayar` int(1) NOT NULL,
  `tanggal_input` date NOT NULL,
  `user_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_input`, `user_input`) VALUES
('AsnGN04Q29dOa7PZ', 'IN.191293', '2020-01-01', 'EKZ372', 320000000, 0, 32000000, 0, 352000000, 1, '2020-01-19', 'udin'),
('ghKyux6fq0OSpJV9', 'IN20', '2020-01-03', 'EKZ372', 52500000, 0, 5250000, 0, 57750000, 1, '2020-01-19', 'udin'),
('GItYuFki0SpPKgq8', 'ccc', '2020-01-20', 'EKZ372', 20000000, 0, 0, 0, 20000000, 1, '2020-01-20', 'udin'),
('s18nYcxUTr4Bi5Ig', 'IN22', '2020-01-02', 'EKZ372', 16000000, 0, 1600000, 0, 17600000, 1, '2020-01-19', 'udin');

-- --------------------------------------------------------

--
-- Table structure for table `master_penjualan`
--

CREATE TABLE `master_penjualan` (
  `no_order_penjualan` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
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
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `user`) VALUES
('OUT0169275', '2020-01-20', 'LDQ3519028', 'DNL6124', 4000000, 5000, 0, 0, 3995000, 1, NULL, '2020-01-20', 'usn'),
('OUT0769812', '2020-01-20', 'IGZ5764280', 'UDY3572', 100000000, 0, 0, 0, 100000000, 1, NULL, '2020-01-20', 'usn'),
('OUT1809374', '2020-01-20', 'XGY0126483', 'DNL6124', 20000000, 0, 0, 0, 20000000, 1, NULL, '2020-01-20', 'usn'),
('OUT2031946', '2020-01-20', 'FAU0839176', 'DNL6124', 10000000, 0, 0, 0, 10000000, 1, NULL, '2020-01-20', 'usn'),
('OUT2091736', '2020-01-20', 'UHB6532841', 'TFtYbkIJB4EUOMAy', 10000000, 0, 0, 0, 10000000, 1, NULL, '2020-01-20', 'usn'),
('OUT2465831', '2020-01-20', 'WMU4593167', 'DNL6124', 60000000, 0, 0, 0, 60000000, 1, NULL, '2020-01-20', 'usn'),
('OUT2549136', '2020-01-19', 'SAY9542867', 'UDY3572', 20000000, 0, 2000000, 0, 22000000, 1, NULL, '2020-01-19', 'usn'),
('OUT2651084', '2020-01-20', 'FTC2410368', 'eWTm7KiUwVdn4Yqu', 10000000, 0, 0, 0, 10000000, 1, NULL, '2020-01-20', 'usn'),
('OUT2856397', '2020-01-20', 'LDD7921048', 'UDY3572', 140000000, 0, 0, 0, 140000000, 1, NULL, '2020-01-20', 'usn'),
('OUT4912587', '2020-01-20', 'KLO3692741', 'UDY3572', 100000000, 0, 0, 0, 100000000, 1, NULL, '2020-01-20', 'usn'),
('OUT5406982', '2020-01-20', 'KJN5126894', 'a', 10000000, 0, 0, 0, 10000000, 1, NULL, '2020-01-20', 'usn'),
('OUT5923874', '2020-01-20', 'GIT4596728', 'VbBMo29UwzGTEukg', 16000000, 0, 0, 0, 16000000, 1, NULL, '2020-01-20', 'usn'),
('OUT7281406', '2020-01-20', 'ZDS7125063', 'ZXu2DhVlBTyHLN7b', 10000000, 0, 0, 0, 10000000, 1, NULL, '2020-01-20', 'usn'),
('OUT7852691', '2020-01-20', 'TUR6245037', 'UDY3572', 16000000, 0, 0, 0, 16000000, 1, NULL, '2020-01-20', 'usn'),
('OUT7861425', '2020-01-20', 'TSA7380415', 'DNL6124', 300000, 0, 0, 0, 300000, 1, NULL, '2020-01-20', 'usn'),
('OUT8136072', '2020-01-20', 'GYD0964325', 'o2iY3WQ0g5JGsOmb', 14000000, 0, 0, 0, 14000000, 1, NULL, '2020-01-20', 'usn'),
('OUT9127056', '2020-01-20', 'SWD0268513', '5GmrF34ZUbyBoLIt', 14000000, 0, 0, 0, 14000000, 1, NULL, '2020-01-20', 'usn');

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
(15, 'P001', 993, 0, 0, '2020-01-20 09:35:10', '');

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
('EKO076', 'PT JAYA MAKMUR', 'aksdjlkasjdlkasjdlkaj\r\nasdasdasd\r\nasdasdasdasd', '921839018239081', '12.983.910.2-839.012', 'BCA-192839128-Lucky', 'asdasdasd', '2020-01-16 14:43:17'),
('EKZ372', 'GENERAL VENDOR', 'General Vendor', '0', '00.000.000.0-000.000', '--0--', 'General Vendor', '2020-01-16 14:43:50'),
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
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `kode_pegawai` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `id_penghasilan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`kode_pegawai`, `password`, `jabatan`, `nama_lengkap`, `alamat`, `npwp`, `nomor_rekening`, `tanggal_lahir`, `pendidikan_terakhir`, `id_penghasilan`) VALUES
('10001', '123', 'Direktur', 'Lucky Anggara', 'askdjalskjdlakdj', '', '', '2020-01-15', 'Sarjana', '1');

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
('AsnGN04Q29dOa7PZ', 320000000, 0, 32000000, 0, 352000000, '2020-01-19 11:08:45'),
('ghKyux6fq0OSpJV9', 52500000, 0, 5250000, 0, 57750000, '2020-01-19 11:19:48'),
('GItYuFki0SpPKgq8', 20000000, 0, 0, 0, 20000000, '2020-01-20 08:35:02'),
('OUT2091736', 10000000, 0, 0, 0, 10000000, '2020-01-20 08:33:37'),
('OUT5406982', 10000000, 0, 0, 0, 10000000, '2020-01-20 08:17:18'),
('OUT9127056', 14000000, 0, 0, 0, 14000000, '2020-01-20 08:36:24'),
('s18nYcxUTr4Bi5Ig', 16000000, 0, 1600000, 0, 17600000, '2020-01-19 11:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `temp_tabel_keranjang_pembelian`
--

CREATE TABLE `temp_tabel_keranjang_pembelian` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
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
  `tanggal_transaksi` date NOT NULL,
  `no_order_penjualan` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_penjualan` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_tabel_keranjang_penjualan`
--

INSERT INTO `temp_tabel_keranjang_penjualan` (`id`, `tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(358, '2020-01-19', 'OUT2549136', 'P001', 10, 2000000, 0, 20000000, '2020-01-19 05:20:13'),
(359, '2020-01-20', 'OUT0169275', 'P001', 2, 2000000, 5000, 3995000, '2020-01-19 22:20:35'),
(360, '2020-01-20', 'OUT2031946', 'P001', 5, 2000000, 0, 10000000, '2020-01-19 22:22:10'),
(362, '2020-01-20', 'OUT4912587', 'P001', 50, 2000000, 0, 100000000, '2020-01-19 22:29:14'),
(363, '2020-01-20', 'OUT2465831', 'P001', 30, 2000000, 0, 60000000, '2020-01-19 22:31:25'),
(364, '2020-01-20', 'OUT0769812', 'P001', 50, 2000000, 0, 100000000, '2020-01-19 22:40:29'),
(365, '2020-01-20', 'OUT7861425', 'P001', 20, 15000, 0, 300000, '2020-01-19 23:45:42'),
(366, '2020-01-20', 'OUT2856397', 'P001', 50, 2000000, 0, 100000000, '2020-01-20 00:25:47'),
(367, '2020-01-20', 'OUT2856397', 'P001', 20, 2000000, 0, 40000000, '2020-01-20 00:26:09'),
(368, '2020-01-20', 'OUT7852691', 'P001', 6, 2000000, 0, 12000000, '2020-01-20 00:28:06'),
(369, '2020-01-20', 'OUT7852691', 'P001', 2, 2000000, 0, 4000000, '2020-01-20 00:28:17'),
(370, '2020-01-20', 'OUT8136072', 'P001', 7, 2000000, 0, 14000000, '2020-01-20 01:42:07'),
(371, '2020-01-20', 'OUT5923874', 'P001', 4, 2000000, 0, 8000000, '2020-01-20 01:42:55'),
(372, '2020-01-20', 'OUT5923874', 'P001', 4, 2000000, 0, 8000000, '2020-01-20 01:42:59'),
(373, '2020-01-20', 'OUT1809374', 'P001', 10, 2000000, 0, 20000000, '2020-01-20 02:05:02'),
(374, '2020-01-20', 'OUT5406982', 'P001', 5, 2000000, 0, 10000000, '2020-01-20 02:16:59'),
(375, '2020-01-20', 'OUT2651084', 'P001', 5, 2000000, 0, 10000000, '2020-01-20 02:17:29'),
(376, '2020-01-20', 'OUT7281406', 'P001', 5, 2000000, 0, 10000000, '2020-01-20 02:17:59'),
(377, '2020-01-20', 'OUT2091736', 'P001', 5, 2000000, 0, 10000000, '2020-01-20 02:33:34'),
(378, '2020-01-20', 'OUT9127056', 'P001', 7, 2000000, 0, 14000000, '2020-01-20 02:36:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan` (`nomor_faktur`);

--
-- Indexes for table `harga_detail_pembelian`
--
ALTER TABLE `harga_detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga_detail_penjualan`
--
ALTER TABLE `harga_detail_penjualan`
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
  ADD PRIMARY KEY (`id_pelanggan`);

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
  ADD PRIMARY KEY (`no_order_penjualan`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`),
  ADD KEY `no_faktur_2` (`no_faktur`);

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
  ADD PRIMARY KEY (`kode_pegawai`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `harga_detail_pembelian`
--
ALTER TABLE `harga_detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `harga_detail_penjualan`
--
ALTER TABLE `harga_detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `master_hutang`
--
ALTER TABLE `master_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_kartu_persediaan`
--
ALTER TABLE `master_kartu_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_merek_barang`
--
ALTER TABLE `master_merek_barang`
  MODIFY `id_merek_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_persediaan`
--
ALTER TABLE `master_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `master_piutang`
--
ALTER TABLE `master_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `setting_perusahaan`
--
ALTER TABLE `setting_perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `penjualan` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `no_order_join` FOREIGN KEY (`no_order`) REFERENCES `master_penjualan` (`no_order_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
