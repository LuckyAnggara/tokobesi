-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2020 at 09:24 AM
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
('desi10', '199207152019011002', '$2y$10$KaPuBy66KgtWC/gbOFLS/O/XcRisL.DJ3iG249CgA8Qswz5VMbuJW', '2', 'Desi Evilia A', 'avatar-3.jpg', 0, '2020-02-24 08:39:44', '2020-02-15 07:56:40', 1),
('kasir', '002', '$2y$10$6FzZiMgxo3PfDoFRL8nGpegZxgpxNlRNpHpCiAH0qzTVskbXV2ktK', '1', 'Kasir', '', 0, '2020-02-24 09:23:34', '0000-00-00 00:00:00', 1),
('lucky15', '199207152019011001', '$2y$10$Xz9yw5OdntM8OAM6OKkFS.H.p4qss7I5/ybwCT5uWAtXK7bRznxGu', '3', 'Lucky Anggara', 'avatar-2.jpg', 0, '2020-02-24 08:20:11', '2020-02-15 07:59:37', 1);

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
(18, 'Sales', '#', 'fa fa-users', 'Admin');

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
(4, 'Supervisor', '6,9,12'),
(5, 'Manager', '7,11,12'),
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
(25, '12', 'Insentif Sales', 'manajemen_pegawai/insentifsales', 'Supervisor Insentif Sales'),
(26, '8', 'Daftar Purchase Order', 'manajemen_penjualan/purchaseordersales/daftar', 'Sales Daftar P.O'),
(27, '8', 'Purchase Order', 'manajemen_penjualan/purchaseordersales', 'Sales P.O'),
(28, '8', 'Insentif', 'manajemen_sales/insentif', 'Sales Insentif Monitor'),
(29, '15', 'Master Piutang', 'manajemen_keuangan/masterpiutang/daftar_piutang', 'Admin Master Piutang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tabel_role`
--
ALTER TABLE `tabel_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_submenu`
--
ALTER TABLE `tabel_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_user`
--
ALTER TABLE `master_user`
  ADD CONSTRAINT `nip` FOREIGN KEY (`nip`) REFERENCES `master_pegawai` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
