-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2020 at 12:52 AM
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
(1, '96e8lGCs5MuRUaBZ', '2020-02-26 09:26:09', 'KIW123123', 'BAJ0003', 30, 75000, 0, 2250000, '2020-02-26', 30),
(2, '96e8lGCs5MuRUaBZ', '2020-02-26 09:26:15', 'KIW123123', 'SPA0001', 100, 90000, 0, 9000000, '2020-02-26', 100),
(6, 'fVAhvE4tm71LJGjy', '2020-02-27 14:22:23', 'yyryrty', 'BAJ0003', 20, 100000, 0, 2000000, '2020-02-27', 20),
(10, 'HJ1zFNdIC5A3XjwM', '2020-02-28 18:20:47', '123', 'BAJ0003', 20, 1000000, 0, 20000000, '2020-02-27', 20);

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
(1, 'OUT9317802', '2020-02-26 09:24:19', '0000001', 'SPA0001', 40, 100000, 0, 4000000, '2020-02-26'),
(2, 'OUT9317802', '2020-02-26 09:24:35', '0000001', 'BAJ0003', 10, 50000, 0, 500000, '2020-02-26');

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
(1, '2020-02-26', 'KIW/123/123', 'BAJ0003', 30, 75000, 30),
(2, '2020-02-26', 'KIW/123/123', 'SPA0001', 100, 90000, 100),
(3, '2020-02-27', 'yyryrty', 'BAJ0003', 20, 100000, 20);

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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `nomor_faktur` varchar(255) NOT NULL,
  `nominal_pembayaran` double NOT NULL,
  `sisa_utang` double NOT NULL,
  `tanggal` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `gambar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `keterangan` text NOT NULL,
  `status_jual` tinyint(4) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`) VALUES
('BAJ0003', 1, 1, 1, 'EKZ372', 'BAJA RINGAN', 0, 50000, 1, 10, 'FIFO', 0, 'Dg1XlsTrfOywPGvW.jpeg', '', 0, '', '2020-02-27 18:04:54'),
('SPA0001', 1, 1, 1, 'EKZ372', 'SPANDEK B00123', 0, 100000, 1, 10, 'FIFO', 0, 'SPA0001.jpg', '', 0, '', '2020-02-26 08:45:13'),
('SPA0002', 1, 1, 1, 'EKZ372', 'SPANDEK124', 0, 100000, 1, 10, 'FIFO', 0, 'SPA0002.jpg', '', 0, '', '2020-02-26 08:58:26');

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
(1, 'Null', 'TIDAK ADA JENIS', '', 'lucky15', '2020-01-28 14:54:57'),
(2, 'BSI', 'BESI', 'Jenis Barang ', '', '2020-01-05 05:39:41');

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
(1, 'NULL', 'TIDAK ADA MEREK', 'TIDAK ADA MEREK BARANG', '', '2020-01-05 00:00:00'),
(2, 'ATM', 'ANTAM', 'MEREK BESI', '', '2020-01-05 00:00:00'),
(3, 'KTK', 'KERAKATAU STEEL', 'BESI KRAKATAU STEEL', '', '2020-01-05 08:05:10');

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
  `has_user` int(1) NOT NULL DEFAULT 0,
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pegawai`
--

INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gambar`, `has_user`, `user`, `timestamp`) VALUES
(1, '199207152019011001', '3201241241231230011', 'LUCKY', 0, 'SDASDASDASD', 'ASDASDA', 'ASDASDASD', 'ASDASDA', '1992-07-15', '2020-01-01', 'Sarjana', 'Manajer', '08604560', 'BCA - 0468995561', '124124124', 1, '23K1xq4Ft0IQDPYO.png', 1, 'lucky15', '2020-02-18 19:18:12'),
(2, '199207152019011002', '320124124123123', 'DESI E', 0, 'asdlkasjdlkj\r\naskldjlaskjdk\r\naslkdjalskdjl', '', '', '', '1995-08-10', '2020-01-01', 'SARJAN', 'Cashier', '', '124124124', '', 1, 'bYQZxJe2ncz1aPTs.jpg', 1, 'lucky15', '2020-02-18 19:03:04'),
(4, '002', '321412412', 'ASDKJALSKJD', 1, 'PASIR HONJE\r\nPASIR HONJE', 'ASDASD', '40191', 'BANDUNG', '2020-02-12', '2020-02-19', 'ASDASD', 'ASDASD', '124124', 'ASDASD - 124124', '124124', 1, '002.png', 0, 'lucky15', '2020-02-18 19:19:16');

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
(7, '8kons1dF3fS7irNj', '', 'asfasf', '', '', '', '', '', 1, '0000-00-00', ''),
(8, 'WLV7348', 'rekanan', 'PT BESI BAJA MAKMUR', 'asdasdasd', 'asdasd@gmail.com', '123123', '12.312.312.3-123.123', 'BNI-123123-asdasda', 0, '2020-02-26', 'kasir');

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
('96e8lGCs5MuRUaBZ', 'KIW123123', '2020-02-26 09:26:35', 'EKZ372', 11250000, 0, 1125000, 0, 12375000, 'VH7GDNa3PZ9n5kcC.pdf', 1, '2020-02-26', 'desi10'),
('fVAhvE4tm71LJGjy', 'yyryrty', '2020-02-27 14:22:29', 'EKZ372', 2000000, 0, 200000, 0, 2200000, 'BZ1GbVJvWt6pwmgk.pdf', 1, '2020-02-27', 'desi10'),
('HJ1zFNdIC5A3XjwM', '123', '2020-02-28 00:00:00', 'EKO076', 20000000, 0, 2000000, 0, 22000000, 'zZQM3F8aCb2VjWe4.pdf', 0, '2020-02-27', 'desi10');

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
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`) VALUES
(1, 'OUT9317802', '2020-02-26 09:24:49', '0000001', 'WLV7348', 4500000, 0, 450000, 0, 4950000, 1, NULL, '2020-02-26', 'nosales', 'kasir');

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
  `status_po` int(11) NOT NULL DEFAULT 1
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
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(1, 'SPA0001', 'SALDO AWAL', 100, 60, 100000, '2020-02-26 08:48:49', '2020-01-01 00:00:01', 'desi10'),
(2, 'BAJ0003', 'SALDO AWAL', 100, 90, 50000, '2020-02-26 09:12:39', '2020-01-01 00:00:01', 'desi10'),
(3, 'SPA0002', 'SALDO AWAL', 200, 200, 100000, '2020-02-26 09:12:50', '2020-01-01 00:00:01', 'desi10');

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
(1, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gulaasdasda', '', '2020-01-05 08:20:51'),
(2, 'PTG', 'POTONG', '', '', '0000-00-00 00:00:00'),
(3, 'MTR', 'METER', '', '', '0000-00-00 00:00:00'),
(4, 'CM', 'CENTIMETER', 'Untuk alsdklaskdasd', '', '2020-01-04 08:02:14'),
(5, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gula', '', '2020-01-05 05:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `master_setting`
--

CREATE TABLE `master_setting` (
  `id` int(11) NOT NULL,
  `nama_setting` varchar(255) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(8, 'nomor_faktur', '1', '2020-02-25 14:16:01'),
(9, 'catatan_faktur_cash', 'nlknlkn', '2020-02-21 13:16:00'),
(10, 'catatan_faktur_kredit', 'asss', '2020-02-25 06:34:05'),
(11, 'catatan_retur_jual', 'asdasda', '2020-02-24 11:58:09'),
(12, 'catatan_retur_beli', 'asdasda', '2020-02-24 11:58:09'),
(13, 'password_harga', '2', '2020-02-25 08:33:06'),
(14, 'komisi_sales', '0', '2020-02-25 14:41:40'),
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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `isactive` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`) VALUES
('desi10', '199207152019011002', '$2y$10$KaPuBy66KgtWC/gbOFLS/O/XcRisL.DJ3iG249CgA8Qswz5VMbuJW', '2', 'Desi Evilia A', 'avatar-3.jpg', 0, '2020-02-27 14:01:26', '2020-02-15 07:56:40', 1),
('kasir', '002', '$2y$10$6FzZiMgxo3PfDoFRL8nGpegZxgpxNlRNpHpCiAH0qzTVskbXV2ktK', '1', 'Kasir', '', 0, '2020-02-27 14:19:01', '0000-00-00 00:00:00', 1),
('lucky15', '199207152019011001', '$2y$10$Xz9yw5OdntM8OAM6OKkFS.H.p4qss7I5/ybwCT5uWAtXK7bRznxGu', '4', 'Lucky Anggara', 'avatar-2.jpg', 0, '2020-02-27 14:19:42', '2020-02-15 07:59:37', 1);

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
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_utang`
--

INSERT INTO `master_utang` (`id`, `nomor_transaksi`, `tanggal_jatuh_tempo`, `total_tagihan`, `total_pembayaran`, `down_payment`, `sisa_utang`, `tanggal_input`, `user`) VALUES
(1, '123', '2020-03-27', 0, 0, 50000, 21950000, '2020-02-27', 'desi10');

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
(13, 'Laporan', '#', 'fa fa-file-text', ''),
(14, 'Data', '#', 'fa fa-database', 'Kasir'),
(15, 'Keuangan', '#', 'fa fa-money', 'Admin, Supervisor'),
(16, 'Penjualan', '#', 'fa fa-cart-arrow-down', 'Admin'),
(17, 'Persediaan', '#', 'fa fa-window-restore', 'Admin'),
(18, 'Sales', '#', 'fa fa-users', 'Admin'),
(19, 'Pegawai', '#', 'fa fa-users', 'Supervisor'),
(20, 'Settings', 'setting/setting', 'fa fa-gear', 'Manajer'),
(21, 'Transaksi', '#', 'fa fa-money', 'Supervisor');

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
('Almg7XSaH1Lq0fnR', 2000000, 0, 200000, 0, 2200000, '2020-02-27 17:19:11'),
('Dv4JF0gfWXnwHmTo', 200000, 0, 20000, 0, 220000, '2020-02-27 17:13:15'),
('fVAhvE4tm71LJGjy', 2000000, 0, 200000, 0, 2200000, '2020-02-27 13:22:26'),
('HJ1zFNdIC5A3XjwM', 20000000, 0, 2000000, 0, 22000000, '2020-02-27 17:20:49'),
('I3DwjqS0po7lHbxB', 20000000, 0, 2000000, 0, 22000000, '2020-02-27 17:16:26'),
('oGvyeScZBAm4b19X', 10000000, 0, 1000000, 0, 11000000, '2020-02-26 11:13:17'),
('OUT1960475', 175000000, 0, 17500000, 0, 192500000, '2020-02-20 07:23:46'),
('OUT8074695', 250000000, 10000000, 24000000, 0, 264000000, '2020-02-20 07:25:10'),
('OUT9604258', 50000000, 100000, 0, 0, 49900000, '2020-02-20 07:20:40'),
('plGiIZWUjEBg7RPD', 8000000, 30000, 797000, 0, 8767000, '2020-02-27 13:20:40');

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
(4, 'Supervisor', '6,21,9,15,19'),
(5, 'Manager', '7,11,12,20'),
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
(31, '12', 'Insentif Sales', 'manajemen_pegawai/insentifsales', 'Manajer Insentif Sales'),
(32, '21', 'Daftar Transaksi Penjualan', 'manajemen_penjualan/daftartransaksipenjualan', ''),
(33, '21', 'Daftar Transaksi Pembelian', 'manajemen_pembelian/daftartransaksipembelian', '');

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
  `status` int(11) NOT NULL DEFAULT 0
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

--
-- Dumping data for table `temp_tabel_keranjang_pembelian`
--

INSERT INTO `temp_tabel_keranjang_pembelian` (`id`, `tanggal_transaksi`, `no_order_pembelian`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(7, '2020-02-26 12:13:13', 'oGvyeScZBAm4b19X', 'BAJ0003', 50, 200000, 0, 10000000, '2020-02-26');

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
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  ADD UNIQUE KEY `no_faktur` (`nomor_transaksi`),
  ADD KEY `no_faktur_2` (`nomor_transaksi`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_persediaan`
--
ALTER TABLE `detail_persediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `master_harga_pokok_penjualan`
--
ALTER TABLE `master_harga_pokok_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_insentif`
--
ALTER TABLE `master_insentif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_merek_barang`
--
ALTER TABLE `master_merek_barang`
  MODIFY `id_merek_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_pegawai`
--
ALTER TABLE `master_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_penjualan`
--
ALTER TABLE `master_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_satuan_barang`
--
ALTER TABLE `master_satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_setting`
--
ALTER TABLE `master_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master_stok_opname`
--
ALTER TABLE `master_stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_utang`
--
ALTER TABLE `master_utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tabel_role`
--
ALTER TABLE `tabel_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_submenu`
--
ALTER TABLE `tabel_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `temp_purchase_order`
--
ALTER TABLE `temp_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `temp_tabel_keranjang_pembelian`
--
ALTER TABLE `temp_tabel_keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `master_utang` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_utang` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

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
