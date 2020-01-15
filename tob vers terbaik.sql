-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 05:26 PM
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
  `tanggal_transaksi` date NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(3, 'XLaHcSgzn5b64RqQ', '0000-00-00', '1-2', 'B001', 1, 11000, 0, 11000, '2020-01-14'),
(4, '3UhiZcxzA1f9KEoJ', '2020-01-14', '3', 'B001', 10, 12000, 0, 120000, '2020-01-14');

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
  `jumlah_penjualan` int(11) NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(4, '9371064285', '0000-00-00', '', 'B001', 5, 0, 0, 75000, '0000-00-00'),
(5, '6028795143', '0000-00-00', '', 'B001', 5, 0, 0, 75000, '0000-00-00'),
(6, '7560984132', '2020-01-15', 'JXP6482709', 'B001', 1, 15000, 0, 15000, '2020-01-15'),
(7, '3785902416', '2020-01-15', 'BJK4763219', 'B001', 10, 15000, 10000, 140000, '2020-01-15'),
(8, '8967423105', '2020-01-15', 'JEU2947135', 'B001', 5, 15000, 0, 75000, '2020-01-15'),
(9, '2806153794', '2020-01-15', 'UUF9835261', 'B001', 1, 15000, 0, 15000, '2020-01-15'),
(10, '5249710368', '2020-01-15', 'PNC8019365', 'B001', 3, 15000, 0, 45000, '2020-01-15'),
(11, '2791846350', '2020-01-15', 'HHY9807123', 'B001', 5, 15000, 0, 75000, '2020-01-15'),
(12, '4913657082', '2020-01-15', 'BIU9230674', 'B001', 5, 15000, 0, 75000, '2020-01-15'),
(13, '9014683257', '2020-01-15', 'INV4289176', 'B001', 5, 15000, 0, 75000, '2020-01-15'),
(14, '2401978653', '2020-01-15', 'DTU5649371', 'B001', 1, 15000, 0, 15000, '2020-01-15'),
(15, '4183065972', '2020-01-15', 'AGC9236017', 'B001', 5, 15000, 0, 75000, '2020-01-15'),
(16, '0261935487', '2020-01-15', 'OVX8593407', 'B001', 3, 15000, 0, 45000, '2020-01-15');

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
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `kode_satuan`, `persediaan_minimum`, `gambar`, `keterangan`, `status_jual`, `tanggal_input`) VALUES
('B001', 1, 1, 0, 'QHQ851', 'BAJA 10 METER', 10000, 15000, 0, 2, 'B001.jpg', '', 1, '2020-01-14 13:38:37');

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
  `status` int(1) NOT NULL,
  `tanggal_input` date NOT NULL,
  `user_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `status`, `tanggal_input`, `user_input`) VALUES
('0u9L1hAIWOfn8RMY', '1', '0000-00-00', 'EKO076', 11000, 0, 0, 0, 11000, 0, '2020-01-14', 'udin'),
('3UhiZcxzA1f9KEoJ', '3', '2020-01-14', 'EKO076', 120000, 0, 0, 0, 120000, 0, '2020-01-14', 'udin'),
('XLaHcSgzn5b64RqQ', '1-2', '2020-01-15', 'EKO076', 11000, 0, 0, 0, 11000, 0, '2020-01-14', 'udin');

-- --------------------------------------------------------

--
-- Table structure for table `master_penjualan`
--

CREATE TABLE `master_penjualan` (
  `no_order_penjualan` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `total_penjualan` double NOT NULL DEFAULT 0,
  `diskon` double DEFAULT 0,
  `pajak_masukan` double NOT NULL DEFAULT 0,
  `ongkir` double NOT NULL DEFAULT 0,
  `grand_total` double NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status`, `tanggal_jatuh_tempo`, `tanggal_input`, `user`) VALUES
('0261935487', '2020-01-15', 'OVX8593407', 'h9tc7QlRayJGMEAH', 45000, 0, 0, 0, 45000, 1, NULL, '2020-01-15', 'usn'),
('1', '2020-01-15', 'XMO5201379', '1', 0, 0, 0, 0, 0, 1, NULL, '2020-01-15', 'udin'),
('2', '2020-01-15', 'QAJ8134096', '2', 0, 0, 0, 0, 0, 2, NULL, '2020-01-15', 'usn'),
('2401978653', '2020-01-15', 'DTU5649371', 'Lf4k2o8DWgpBsSwd', 15000, 0, 0, 0, 15000, 1, NULL, '2020-01-15', 'usn'),
('2791846350', '2020-01-15', 'HHY9807123', '37f0VxohtwDXSQiI', 75000, 0, 0, 0, 75000, 1, NULL, '2020-01-15', 'usn'),
('2806153794', '2020-01-15', 'UUF9835261', 'rvy7ShaG19pPqdxc', 15000, 0, 0, 0, 15000, 1, NULL, '2020-01-15', 'usn'),
('3785902416', '2020-01-15', 'BJK4763219', 'Xo3zZ0By2SlIfVtu', 150000, 10000, 0, 0, 140000, 1, NULL, '2020-01-15', 'usn'),
('4', '2020-01-15', 'CHM8520916', '4', 0, 0, 0, 0, 0, 4, NULL, '2020-01-15', 'udin'),
('4183065972', '2020-01-15', 'AGC9236017', 'zDEOaH58oVXd2lP0', 75000, 0, 0, 0, 75000, 1, NULL, '2020-01-15', 'usn'),
('4913657082', '2020-01-15', 'BIU9230674', '0RkolLHMyST6zQrx', 75000, 0, 0, 0, 75000, 1, NULL, '2020-01-15', 'usn'),
('5249710368', '2020-01-15', 'PNC8019365', '0qmMHT73CRnvVYZF', 45000, 0, 0, 10000, 55000, 1, NULL, '2020-01-15', 'usn'),
('7', '2020-01-15', 'MEX9103425', '7', 0, 0, 0, 0, 0, 7, NULL, '2020-01-15', 'udin'),
('7560984132', '2020-01-15', 'JXP6482709', 'K2uQDrPMyxJBvq5R', 15000, 0, 0, 0, 15000, 1, NULL, '2020-01-15', 'usn'),
('8967423105', '2020-01-15', 'JEU2947135', 'rAHVIgPqSvbCKtNL', 75000, 0, 0, 0, 75000, 1, NULL, '2020-01-15', 'usn'),
('9014683257', '2020-01-15', 'INV4289176', 'JZ1K3VYjIGvpmgP6', 75000, 0, 0, 0, 75000, 1, NULL, '2020-01-15', 'usn');

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
(14, 'B001', 1, 1, 0, '2020-01-14 14:25:33', '');

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
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `nomor_induk_pegawai` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `id_penghasilan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`nomor_induk_pegawai`, `password`, `jabatan`, `nama_lengkap`, `alamat`, `tanggal_lahir`, `pendidikan_terakhir`, `id_penghasilan`) VALUES
('10001', '123', 'Direktur', 'Lucky Anggara', 'askdjalskjdlakdj', '2020-01-15', 'Sarjana', '1');

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
('0qmMHT73CRnvVYZF', 'Lucky', '', '', 1),
('0RkolLHMyST6zQrx', 'a', '', '', 1),
('37f0VxohtwDXSQiI', 's', '', '', 1),
('5CVDdqlTjaiSzbhs', '4', '', '', 1),
('d3J7sjXyeCLGK4aM', 's', '', '', 1),
('h9tc7QlRayJGMEAH', 'a', '', '', 1),
('JZ1K3VYjIGvpmgP6', 's', '', '', 1),
('K2uQDrPMyxJBvq5R', 'a', '', '', 1),
('Lf4k2o8DWgpBsSwd', 'a', '', '', 1),
('PCjViRn8Xk31hpmd', 'a', '', '', 1),
('qnwcGf6lu3eBTWdS', 's', '', '', 1),
('rAHVIgPqSvbCKtNL', 'ss', '', '', 1),
('rvy7ShaG19pPqdxc', 's', '', '', 1),
('uQqUxCanR58Jho6y', 'aa', '', '', 1),
('Xo3zZ0By2SlIfVtu', 'as', '', '', 1),
('z48UQSGksIWe1ibx', '4', '', '', 1),
('zDEOaH58oVXd2lP0', 'a', '', '', 1),
('zYRx6V07SIj2EG1r', '4', '', '', 1);

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
('0261935487', 45000, 0, 0, 0, 45000, '2020-01-15 16:21:14'),
('0376148295', 45000, 0, 0, 0, 45000, '2020-01-15 14:45:58'),
('0523179468', 15000, 0, 0, 0, 15000, '2020-01-15 15:38:41'),
('0842157369', 150000, 15000, 13500, 0, 148500, '2020-01-15 14:54:47'),
('1628357409', 15000, 0, 0, 0, 15000, '2020-01-15 15:41:22'),
('1639270854', 0, 0, 0, 0, 0, '2020-01-15 13:04:16'),
('2401978653', 15000, 0, 0, 0, 15000, '2020-01-15 16:19:33'),
('2435016798', 15000, 12000, 0, 1000, 4000, '2020-01-15 15:13:25'),
('2658091437', 15000, 0, 0, 0, 15000, '2020-01-15 15:49:34'),
('2791846350', 75000, 0, 0, 0, 75000, '2020-01-15 16:13:57'),
('2806153794', 15000, 0, 0, 0, 15000, '2020-01-15 16:05:40'),
('2943758601', 135000, 10000, 0, 0, 125000, '2020-01-15 14:47:02'),
('2978053164', 15000, 0, 0, 0, 15000, '2020-01-15 15:46:52'),
('3280574691', 15000, 0, 0, 0, 15000, '2020-01-15 16:24:14'),
('3471280956', 15000, 0, 1500, 10000, 26500, '2020-01-15 14:53:20'),
('3785902416', 150000, 10000, 0, 0, 140000, '2020-01-15 16:02:20'),
('3847190625', 15000, 0, 0, 0, 15000, '2020-01-15 16:23:04'),
('3UhiZcxzA1f9KEoJ', 120000, 0, 0, 0, 120000, '2020-01-14 13:25:28'),
('4183065972', 75000, 0, 0, 0, 75000, '2020-01-15 16:20:38'),
('4327908561', 15000, 0, 0, 0, 15000, '2020-01-15 15:38:05'),
('4519832607', 15000, 0, 0, 0, 15000, '2020-01-15 16:24:32'),
('4829360751', 15000, 0, 0, 0, 15000, '2020-01-15 15:40:01'),
('4896730152', 15000, 0, 0, 0, 15000, '2020-01-15 14:47:43'),
('4913657082', 75000, 0, 0, 0, 75000, '2020-01-15 16:15:22'),
('5018392476', 15000, 0, 0, 0, 15000, '2020-01-15 13:53:01'),
('5249710368', 45000, 0, 0, 10000, 55000, '2020-01-15 16:06:37'),
('5382174096', 45000, 0, 0, 0, 45000, '2020-01-15 14:53:52'),
('5489206317', 30000, 0, 0, 0, 30000, '2020-01-15 14:52:53'),
('5723806491', 15000, 0, 0, 0, 15000, '2020-01-15 13:28:28'),
('6028795143', 75000, 0, 0, 0, 75000, '2020-01-15 15:33:05'),
('7268905341', 15000, 0, 0, 0, 15000, '2020-01-15 14:50:40'),
('7319620584', 150000, 0, 0, 0, 150000, '2020-01-15 15:43:41'),
('7546201893', 15000, 0, 0, 0, 15000, '2020-01-15 16:25:11'),
('7560984132', 15000, 0, 0, 0, 15000, '2020-01-15 15:50:14'),
('7835496210', 15000, 0, 0, 0, 15000, '2020-01-15 16:26:02'),
('8012954763', 16000, 500, 0, 0, 15500, '2020-01-15 14:09:40'),
('8391675402', 43000, 2000, 0, 0, 41000, '2020-01-15 14:03:20'),
('8907153246', 15000, 0, 0, 0, 15000, '2020-01-15 15:37:15'),
('8967423105', 75000, 0, 0, 0, 75000, '2020-01-15 16:04:16'),
('9014683257', 75000, 0, 0, 0, 75000, '2020-01-15 16:17:47'),
('9321587640', 15000, 0, 0, 0, 15000, '2020-01-15 16:23:34'),
('9346752180', 10000, 0, 0, 0, 10000, '2020-01-15 14:04:39'),
('9371064285', 75000, 0, 0, 0, 75000, '2020-01-15 15:30:45'),
('9481250376', 75000, 0, 0, 0, 75000, '2020-01-15 16:20:58'),
('9573460812', 15000, 10000, 0, 0, 5000, '2020-01-15 14:42:58'),
('9831246750', 35000, 0, 0, 0, 35000, '2020-01-15 13:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `temp_tabel_keranjang_pembelian`
--

CREATE TABLE `temp_tabel_keranjang_pembelian` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
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

INSERT INTO `temp_tabel_keranjang_pembelian` (`id`, `tanggal_transaksi`, `no_order_pembelian`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(122, '2020-01-14', '3UhiZcxzA1f9KEoJ', 'B001', 10, 12000, 0, 120000, '2020-01-14');

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
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_tabel_keranjang_penjualan`
--

INSERT INTO `temp_tabel_keranjang_penjualan` (`id`, `tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(186, '2020-01-15', '4183065972', 'B001', 5, 15000, 0, 75000, '2020-01-15 10:20:34'),
(188, '2020-01-15', '0261935487', 'B001', 3, 15000, 0, 45000, '2020-01-15 10:21:11'),
(194, '2020-01-15', '7835496210', 'B001', 1, 15000, 0, 15000, '2020-01-15 10:26:01');

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
-- Indexes for table `master_pembelian`
--
ALTER TABLE `master_pembelian`
  ADD PRIMARY KEY (`no_order_pembelian`),
  ADD UNIQUE KEY `nomor_transaksi` (`nomor_transaksi`);

--
-- Indexes for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  ADD PRIMARY KEY (`no_order_penjualan`);

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
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`nomor_induk_pegawai`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

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
  ADD CONSTRAINT `no_order_join` FOREIGN KEY (`no_order`) REFERENCES `master_penjualan` (`no_order_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
