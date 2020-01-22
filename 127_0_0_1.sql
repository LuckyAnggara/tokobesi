-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2020 at 12:35 AM
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
(27, 'XSidQWgjCs3lFEYe', '2020-01-01 00:00:00', 'BB', 'B001', 20, 15000, 0, 300000, '2020-01-21', 20),
(28, 'XSidQWgjCs3lFEYe', '2020-01-01 00:00:00', 'BB', 'P001', 10, 10000, 0, 100000, '2020-01-21', 0),
(30, 'U3eMxVS7ofcaNH1w', '2020-01-10 00:00:00', 'aa', 'P001', 5, 20000, 0, 100000, '2020-01-21', 0),
(31, 'jZPE8IxvS9arVpkF', '2020-01-21 00:00:00', 'cc', 'P001', 10, 20000, 0, 200000, '2020-01-21', 53),
(33, 'hF2EqWwRApH6iouY', '2020-01-21 00:00:00', 'd', 'P001', 100, 1500000, 0, 150000000, '2020-01-21', 53),
(35, 'YLAM250zKkgxhb3O', '2020-01-21 00:00:00', 'aaaa', 'P001', 1, 1, 0, 1, '2020-01-21', 1),
(36, 'ZRMmuEQPxbNVDBXn', '2020-01-21 16:59:34', 'aaaaaaaa', 'P001', 222, 100000, 0, 22200000, '2020-01-21', 222),
(37, 'CSs2iZuU74gYTdWp', '2020-01-22 15:46:25', 'popo', 'K001', 1000, 12000, 0, 12000000, '2020-01-22', 0),
(38, '8bq09mEdBFQxfeTo', '2020-01-23 15:47:58', 'wrwr', 'K001', 500, 15000, 0, 7500000, '2020-01-22', 300);

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
(14, 'OUT8926415', '2020-01-21 00:00:00', 'AFW4156732', 'P001', 7, 2000000, 0, 14000000, '2020-01-21'),
(15, 'OUT9241857', '2020-01-21 00:00:00', 'BQK7219648', 'P001', 3, 2000000, 0, 6000000, '2020-01-21'),
(16, 'OUT9241857', '2020-01-21 00:00:00', 'BQK7219648', 'P001', 4, 2000000, 0, 8000000, '2020-01-21'),
(18, 'OUT9273084', '2020-01-21 00:00:00', 'PEN5734682', 'P001', 4, 2000000, 0, 8000000, '2020-01-21'),
(19, 'OUT9273084', '2020-01-21 00:00:00', 'PEN5734682', 'P001', 4, 2000000, 0, 8000000, '2020-01-21'),
(22, 'OUT2759601', '2020-01-21 16:39:47', 'LMD8167945', 'P001', 50, 2000000, 0, 100000000, '2020-01-21'),
(23, 'OUT6198205', '2020-01-22 15:49:13', 'BKR3290685', 'K001', 1200, 20000, 0, 24000000, '2020-01-22');

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
(1, '2020-01-10', 'aa', 'P001', 5, 20000, 5),
(3, '2020-01-01', 'BB', 'B001', 20, 15000, 20),
(4, '2020-01-01', 'BB', 'P001', 10, 10000, 10),
(5, '2020-01-21', 'd', 'P001', 100, 1500000, 100),
(6, '6975-06-06', 'f', 'P001', 50, 1500000, 50),
(7, '2020-01-21', 'aaaa', 'P001', 1, 1, 1),
(8, '2020-01-21', 'aaaaaaaa', 'P001', 222, 100000, 222),
(9, '2020-01-22', 'popo', 'K001', 1000, 12000, 1000),
(10, '2020-01-23', 'wrwr', 'K001', 500, 15000, 500);

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
  `kode_satuan` int(11) DEFAULT 0,
  `persediaan_minimum` int(11) NOT NULL DEFAULT 0,
  `metode_hpp` varchar(255) NOT NULL,
  `komisi_sales` double NOT NULL DEFAULT 0,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `tanggal_input`) VALUES
('B001', 1, 1, 1, 'EKZ372', 'BESI', 15000, 20000, 0, 10, 'FIFO', 0, 'B001.jpg', '', 1, '2020-01-20 13:46:26'),
('K001', 1, 1, 1, 'EKZ372', 'KERTAS', 10000, 15000, 0, 10, 'FIFO', 500, 'K001.jpg', '', 1, '2020-01-22 15:46:02'),
('P001', 1, 1, 1, 'EKZ372', 'PIPA BESI', 1500000, 2000000, 0, 10, 'FIFO', 0, 'P001.jpg', '', 1, '2020-01-19 12:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `master_harga_pokok_penjualan`
--

CREATE TABLE `master_harga_pokok_penjualan` (
  `id` int(11) NOT NULL,
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

INSERT INTO `master_harga_pokok_penjualan` (`id`, `nomor_faktur`, `kode_barang`, `qty`, `harga_pokok`, `harga_jual`, `keterangan`) VALUES
(15, 'AFW4156732', 'P001', 7, 10000, 2000000, 'FIFO'),
(16, 'BQK7219648', 'P001', 3, 10000, 2000000, 'FIFO'),
(17, 'BQK7219648', 'P001', 4, 20000, 2000000, 'FIFO'),
(18, 'PEN5734682', 'P001', 1, 20000, 2000000, 'FIFO'),
(19, 'PEN5734682', 'P001', 3, 20000, 2000000, 'FIFO'),
(20, 'PEN5734682', 'P001', 4, 20000, 2000000, 'FIFO'),
(23, 'LMD8167945', 'P001', 3, 20000, 2000000, 'FIFO'),
(24, 'LMD8167945', 'P001', 47, 1500000, 2000000, 'FIFO'),
(25, 'BKR3290685', 'K001', 1000, 12000, 20000, 'FIFO'),
(26, 'BKR3290685', 'K001', 200, 15000, 20000, 'FIFO');

-- --------------------------------------------------------

--
-- Table structure for table `master_hutang`
--

CREATE TABLE `master_hutang` (
  `id` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `down_payment` double NOT NULL DEFAULT 0,
  `sisa_pembayaran` double NOT NULL DEFAULT 0,
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
('15PUBvwLyKE0WDlj', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('1Ud6DKNLHmjIafXl', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('2erbhNsg0VnjZmI5', '', 'asd', 'asdasd', '', 'asdasdad', '', '', 1, '0000-00-00', ''),
('2rnTCYigPcE38fZH', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('37f0VxohtwDXSQiI', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('3CMAwRYdbnQsJioG', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('3D9SLwtOM4PvoY7f', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('5CVDdqlTjaiSzbhs', '', '4', '', '', '', '', '', 1, '0000-00-00', ''),
('5GmrF34ZUbyBoLIt', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('5iHwbjPSxgWFVtRh', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('7LJeN3WE1jAgq4nV', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('9sjbBJfU6V5L0MC1', '', 'Gesang', 'aksndaklsdkla', '', 'askdklanslfa', '', '', 1, '0000-00-00', ''),
('bO4K0hxkpD1RWGnZ', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('CGjBh5uwYgpJE74M', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('CsbwuW5qvJpMDi6L', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('CxYQdtbijfo4H5qK', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('d3J7sjXyeCLGK4aM', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('DkJh6g2zelP8uWiL', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('DNL6124', 'general', 'LUCKY', 'asd', '', '120491204', '12.222.222.2-222.222', 'a-a-a', 0, '2020-01-16', '1000'),
('e1mdf5sX6VRpDk3l', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('eBDi80pqt6l93W4y', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('EmVMwP8LQ94splAg', '', 'aasa', '', '', '', '', '', 1, '0000-00-00', ''),
('eq6LR8gZhrcf5zDE', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('EsaBO25oACTwMlVR', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('eWTm7KiUwVdn4Yqu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('F70vjqwJCGID1nox', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('fa3sCnmcTX56WUwH', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Gbv6Z8OFrTh1m2iR', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('GD07tgLpzeTxXiyC', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('gQhVk9PMzwcEH3up', '', 'RED', 'AA', '', 'AA', '', '', 1, '0000-00-00', ''),
('h9tc7QlRayJGMEAH', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('hCizX3f6GLBs5YvP', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('HiZzSDOtmELdlVrk', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('HoiPpwTOt9Id1mk8', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('iFvPgCxEJduAkYyW', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('iUhzaRgQvJYXwHCo', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('JMimYthwOKdAnvP7', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('JZ1K3VYjIGvpmgP6', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('K2uQDrPMyxJBvq5R', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('KA4D8GM9zC6WOniQ', '', 'Hadiyan', 'Kalimantan Timur', '', '08808080', '', '', 1, '0000-00-00', ''),
('L4lI6mVBsjUwpEK8', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Lf4k2o8DWgpBsSwd', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('LimIMTgnOqzDNfkY', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('LpK5vNUyOP0TjHwl', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('MK7Aj8JYWVtTxcyu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('MYAJfULSqljE2WHh', '', 'Hadiyan', 'Kalimantan Timur', '', 'asdasd', '', '', 1, '0000-00-00', ''),
('N9iRhXfzyPxT2Od1', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('nAokKCbZs5NIL7zw', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('nsIYWUqPTvrwXe1a', '', 'hadh', 'asdas', '', '', '', '', 1, '0000-00-00', ''),
('nUVoEvkfydg0NYxK', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('nxuIGo9egTQ2Ky45', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('o2B0LrdpuDlFzJUM', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('o2iY3WQ0g5JGsOmb', '', 'asdasd', '', '', '', '', '', 1, '0000-00-00', ''),
('oO56X1rVs89vEnT4', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('ORsQX3np6TNk2u5w', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('pcbt6YuHCjLySGkn', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('PCjViRn8Xk31hpmd', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Qn5YkIDPLlxj9gqG', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('qnwcGf6lu3eBTWdS', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('rAHVIgPqSvbCKtNL', '', 'ss', '', '', '', '', '', 1, '0000-00-00', ''),
('RPw8o5nzD4vymYSr', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('rvy7ShaG19pPqdxc', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('S7pAwcb9aL8ufeDv', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('SQia5jFYgRxmd8oy', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('TFtYbkIJB4EUOMAy', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('UDY3572', 'rekanan', 'DESI EVILIA', 'Limbangan', 'kerjaan.desi@qmail.com', '082116562811', '92.912.959.1-028.509', 'BCA-91509125-Desi Evilia', 0, '2020-01-18', '1000'),
('uQqUxCanR58Jho6y', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('UREK973T1XkyuChA', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('V51XL63QJdCRSFfo', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('VbBMo29UwzGTEukg', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('VIWSdHCh4igBxosz', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('vX7lyAO0hmcNjMu2', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('WFI6032', 'rekanan', 'LUCKY ANGGARA', 'Pasir Honje No 37 RT 02 RW 14', '', '082116562811', '70.313.243.2-400.000', 'BNI-0468995561-Lucky Anggara', 0, '2020-01-16', '1000'),
('wGf4sSa9kCOtx6KT', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Xo3zZ0By2SlIfVtu', '', 'as', '', '', '', '', '', 1, '0000-00-00', ''),
('y1GShsvgClbX9Wae', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('YAp46rNsCgFztfjG', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('yvhMtUmgXfRZwYkP', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Z3BvrbywPX9Yhenx', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('z48UQSGksIWe1ibx', '', '4', '', '', '', '', '', 1, '0000-00-00', ''),
('zDEOaH58oVXd2lP0', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('zOh0Z4sBfcMrQL9q', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('zrxnY4Uwha7QijBu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Zu6AyCSI5OhBVTrt', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('ZXu2DhVlBTyHLN7b', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('zYRx6V07SIj2EG1r', '', '4', '', '', '', '', '', 1, '0000-00-00', '');

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
  `user_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_input`, `user_input`) VALUES
('8bq09mEdBFQxfeTo', 'wrwr', '2020-01-23 15:48:03', 'EKZ372', 7500000, 0, 0, 0, 7500000, 1, '2020-01-22', 'udin'),
('CSs2iZuU74gYTdWp', 'popo', '2020-01-22 15:46:31', 'EKZ372', 12000000, 0, 1200000, 0, 13200000, 1, '2020-01-22', 'udin'),
('hF2EqWwRApH6iouY', 'd', '2020-01-21 00:00:00', 'EKZ372', 150000000, 0, 0, 0, 150000000, 1, '2020-01-21', 'udin'),
('jZPE8IxvS9arVpkF', 'cc', '2020-01-21 00:00:00', 'EKZ372', 200000, 0, 20000, 0, 220000, 1, '2020-01-21', 'udin'),
('U3eMxVS7ofcaNH1w', 'aa', '2020-01-10 00:00:00', 'EKZ372', 100000, 0, 0, 0, 100000, 1, '2020-01-21', 'udin'),
('XSidQWgjCs3lFEYe', 'BB', '2020-01-01 00:00:00', 'EKZ372', 400000, 0, 40000, 0, 440000, 1, '2020-01-21', 'udin'),
('YLAM250zKkgxhb3O', 'aaaa', '2020-01-21 00:00:00', 'EKZ372', 1, 0, 0, 0, 1, 1, '2020-01-21', 'udin'),
('ZRMmuEQPxbNVDBXn', 'aaaaaaaa', '2020-01-21 16:59:39', 'EKZ372', 22200000, 0, 0, 0, 22200000, 1, '2020-01-21', 'udin');

-- --------------------------------------------------------

--
-- Table structure for table `master_penjualan`
--

CREATE TABLE `master_penjualan` (
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
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `user`) VALUES
('OUT2759601', '2020-01-21 16:39:51', 'LMD8167945', 'WFI6032', 100000000, 0, 0, 0, 100000000, 1, NULL, '2020-01-21', 'usn'),
('OUT6198205', '2020-01-22 15:49:31', 'BKR3290685', '9sjbBJfU6V5L0MC1', 24000000, 0, 2400000, 100000, 26500000, 1, NULL, '2020-01-22', 'usn'),
('OUT8926415', '2020-01-21 00:00:00', 'AFW4156732', 'DNL6124', 14000000, 0, 0, 0, 14000000, 1, NULL, '2020-01-21', 'usn'),
('OUT9241857', '2020-01-21 00:00:00', 'BQK7219648', 'DNL6124', 14000000, 0, 0, 0, 14000000, 1, NULL, '2020-01-21', 'usn'),
('OUT9273084', '2020-01-23 00:00:00', 'PEN5734682', 'WFI6032', 16000000, 0, 0, 0, 16000000, 1, NULL, '2020-01-21', 'usn');

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
(0, 'K001', -1200, 0, 0, '2020-01-22 15:46:02', ''),
(15, 'P001', -121, -45, 0, '2020-01-21 16:22:28', ''),
(16, 'B001', 5, -15, 0, '2020-01-21 04:28:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_piutang`
--

CREATE TABLE `master_piutang` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `down_payment` double NOT NULL DEFAULT 0,
  `sisa_pembayaran` double NOT NULL DEFAULT 0,
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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_perhitungan_order`
--

INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES
('8bq09mEdBFQxfeTo', 7500000, 0, 0, 0, 7500000, '2020-01-22 14:47:58'),
('CSs2iZuU74gYTdWp', 12000000, 0, 1200000, 0, 13200000, '2020-01-22 14:46:27');

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
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD UNIQUE KEY `no_faktur` (`no_faktur`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `master_hutang`
--
ALTER TABLE `master_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_piutang`
--
ALTER TABLE `master_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
