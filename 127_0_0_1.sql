-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2020 at 10:11 AM
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
  `tanggal_input` date NOT NULL,
  `saldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`, `saldo`) VALUES
(27, 'XSidQWgjCs3lFEYe', '2020-01-01', 'BB', 'B001', 20, 15000, 0, 300000, '2020-01-21', 20),
(28, 'XSidQWgjCs3lFEYe', '2020-01-01', 'BB', 'P001', 10, 10000, 0, 100000, '2020-01-21', 10);

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
(3, '2020-01-01', 'BB', 'B001', 20, 15000, 20),
(4, '2020-01-01', 'BB', 'P001', 10, 10000, 10);

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
(1, '2020-01-19', 'A', 'P001', 5, 1, 0),
(2, '2020-01-20', 'A', 'P001', 5, 2, 0),
(3, '2020-01-14', 'b', 'B001', 5, 1, 5),
(4, '2020-01-22', 'b', 'B001', 5, 2, 0),
(5, '2020-01-21', 'a', 'P001', 5, 3, 10);

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

--
-- Dumping data for table `harga_detail_penjualan`
--

INSERT INTO `harga_detail_penjualan` (`id`, `no_faktur`, `kode_barang`, `qty`, `harga_pokok`, `harga_jual`) VALUES
(55, '', 'P001', 5, 1, 2000000),
(56, '', 'P001', 5, 2, 2000000),
(57, '', 'P001', 1, 3, 2000000);

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
('B001', 1, 1, 1, 'EKZ372', 'BESI', 15000, 20000, 0, 10, 'B001.jpg', '', 1, '2020-01-20 13:46:26'),
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
('15PUBvwLyKE0WDlj', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('2erbhNsg0VnjZmI5', '', 'asd', 'asdasd', '', 'asdasdad', '', '', 1, '0000-00-00', ''),
('2rnTCYigPcE38fZH', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('37f0VxohtwDXSQiI', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('3CMAwRYdbnQsJioG', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('3D9SLwtOM4PvoY7f', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('5CVDdqlTjaiSzbhs', '', '4', '', '', '', '', '', 1, '0000-00-00', ''),
('5GmrF34ZUbyBoLIt', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('5iHwbjPSxgWFVtRh', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('7LJeN3WE1jAgq4nV', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('bO4K0hxkpD1RWGnZ', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('CGjBh5uwYgpJE74M', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('CsbwuW5qvJpMDi6L', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('CxYQdtbijfo4H5qK', '', 'aa', '', '', '', '', '', 1, '0000-00-00', ''),
('d3J7sjXyeCLGK4aM', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('DNL6124', 'general', 'LUCKY', 'asd', '', '120491204', '12.222.222.2-222.222', 'a-a-a', 0, '2020-01-16', '1000'),
('e1mdf5sX6VRpDk3l', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('eBDi80pqt6l93W4y', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('eq6LR8gZhrcf5zDE', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('eWTm7KiUwVdn4Yqu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('F70vjqwJCGID1nox', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('fa3sCnmcTX56WUwH', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('gQhVk9PMzwcEH3up', '', 'RED', 'AA', '', 'AA', '', '', 1, '0000-00-00', ''),
('h9tc7QlRayJGMEAH', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('hCizX3f6GLBs5YvP', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('HiZzSDOtmELdlVrk', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('HoiPpwTOt9Id1mk8', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('JMimYthwOKdAnvP7', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('JZ1K3VYjIGvpmgP6', '', 's', '', '', '', '', '', 1, '0000-00-00', ''),
('K2uQDrPMyxJBvq5R', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('L4lI6mVBsjUwpEK8', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Lf4k2o8DWgpBsSwd', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('LimIMTgnOqzDNfkY', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('LpK5vNUyOP0TjHwl', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('MK7Aj8JYWVtTxcyu', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('nAokKCbZs5NIL7zw', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('nUVoEvkfydg0NYxK', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('nxuIGo9egTQ2Ky45', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
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
('yvhMtUmgXfRZwYkP', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('Z3BvrbywPX9Yhenx', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
('z48UQSGksIWe1ibx', '', '4', '', '', '', '', '', 1, '0000-00-00', ''),
('zDEOaH58oVXd2lP0', '', 'a', '', '', '', '', '', 1, '0000-00-00', ''),
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
('XSidQWgjCs3lFEYe', 'BB', '2020-01-01', 'EKZ372', 400000, 0, 40000, 0, 440000, 1, '2020-01-21', 'udin');

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
(15, 'P001', 36, -11, 0, '2020-01-21 04:28:53', ''),
(16, 'B001', 15, 5, 0, '2020-01-21 04:28:53', '');

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
('5JP9AuaLDK8bwI0h', 50000, 0, 0, 0, 50000, '2020-01-20 14:43:39'),
('AsnGN04Q29dOa7PZ', 320000000, 0, 32000000, 0, 352000000, '2020-01-19 11:08:45'),
('cnwEHCsmvW9GkQNM', 50000, 0, 0, 0, 50000, '2020-01-20 14:50:36'),
('DIN4H2SyJTtlVd5R', 50000, 0, 0, 0, 50000, '2020-01-20 14:44:22'),
('ghKyux6fq0OSpJV9', 52500000, 0, 5250000, 0, 57750000, '2020-01-19 11:19:48'),
('GItYuFki0SpPKgq8', 20000000, 0, 0, 0, 20000000, '2020-01-20 08:35:02'),
('hZM953iENxnbwvjO', 0, 0, 0, 0, 0, '2020-01-20 14:45:13'),
('ji7GkcnzHK08lgdx', 50000, 0, 0, 0, 50000, '2020-01-20 14:54:38'),
('kd7G1Oxg0SrQ8yfj', 50000, 0, 0, 0, 50000, '2020-01-20 14:42:22'),
('LbtpEsNo6m18idrA', 15000000, 0, 0, 0, 15000000, '2020-01-20 12:47:03'),
('OUT0361294', 12000000, 0, 0, 0, 12000000, '2020-01-20 12:59:32'),
('OUT0748253', 14000000, 0, 0, 0, 14000000, '2020-01-20 13:01:27'),
('OUT1540986', 14000000, 0, 0, 0, 14000000, '2020-01-20 12:59:59'),
('OUT2091736', 10000000, 0, 0, 0, 10000000, '2020-01-20 08:33:37'),
('OUT4735690', 14000000, 0, 0, 0, 14000000, '2020-01-20 13:02:10'),
('OUT5406982', 10000000, 0, 0, 0, 10000000, '2020-01-20 08:17:18'),
('OUT9127056', 14000000, 0, 0, 0, 14000000, '2020-01-20 08:36:24'),
('PNsWpzhBJr90SvMl', 20000, 0, 0, 0, 20000, '2020-01-20 14:58:38'),
('s18nYcxUTr4Bi5Ig', 16000000, 0, 1600000, 0, 17600000, '2020-01-19 11:17:07'),
('XSidQWgjCs3lFEYe', 400000, 0, 40000, 0, 440000, '2020-01-21 03:28:50'),
('yzp0tCkaKQbZswRA', 50000, 0, 0, 0, 50000, '2020-01-20 14:45:39');

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
  ADD KEY `penjualan` (`nomor_faktur`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `harga_detail_pembelian`
--
ALTER TABLE `harga_detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `harga_detail_penjualan`
--
ALTER TABLE `harga_detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_pembelian` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

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
