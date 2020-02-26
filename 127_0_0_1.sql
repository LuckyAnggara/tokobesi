-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 09:36 AM
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

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`, `saldo`) VALUES
(1, '96e8lGCs5MuRUaBZ', '2020-02-26 09:26:09', 'KIW/123/123', 'BAJ0003', 30, 75000, 0, 2250000, '2020-02-26', 30),
(2, '96e8lGCs5MuRUaBZ', '2020-02-26 09:26:15', 'KIW/123/123', 'SPA0001', 100, 90000, 0, 9000000, '2020-02-26', 100);

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES
(1, 'OUT9317802', '2020-02-26 09:24:19', '0000001', 'SPA0001', 40, 100000, 0, 4000000, '2020-02-26'),
(2, 'OUT9317802', '2020-02-26 09:24:35', '0000001', 'BAJ0003', 10, 50000, 0, 500000, '2020-02-26');

--
-- Dumping data for table `detail_persediaan`
--

INSERT INTO `detail_persediaan` (`id`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah`, `harga_beli`, `saldo`) VALUES
(1, '2020-02-26', 'KIW/123/123', 'BAJ0003', 30, 75000, 30),
(2, '2020-02-26', 'KIW/123/123', 'SPA0001', 100, 90000, 100);

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`) VALUES
('BAJ0003', 1, 1, 1, 'EKZ372', 'BAJA RINGAN', 0, 50000, 0, 10, 'FIFO', 0, 'BAJ0003.jpg', '', 0, '', '2020-02-26 09:05:27'),
('SPA0001', 1, 1, 1, 'EKZ372', 'SPANDEK B00123', 0, 100000, 0, 10, 'FIFO', 0, 'SPA0001.jpg', '', 0, '', '2020-02-26 08:45:13'),
('SPA0002', 1, 1, 1, 'EKZ372', 'SPANDEK124', 0, 100000, 0, 10, 'FIFO', 0, 'SPA0002.jpg', '', 0, '', '2020-02-26 08:58:26');

--
-- Dumping data for table `master_harga_pokok_penjualan`
--

INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `harga_pokok`, `harga_jual`, `keterangan`) VALUES
(1, '2020-02-26 09:24:49', '0000001', 'SPA0001', 60, 100000, 100000, 'FIFO'),
(2, '2020-02-26 09:24:49', '0000001', 'BAJ0003', 90, 50000, 50000, 'FIFO');

--
-- Dumping data for table `master_jenis_barang`
--

INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES
(0, 'Null', 'TIDAK ADA JENIS', '', 'lucky15', '2020-01-28 14:54:57'),
(1, 'BSI', 'BESI', 'Jenis Barang ', '', '2020-01-05 05:39:41');

--
-- Dumping data for table `master_merek_barang`
--

INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES
(0, 'NULL', 'TIDAK ADA MEREK', 'TIDAK ADA MEREK BARANG', '', '2020-01-05 00:00:00'),
(1, 'ATM', 'ANTAM', 'MEREK BESI', '', '2020-01-05 00:00:00'),
(6, 'KTK', 'KERAKATAU STEEL', 'BESI KRAKATAU STEEL', '', '2020-01-05 08:05:10');

--
-- Dumping data for table `master_pegawai`
--

INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gambar`, `has_user`, `user`, `timestamp`) VALUES
(1, '199207152019011001', '3201241241231230011', 'LUCKY', 0, 'SDASDASDASD', 'ASDASDA', 'ASDASDASD', 'ASDASDA', '1992-07-15', '2020-01-01', 'Sarjana', 'Manajer', '08604560', 'BCA - 0468995561', '124124124', 1, '23K1xq4Ft0IQDPYO.png', 1, 'lucky15', '2020-02-19 02:18:12'),
(2, '199207152019011002', '320124124123123', 'DESI E', 0, 'asdlkasjdlkj\r\naskldjlaskjdk\r\naslkdjalskdjl', '', '', '', '1995-08-10', '2020-01-01', 'SARJAN', 'Cashier', '', '124124124', '', 1, 'bYQZxJe2ncz1aPTs.jpg', 1, 'lucky15', '2020-02-19 02:03:04'),
(4, '002', '321412412', 'ASDKJALSKJD', 1, 'PASIR HONJE\r\nPASIR HONJE', 'ASDASD', '40191', 'BANDUNG', '2020-02-12', '2020-02-19', 'ASDASD', 'ASDASD', '124124', 'ASDASD - 124124', '124124', 1, '002.png', 0, 'lucky15', '2020-02-19 02:19:16');

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

--
-- Dumping data for table `master_pembelian`
--

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_input`, `user`) VALUES
('96e8lGCs5MuRUaBZ', 'KIW/123/123', '2020-02-26 09:26:35', 'EKZ372', 11250000, 0, 1125000, 0, 12375000, 1, '2020-02-26', 'desi10');

--
-- Dumping data for table `master_penjualan`
--

INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`) VALUES
(1, 'OUT9317802', '2020-02-26 09:24:49', '0000001', 'WLV7348', 4500000, 0, 450000, 0, 4950000, 1, NULL, '2020-02-26', 'nosales', 'kasir');

--
-- Dumping data for table `master_saldo_awal`
--

INSERT INTO `master_saldo_awal` (`id`, `kode_barang`, `nomor_faktur`, `qty_awal`, `saldo_awal`, `harga_awal`, `tanggal_input`, `tanggal_saldo`, `user`) VALUES
(1, 'SPA0001', 'SALDO AWAL', 100, 60, 100000, '2020-02-26 08:48:49', '2020-01-01 00:00:01', 'desi10'),
(2, 'BAJ0003', 'SALDO AWAL', 100, 90, 50000, '2020-02-26 09:12:39', '2020-01-01 00:00:01', 'desi10'),
(3, 'SPA0002', 'SALDO AWAL', 200, 200, 100000, '2020-02-26 09:12:50', '2020-01-01 00:00:01', 'desi10');

--
-- Dumping data for table `master_satuan_barang`
--

INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES
(0, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gulaasdasda', '', '2020-01-05 08:20:51'),
(1, 'PTG', 'POTONG', '', '', '0000-00-00 00:00:00'),
(2, 'MTR', 'METER', '', '', '0000-00-00 00:00:00'),
(3, 'CM', 'CENTIMETER', 'Untuk alsdklaskdasd', '', '2020-01-04 08:02:14'),
(4, 'PCS', 'PIECES', 'Untuk produk satuan seperti Gula', '', '2020-01-05 05:24:09');

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
(8, 'nomor_faktur', '2', '2020-02-25 08:36:01'),
(9, 'catatan_faktur_cash', 'nlknlkn', '2020-02-21 13:16:00'),
(10, 'catatan_faktur_kredit', 'asss', '2020-02-25 06:34:05'),
(11, 'catatan_retur_jual', 'asdasda', '2020-02-24 11:58:09'),
(12, 'catatan_retur_beli', 'asdasda', '2020-02-24 11:58:09'),
(13, 'password_harga', '2', '2020-02-25 08:33:06'),
(14, 'komisi_sales', '0.5', '2020-02-25 08:34:06'),
(15, 'notifikasi', '1', '2020-02-25 08:50:23'),
(16, 'frekuensi_notifikasi', '', '2020-02-25 08:38:12');

--
-- Dumping data for table `master_supplier`
--

INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES
('EKO076', 'PT JAYA MAKMUR', 'aksdjlkasjdlkasjdlkaj\r\nasdasdasd\r\nasdasdasdasd', '921839018239081', '12.983.910.2-839.012', 'BCA-192839128-Lucky', 'asdasdasd', '', '2020-01-16 14:43:17'),
('EKZ372', 'GENERAL VENDOR', 'General Vendor', '0', '00.000.000.0-000.000', '--0--', 'General Vendor', '', '2020-01-16 14:43:50'),
('QHQ851', 'PTP', 'TPPTPTTPPTPTPTPT', '123012301203', '11.111.111.1-111.111', 'BCA-12310230122-1231231231', 'paspdapdasdasdasda', '', '2020-01-05 06:26:04');

--
-- Dumping data for table `master_tipe_barang`
--

INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`, `user`, `timestamp`) VALUES
(1, 'INVENTORY', 'TIPE UNTUK BARANG YANG DIJUAL', '', '2020-01-25 03:59:03'),
(2, 'NON-INVENTORY', 'TIPE UNTUK BARANG YANG TIDAK DIJUAL, CONTOH PERALATAN KANTOR', '', '2020-01-25 03:59:03'),
(3, 'JASA', 'TIPE BARANG YANG TIDAK BERUPA, SEPERTI JASA PENGANTAR BARANG, JASA RAKITAN', '', '2020-01-25 03:59:03'),
(4, 'RAKITAN', 'TIPE BARANG BUNDLING, SEPERTI PAKET SEMABAKO', '', '2020-01-25 03:59:03');

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`) VALUES
('desi10', '199207152019011002', '$2y$10$KaPuBy66KgtWC/gbOFLS/O/XcRisL.DJ3iG249CgA8Qswz5VMbuJW', '2', 'Desi Evilia A', 'avatar-3.jpg', 0, '2020-02-26 09:27:06', '2020-02-15 07:56:40', 1),
('kasir', '002', '$2y$10$6FzZiMgxo3PfDoFRL8nGpegZxgpxNlRNpHpCiAH0qzTVskbXV2ktK', '1', 'Kasir', '', 0, '2020-02-26 09:27:13', '0000-00-00 00:00:00', 1),
('lucky15', '199207152019011001', '$2y$10$Xz9yw5OdntM8OAM6OKkFS.H.p4qss7I5/ybwCT5uWAtXK7bRznxGu', '4', 'Lucky Anggara', 'avatar-2.jpg', 0, '2020-02-26 09:32:02', '2020-02-15 07:59:37', 1);

--
-- Dumping data for table `setting_perusahaan`
--

INSERT INTO `setting_perusahaan` (`id`, `nama_perusahaan`, `alamat_perusahaan`, `nomor_telepon`, `nomor_fax`, `alamat_email`, `logo_perusahaan`, `prefix_faktur`, `note_faktur_jual`, `note_faktur_beli`, `insentif`, `note_faktur_jual_kredit`, `note_retur_faktur_jual`) VALUES
(1, 'PT. BERKAH BAJA MAKMUR', 'JL. RAYA BANDUNG TASIK LIMBANGAN TIMUR\r\nGARUT, JAWA BARAT', '082119349199', '-', 'berkahbajamakmur@gmail.com', 'logo-perusahaan.png', 'BBM', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0.5, '', '');

--
-- Dumping data for table `tabel_diskon`
--

INSERT INTO `tabel_diskon` (`id`, `kode_diskon`, `potongan`, `jumlah_diskon`, `keterangan`) VALUES
(1, 'HAYU10', 10, 10, 'POTONGAN DISKON 10 Persen');

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
(20, 'Settings', 'setting/setting', 'fa fa-gear', 'Manajer');

--
-- Dumping data for table `tabel_perhitungan_order`
--

INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES
('96e8lGCs5MuRUaBZ', 11250000, 0, 1125000, 0, 12375000, '2020-02-26 08:26:20'),
('OUT1960475', 175000000, 0, 17500000, 0, 192500000, '2020-02-20 07:23:46'),
('OUT8074695', 250000000, 10000000, 24000000, 0, 264000000, '2020-02-20 07:25:10'),
('OUT9604258', 50000000, 100000, 0, 0, 49900000, '2020-02-20 07:20:40');

--
-- Dumping data for table `tabel_role`
--

INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES
(1, 'Kasir', '4,1,14'),
(2, 'Admin', '5,16,2,18,17,10,15'),
(3, 'Sales', '3,8'),
(4, 'Supervisor', '6,9,15,19'),
(5, 'Manager', '7,11,12,20'),
(6, 'Superuser', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20');

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
(31, '12', 'Insentif Sales', 'manajemen_pegawai/insentifsales', 'Manajer Insentif Sales');

--
-- Dumping data for table `temp_purchase_order`
--

INSERT INTO `temp_purchase_order` (`id`, `no_order`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`, `user`, `status`) VALUES
(209, 'PO.200220001', 'B001', 200, 2500000, 0, 500000000, '2020-02-20 08:08:36', 'lucky15', 2),
(210, 'PO.200220001', 'B001', 100, 2500000, 100000, 249900000, '2020-02-20 08:08:49', 'lucky15', 2);

--
-- Dumping data for table `timeline_po`
--

INSERT INTO `timeline_po` (`id`, `no_order`, `urutan`, `tanggal`, `pesan`, `user`) VALUES
(36, 'PO.090220001', 1, '2020-02-09 09:59:56', 'xvsdg', 'lucky15'),
(39, 'PO.190220001', 1, '2020-02-19 08:20:19', 'proses min', 'lucky15'),
(40, 'PO.190220001', 2, '2020-02-19 08:30:49', '<span class=\"text-success\">Approve</span><br>', 'desi10'),
(41, 'PO.200220001', 1, '2020-02-20 08:09:34', 'proses yap', 'lucky15'),
(42, 'PO.200220001', 2, '2020-02-20 08:10:30', '<span class=\"text-success\">Approve</span><br>', 'desi10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
