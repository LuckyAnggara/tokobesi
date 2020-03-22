-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 10:49 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;

START TRANSACTION;

CREATE TABLE `detail_biaya` (
  `id` int(11) NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `kategori_biaya` int(11) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_biaya`
--

INSERT INTO `detail_biaya` (`id`, `nomor_referensi`, `kategori_biaya`, `keterangan`, `total`, `status`, `user`, `tanggal`) VALUES
(1, 'REF2940865', 1, 'bayar listrik harian', 1000000, 0, 'edwin', '2020-03-13 10:48:32'),
(2, 'REF2940865', 3, 'ongkos tol', 200000, 0, 'edwin', '2020-03-13 10:48:48'),
(3, 'REF2940865', 3, 'bayar pengamen', 100000, 0, 'edwin', '2020-03-13 10:49:06');

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
(30, '1', 10000000, 10000000, 1, 'Saldo Awal Penarikan', '2020-03-16 07:09:38'),
(31, '2', 1000000, 1000000, 1, 'Saldo Awal Penarikan', '2020-03-16 07:29:55'),
(32, '1', 9000000, 1000000, 2, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-16 07:29:55'),
(33, '2', 4000000, 3000000, 1, 'Penambahan dana', '2020-03-16 08:25:00'),
(34, '1', 6000000, 3000000, 2, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-16 08:25:00'),
(35, '2', 3000000, 1000000, 1, 'Penyetoran dana', '2020-03-16 08:32:28'),
(36, '1', 7000000, 1000000, 1, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-16 08:32:28'),
(37, '1', 2000000, 5000000, 2, 'Penyetoran dana', '2020-03-16 08:38:04'),
(38, '1', 5000000, 3000000, 1, 'Penambahan dana', '2020-03-16 09:13:23'),
(39, '1', 6000000, 1000000, 1, 'Penambahan dana', '2020-03-16 09:59:41'),
(40, '1', 3000000, 3000000, 2, 'Penyetoran dana', '2020-03-16 10:05:11'),
(41, '2', 6000000, 3000000, 1, 'Penambahan dana', '2020-03-16 10:19:57'),
(42, '1', 0, 3000000, 2, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-16 10:19:57'),
(43, '2', 1000000, 5000000, 2, 'Penyetoran dana', '2020-03-16 10:48:27'),
(44, '1', -5000000, 5000000, 4, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-16 10:48:27');

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
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_gaji`
--

INSERT INTO `detail_gaji` (`id`, `nomor_referensi`, `nip`, `tanggal_pembayaran`, `gaji_pokok`, `uang_makan`, `bonus`, `total`, `status`, `user`) VALUES
(437, 'REF7965843', '1', '2020-03-06 09:13:36', 50000, 10000, 0, 60000, 2, 'edwin'),
(438, 'REF7965843', '123123123', '2020-03-06 09:13:36', 100000, 10000, 0, 110000, 2, 'edwin'),
(439, 'REF7965843', '124124', '2020-03-06 09:13:36', 50000, 10000, 0, 60000, 2, 'edwin'),
(440, 'REF7965843', '21124124', '2020-03-06 09:13:36', 50000, 10000, 0, 60000, 2, 'edwin'),
(441, 'REF7965843', '123123', '2020-03-06 09:13:36', 50000, 10000, 0, 60000, 2, 'edwin'),
(442, 'REF7965843', '647476', '2020-03-06 09:13:36', 23424, 24324324, 0, 24347748, 2, 'edwin'),
(443, 'REF6098237', '1', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 'edwin'),
(444, 'REF6098237', '123123123', '0000-00-00 00:00:00', 100000, 10000, 0, 110000, 0, 'edwin'),
(445, 'REF6098237', '124124', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 'edwin'),
(446, 'REF6098237', '21124124', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 'edwin'),
(447, 'REF6098237', '123123', '0000-00-00 00:00:00', 50000, 10000, 0, 60000, 0, 'edwin'),
(448, 'REF6098237', '647476', '0000-00-00 00:00:00', 23424, 24324324, 0, 24347748, 0, 'edwin');

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
(101, 'b6UL8VOkAumN72J9', '2020-03-06 03:31:11', '1', 'BES0001', 10, 16000, 0, 160000, '2020-03-06', 0),
(102, 'b6UL8VOkAumN72J9', '2020-03-06 03:31:20', '1', 'BES0002', 20, 20000, 0, 400000, '2020-03-06', 0),
(104, 'wNPBVDyLUaXHJIux', '2020-03-06 04:51:25', '2', 'CNP0020', 20, 20000, 0, 400000, '2020-03-06', 20),
(105, 'wNPBVDyLUaXHJIux', '2020-03-06 04:51:33', '2', 'BES0004', 30, 10000, 0, 300000, '2020-03-06', 30),
(106, 'wNPBVDyLUaXHJIux', '2020-03-06 04:51:47', '2', 'BES0006', 20, 30000, 0, 550000, '2020-03-06', 20),
(107, 'Gsc4eWCduFxmSqYR', '2020-02-01 00:00:00', 'kredit', 'BES0001', 500, 10000, 0, 5000000, '2020-03-09', 0),
(108, 'Gsc4eWCduFxmSqYR', '2020-02-01 00:00:00', 'kredit', 'SKR0046', 200, 1000000, 0, 200000000, '2020-03-09', 200);

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
(22, 'OUT3426109', '2020-03-06 03:32:25', 'bbmkdr060320001', 'BES0001 ', 15, 24000, 100000, 260000, '2020-03-06'),
(23, 'OUT3426109', '2020-03-06 03:32:34', 'bbmkdr060320001', 'BES0002 ', 15, 33000, 5000, 490000, '2020-03-06'),
(24, 'OUT8726340', '2020-03-13 10:26:15', 'bbmkdr130320002', 'BES0001', 415, 24000, 0, 9960000, '2020-03-13'),
(25, 'OUT8726340', '2020-03-13 10:26:23', 'bbmkdr130320002', 'BES0002', 5, 33000, 0, 165000, '2020-03-13');

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
(1, '2020-03-05', '123', 'BES0002', 5, 25000, 5),
(2, '2020-03-05', '1', 'BES0001', 20, 15000, 20),
(3, '2020-03-06', '1', 'BES0001', 10, 16000, 10),
(4, '2020-03-06', '1', 'BES0002', 20, 20000, 20),
(6, '2020-03-06', '2', 'CNP0020', 20, 20000, 20),
(7, '2020-03-06', '2', 'BES0004', 30, 10000, 30),
(8, '2020-03-06', '2', 'BES0006', 20, 30000, 20),
(9, '2020-02-01', 'kredit', 'BES0001', 500, 10000, 500),
(10, '2020-02-01', 'kredit', 'SKR0046', 200, 1000000, 200);

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
  `tanggal_input` datetime NOT NULL
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
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_retur_barang_penjualan`
--

INSERT INTO `detail_retur_barang_penjualan` (`id`, `nomor_faktur`, `kode_barang`, `harga_pokok`, `saldo_tersedia`, `saldo_retur`, `keterangan`, `user`, `tanggal_input`) VALUES
(7, 'RTR-bbmkdr060320001', 'BES0001', 20000, 0, 5, 'RTR-bbmkdr060320001 - Cacat', 'edwin', '2020-03-06 08:34:42');

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
(6, 107, 'RTR-kredit', 'BES0001', 'rusak', 100, 10000, 0, 1000000, 'dini', '2020-03-09 11:23:09');

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
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_retur_penjualan`
--

INSERT INTO `detail_retur_penjualan` (`id`, `id_detail_penjualan`, `nomor_faktur`, `kode_barang`, `keterangan`, `jumlah_retur`, `saldo`, `harga_retur`, `diskon`, `total_retur`, `user`, `tanggal`) VALUES
(7, 22, 'RTR-bbmkdr060320001', 'BES0001', 'Cacat', 5, 0, 76000, 100000, 380000, 'dini', '2020-03-06 07:34:42');

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
(385, 'REF5732941', '2020-03-09 00:00:00', 'BES0001', 10, 10, 0, 0, '', 'dini'),
(386, 'REF5732941', '2020-03-09 00:00:00', 'BES0002', 5, 10, -5, 0, '', 'dini'),
(387, 'REF5732941', '2020-03-09 00:00:00', 'BES0003', 0, 0, 0, 0, '', 'dini'),
(388, 'REF5732941', '2020-03-09 00:00:00', 'BES0004', 30, 27, 3, 0, '', 'dini'),
(389, 'REF5732941', '2020-03-09 00:00:00', 'BES0005', 0, 0, 0, 0, '', 'dini'),
(390, 'REF5732941', '2020-03-09 00:00:00', 'BES0006', 20, 20, 0, 0, '', 'dini'),
(391, 'REF5732941', '2020-03-09 00:00:00', 'BES0007', 0, 0, 0, 0, '', 'dini'),
(392, 'REF5732941', '2020-03-09 00:00:00', 'BES0008', 0, 0, 0, 0, '', 'dini'),
(393, 'REF5732941', '2020-03-09 00:00:00', 'BES0064', 0, 0, 0, 0, '', 'dini'),
(394, 'REF5732941', '2020-03-09 00:00:00', 'BON0009', 0, 0, 0, 0, '', 'dini'),
(395, 'REF5732941', '2020-03-09 00:00:00', 'BON0010', 0, 0, 0, 0, '', 'dini'),
(396, 'REF5732941', '2020-03-09 00:00:00', 'BON0011', 0, 0, 0, 0, '', 'dini'),
(397, 'REF5732941', '2020-03-09 00:00:00', 'BON0012', 0, 0, 0, 0, '', 'dini'),
(398, 'REF5732941', '2020-03-09 00:00:00', 'BON0013', 0, 0, 0, 0, '', 'dini'),
(399, 'REF5732941', '2020-03-09 00:00:00', 'BON0014', 0, 0, 0, 0, '', 'dini'),
(400, 'REF5732941', '2020-03-09 00:00:00', 'BON0015', 0, 0, 0, 0, '', 'dini'),
(401, 'REF5732941', '2020-03-09 00:00:00', 'BON0016', 0, 0, 0, 0, '', 'dini'),
(402, 'REF5732941', '2020-03-09 00:00:00', 'CNP0017', 0, 0, 0, 0, '', 'dini'),
(403, 'REF5732941', '2020-03-09 00:00:00', 'CNP0018', 0, 0, 0, 0, '', 'dini'),
(404, 'REF5732941', '2020-03-09 00:00:00', 'CNP0019', 0, 0, 0, 0, '', 'dini'),
(405, 'REF5732941', '2020-03-09 00:00:00', 'CNP0020', 20, 20, 0, 0, '', 'dini'),
(406, 'REF5732941', '2020-03-09 00:00:00', 'CNP0021', 0, 0, 0, 0, '', 'dini'),
(407, 'REF5732941', '2020-03-09 00:00:00', 'CNP0022', 0, 0, 0, 0, '', 'dini'),
(408, 'REF5732941', '2020-03-09 00:00:00', 'DEM0023', 0, 0, 0, 0, '', 'dini'),
(409, 'REF5732941', '2020-03-09 00:00:00', 'DEM0024', 0, 0, 0, 0, '', 'dini'),
(410, 'REF5732941', '2020-03-09 00:00:00', 'DEM0025', 0, 0, 0, 0, '', 'dini'),
(411, 'REF5732941', '2020-03-09 00:00:00', 'DEM0026', 0, 0, 0, 0, '', 'dini'),
(412, 'REF5732941', '2020-03-09 00:00:00', 'DEM0027', 0, 0, 0, 0, '', 'dini'),
(413, 'REF5732941', '2020-03-09 00:00:00', 'DIN0028', 0, 0, 0, 0, '', 'dini'),
(414, 'REF5732941', '2020-03-09 00:00:00', 'DIN0029', 0, 0, 0, 0, '', 'dini'),
(415, 'REF5732941', '2020-03-09 00:00:00', 'DIN0030', 0, 0, 0, 0, '', 'dini'),
(416, 'REF5732941', '2020-03-09 00:00:00', 'DIN0031', 0, 0, 0, 0, '', 'dini'),
(417, 'REF5732941', '2020-03-09 00:00:00', 'DIN0032', 0, 0, 0, 0, '', 'dini'),
(418, 'REF5732941', '2020-03-09 00:00:00', 'GEN0033', 0, 0, 0, 0, '', 'dini'),
(419, 'REF5732941', '2020-03-09 00:00:00', 'GEN0034', 0, 0, 0, 0, '', 'dini'),
(420, 'REF5732941', '2020-03-09 00:00:00', 'GEN0035', 0, 0, 0, 0, '', 'dini'),
(421, 'REF5732941', '2020-03-09 00:00:00', 'GEN0036', 0, 0, 0, 0, '', 'dini'),
(422, 'REF5732941', '2020-03-09 00:00:00', 'GEN0063', 0, 0, 0, 0, '', 'dini'),
(423, 'REF5732941', '2020-03-09 00:00:00', 'HOL0037', 0, 0, 0, 0, '', 'dini'),
(424, 'REF5732941', '2020-03-09 00:00:00', 'HOL0038', 0, 0, 0, 0, '', 'dini'),
(425, 'REF5732941', '2020-03-09 00:00:00', 'KAW0040', 0, 0, 0, 0, '', 'dini'),
(426, 'REF5732941', '2020-03-09 00:00:00', 'KAW0041', 0, 0, 0, 0, '', 'dini'),
(427, 'REF5732941', '2020-03-09 00:00:00', 'KAW0042', 0, 0, 0, 0, '', 'dini'),
(428, 'REF5732941', '2020-03-09 00:00:00', 'KIN0043', 0, 0, 0, 0, '', 'dini'),
(429, 'REF5732941', '2020-03-09 00:00:00', 'KIN0044', 0, 0, 0, 0, '', 'dini'),
(430, 'REF5732941', '2020-03-09 00:00:00', 'PAP0039', 0, 0, 0, 0, '', 'dini'),
(431, 'REF5732941', '2020-03-09 00:00:00', 'SKR0045', 0, 0, 0, 0, '', 'dini'),
(432, 'REF5732941', '2020-03-09 00:00:00', 'SKR0046', 0, 0, 0, 0, '', 'dini'),
(433, 'REF5732941', '2020-03-09 00:00:00', 'SKR0047', 0, 0, 0, 0, '', 'dini'),
(434, 'REF5732941', '2020-03-09 00:00:00', 'SKR0048', 0, 0, 0, 0, '', 'dini'),
(435, 'REF5732941', '2020-03-09 00:00:00', 'SPA0049', 0, 0, 0, 0, '', 'dini'),
(436, 'REF5732941', '2020-03-09 00:00:00', 'SPA0050', 0, 0, 0, 0, '', 'dini'),
(437, 'REF5732941', '2020-03-09 00:00:00', 'SPA0051', 0, 0, 0, 0, '', 'dini'),
(438, 'REF5732941', '2020-03-09 00:00:00', 'SPA0052', 0, 0, 0, 0, '', 'dini'),
(439, 'REF5732941', '2020-03-09 00:00:00', 'SPA0053', 0, 0, 0, 0, '', 'dini'),
(440, 'REF5732941', '2020-03-09 00:00:00', 'SPA0054', 0, 0, 0, 0, '', 'dini'),
(441, 'REF5732941', '2020-03-09 00:00:00', 'SPA0055', 0, 0, 0, 0, '', 'dini'),
(442, 'REF5732941', '2020-03-09 00:00:00', 'SPA0056', 0, 0, 0, 0, '', 'dini'),
(443, 'REF5732941', '2020-03-09 00:00:00', 'WD0057', 0, 0, 0, 0, '', 'dini'),
(444, 'REF5732941', '2020-03-09 00:00:00', 'WD0058', 0, 0, 0, 0, '', 'dini'),
(445, 'REF5732941', '2020-03-09 00:00:00', 'WIR0059', 0, 0, 0, 0, '', 'dini'),
(446, 'REF5732941', '2020-03-09 00:00:00', 'WIR0060', 0, 0, 0, 0, '', 'dini'),
(447, 'REF5732941', '2020-03-09 00:00:00', 'WIR0061', 0, 0, 0, 0, '', 'dini'),
(448, 'REF5732941', '2020-03-09 00:00:00', 'WIR0062', 0, 0, 0, 0, '', 'dini');

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

--
-- Dumping data for table `detail_utang`
--

INSERT INTO `detail_utang` (`id`, `nomor_transaksi`, `nominal_pembayaran`, `sisa_utang`, `tanggal`, `user`, `bukti`, `keterangan`, `timestamp`) VALUES
(1, 'kredit', 0, 205000000, '2020-03-09 12:20:25', 'dini', '1', 'Down Payment', '2020-03-09 11:20:25');

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
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_biaya`
--

INSERT INTO `master_biaya` (`id`, `nomor_referensi`, `tanggal`, `total_biaya`, `keterangan`, `status`, `user`) VALUES
(1, 'REF2940865', '2020-03-13 00:00:00', 0, '', 2, 'edwin');

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
(18, '1', '', 'edwin', 4, 10000000, 0, 5000000, 1, 'alksadkl a\r\nsdasdka;lsdj\r\naskjdlaksdasd', '2020-03-16 07:09:23'),
(19, '2', '1', 'lucky15', 1, 1000000, 0, 1000000, 1, 'sadasdasd', '2020-03-16 07:15:44');

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
(38, '1', 10000000, 3, 2, 'edwin', '', 'manajer', 3, '2020-03-16 07:09:23'),
(39, '2', 1000000, 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-16 07:15:44'),
(40, '2', 3000000, 1, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-16 08:23:22'),
(41, '2', 1000000, 2, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-16 08:31:56'),
(42, '1', 5000000, 2, 2, 'edwin', '', 'manajer', 3, '2020-03-16 08:37:20'),
(43, '1', 3000000, 1, 99, 'edwin', '', 'manajer', 3, '2020-03-16 08:41:02'),
(44, '1', 5000000, 1, 99, 'edwin', '', 'manajer', 3, '2020-03-16 08:42:06'),
(45, '1', 1000000, 1, 99, 'edwin', '', 'manajer', 3, '2020-03-16 08:42:15'),
(46, '1', 3000000, 2, 2, 'edwin', '', 'manajer', 3, '2020-03-16 08:52:05'),
(47, '1', 1000000, 1, 2, 'edwin', '', 'manajer', 3, '2020-03-16 09:59:06'),
(48, '1', 3000000, 2, 2, 'edwin', '', 'manajer', 3, '2020-03-16 10:00:18'),
(49, '2', 3000000, 1, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-16 10:09:31'),
(50, '2', 5000000, 2, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-16 10:20:55');

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
(96, '2020-03-06 00:00:00', 'REF7965843', 24697748, '', 2, 'edwin'),
(97, '2020-03-03 00:00:00', 'REF6098237', 0, '', 0, 'edwin');

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
(31, '2020-03-06 03:32:47', 'bbmkdr060320001', 'BES0001 ', 10, 15000, 24000, 'FIFO'),
(32, '2020-03-06 03:32:47', 'bbmkdr060320001', 'BES0001 ', 5, 16000, 24000, 'FIFO'),
(33, '2020-03-06 03:32:47', 'bbmkdr060320001', 'BES0002 ', 15, 20000, 33000, 'FIFO'),
(34, '2020-03-13 10:26:36', 'bbmkdr130320002', 'BES0001', 5, 15000, 24000, 'FIFO'),
(35, '2020-03-13 10:26:36', 'bbmkdr130320002', 'BES0001', 400, 10000, 24000, 'FIFO'),
(36, '2020-03-13 10:26:36', 'bbmkdr130320002', 'BES0001', 5, 16000, 24000, 'FIFO'),
(37, '2020-03-13 10:26:36', 'bbmkdr130320002', 'BES0001', 5, 20000, 24000, 'FIFO'),
(38, '2020-03-13 10:26:36', 'bbmkdr130320002', 'BES0002', 5, 20000, 33000, 'FIFO');

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
-- Table structure for table `master_kategori_biaya`
--

CREATE TABLE `master_kategori_biaya` (
  `id` int(11) NOT NULL,
  `nama_biaya` varchar(255) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_kategori_biaya`
--

INSERT INTO `master_kategori_biaya` (`id`, `nama_biaya`, `keterangan`, `user`, `tanggal_input`, `status`) VALUES
(1, 'LISTRIK', 'Untuk kateg', 'edwin', '2020-03-04 07:50:39', 0),
(2, 'Air', 'Untuk kategori biaya air', 'edwin', '2020-03-04 08:00:51', 1),
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
(1, '1', '0', 'Neng Yuliantin', 1, 'Jl Raya Limbangan', '', '', 'Garut', '2018-12-01', '2020-02-01', '', 'Direktur', '0', '0-0', '0', 1, 50000, 10000, 'SpDT0P752ut6lZHE.jpeg', 1, '', '2020-03-03 12:42:02'),
(10, '123123123', '123123123123', 'LUCKY ANGGARA', 0, 'BANDUNG', 'BANDUNG', 'BANDUNG', 'BANDUNG', '1992-07-15', '2020-03-01', 'SARJANA', 'KASIR', '082116562811', 'BNI - 0468995561', '12312312312', 1, 100000, 10000, '123123123.jpg', 1, 'manajer', '2020-03-06 08:05:49'),
(11, '124124', '1241241', 'DINI', 1, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-18', '2020-03-01', 'SMA', 'ADMIN', '08800', 'BNI - 080808', '123123', 1, 50000, 10000, 'default.jpg', 0, 'manajer', '2020-03-02 06:07:07'),
(12, '21124124', '124124124', 'HADI', 0, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-09', '2020-03-01', 'SARJANA', 'SALES', '0808080', 'ASAS - 54654654', '21313', 1, 50000, 10000, '21124124.jpg', 1, 'manajer', '2020-03-02 12:53:43'),
(13, '123123', '1231231', 'EDWIN', 0, 'JAKARTA', 'JAKARTA', 'JAKARTA', 'JAKARTA', '2020-03-26', '2020-03-01', 'MAGISTER', 'SUPERVISOR', '9128491248', 'BA - 31231', '213123', 1, 50000, 10000, '123123.jpg', 1, 'manajer', '2020-03-02 06:07:10'),
(14, '647476', '54345354354', 'GJHGJHG', 0, 'HGDGHDHGD', 'GDGFDGFQ', 'HGDGHDH', 'DGFDGFD', '2020-03-20', '2020-03-06', 'GFHGFG', 'GDGHDHG', '67456456', 'GFHGF - 345354', '564564654564', 1, 23424, 24324324, '647476.png', 0, 'manajer', '2020-03-06 08:08:10');

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
(14, 'HWW1875', 'general', 'AAAAA', '11', 'aaa@gmail.com', '111', '11.111.111.1-111.111', '111-111111-111', 0, '2020-03-05', 'lucky15');

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

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `lampiran`, `status_bayar`, `tanggal_input`, `user`) VALUES
('b6UL8VOkAumN72J9', '1', '2020-03-06 03:31:32', 'BIR674', 560000, 0, 56000, 0, 616000, '', 1, '2020-03-06', 'dini'),
('Gsc4eWCduFxmSqYR', 'kredit', '2020-02-01 00:00:00', 'BIR674', 205000000, 0, 0, 0, 205000000, '', 0, '2020-03-09', 'dini'),
('wNPBVDyLUaXHJIux', '2', '2020-03-06 04:51:57', 'ESF053', 1300000, 50000, 125000, 0, 1375000, '', 1, '2020-03-06', 'dini');

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
  `user` varchar(255) NOT NULL,
  `no_polisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`, `no_polisi`) VALUES
(16, 'OUT3426109', '2020-03-06 03:32:46', 'bbmkdr060320001', 'HWW1875', 855000, 0, 75000, 0, 930000, 1, NULL, '2020-03-06', 'nosales', 'lucky15', ''),
(17, 'OUT8726340', '2020-03-13 00:00:00', 'bbmkdr130320002', 'HWW1875', 10125000, 0, 0, 0, 10125000, 1, NULL, '2020-03-13', 'nosales', 'lucky15', '');

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

--
-- Dumping data for table `master_purchase_order`
--

INSERT INTO `master_purchase_order` (`id`, `tanggal_transaksi`, `no_order`, `sales`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `tanggal_input`, `user`, `admin`, `status_po`) VALUES
(1, '0000-00-00 00:00:00', 'PO.090320001', 'hadi', 'HWW1875', 525000, 0, 52500, 0, 577500, '2020-03-09 05:13:57', 'hadi', '', 1);

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
(6, 'kredit', 'RTR-kredit', 'BIR674', 1000000, 0, 0, 1000000, 'dini', '2020-03-09 11:23:09');

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
(7, 'bbmkdr060320001', 'RTR-bbmkdr060320001', 'HWW1875', 380000, 105000, 27500, 302500, 'dini', '2020-03-06 07:33:43');

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
(2, 'BES0001', 'SALDO AWAL', 10, 0, 15000, '2020-03-06 03:31:00', '2020-01-01 00:00:01', 'dini');

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
  `value` varchar(1024) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_setting`
--

INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES
(1, 'nama_perusahaan', 'Besi Baja Makmur Kadungora', '2020-03-01 04:50:43'),
(2, 'alamat_perusahaan', 'Jl Raya Kadungora No asdasdasd asdasdasd asdasdasd asdasdas asdasdasd', '2020-03-09 12:23:15'),
(3, 'nomor_telepon', '085555555', '2020-03-01 04:50:43'),
(4, 'nomor_fax', '0808080', '2020-03-01 04:50:43'),
(5, 'alamat_email', 'bbmkadungora@gmail.com', '2020-03-01 04:50:43'),
(6, 'logo_perusahaan', 't7bQeA3qsT28E9F0.png', '2020-03-01 04:50:37'),
(7, 'prefix_faktur', 'bbmkdr', '2020-03-01 04:51:14'),
(8, 'nomor_faktur', '3', '2020-03-01 04:51:14'),
(9, 'catatan_faktur_cash', 'No Rek BCA : 148-098-0570\nNo Rek BNI : 033-078-6610\nNo Rek Mandiri : 177-00-00494-655\nNo Rek BRI : 0025-01-000778-56-6\na.n Bpk. Aten Aripin', '2020-03-05 11:15:21'),
(10, 'catatan_faktur_kredit', 'asss', '2020-02-25 06:34:05'),
(11, 'catatan_retur_jual', 'asdasda', '2020-02-24 11:58:09'),
(12, 'catatan_retur_beli', 'asdasda', '2020-02-24 11:58:09'),
(13, 'password_harga', '5', '2020-02-29 13:57:52'),
(14, 'komisi_sales', '0.5', '2020-03-01 04:51:28'),
(15, 'notifikasi', '2,3', '2020-02-25 14:18:42'),
(16, 'frekuensi_notifikasi', '20', '2020-02-25 14:24:49'),
(17, 'threshold_bonus', '1000', '2020-03-03 12:38:45'),
(18, 'bonus_senior', '15000', '2020-03-03 12:45:01'),
(19, 'bonus_junior', '10000', '2020-03-03 12:45:01');

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
(5, 'REF7542908', '2020-03-02 00:00:00', '23123', 0, 'edwin', ''),
(12, 'REF5732941', '2020-03-09 06:35:28', '', 2, 'dini', 'edwin');

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
('dini', '124124', '$2y$10$RrwCvrb/WuSCU/JAHKr.2.A7f7WpsPc5qBKhH7.PZx.kua5bxKr8a', '2', 'DINI', 'default.jpg', 0, '2020-03-09 12:23:25', '0000-00-00 00:00:00', 1, 0),
('edwin', '123123', '$2y$10$oi6qEP4bxeYkrUK5YCvhFe8a4PBCVriLudVjVxMvqQPPYCy.xKF9u', '4', 'EDWIN', 'default.jpg', 0, '2020-03-16 10:20:30', '0000-00-00 00:00:00', 1, 0),
('hadi', '21124124', '$2y$10$.Zz5dNGxi92mm.vF2/W59OWdBQEkYEIAjgnf01FkeUNal0jg2Lzf.', '3', 'HADI', 'default.jpg', 0, '2020-03-09 05:19:50', '0000-00-00 00:00:00', 1, 0),
('lucky15', '123123123', '$2y$10$3HBFxWoWL9yHhbW1zegPteGL2ZtN4bPiBTTGEwkFifMu7djwD2Q0S', '1', 'LUCKY ANGGARA', 'default.jpg', 0, '2020-03-16 10:21:04', '0000-00-00 00:00:00', 1, 0),
('manajer', '1', '$2y$10$Z.wVyoe9feypSG31/yGrhulh1abnvFshzx6nUSQBq5yZlmlVUeiLO', '5', 'Neng', 'PjNKCoktVUdi3BZp.jpeg', 0, '2020-03-16 10:21:29', '2020-03-01 00:00:00', 1, 0);

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

--
-- Dumping data for table `master_utang`
--

INSERT INTO `master_utang` (`id`, `nomor_transaksi`, `tanggal_jatuh_tempo`, `total_tagihan`, `total_pembayaran`, `down_payment`, `sisa_utang`, `tanggal_input`, `user`) VALUES
(1, 'kredit', '2020-04-30', 205000000, 0, 0, 205000000, '2020-03-09', 'dini');

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
  `is_read` int(1) NOT NULL DEFAULT '0',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES
(1, 'manajer', 'edwin', 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/', 1, 0, '2020-03-13 09:31:26'),
(2, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 1, 0, '2020-03-13 10:14:56'),
(3, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 1, 0, '2020-03-13 11:24:20'),
(4, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-13 11:26:17'),
(5, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-13 12:01:47'),
(6, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-13 12:18:18'),
(7, 'edwin', 'lucky15', 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-13 12:31:45'),
(8, 'edwin', 'lucky15', 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-13 12:35:20'),
(9, 'edwin', 'manajer', 'Permintaan Dana', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-13 12:35:36'),
(10, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 05:30:47'),
(11, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 05:45:15'),
(12, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 06:37:47'),
(13, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 06:50:29'),
(14, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 07:09:38'),
(15, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 07:29:55'),
(16, 'edwin', 'lucky15', 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 08:25:01'),
(17, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 08:32:28'),
(18, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 08:38:04'),
(19, 'edwin', 'manajer', 'Permintaan Dana', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 08:41:02'),
(20, 'edwin', 'manajer', 'Permintaan Dana', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 08:42:06'),
(21, 'edwin', 'manajer', 'Permintaan Dana', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 08:42:15'),
(22, 'edwin', 'manajer', 'Permintaan Dana', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 08:52:05'),
(23, 'manajer', 'edwin', 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 09:13:23'),
(24, 'edwin', 'manajer', 'Permintaan Dana', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 09:59:06'),
(25, 'manajer', 'edwin', 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 09:59:42'),
(26, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 10:05:12'),
(27, 'edwin', 'lucky15', 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 10:19:57'),
(28, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-16 10:48:27');

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_perhitungan_order`
--

INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES
('39gtUec7uoHCMPI8', 125000, 0, 12500, 0, 137500, '2020-03-05 05:21:19'),
('7EnBUwIJmx1cTsfp', 300000, 0, 0, 10000, 310000, '2020-03-05 05:45:14'),
('b6UL8VOkAumN72J9', 560000, 0, 56000, 0, 616000, '2020-03-06 02:31:25'),
('Gsc4eWCduFxmSqYR', 205000000, 0, 0, 0, 205000000, '2020-03-09 11:20:11'),
('OUT0219576', 24000, 0, 0, 0, 24000, '2020-03-04 08:01:20'),
('OUT0624851', 720000, 0, 0, 0, 720000, '2020-03-04 08:16:07'),
('OUT1243956', 48000, 0, 0, 0, 48000, '2020-03-05 12:03:28'),
('OUT3280967', 720000, 0, 0, 0, 720000, '2020-03-04 08:00:06'),
('OUT3605217', 720000, 0, 0, 0, 720000, '2020-03-04 08:00:53'),
('OUT4309761', 24000, 0, 0, 0, 24000, '2020-03-04 08:03:15'),
('OUT7129068', 720000, 0, 0, 0, 720000, '2020-03-04 07:53:49'),
('PO.090320001', 525000, 0, 52500, 0, 577500, '2020-03-09 04:14:06'),
('wNPBVDyLUaXHJIux', 1300000, 50000, 125000, 0, 1375000, '2020-03-06 03:51:54');

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
(37, '12', 'Master Piutang', '	\r\nmanajemen_keuangan/masterpiutang/daftar_piutang', 'Manajer Master Piutang'),
(39, '24', 'Master Gaji', 'manajemen_keuangan/mastergaji/', 'Supervisor Master Gaji'),
(40, '24', 'Master Biaya', 'manajemen_keuangan/masterbiaya/', 'Supervisor Master Biaya'),
(41, '10', 'Master Kategori Biaya', 'manajemen_data/masterkategoribiaya', 'Supervisor Kategori Biaya'),
(42, '9', 'Transfer Retur Barang', 'manajemen_persediaan/returpersediaan', 'Supervisor Transfer Retur Barang'),
(43, '13', 'Laporan Laba / Rugi Usaha', 'laporan/laba', 'Manajer Laporan Laba / Rugi'),
(44, '24', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Supervisor COH'),
(45, '12', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Manajer Master Kas'),
(46, '25', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Kasir Master Dana COH'),
(47, '1', 'Daftar Pending Transaksi', 'manajemen_penjualan/pendingtransaksi', 'Kasir Pending Transaksi');

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
-- Dumping data for table `timeline_po`
--

INSERT INTO `timeline_po` (`id`, `no_order`, `urutan`, `tanggal`, `pesan`, `user`) VALUES
(1, 'PO.090320001', 1, '2020-03-09 05:14:18', 'Proses', 'hadi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_biaya`
--
ALTER TABLE `detail_biaya`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_biaya` (`nomor_referensi`);

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
-- Indexes for table `detail_retur_barang_pembelian`
--
ALTER TABLE `detail_retur_barang_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_retur_barang_penjualan`
--
ALTER TABLE `detail_retur_barang_penjualan`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `detail_biaya`
--
ALTER TABLE `detail_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_coh`
--
ALTER TABLE `detail_coh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `detail_detail_stok_opname`
--
ALTER TABLE `detail_detail_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_retur_pembelian`
--
ALTER TABLE `detail_retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_retur_penjualan`
--
ALTER TABLE `detail_retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_stok_opname`
--
ALTER TABLE `detail_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

--
-- AUTO_INCREMENT for table `detail_utang`
--
ALTER TABLE `detail_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_biaya`
--
ALTER TABLE `master_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_coh`
--
ALTER TABLE `master_coh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `master_coh_permintaan`
--
ALTER TABLE `master_coh_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `master_gaji`
--
ALTER TABLE `master_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `master_piutang`
--
ALTER TABLE `master_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_purchase_order`
--
ALTER TABLE `master_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_retur_pembelian`
--
ALTER TABLE `master_retur_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_retur_penjualan`
--
ALTER TABLE `master_retur_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_saldo_awal`
--
ALTER TABLE `master_saldo_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_satuan_barang`
--
ALTER TABLE `master_satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_setting`
--
ALTER TABLE `master_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `master_stok_opname`
--
ALTER TABLE `master_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_utang`
--
ALTER TABLE `master_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_penjualan`
--
ALTER TABLE `temp_tabel_keranjang_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `timeline_po`
--
ALTER TABLE `timeline_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_biaya`
--
ALTER TABLE `detail_biaya`
  ADD CONSTRAINT `master_biaya` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_biaya` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE;

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
