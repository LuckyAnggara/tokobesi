#
# TABLE STRUCTURE FOR: detail_biaya
#

DROP TABLE IF EXISTS `detail_biaya`;

CREATE TABLE `detail_biaya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_jurnal` varchar(255) NOT NULL,
  `kategori_biaya` int(11) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_transaksi` (`nomor_jurnal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: detail_coh
#

DROP TABLE IF EXISTS `detail_coh`;

CREATE TABLE `detail_coh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_referensi` varchar(255) NOT NULL,
  `saldo` double NOT NULL,
  `nominal` double NOT NULL,
  `jenis` int(1) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `master_coh` (`nomor_referensi`),
  CONSTRAINT `master_coh` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_coh` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (30, '1', '10000000', '10000000', 1, 'Saldo Awal Penarikan', '2020-03-16 07:09:38');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (31, '2', '1000000', '1000000', 1, 'Saldo Awal Penarikan', '2020-03-16 07:29:55');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (32, '1', '9000000', '1000000', 2, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-16 07:29:55');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (33, '2', '4000000', '3000000', 1, 'Penambahan dana', '2020-03-16 08:25:00');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (34, '1', '6000000', '3000000', 2, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-16 08:25:00');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (35, '2', '3000000', '1000000', 1, 'Penyetoran dana', '2020-03-16 08:32:28');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (36, '1', '7000000', '1000000', 1, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-16 08:32:28');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (37, '1', '2000000', '5000000', 2, 'Penyetoran dana', '2020-03-16 08:38:04');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (38, '1', '5000000', '3000000', 1, 'Penambahan dana', '2020-03-16 09:13:23');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (39, '1', '6000000', '1000000', 1, 'Penambahan dana', '2020-03-16 09:59:41');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (40, '1', '3000000', '3000000', 2, 'Penyetoran dana', '2020-03-16 10:05:11');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (41, '2', '6000000', '3000000', 1, 'Penambahan dana', '2020-03-16 10:19:57');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (42, '1', '0', '3000000', 2, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-16 10:19:57');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (43, '2', '1000000', '5000000', 2, 'Penyetoran dana', '2020-03-16 10:48:27');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (44, '1', '5000000', '5000000', 4, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-16 10:48:27');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (45, '2', '0', '1000000', 2, 'Penyetoran dana', '2020-03-18 03:26:19');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (46, '1', '6000000', '1000000', 4, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-18 03:26:19');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (47, '1', '0', '6000000', 2, 'Penyetoran dana', '2020-03-18 03:58:25');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (48, '3', '20000000', '20000000', 1, 'Saldo Awal Penarikan', '2020-03-18 04:00:11');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (49, '4', '1000000', '1000000', 1, 'Saldo Awal Penarikan', '2020-03-18 04:01:14');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (50, '3', '19000000', '1000000', 3, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-18 04:01:14');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (51, '4', '4000000', '3000000', 1, 'Penambahan dana', '2020-03-18 05:09:22');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (52, '3', '16000000', '3000000', 2, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-18 05:09:23');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (53, '5', '2000000', '2000000', 1, 'Saldo Awal Penarikan', '2020-03-18 05:36:55');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (54, '3', '14000000', '2000000', 3, 'Penarikan dana Oleh DESI', '2020-03-18 05:36:55');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (61, '5', '6000000', '4000000', 1, 'Transfer Dana dari LUCKY ANGGARA', '2020-03-18 07:21:31');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (62, '4', '0', '4000000', 2, 'Transfer dana ke DESI', '2020-03-18 07:21:31');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (63, '4', '2000000', '2000000', 1, 'Transfer Dana dari DESI', '2020-03-18 07:24:02');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (64, '5', '4000000', '2000000', 2, 'Transfer dana ke LUCKY ANGGARA', '2020-03-18 07:24:02');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (65, '5', '5000000', '1000000', 1, 'Transfer Dana dari LUCKY ANGGARA', '2020-03-18 07:34:17');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (66, '4', '1000000', '1000000', 2, 'Transfer dana ke DESI', '2020-03-18 07:34:17');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (67, '5', '5500000', '500000', 1, 'Transfer Dana dari LUCKY ANGGARA', '2020-03-18 07:37:00');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (68, '4', '500000', '500000', 2, 'Transfer dana ke DESI', '2020-03-18 07:37:00');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (69, '4', '5500000', '5000000', 1, 'Transfer Dana dari DESI', '2020-03-18 07:38:27');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (70, '5', '500000', '5000000', 2, 'Transfer dana ke LUCKY ANGGARA', '2020-03-18 07:38:27');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (71, '5', '5500000', '5000000', 1, 'Transfer Dana dari LUCKY ANGGARA', '2020-03-18 07:39:59');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (72, '4', '500000', '5000000', 2, 'Transfer dana ke DESI', '2020-03-18 07:39:59');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (73, '4', '3500000', '3000000', 1, 'Transfer Dana dari DESI', '2020-03-18 07:40:47');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (74, '5', '2500000', '3000000', 2, 'Transfer dana ke LUCKY ANGGARA', '2020-03-18 07:40:47');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (75, '5', '6000000', '3500000', 1, 'Transfer Dana dari LUCKY ANGGARA', '2020-03-18 07:41:51');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (76, '4', '0', '3500000', 2, 'Transfer dana ke DESI', '2020-03-18 07:41:51');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (77, '4', '6000000', '6000000', 1, 'Transfer Dana dari DESI', '2020-03-18 07:45:44');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (78, '5', '0', '6000000', 2, 'Transfer dana ke LUCKY ANGGARA', '2020-03-18 07:45:44');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (79, '5', '3000000', '3000000', 1, 'Transfer Dana dari LUCKY ANGGARA', '2020-03-18 07:46:28');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (80, '4', '3000000', '3000000', 2, 'Transfer dana ke DESI', '2020-03-18 07:46:28');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (81, '4', '3900000', '900000', 1, 'Transfer Dana dari DESI', '2020-03-18 07:48:19');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (82, '5', '2100000', '900000', 2, 'Transfer dana ke LUCKY ANGGARA', '2020-03-18 07:48:19');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (83, '5', '6000000', '3900000', 1, 'Transfer Dana dari LUCKY ANGGARA', '2020-03-18 07:49:30');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (84, '4', '0', '3900000', 2, 'Transfer dana ke DESI', '2020-03-18 07:49:30');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (85, '5', '6726000', '726000', 1, 'Penjualan Cash Nomor Faktur : bbmkdr180320003', '2020-03-18 09:28:58');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (86, '5', '0', '6726000', 2, 'Penyetoran dana', '2020-03-19 03:53:57');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (87, '3', '20726000', '6726000', 1, 'Dana di setorkan oleh DESI', '2020-03-19 03:53:58');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (88, '3', '0', '20726000', 2, 'Penyetoran dana', '2020-03-19 03:55:20');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (89, '6', '10000000', '10000000', 1, 'Saldo Awal Penarikan', '2020-03-19 03:56:36');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (96, '6', '5000000', '5000000', 2, 'Debet Biaya LISTRIK Nomor Jurnal :#19032041', '2020-03-19 09:12:27');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (101, '6', '8500000', '3500000', 1, 'Pengembalian Biaya LISTRIK Nomor Jurnal :#19032041', '2020-03-19 09:23:33');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (102, '7', '5000000', '5000000', 1, 'Saldo Awal', '2020-03-19 10:00:25');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (103, '6', '3500000', '5000000', 3, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-19 10:00:26');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (104, '7', '0', '5000000', 2, 'Penyetoran dana', '2020-03-20 02:06:41');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (105, '6', '8500000', '5000000', 1, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-20 02:06:41');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (106, '6', '0', '8500000', 2, 'Penyetoran dana', '2020-03-20 02:07:35');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (107, '8', '10000000', '10000000', 1, 'Saldo Awal', '2020-03-20 02:11:43');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (108, '9', '2000000', '2000000', 1, 'Saldo Awal', '2020-03-20 02:12:22');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (109, '8', '8000000', '2000000', 3, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-20 02:12:22');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (111, '9', '2660000', '660000', 1, 'Penjualan Cash Nomor Faktur : bbmkdr200320002', '2020-03-20 06:04:39');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (112, '9', '3650000', '990000', 1, 'Penjualan Cash Nomor Faktur : bbmkdr200320002', '2020-03-20 06:10:19');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (113, '9', '4475000', '825000', 1, 'Penjualan Cash Nomor Faktur : bbmkdr200320003', '2020-03-20 06:10:49');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (114, '9', '4715000', '240000', 1, 'Penjualan Cash Nomor Faktur : bbmkdr200320001', '2020-03-20 10:41:09');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (115, '9', '5915000', '1200000', 1, 'Penjualan Cash Nomor Faktur : bbmkdr200320002', '2020-03-20 10:48:14');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (116, '9', '7595000', '1680000', 1, 'Penjualan Cash Nomor Faktur : bbmkdr200320003', '2020-03-20 11:40:33');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (117, '9', '0', '7595000', 2, 'Penyetoran dana', '2020-03-21 04:53:50');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (118, '8', '15595000', '7595000', 1, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-21 04:53:50');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (119, '8', '0', '15595000', 2, 'Penyetoran dana', '2020-03-21 04:54:20');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (120, '10', '1000000', '1000000', 1, 'Saldo Awal', '2020-03-21 15:09:00');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (121, '11', '500000', '500000', 1, 'Saldo Awal', '2020-03-21 15:15:39');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (122, '10', '500000', '500000', 3, 'Penarikan dana Oleh LUCKY ANGGARA', '2020-03-21 15:15:39');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (123, '11', '600000', '100000', 1, 'Penjualan Kredit Nomor Faktur : bbmkdr210320004', '2020-03-21 15:16:40');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (124, '11', '0', '600000', 2, 'Penyetoran dana', '2020-03-22 04:30:06');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (125, '10', '1100000', '600000', 1, 'Dana di setorkan oleh LUCKY ANGGARA', '2020-03-22 04:30:06');
INSERT INTO `detail_coh` (`id`, `nomor_referensi`, `saldo`, `nominal`, `jenis`, `keterangan`, `tanggal_input`) VALUES (126, '10', '0', '1100000', 2, 'Penyetoran dana', '2020-03-22 04:50:24');


#
# TABLE STRUCTURE FOR: detail_detail_stok_opname
#

DROP TABLE IF EXISTS `detail_detail_stok_opname`;

CREATE TABLE `detail_detail_stok_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_detail_stok_opname` int(10) NOT NULL,
  `qty` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `detail_detail_stok_opname` (`id`, `id_detail_stok_opname`, `qty`, `keterangan`) VALUES (1, 386, '0', '');
INSERT INTO `detail_detail_stok_opname` (`id`, `id_detail_stok_opname`, `qty`, `keterangan`) VALUES (2, 388, '3', 'Rusak');


#
# TABLE STRUCTURE FOR: detail_gaji
#

DROP TABLE IF EXISTS `detail_gaji`;

CREATE TABLE `detail_gaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_referensi` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `gaji_pokok` double NOT NULL,
  `uang_makan` double NOT NULL,
  `bonus` double NOT NULL,
  `total` double NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `master_gaji` (`nomor_referensi`),
  CONSTRAINT `master_gaji` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_gaji` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: detail_pembelian
#

DROP TABLE IF EXISTS `detail_pembelian`;

CREATE TABLE `detail_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_order_pembelian` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL,
  `saldo` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_pembelian` (`nomor_transaksi`),
  CONSTRAINT `pembelian` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_pembelian` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`, `saldo`) VALUES (111, 'tgEjyDVuIn5azWFB', '2020-03-07 00:00:00', 'kredit', 'BES0001', '100', '15000', '0', '1500000', '2020-03-20', '0');
INSERT INTO `detail_pembelian` (`id`, `no_order_pembelian`, `tanggal_transaksi`, `nomor_transaksi`, `kode_barang`, `jumlah_pembelian`, `harga_beli`, `diskon`, `total_harga`, `tanggal_input`, `saldo`) VALUES (112, 'dL2UcZKEwjqNDBsv', '2020-03-08 00:00:00', 'ya', 'BES0001', '50', '16000', '0', '800000', '2020-03-20', '0');


#
# TABLE STRUCTURE FOR: detail_penjualan
#

DROP TABLE IF EXISTS `detail_penjualan`;

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_order_penjualan` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_penjualan` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan` (`nomor_faktur`),
  KEY `nomor_faktur` (`nomor_faktur`),
  CONSTRAINT `penjualan` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES (34, 'OUT6592834', '2020-03-17 10:41:03', 'bbmkdr200320001', 'BES0001', '10', '24000', '0', '240000', '2020-03-20');
INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES (35, 'OUT2895167', '2020-03-20 10:48:03', 'bbmkdr200320002', 'BES0001', '50', '24000', '0', '1200000', '2020-03-20');
INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES (36, 'OUT5823746', '2020-03-20 11:40:26', 'bbmkdr200320003', 'BES0001', '70', '24000', '0', '1680000', '2020-03-20');
INSERT INTO `detail_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `jumlah_penjualan`, `harga_jual`, `diskon`, `total_harga`, `tanggal_input`) VALUES (37, 'OUT5469721', '2020-03-21 15:16:22', 'bbmkdr210320004', 'BES0001', '20', '24000', '0', '480000', '2020-03-21');


#
# TABLE STRUCTURE FOR: detail_persediaan
#

DROP TABLE IF EXISTS `detail_persediaan`;

CREATE TABLE `detail_persediaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `saldo` double NOT NULL,
  `debit` double NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES (16, 'BES0001', 'kredit', 'pembelian_bersih', '15000', '100', '0', '2020-03-07 00:00:00');
INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES (17, 'BES0001', 'bbmkdr200320001', 'pembelian_bersih', '15000', '90', '10', '2020-03-20 10:41:09');
INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES (18, 'BES0001', 'bbmkdr200320002', 'pembelian_bersih', '15000', '40', '50', '2020-03-20 10:48:13');
INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES (19, 'BES0001', 'ya', 'pembelian_bersih', '16000', '50', '0', '2020-03-08 00:00:00');
INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES (20, 'BES0001', 'bbmkdr200320003', 'pembelian_bersih', '15000', '0', '70', '2020-03-20 11:40:33');
INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES (21, 'BES0001', 'bbmkdr200320003', 'pembelian_bersih', '16000', '20', '70', '2020-03-20 11:40:33');
INSERT INTO `detail_persediaan` (`id`, `kode_barang`, `nomor_transaksi`, `jenis_barang`, `harga_pokok`, `saldo`, `debit`, `tanggal_transaksi`) VALUES (22, 'BES0001', 'bbmkdr210320004', 'pembelian_bersih', '16000', '0', '20', '2020-03-21 15:16:40');


#
# TABLE STRUCTURE FOR: detail_piutang
#

DROP TABLE IF EXISTS `detail_piutang`;

CREATE TABLE `detail_piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_faktur` varchar(255) NOT NULL,
  `nominal_pembayaran` double NOT NULL,
  `sisa_piutang` double NOT NULL,
  `tanggal` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `master_piutang` (`nomor_faktur`),
  CONSTRAINT `master_piutang` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_piutang` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `detail_piutang` (`id`, `nomor_faktur`, `nominal_pembayaran`, `sisa_piutang`, `tanggal`, `user`, `bukti`, `keterangan`, `timestamp`) VALUES (1, 'bbmkdr210320004', '100000', '380000', '2020-03-21 15:16:40', 'lucky15', '1', 'Down Payment', '2020-03-21 21:16:40');


#
# TABLE STRUCTURE FOR: detail_retur_barang_pembelian
#

DROP TABLE IF EXISTS `detail_retur_barang_pembelian`;

CREATE TABLE `detail_retur_barang_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `saldo_tersedia` double NOT NULL,
  `saldo_retur` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: detail_retur_barang_penjualan
#

DROP TABLE IF EXISTS `detail_retur_barang_penjualan`;

CREATE TABLE `detail_retur_barang_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `harga_pokok` double NOT NULL,
  `saldo_tersedia` double NOT NULL,
  `saldo_retur` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `master_retur` (`nomor_faktur`),
  CONSTRAINT `master_retur` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_retur_penjualan` (`nomor_faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `detail_retur_barang_penjualan` (`id`, `nomor_faktur`, `kode_barang`, `harga_pokok`, `saldo_tersedia`, `saldo_retur`, `keterangan`, `user`, `tanggal_input`, `tanggal_transaksi`) VALUES (13, 'RTR-bbmkdr200320001', 'BES0001', '15000', '3', '3', 'RTR-bbmkdr200320001 - Cacat', 'manajer', '2020-03-20 12:13:34', '2020-03-17 10:41:09');


#
# TABLE STRUCTURE FOR: detail_retur_pembelian
#

DROP TABLE IF EXISTS `detail_retur_pembelian`;

CREATE TABLE `detail_retur_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_detail_pembelian` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `jumlah_retur` double NOT NULL,
  `harga_retur` double NOT NULL,
  `diskon` double NOT NULL,
  `total_retur` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `retur_master` (`nomor_transaksi`),
  CONSTRAINT `master` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_retur_pembelian` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: detail_retur_penjualan
#

DROP TABLE IF EXISTS `detail_retur_penjualan`;

CREATE TABLE `detail_retur_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `retur_master` (`nomor_faktur`),
  CONSTRAINT `retur_master` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_retur_penjualan` (`nomor_faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO `detail_retur_penjualan` (`id`, `id_detail_penjualan`, `nomor_faktur`, `kode_barang`, `keterangan`, `jumlah_retur`, `saldo`, `harga_retur`, `diskon`, `total_retur`, `user`, `tanggal`, `tanggal_transaksi`) VALUES (18, 34, 'RTR-bbmkdr200320001', 'BES0001', 'Cacat', '3', '0', '24000', '0', '72000', 'dini', '2020-03-20 18:13:34', '2020-03-17 10:41:09');


#
# TABLE STRUCTURE FOR: detail_stok_opname
#

DROP TABLE IF EXISTS `detail_stok_opname`;

CREATE TABLE `detail_stok_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_referensi` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `saldo_buku` double NOT NULL,
  `saldo_fisik` double NOT NULL,
  `selisih` double NOT NULL,
  `koreksi` double NOT NULL,
  `nomor_referensi_detail` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stokopname` (`nomor_referensi`),
  CONSTRAINT `stokopname` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_stok_opname` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=449 DEFAULT CHARSET=latin1;

INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (385, 'REF5732941', '2020-03-09 00:00:00', 'BES0001', '10', '10', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (386, 'REF5732941', '2020-03-09 00:00:00', 'BES0002', '5', '10', '-5', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (387, 'REF5732941', '2020-03-09 00:00:00', 'BES0003', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (388, 'REF5732941', '2020-03-09 00:00:00', 'BES0004', '30', '27', '3', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (389, 'REF5732941', '2020-03-09 00:00:00', 'BES0005', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (390, 'REF5732941', '2020-03-09 00:00:00', 'BES0006', '20', '20', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (391, 'REF5732941', '2020-03-09 00:00:00', 'BES0007', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (392, 'REF5732941', '2020-03-09 00:00:00', 'BES0008', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (393, 'REF5732941', '2020-03-09 00:00:00', 'BES0064', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (394, 'REF5732941', '2020-03-09 00:00:00', 'BON0009', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (395, 'REF5732941', '2020-03-09 00:00:00', 'BON0010', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (396, 'REF5732941', '2020-03-09 00:00:00', 'BON0011', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (397, 'REF5732941', '2020-03-09 00:00:00', 'BON0012', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (398, 'REF5732941', '2020-03-09 00:00:00', 'BON0013', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (399, 'REF5732941', '2020-03-09 00:00:00', 'BON0014', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (400, 'REF5732941', '2020-03-09 00:00:00', 'BON0015', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (401, 'REF5732941', '2020-03-09 00:00:00', 'BON0016', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (402, 'REF5732941', '2020-03-09 00:00:00', 'CNP0017', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (403, 'REF5732941', '2020-03-09 00:00:00', 'CNP0018', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (404, 'REF5732941', '2020-03-09 00:00:00', 'CNP0019', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (405, 'REF5732941', '2020-03-09 00:00:00', 'CNP0020', '20', '20', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (406, 'REF5732941', '2020-03-09 00:00:00', 'CNP0021', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (407, 'REF5732941', '2020-03-09 00:00:00', 'CNP0022', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (408, 'REF5732941', '2020-03-09 00:00:00', 'DEM0023', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (409, 'REF5732941', '2020-03-09 00:00:00', 'DEM0024', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (410, 'REF5732941', '2020-03-09 00:00:00', 'DEM0025', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (411, 'REF5732941', '2020-03-09 00:00:00', 'DEM0026', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (412, 'REF5732941', '2020-03-09 00:00:00', 'DEM0027', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (413, 'REF5732941', '2020-03-09 00:00:00', 'DIN0028', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (414, 'REF5732941', '2020-03-09 00:00:00', 'DIN0029', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (415, 'REF5732941', '2020-03-09 00:00:00', 'DIN0030', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (416, 'REF5732941', '2020-03-09 00:00:00', 'DIN0031', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (417, 'REF5732941', '2020-03-09 00:00:00', 'DIN0032', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (418, 'REF5732941', '2020-03-09 00:00:00', 'GEN0033', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (419, 'REF5732941', '2020-03-09 00:00:00', 'GEN0034', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (420, 'REF5732941', '2020-03-09 00:00:00', 'GEN0035', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (421, 'REF5732941', '2020-03-09 00:00:00', 'GEN0036', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (422, 'REF5732941', '2020-03-09 00:00:00', 'GEN0063', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (423, 'REF5732941', '2020-03-09 00:00:00', 'HOL0037', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (424, 'REF5732941', '2020-03-09 00:00:00', 'HOL0038', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (425, 'REF5732941', '2020-03-09 00:00:00', 'KAW0040', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (426, 'REF5732941', '2020-03-09 00:00:00', 'KAW0041', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (427, 'REF5732941', '2020-03-09 00:00:00', 'KAW0042', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (428, 'REF5732941', '2020-03-09 00:00:00', 'KIN0043', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (429, 'REF5732941', '2020-03-09 00:00:00', 'KIN0044', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (430, 'REF5732941', '2020-03-09 00:00:00', 'PAP0039', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (431, 'REF5732941', '2020-03-09 00:00:00', 'SKR0045', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (432, 'REF5732941', '2020-03-09 00:00:00', 'SKR0046', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (433, 'REF5732941', '2020-03-09 00:00:00', 'SKR0047', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (434, 'REF5732941', '2020-03-09 00:00:00', 'SKR0048', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (435, 'REF5732941', '2020-03-09 00:00:00', 'SPA0049', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (436, 'REF5732941', '2020-03-09 00:00:00', 'SPA0050', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (437, 'REF5732941', '2020-03-09 00:00:00', 'SPA0051', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (438, 'REF5732941', '2020-03-09 00:00:00', 'SPA0052', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (439, 'REF5732941', '2020-03-09 00:00:00', 'SPA0053', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (440, 'REF5732941', '2020-03-09 00:00:00', 'SPA0054', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (441, 'REF5732941', '2020-03-09 00:00:00', 'SPA0055', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (442, 'REF5732941', '2020-03-09 00:00:00', 'SPA0056', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (443, 'REF5732941', '2020-03-09 00:00:00', 'WD0057', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (444, 'REF5732941', '2020-03-09 00:00:00', 'WD0058', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (445, 'REF5732941', '2020-03-09 00:00:00', 'WIR0059', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (446, 'REF5732941', '2020-03-09 00:00:00', 'WIR0060', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (447, 'REF5732941', '2020-03-09 00:00:00', 'WIR0061', '0', '0', '0', '0', '', 'dini');
INSERT INTO `detail_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `kode_barang`, `saldo_buku`, `saldo_fisik`, `selisih`, `koreksi`, `nomor_referensi_detail`, `user`) VALUES (448, 'REF5732941', '2020-03-09 00:00:00', 'WIR0062', '0', '0', '0', '0', '', 'dini');


#
# TABLE STRUCTURE FOR: detail_utang
#

DROP TABLE IF EXISTS `detail_utang`;

CREATE TABLE `detail_utang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(255) NOT NULL,
  `nominal_pembayaran` double NOT NULL,
  `sisa_utang` double NOT NULL,
  `tanggal` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `master_piutang` (`nomor_transaksi`),
  CONSTRAINT `master_utang` FOREIGN KEY (`nomor_transaksi`) REFERENCES `master_utang` (`nomor_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: harga_detail_pembelian
#

DROP TABLE IF EXISTS `harga_detail_pembelian`;

CREATE TABLE `harga_detail_pembelian` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `harga` double NOT NULL,
  `sisa` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_barang
#

DROP TABLE IF EXISTS `master_barang`;

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
  `is_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_barang`),
  KEY `tipe_barang` (`tipe_barang`,`jenis_barang`,`merek_barang`),
  KEY `satuan` (`kode_satuan`),
  KEY `merek_barang_join` (`merek_barang`),
  KEY `jenis_barang_join` (`jenis_barang`),
  KEY `kode_supplier` (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0001', 1, 3, 4, 'BIR674', 'BESI BETON POLOS 6 KBM', '17404', '24000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-03-01 04:15:57', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0002', 1, 3, 5, 'FCL359', 'BESI BETON POLOS 8 BEH', '28568', '33000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0003', 1, 3, 6, 'FCL359', 'BESI BETON POLOS 8 KZBM', '26568', '30000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0004', 1, 3, 4, 'OCZ285', 'BESI BETON POLOS 8 KBM', '27188', '33000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0005', 1, 3, 4, 'OCZ285', 'BESI BETON POLOS 10 KBM', '39262', '55000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0006', 1, 3, 7, 'HWI209', 'BESI BETON POLOS 12 DAS', '56175', '72000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0007', 1, 3, 8, 'HWI209', 'BESI BETON ULIR 13 YES', '74375', '89250', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0008', 1, 3, 7, 'HWI209', 'BESI BETON ULIR 16 DAS', '101650', '122000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BES0064', 1, 3, 9, 'BIR674', 'BESI BBM PUNYA', '0', '20000', '19000', '18000', 6, 0, 'FIFO', '0', 'BES0064.jpg', 'besi produksi besi baja makmur', 0, 'edwin', '2020-03-01 07:01:56', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0009', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ MTR', '66040', '81000', '0', '0', 7, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 1);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0010', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ 4 MTR', '264160', '324000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0011', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ 5MTR', '330200', '405000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0012', 1, 5, 9, 'BIR674', 'BONDECK 0.65 tl@ 6MTR', '396240', '486000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0013', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ 4MTR', '275880', '340000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0014', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ 5 MTR', '344850', '425000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0015', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ 6 MTR', '413820', '510000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('BON0016', 1, 5, 9, 'BIR674', 'BONDECK 0.70 tl@ MTR', '68970', '85000', '0', '0', 7, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('CNP0017', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.55 mm', '41820', '49500', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('CNP0018', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.60 mm', '45750', '51500', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('CNP0019', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.65 mm', '44240', '55500', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('CNP0020', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.70 mm', '47730', '61500', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('CNP0021', 1, 6, 10, 'BIR674', 'CNP 75/35 TL 0.75 mm', '54625', '64000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('CNP0022', 1, 6, 10, 'BIR674', 'CNP 75/35 TL  1.0 mm', '76101', '98000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DEM0023', 1, 7, 11, 'SMV257', 'DEMPUL ISAMU 1 KG', '53500', '64000', '0', '0', 9, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DEM0024', 1, 7, 11, 'SMV257', 'DEMPUL ISAMU 1/4 KG', '20500', '25000', '0', '0', 9, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DEM0025', 1, 7, 12, 'SMV257', 'DEMPUL SANPOLAC 1 KG', '36500', '43800', '0', '0', 9, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DEM0026', 1, 7, 12, 'SMV257', 'DEMPUL SANPOLAC 1/4 KG', '15500', '19000', '0', '0', 9, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DEM0027', 1, 7, 12, 'SMV257', 'DEMPUL SANPOLAC GALON', '122500', '147000', '0', '0', 9, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DIN0028', 1, 8, 13, 'SMV257', 'DINABOLT 10X50', '700', '850', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DIN0029', 1, 8, 13, 'SMV257', 'DINABOLT 10X65', '806', '1000', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DIN0030', 1, 8, 13, 'SMV257', 'DINABOLT 10X77', '962', '1500', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DIN0031', 1, 8, 13, 'SMV257', 'DINABOLT 8X40', '1087', '2000', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('DIN0032', 1, 8, 13, 'SMV257', 'DINABOLT 8X65', '1279', '2000', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('GEN0033', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR COKLAT', '15625', '24000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('GEN0034', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR HIJAU', '15625', '24000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('GEN0035', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR HITAM', '15625', '24000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('GEN0036', 1, 9, 9, 'BIR674', 'GENTENG METAL PASIR MERAH', '15625', '24000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('GEN0063', 1, 9, 1, 'BIR674', 'GENTENG', '0', '14000', '15000', '16000', 6, 10, 'FIFO', '0', 'GEN0063.jpg', '', 0, 'edwin', '2020-03-01 06:22:42', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('HOL0037', 1, 10, 9, 'BIR674', 'HOLLO PLAFON 2X4', '9576', '15000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('HOL0038', 1, 10, 9, 'BIR674', 'HOLLO PLAFON 4X4', '12768', '18000', '0', '0', 6, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('KAW0040', 1, 12, 15, 'BMX310', 'KAWAT LAS RD 260 @ 2.6 mm', '42000', '0', '0', '0', 10, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('KAW0041', 1, 12, 15, 'BMX310', 'KAWAT LAS RD 260 @ 2.0 mm', '115000', '132000', '0', '0', 10, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('KAW0042', 1, 17, 16, 'HWI209', 'KAWAT TALI BETON ', '60000', '69000', '0', '0', 12, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('KIN0043', 1, 13, 17, 'BMX310', 'KINIK 14\"', '11787', '14000', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('KIN0044', 1, 13, 17, 'BMX310', 'KINIK 4X8', '35000', '40250', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('PAP0039', 1, 11, 14, 'XQO406', 'PAPAN GPYSUM 9mm x 1200mm x 2400 mm', '7000', '8500', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SKR0045', 1, 14, 18, 'ESF053', 'SKRUP RENG 10 X 16', '107', '150', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SKR0046', 1, 14, 18, 'ESF053', 'SKRUP BAJA 10 X 19', '117', '200', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SKR0047', 1, 14, 18, 'ESF053', 'SKRUP GYPSUM 1\"', '46', '75', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SKR0048', 1, 14, 18, 'ESF053', 'SKRUP GYPSUM 1. 1/4\"', '76', '85', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0049', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ mtr', '27010', '34000', '0', '0', 7, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0050', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ 4 MTR', '108040', '136000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0051', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ 5 MTR', '135050', '170000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0052', 1, 15, 9, 'BIR674', 'SPANDECK 0.25 x 1000 tl@ 6 MTR', '162060', '204000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0053', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@ 4 MTR', '135240', '172000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0054', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@ 5 MTR', '169050', '215000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0055', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@ 6 MTR', '202860', '258000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('SPA0056', 1, 15, 9, 'BIR674', 'SPANDECK 0.30 x 1000 tl@mtr', '33810', '43000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('WD0057', 1, 13, 19, 'BIR674', 'WD 4\"', '2300', '4000', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('WD0058', 1, 13, 19, 'BIR674', 'WD 14\"', '26000', '30000', '0', '0', 11, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('WIR0059', 1, 16, 1, 'DDW516', 'Wire Mesh M6 ', '176457', '240000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('WIR0060', 1, 16, 1, 'DDW516', 'Wire Mesh M8 K', '278080', '400000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('WIR0061', 1, 16, 1, 'DDW516', 'Wire Mesh M8 B ', '328182', '440000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);
INSERT INTO `master_barang` (`kode_barang`, `tipe_barang`, `jenis_barang`, `merek_barang`, `kode_supplier`, `nama_barang`, `harga_pokok`, `harga_satuan`, `harga_kedua`, `harga_ketiga`, `kode_satuan`, `persediaan_minimum`, `metode_hpp`, `komisi_sales`, `gambar`, `keterangan`, `status_jual`, `user`, `tanggal_input`, `is_delete`) VALUES ('WIR0062', 1, 16, 1, 'DDW516', 'Wire Mesh M10', '485894', '730000', '0', '0', 8, 0, 'FIFO', '0', 'default.jpg', '', 0, 'supervisor', '2020-02-29 00:00:00', 0);


#
# TABLE STRUCTURE FOR: master_biaya
#

DROP TABLE IF EXISTS `master_biaya`;

CREATE TABLE `master_biaya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_referensi` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_biaya` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_referensi` (`nomor_referensi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_coh
#

DROP TABLE IF EXISTS `master_coh`;

CREATE TABLE `master_coh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_referensi` varchar(255) NOT NULL,
  `nomor_referensi_spv` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `saldo_awal` double NOT NULL,
  `saldo_proses` double NOT NULL,
  `saldo_akhir` double NOT NULL,
  `status` int(1) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_referensi` (`nomor_referensi`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (18, '1', '', 'edwin', 4, '10000000', '0', '0', 2, 'alksadkl a\r\nsdasdka;lsdj\r\naskjdlaksdasd', '2020-03-16 07:09:23');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (19, '2', '1', 'lucky15', 1, '1000000', '0', '0', 2, 'sadasdasd', '2020-03-16 07:15:44');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (20, '3', '', 'edwin', 4, '20000000', '0', '0', 2, 'ALSKDLKASLD', '2020-03-18 03:59:52');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (21, '4', '3', 'lucky15', 1, '1000000', '0', '0', 2, 'asdasd', '2020-03-18 04:00:56');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (22, '5', '3', 'desi', 1, '2000000', '0', '0', 2, 'sadasd', '2020-03-18 05:36:34');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (23, '6', '', 'edwin', 4, '10000000', '0', '0', 2, 'hari kamis wfh', '2020-03-19 03:56:21');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (24, '7', '6', 'lucky15', 1, '5000000', '0', '0', 2, '', '2020-03-19 09:39:09');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (25, '8', '', 'edwin', 4, '10000000', '0', '0', 2, 'asdasdasd', '2020-03-20 02:11:28');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (26, '9', '8', 'lucky15', 1, '2000000', '0', '0', 2, 'asdasdas', '2020-03-20 02:12:02');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (27, '10', '', 'edwin', 4, '1000000', '0', '0', 2, 'sdsdf', '2020-03-21 15:08:41');
INSERT INTO `master_coh` (`id`, `nomor_referensi`, `nomor_referensi_spv`, `user`, `level`, `saldo_awal`, `saldo_proses`, `saldo_akhir`, `status`, `keterangan`, `tanggal_input`) VALUES (33, '11', '10', 'lucky15', 1, '500000', '0', '0', 2, '', '2020-03-21 15:14:49');


#
# TABLE STRUCTURE FOR: master_coh_permintaan
#

DROP TABLE IF EXISTS `master_coh_permintaan`;

CREATE TABLE `master_coh_permintaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_referensi` varchar(255) NOT NULL,
  `nominal` double NOT NULL,
  `jenis_permintaan` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  `spv` varchar(255) NOT NULL,
  `approval` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nomor_referensi` (`nomor_referensi`),
  CONSTRAINT `coh` FOREIGN KEY (`nomor_referensi`) REFERENCES `master_coh` (`nomor_referensi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (56, '2', '0', 5, 99, 'lucky15', 'edwin', 'edwin', 2, '2020-03-18 03:50:20');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (57, '2', '0', 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-18 03:56:25');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (58, '1', '6000000', 2, 2, 'edwin', '', 'manajer', 3, '2020-03-18 03:57:58');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (59, '1', '0', 5, 2, 'edwin', '', 'manajer', 3, '2020-03-18 03:59:17');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (60, '3', '20000000', 3, 2, 'edwin', '', 'manajer', 3, '2020-03-18 03:59:52');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (61, '4', '1000000', 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-18 04:00:56');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (62, '4', '3000000', 1, 2, 'lucky15', 'edwin', 'edwin', 1, '2020-03-18 05:09:02');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (63, '5', '2000000', 3, 2, 'desi', 'edwin', 'edwin', 2, '2020-03-18 05:36:34');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (65, '5', '4000000', 1, 2, 'desi', 'lucky15', 'lucky15', 1, '2020-03-18 06:13:57');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (66, '4', '2000000', 1, 2, 'lucky15', 'desi', 'desi', 1, '2020-03-18 07:23:40');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (67, '5', '1000000', 1, 2, 'desi', 'lucky15', 'lucky15', 1, '2020-03-18 07:33:51');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (68, '5', '500000', 1, 2, 'desi', 'lucky15', 'lucky15', 1, '2020-03-18 07:36:40');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (69, '4', '5000000', 1, 2, 'lucky15', 'desi', 'desi', 1, '2020-03-18 07:37:58');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (70, '5', '5000000', 1, 2, 'desi', 'lucky15', 'lucky15', 1, '2020-03-18 07:39:23');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (71, '4', '3000000', 1, 2, 'lucky15', 'desi', 'desi', 1, '2020-03-18 07:40:16');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (72, '5', '3500000', 1, 2, 'desi', 'lucky15', 'lucky15', 1, '2020-03-18 07:41:25');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (73, '4', '5500000', 1, 99, 'lucky15', 'desi', 'desi', 1, '2020-03-18 07:42:24');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (74, '4', '6000000', 1, 2, 'lucky15', 'desi', 'desi', 1, '2020-03-18 07:45:12');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (75, '5', '3000000', 1, 2, 'desi', 'lucky15', 'lucky15', 1, '2020-03-18 07:46:04');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (76, '4', '900000', 1, 2, 'lucky15', 'desi', 'desi', 1, '2020-03-18 07:47:46');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (77, '5', '3900000', 1, 2, 'desi', 'lucky15', 'lucky15', 1, '2020-03-18 07:48:46');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (78, '4', '0', 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-18 07:49:43');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (79, '5', '6726000', 2, 2, 'desi', 'edwin', 'edwin', 2, '2020-03-19 03:53:37');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (80, '5', '0', 5, 2, 'desi', 'edwin', 'edwin', 2, '2020-03-19 03:54:17');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (81, '3', '20726000', 2, 2, 'edwin', '', 'manajer', 3, '2020-03-19 03:54:56');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (82, '3', '0', 5, 2, 'edwin', '', 'manajer', 3, '2020-03-19 03:55:41');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (83, '6', '10000000', 3, 2, 'edwin', '', 'manajer', 3, '2020-03-19 03:56:21');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (84, '7', '5000000', 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-19 09:39:09');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (85, '7', '5000000', 2, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-20 02:06:23');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (86, '6', '8500000', 2, 2, 'edwin', '', 'manajer', 3, '2020-03-20 02:07:01');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (87, '7', '0', 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-20 02:07:17');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (88, '6', '0', 5, 2, 'edwin', '', 'manajer', 3, '2020-03-20 02:10:52');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (89, '8', '10000000', 3, 2, 'edwin', '', 'manajer', 3, '2020-03-20 02:11:28');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (90, '9', '2000000', 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-20 02:12:02');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (91, '9', '7595000', 2, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-21 04:53:20');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (92, '8', '15595000', 2, 2, 'edwin', '', 'manajer', 3, '2020-03-21 04:53:59');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (93, '9', '0', 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-21 04:54:46');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (94, '8', '0', 5, 2, 'edwin', '', 'manajer', 3, '2020-03-21 04:55:17');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (95, '10', '1000000', 3, 2, 'edwin', '', 'manajer', 3, '2020-03-21 15:08:41');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (96, '11', '500000', 3, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-21 15:14:49');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (97, '11', '600000', 2, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-22 04:29:33');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (98, '10', '600000', 2, 99, 'edwin', '', 'manajer', 3, '2020-03-22 04:30:27');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (99, '11', '0', 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-22 04:47:16');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (100, '10', '1100000', 2, 2, 'edwin', '', 'manajer', 3, '2020-03-22 04:49:56');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (101, '10', '0', 5, 2, 'edwin', '', 'manajer', 3, '2020-03-22 04:50:40');
INSERT INTO `master_coh_permintaan` (`id`, `nomor_referensi`, `nominal`, `jenis_permintaan`, `status`, `user`, `spv`, `approval`, `level`, `tanggal`) VALUES (102, '11', '0', 5, 2, 'lucky15', 'edwin', 'edwin', 2, '2020-03-22 04:53:29');


#
# TABLE STRUCTURE FOR: master_gaji
#

DROP TABLE IF EXISTS `master_gaji`;

CREATE TABLE `master_gaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `nomor_referensi` varchar(255) NOT NULL,
  `total_pembayaran` double NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_referensi` (`nomor_referensi`),
  KEY `nomor_referensi_2` (`nomor_referensi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_harga_pokok_penjualan
#

DROP TABLE IF EXISTS `master_harga_pokok_penjualan`;

CREATE TABLE `master_harga_pokok_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` datetime NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `sisa` double NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_jual` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nomor_faktur` (`nomor_faktur`),
  CONSTRAINT `hpp` FOREIGN KEY (`nomor_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `sisa`, `harga_pokok`, `harga_jual`, `keterangan`, `jenis_barang`) VALUES (48, '2020-03-17 10:41:09', 'bbmkdr200320001', 'BES0001', '10', '90', '15000', '24000', 'FIFO', 'pembelian_bersih');
INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `sisa`, `harga_pokok`, `harga_jual`, `keterangan`, `jenis_barang`) VALUES (49, '2020-03-20 10:48:13', 'bbmkdr200320002', 'BES0001', '50', '40', '15000', '24000', 'FIFO', 'pembelian_bersih');
INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `sisa`, `harga_pokok`, `harga_jual`, `keterangan`, `jenis_barang`) VALUES (50, '2020-03-20 11:40:33', 'bbmkdr200320003', 'BES0001', '40', '0', '15000', '24000', 'FIFO', 'pembelian_bersih');
INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `sisa`, `harga_pokok`, `harga_jual`, `keterangan`, `jenis_barang`) VALUES (51, '2020-03-20 11:40:33', 'bbmkdr200320003', 'BES0001', '30', '20', '16000', '24000', 'FIFO', 'pembelian_bersih');
INSERT INTO `master_harga_pokok_penjualan` (`id`, `tanggal_transaksi`, `nomor_faktur`, `kode_barang`, `qty`, `sisa`, `harga_pokok`, `harga_jual`, `keterangan`, `jenis_barang`) VALUES (52, '2020-03-21 15:16:40', 'bbmkdr210320004', 'BES0001', '20', '0', '16000', '24000', 'FIFO', 'pembelian_bersih');


#
# TABLE STRUCTURE FOR: master_insentif
#

DROP TABLE IF EXISTS `master_insentif`;

CREATE TABLE `master_insentif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_faktur` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `gross_penjualan` double NOT NULL,
  `insentif` double NOT NULL,
  `total_insentif` double NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nomor_faktur` (`nomor_faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_jenis_barang
#

DROP TABLE IF EXISTS `master_jenis_barang`;

CREATE TABLE `master_jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis_barang` varchar(128) NOT NULL,
  `nama_jenis_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`id_jenis_barang`),
  UNIQUE KEY `kode_jenis` (`kode_jenis_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (3, 'BB', 'BESI BETON', 'jenis barang besi beton', 'supervisor', '2020-02-29 08:36:26');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (5, 'FD', 'FLOORDECK', 'untuk jenis barang floordeck', 'supervisor', '2020-02-29 08:36:31');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (6, 'BR', 'BAJA RINGAN', 'Jenis Barang baja ringan', 'supervisor', '2020-02-29 08:36:36');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (7, 'DEMP', 'DEMPUL', 'jenis barang dempul', 'supervisor', '2020-02-29 08:35:12');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (8, 'BAUD', 'BAUD', 'jenis barang baud', 'supervisor', '2020-02-29 08:35:26');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (9, 'GTG', 'GENTENG', 'jenis barang genteng', 'supervisor', '2020-02-29 08:36:42');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (10, 'HL', 'HOLLO', 'jenis barang hollo', 'supervisor', '2020-02-29 08:36:46');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (11, 'GYP', 'GYPSUM', 'jenis barang gypsum', 'supervisor', '2020-02-29 08:36:22');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (12, 'KL', 'KAWAT LAS', 'jenis barang kawat las', 'supervisor', '2020-02-29 08:37:06');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (13, 'BP', 'BATU POTONG', 'jenis barang batu potong', 'supervisor', '2020-02-29 08:37:21');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (14, 'SKR', 'SKRUP', 'jenis barang skrup', 'supervisor', '2020-02-29 08:37:37');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (15, 'AR', 'ATAP RINGAN', 'jenis barang atap ringan', 'supervisor', '2020-02-29 08:38:00');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (16, 'WM', 'WIREMESH', 'jenis barang wiremesh', 'supervisor', '2020-02-29 08:38:11');
INSERT INTO `master_jenis_barang` (`id_jenis_barang`, `kode_jenis_barang`, `nama_jenis_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (17, 'KB', 'KAWAT BETON', 'untuk jenis kawat beton', 'supervisor', '2020-02-29 10:02:56');


#
# TABLE STRUCTURE FOR: master_kartu_persediaan
#

DROP TABLE IF EXISTS `master_kartu_persediaan`;

CREATE TABLE `master_kartu_persediaan` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jumlah` double NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_kategori_biaya
#

DROP TABLE IF EXISTS `master_kategori_biaya`;

CREATE TABLE `master_kategori_biaya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_biaya` varchar(255) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `master_kategori_biaya` (`id`, `nama_biaya`, `keterangan`, `user`, `tanggal_input`, `status`) VALUES (1, 'LISTRIK', 'Untuk kateg', 'edwin', '2020-03-04 07:50:39', 0);
INSERT INTO `master_kategori_biaya` (`id`, `nama_biaya`, `keterangan`, `user`, `tanggal_input`, `status`) VALUES (2, 'Air', 'Untuk kategori biaya air', 'edwin', '2020-03-04 08:00:51', 1);
INSERT INTO `master_kategori_biaya` (`id`, `nama_biaya`, `keterangan`, `user`, `tanggal_input`, `status`) VALUES (3, 'ONGKOS', 'asdasd', 'edwin', '2020-03-04 07:53:21', 0);


#
# TABLE STRUCTURE FOR: master_merek_barang
#

DROP TABLE IF EXISTS `master_merek_barang`;

CREATE TABLE `master_merek_barang` (
  `id_merek_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_merek_barang` varchar(128) NOT NULL,
  `nama_merek_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`id_merek_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (1, 'NONE', 'TANPA MEREK', '', 'supervisor', '2020-02-29 00:00:00');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (4, 'KBM', 'KBM', '', 'supervisor', '2020-02-29 08:38:31');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (5, 'BEH', 'BEH', '', 'supervisor', '2020-02-29 08:38:41');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (6, 'KZBM', 'KZBM', '', 'supervisor', '2020-02-29 08:38:49');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (7, 'DAS', 'DAS', '', 'supervisor', '2020-02-29 08:38:57');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (8, 'YES', 'YES', '', 'supervisor', '2020-02-29 08:39:02');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (9, 'BBM', 'BBM', '', 'supervisor', '2020-02-29 08:39:08');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (10, 'BBMT', 'BBM TRUSS', '', 'supervisor', '2020-02-29 08:39:26');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (11, 'ISAMU', 'ISAMU', '', 'supervisor', '2020-02-29 08:39:36');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (12, 'SANPOLAC', 'SANPOLAC', '', 'supervisor', '2020-02-29 08:39:48');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (13, 'WOWO', 'WOWO', '', 'supervisor', '2020-02-29 08:39:58');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (14, 'APLUS', 'APLUS', '', 'supervisor', '2020-02-29 08:40:17');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (15, 'NS', 'NIKO STEEL', '', 'supervisor', '2020-02-29 08:40:29');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (16, 'BWG21', 'BWG 21', '', 'supervisor', '2020-02-29 08:41:37');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (17, 'KINIK', 'KINIK', '', 'supervisor', '2020-02-29 08:41:50');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (18, 'PROFIT', 'PROFIT', '', 'supervisor', '2020-02-29 08:41:59');
INSERT INTO `master_merek_barang` (`id_merek_barang`, `kode_merek_barang`, `nama_merek_barang`, `keterangan`, `user`, `tanggal_input`) VALUES (19, 'WD', 'WD', '', 'supervisor', '2020-02-29 08:42:12');


#
# TABLE STRUCTURE FOR: master_pegawai
#

DROP TABLE IF EXISTS `master_pegawai`;

CREATE TABLE `master_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES (1, '1', '0', 'Neng Yuliantin', 1, 'Jl Raya Limbangan', '', '', 'Garut', '2018-12-01', '2020-02-01', '', 'Direktur', '0', '0-0', '0', 1, '50000', '10000', 'SpDT0P752ut6lZHE.jpeg', 1, '', '2020-03-03 19:42:02');
INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES (10, '123123123', '123123123123', 'LUCKY ANGGARA', 0, 'BANDUNG', 'BANDUNG', 'BANDUNG', 'BANDUNG', '1992-07-15', '2020-03-01', 'SARJANA', 'KASIR', '082116562811', 'BNI - 0468995561', '12312312312', 1, '100000', '10000', '123123123.jpg', 1, 'manajer', '2020-03-06 15:05:49');
INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES (11, '124124', '1241241', 'DINI', 1, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-18', '2020-03-01', 'SMA', 'ADMIN', '08800', 'BNI - 080808', '123123', 1, '50000', '10000', 'default.jpg', 1, 'manajer', '2020-03-18 11:34:29');
INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES (12, '21124124', '124124124', 'HADI', 0, 'GARUT', 'GARUT', 'GARUT', 'GARUT', '2020-03-09', '2020-03-01', 'SARJANA', 'SALES', '0808080', 'ASAS - 54654654', '21313', 1, '50000', '10000', '21124124.jpg', 1, 'manajer', '2020-03-02 19:53:43');
INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES (13, '123123', '1231231', 'EDWIN', 0, 'JAKARTA', 'JAKARTA', 'JAKARTA', 'JAKARTA', '2020-03-26', '2020-03-01', 'MAGISTER', 'SUPERVISOR', '9128491248', 'BA - 31231', '213123', 1, '50000', '10000', '123123.jpg', 1, 'manajer', '2020-03-02 13:07:10');
INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES (14, '647476', '54345354354', 'GJHGJHG', 0, 'HGDGHDHGD', 'GDGFDGFQ', 'HGDGHDH', 'DGFDGFD', '2020-03-20', '2020-03-06', 'GFHGFG', 'GDGHDHG', '67456456', 'GFHGF - 345354', '564564654564', 1, '23424', '24324324', '647476.png', 0, 'manajer', '2020-03-06 15:08:10');
INSERT INTO `master_pegawai` (`id`, `nip`, `ktp`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `tanggal_lahir`, `tanggal_masuk`, `pendidikan_terakhir`, `jabatan`, `nomor_telepon`, `nomor_rekening`, `npwp`, `status`, `gaji_pokok`, `uang_makan`, `gambar`, `has_user`, `user`, `timestamp`) VALUES (15, '1111', '123123', 'DESI', 1, '123123', '12312', '3123', '123', '2020-03-16', '2020-03-18', '123123', 'KASIR', '123123', 'BNI - 123123', 'ASDASD', 1, '50000', '10000', 'default.jpg', 1, 'manajer', '2020-03-18 11:34:35');


#
# TABLE STRUCTURE FOR: master_pelanggan
#

DROP TABLE IF EXISTS `master_pelanggan`;

CREATE TABLE `master_pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (1, 'E9DrUzjt8lAcsNu0', '', 'lucky', 'asda', '', 'asd', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (2, 'pbhy78RH0NqfY5GF', '', '22', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (4, 'hZonWQIws8NtPmlX', '', 'aa', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (5, 'fL3ly8wOgdNBTQci', '', 'aa', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (6, 'U3iRGhTn6uSaCMO2', '', 'aa', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (7, '8tA0scwEmXOUYvrW', '', 'aa', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (8, 'Q3mdZwEsM1KUxgoX', '', 'aa', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (9, 'R2TQ3USPsE16cmfb', '', '11', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (10, 'GT6C8eShvuR2irLY', '', 'aa', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (11, '1S0xEKIjTJOfZL5P', '', 'asd', '', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (12, 'DiF5zgx8ujn04kZK', '', 'desi', '12312', '', '123', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (13, 'XyFxLKNV4wduO526', '', 'Lucky', 'asdasdasdasd', '', '2141241', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (14, 'HWW1875', 'general', 'AAAAA', '11', 'aaa@gmail.com', '111', '11.111.111.1-111.111', '111-111111-111', 0, '2020-03-05', 'lucky15');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (15, '7FIhWcKzNrqiEOnf', '', 'sdasd', 'asdasd', '', '', '', '', 1, '0000-00-00', '');
INSERT INTO `master_pelanggan` (`id`, `id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`, `npwp`, `nomor_rekening`, `status_pelanggan`, `tanggal_input`, `user`) VALUES (16, 'SM1QV09uoD5NF3HE', '', 'Lucky', 'asd', '', '', '', '', 1, '0000-00-00', '');


#
# TABLE STRUCTURE FOR: master_pembelian
#

DROP TABLE IF EXISTS `master_pembelian`;

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
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`no_order_pembelian`),
  UNIQUE KEY `nomor_transaksi` (`nomor_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `lampiran`, `status_bayar`, `tanggal_input`, `user`) VALUES ('dL2UcZKEwjqNDBsv', 'ya', '2020-03-08 00:00:00', 'BIR674', '800000', '0', '0', '0', '800000', '', 1, '2020-03-20', 'dini');
INSERT INTO `master_pembelian` (`no_order_pembelian`, `nomor_transaksi`, `tanggal_transaksi`, `kode_supplier`, `total_pembelian`, `diskon`, `pajak_keluaran`, `ongkir`, `grand_total`, `lampiran`, `status_bayar`, `tanggal_input`, `user`) VALUES ('tgEjyDVuIn5azWFB', 'kredit', '2020-03-07 00:00:00', 'BIR674', '1500000', '0', '0', '0', '1500000', '', 1, '2020-03-20', 'dini');


#
# TABLE STRUCTURE FOR: master_penjualan
#

DROP TABLE IF EXISTS `master_penjualan`;

CREATE TABLE `master_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `no_polisi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_faktur` (`no_faktur`),
  UNIQUE KEY `no_order_penjualan` (`no_order_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`, `no_polisi`) VALUES (26, 'OUT6592834', '2020-03-17 10:41:09', 'bbmkdr200320001', 'HWW1875', '240000', '0', '0', '0', '240000', 1, NULL, '2020-03-20', 'nosales', 'lucky15', '');
INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`, `no_polisi`) VALUES (27, 'OUT2895167', '2020-03-20 10:48:13', 'bbmkdr200320002', '7FIhWcKzNrqiEOnf', '1200000', '0', '0', '0', '1200000', 1, NULL, '2020-03-20', 'nosales', 'lucky15', '');
INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`, `no_polisi`) VALUES (28, 'OUT5823746', '2020-03-20 11:40:33', 'bbmkdr200320003', 'SM1QV09uoD5NF3HE', '1680000', '0', '0', '0', '1680000', 1, NULL, '2020-03-20', 'nosales', 'lucky15', '');
INSERT INTO `master_penjualan` (`id`, `no_order_penjualan`, `tanggal_transaksi`, `no_faktur`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `status_bayar`, `tanggal_jatuh_tempo`, `tanggal_input`, `sales`, `user`, `no_polisi`) VALUES (29, 'OUT5469721', '2020-03-21 15:16:40', 'bbmkdr210320004', 'HWW1875', '480000', '0', '0', '0', '480000', 0, NULL, '2020-03-21', 'nosales', 'lucky15', '');


#
# TABLE STRUCTURE FOR: master_persediaan
#

DROP TABLE IF EXISTS `master_persediaan`;

CREATE TABLE `master_persediaan` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(128) NOT NULL,
  `jumlah_persediaan` double NOT NULL,
  `jumlah_keranjang` double NOT NULL,
  `jumlah_persediaan_sementara` double NOT NULL COMMENT 'temporary jumlah persediaan setelah di pesan',
  `tanggal_input` datetime NOT NULL,
  `no_order_terakhir` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_piutang
#

DROP TABLE IF EXISTS `master_piutang`;

CREATE TABLE `master_piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_tagihan` double NOT NULL,
  `total_pembayaran` double NOT NULL,
  `down_payment` double NOT NULL DEFAULT '0',
  `sisa_piutang` double NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_faktur` (`no_faktur`),
  KEY `no_faktur_2` (`no_faktur`),
  CONSTRAINT `master_penjualan` FOREIGN KEY (`no_faktur`) REFERENCES `master_penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `master_piutang` (`id`, `no_faktur`, `tanggal_jatuh_tempo`, `total_tagihan`, `total_pembayaran`, `down_payment`, `sisa_piutang`, `tanggal_input`, `user`) VALUES (1, 'bbmkdr210320004', '2020-04-25', '480000', '100000', '100000', '380000', '2020-03-21', 'lucky15');


#
# TABLE STRUCTURE FOR: master_purchase_order
#

DROP TABLE IF EXISTS `master_purchase_order`;

CREATE TABLE `master_purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status_po` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_po` (`no_order`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `master_purchase_order` (`id`, `tanggal_transaksi`, `no_order`, `sales`, `id_pelanggan`, `total_penjualan`, `diskon`, `pajak_masukan`, `ongkir`, `grand_total`, `tanggal_input`, `user`, `admin`, `status_po`) VALUES (1, '0000-00-00 00:00:00', 'PO.090320001', 'hadi', 'HWW1875', '525000', '0', '52500', '0', '577500', '2020-03-20 02:12:55', 'hadi', 'dini', 99);


#
# TABLE STRUCTURE FOR: master_retur_pembelian
#

DROP TABLE IF EXISTS `master_retur_pembelian`;

CREATE TABLE `master_retur_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_transaksi_asli` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `retur_total` double NOT NULL,
  `retur_diskon` double NOT NULL,
  `retur_pajak` double NOT NULL,
  `retur_grand_total` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_faktur` (`nomor_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_retur_penjualan
#

DROP TABLE IF EXISTS `master_retur_penjualan`;

CREATE TABLE `master_retur_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_faktur_asli` varchar(255) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `retur_total` double NOT NULL,
  `retur_diskon` double NOT NULL,
  `retur_pajak` double NOT NULL,
  `retur_grand_total` double NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_faktur` (`nomor_faktur`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `master_retur_penjualan` (`id`, `nomor_faktur_asli`, `nomor_faktur`, `id_pelanggan`, `retur_total`, `retur_diskon`, `retur_pajak`, `retur_grand_total`, `user`, `tanggal`, `tanggal_transaksi`) VALUES (14, 'bbmkdr200320001', 'RTR-bbmkdr200320001', 'HWW1875', '72000', '0', '0', '72000', 'dini', '2020-03-20 17:55:15', '2020-03-17 10:41:09');


#
# TABLE STRUCTURE FOR: master_saldo_awal
#

DROP TABLE IF EXISTS `master_saldo_awal`;

CREATE TABLE `master_saldo_awal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `nomor_faktur` varchar(255) NOT NULL,
  `qty_awal` double NOT NULL,
  `saldo_awal` double NOT NULL,
  `harga_awal` double NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `tanggal_saldo` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `saldo_awal` (`kode_barang`),
  CONSTRAINT `saldo_awal` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_sales
#

DROP TABLE IF EXISTS `master_sales`;

CREATE TABLE `master_sales` (
  `kode_sales` varchar(255) NOT NULL,
  `kode_pegawai` varchar(255) NOT NULL,
  `nama_sales` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `insentif` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_sales`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: master_satuan_barang
#

DROP TABLE IF EXISTS `master_satuan_barang`;

CREATE TABLE `master_satuan_barang` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_satuan` varchar(255) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES (6, 'BTG', 'BATANG', 'untuk produk batangan', 'supervisor', '2020-02-29 08:20:49');
INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES (7, 'MTR', 'METER', 'Untuk satuan meter', 'supervisor', '2020-02-29 08:21:02');
INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES (8, 'LBR', 'LEMBAR', 'Untuk satuan lembar', 'supervisor', '2020-02-29 08:21:17');
INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES (9, 'KLG', 'KALENG', 'untuk satuan kaleng', 'supervisor', '2020-02-29 08:23:05');
INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES (10, 'DUS', 'DUS', 'untuk satuan dus', 'supervisor', '2020-02-29 08:23:19');
INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES (11, 'PCS', 'PIECES', 'untuk satuan pieces', 'supervisor', '2020-02-29 08:23:31');
INSERT INTO `master_satuan_barang` (`id_satuan`, `kode_satuan`, `nama_satuan`, `keterangan`, `user`, `tanggal_input`) VALUES (12, 'KG', 'KILOGRAM', 'untuk satuan kilogram', 'supervisor', '2020-02-29 08:23:48');


#
# TABLE STRUCTURE FOR: master_setting
#

DROP TABLE IF EXISTS `master_setting`;

CREATE TABLE `master_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(255) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (1, 'nama_perusahaan', 'Besi Baja Makmur Kadungora', '2020-03-01 11:50:43');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (2, 'alamat_perusahaan', 'Jl Raya Kadungora No asdasdasd asdasdasd asdasdasd asdasdas asdasdasd', '2020-03-09 19:23:15');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (3, 'nomor_telepon', '085555555', '2020-03-01 11:50:43');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (4, 'nomor_fax', '0808080', '2020-03-01 11:50:43');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (5, 'alamat_email', 'bbmkadungora@gmail.com', '2020-03-01 11:50:43');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (6, 'logo_perusahaan', 't7bQeA3qsT28E9F0.png', '2020-03-01 11:50:37');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (7, 'prefix_faktur', 'bbmkdr', '2020-03-01 11:51:14');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (8, 'nomor_faktur', '3', '2020-03-01 11:51:14');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (9, 'catatan_faktur_cash', 'No Rek BCA : 148-098-0570\nNo Rek BNI : 033-078-6610\nNo Rek Mandiri : 177-00-00494-655\nNo Rek BRI : 0025-01-000778-56-6\na.n Bpk. Aten Aripin', '2020-03-05 18:15:21');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (10, 'catatan_faktur_kredit', 'asss', '2020-02-25 13:34:05');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (11, 'catatan_retur_jual', 'asdasda', '2020-02-24 18:58:09');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (12, 'catatan_retur_beli', 'asdasda', '2020-02-24 18:58:09');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (13, 'password_harga', '5', '2020-02-29 20:57:52');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (14, 'komisi_sales', '0.5', '2020-03-01 11:51:28');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (15, 'notifikasi', '2,3', '2020-02-25 21:18:42');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (16, 'frekuensi_notifikasi', '20', '2020-02-25 21:24:49');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (17, 'threshold_bonus', '1000', '2020-03-03 19:38:45');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (18, 'bonus_senior', '15000', '2020-03-03 19:45:01');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (19, 'bonus_junior', '10000', '2020-03-03 19:45:01');
INSERT INTO `master_setting` (`id`, `nama_setting`, `value`, `tanggal`) VALUES (20, 'database', '2019', '2020-03-22 13:14:07');


#
# TABLE STRUCTURE FOR: master_stok_opname
#

DROP TABLE IF EXISTS `master_stok_opname`;

CREATE TABLE `master_stok_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_referensi` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user` varchar(255) NOT NULL,
  `spv` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_referensi` (`nomor_referensi`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `master_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `keterangan`, `status`, `user`, `spv`) VALUES (5, 'REF7542908', '2020-03-02 00:00:00', '23123', 0, 'edwin', '');
INSERT INTO `master_stok_opname` (`id`, `nomor_referensi`, `tanggal`, `keterangan`, `status`, `user`, `spv`) VALUES (12, 'REF5732941', '2020-03-09 06:35:28', '', 2, 'dini', 'edwin');


#
# TABLE STRUCTURE FOR: master_supplier
#

DROP TABLE IF EXISTS `master_supplier`;

CREATE TABLE `master_supplier` (
  `kode_supplier` varchar(128) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(128) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `nomor_rekening` text NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('BIR674', 'PRODUKSI ', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:24:44');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('BMX310', 'PAK MUMU', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:25:31');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('DDW516', 'PT NEWLAND STEEL', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:25:56');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('ESF053', 'PROFIT', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:57:03');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('FCL359', 'PT SMS STEEL', '-', '0', '', '0-BANK--', '-', 'supervisor', '2020-02-29 09:23:56');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('HWI209', 'BBS', '-', '-', '__.___.___._-___.___', '-----', '-', 'supervisor', '2020-02-29 09:24:29');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('OCZ285', 'PT HUAXING INSUSTRIES', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:24:15');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('SMV257', 'LANGGENG JAYA TEKNIK', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:24:57');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('VQT270', 'PMB', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:26:24');
INSERT INTO `master_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `nomor_telepon`, `npwp`, `nomor_rekening`, `keterangan`, `user`, `tanggal_input`) VALUES ('XQO406', 'PT KUDA BERLIAN MEGAH', '-', '-', '', '-----', '-', 'supervisor', '2020-02-29 09:25:12');


#
# TABLE STRUCTURE FOR: master_tipe_barang
#

DROP TABLE IF EXISTS `master_tipe_barang`;

CREATE TABLE `master_tipe_barang` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tipe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`, `user`, `timestamp`) VALUES (1, 'INVENTORY', 'TIPE UNTUK BARANG YANG DIJUAL', '', '2020-01-25 10:59:03');
INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`, `user`, `timestamp`) VALUES (2, 'NON-INVENTORY', 'TIPE UNTUK BARANG YANG TIDAK DIJUAL, CONTOH PERALATAN KANTOR', '', '2020-01-25 10:59:03');
INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`, `user`, `timestamp`) VALUES (3, 'JASA', 'TIPE BARANG YANG TIDAK BERUPA, SEPERTI JASA PENGANTAR BARANG, JASA RAKITAN', '', '2020-01-25 10:59:03');
INSERT INTO `master_tipe_barang` (`id_tipe`, `nama_tipe`, `keterangan`, `user`, `timestamp`) VALUES (4, 'RAKITAN', 'TIPE BARANG BUNDLING, SEPERTI PAKET SEMABAKO', '', '2020-01-25 10:59:03');


#
# TABLE STRUCTURE FOR: master_user
#

DROP TABLE IF EXISTS `master_user`;

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
  `is_del` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`),
  KEY `nip` (`nip`),
  CONSTRAINT `nip` FOREIGN KEY (`nip`) REFERENCES `master_pegawai` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES ('desi', '1111', '$2y$10$FlUdr83tMeM4QuJQLae1OO3/v3NW9CAQNKEnWv9hPNfFzaVvW/iOO', '1', 'DESI', 'default.jpg', 0, '2020-03-19 03:54:20', '0000-00-00 00:00:00', 1, 0);
INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES ('dini', '124124', '$2y$10$RrwCvrb/WuSCU/JAHKr.2.A7f7WpsPc5qBKhH7.PZx.kua5bxKr8a', '2', 'DINI', 'default.jpg', 0, '2020-03-20 11:56:19', '0000-00-00 00:00:00', 1, 0);
INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES ('edwin', '123123', '$2y$10$oi6qEP4bxeYkrUK5YCvhFe8a4PBCVriLudVjVxMvqQPPYCy.xKF9u', '4', 'EDWIN', 'default.jpg', 0, '2020-03-22 05:58:36', '0000-00-00 00:00:00', 1, 0);
INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES ('hadi', '21124124', '$2y$10$.Zz5dNGxi92mm.vF2/W59OWdBQEkYEIAjgnf01FkeUNal0jg2Lzf.', '3', 'HADI', 'default.jpg', 0, '2020-03-09 05:19:50', '0000-00-00 00:00:00', 1, 0);
INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES ('lucky15', '123123123', '$2y$10$3HBFxWoWL9yHhbW1zegPteGL2ZtN4bPiBTTGEwkFifMu7djwD2Q0S', '1', 'LUCKY ANGGARA', 'default.jpg', 0, '2020-03-22 04:54:08', '0000-00-00 00:00:00', 1, 0);
INSERT INTO `master_user` (`username`, `nip`, `password`, `role`, `nama`, `avatar`, `status`, `last_activity`, `tanggal_create`, `isactive`, `is_del`) VALUES ('manajer', '1', '$2y$10$Z.wVyoe9feypSG31/yGrhulh1abnvFshzx6nUSQBq5yZlmlVUeiLO', '5', 'Neng', 'PjNKCoktVUdi3BZp.jpeg', 0, '2020-03-22 06:07:08', '2020-03-01 00:00:00', 1, 0);


#
# TABLE STRUCTURE FOR: master_utang
#

DROP TABLE IF EXISTS `master_utang`;

CREATE TABLE `master_utang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_tagihan` double NOT NULL,
  `total_pembayaran` double NOT NULL,
  `down_payment` double NOT NULL DEFAULT '0',
  `sisa_utang` double NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_faktur` (`nomor_transaksi`),
  KEY `no_faktur_2` (`nomor_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: notif
#

DROP TABLE IF EXISTS `notif`;

CREATE TABLE `notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dari` varchar(255) NOT NULL,
  `ke` varchar(255) NOT NULL,
  `pesan` varchar(512) NOT NULL,
  `link` varchar(255) NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (52, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 04:53:50');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (53, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 1, 0, '2020-03-21 04:54:20');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (54, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 04:55:07');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (55, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 04:55:42');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (56, 'manajer', 'edwin', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 15:09:00');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (57, 'edwin', 'lucky15', 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-21 15:15:39');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (58, 'edwin', 'lucky15', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:30:06');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (59, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:49:34');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (60, 'manajer', 'edwin', 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:50:24');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (61, 'manajer', 'edwin', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:51:47');
INSERT INTO `notif` (`id`, `dari`, `ke`, `pesan`, `link`, `is_read`, `is_deleted`, `tanggal`) VALUES (62, 'edwin', 'lucky15', 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/', 0, 0, '2020-03-22 04:54:30');


#
# TABLE STRUCTURE FOR: tabel_akses
#

DROP TABLE IF EXISTS `tabel_akses`;

CREATE TABLE `tabel_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  `akses` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tabel_diskon
#

DROP TABLE IF EXISTS `tabel_diskon`;

CREATE TABLE `tabel_diskon` (
  `id` int(11) NOT NULL,
  `kode_diskon` varchar(15) NOT NULL,
  `potongan` int(11) NOT NULL,
  `jumlah_diskon` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tabel_keranjang_belanja
#

DROP TABLE IF EXISTS `tabel_keranjang_belanja`;

CREATE TABLE `tabel_keranjang_belanja` (
  `id` int(11) NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_total` double NOT NULL,
  `status` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `no_order` (`no_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tabel_menu
#

DROP TABLE IF EXISTS `tabel_menu`;

CREATE TABLE `tabel_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) NOT NULL,
  `link` varchar(512) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (1, 'Penjualan', '#', 'fa fa-cart-arrow-down', 'Kasir');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (2, 'Pembelian', '#', 'fa fa-cart-plus', 'Admin');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (3, 'Dashboard', 'dashboard/sales', 'mdi mdi-view-dashboard', 'Sales');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (4, 'Dashboard', 'dashboard/kasir', 'mdi mdi-view-dashboard', 'Kasir');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (5, 'Dashboard', 'dashboard/admin', 'mdi mdi-view-dashboard', 'Dashboard Admin');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (6, 'Dashboard', 'dashboard/supervisor', 'mdi mdi-view-dashboard', 'Dashboard Supervisor');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (7, 'Dashboard', '#', 'mdi mdi-view-dashboard', 'Dashboard Manager');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (8, 'Sales', '#', 'fa fa-user-o', 'Sales');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (9, 'Persediaan', '#', 'fa fa-window-restore', 'Supervisor');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (10, 'Data', '#', 'fa fa-database', 'Admin');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (11, 'Pegawai', '#', 'fa fa-users', 'Manajer');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (12, 'Keuangan', '#', 'fa fa-money', 'Manajer');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (13, 'Laporan', '#', 'fa fa-file-text', 'Manajer');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (14, 'Data', '#', 'fa fa-database', 'Kasir');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (15, 'Keuangan', '#', 'fa fa-money', 'Admin');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (16, 'Penjualan', '#', 'fa fa-cart-arrow-down', 'Admin');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (17, 'Persediaan', '#', 'fa fa-window-restore', 'Admin');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (18, 'Sales', '#', 'fa fa-users', 'Admin');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (19, 'Pegawai', '#', 'fa fa-users', 'Supervisor');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (20, 'Settings', 'setting/setting', 'fa fa-gear', 'Manajer');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (21, 'Transaksi', '#', 'fa fa-money', 'Supervisor');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (22, 'Data', '#', 'fa fa-database', 'Supervisor');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (23, 'Transaksi', '#', 'fa fa-cart-arrow-down', 'Manajer');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (24, 'Keuangan', '#', 'fa fa-money', 'Supervisor');
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `keterangan`) VALUES (25, 'Keuangan', '', 'fa fa-money', 'Kasir Keuangan');


#
# TABLE STRUCTURE FOR: tabel_perhitungan_order
#

DROP TABLE IF EXISTS `tabel_perhitungan_order`;

CREATE TABLE `tabel_perhitungan_order` (
  `no_order` varchar(255) NOT NULL,
  `total_keranjang` double NOT NULL,
  `diskon` double NOT NULL,
  `pajak` double NOT NULL,
  `ongkir` double NOT NULL,
  `grand_total` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`no_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('39gtUec7uoHCMPI8', '125000', '0', '12500', '0', '137500', '2020-03-05 12:21:19');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('7EnBUwIJmx1cTsfp', '300000', '0', '0', '10000', '310000', '2020-03-05 12:45:14');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('b6UL8VOkAumN72J9', '560000', '0', '56000', '0', '616000', '2020-03-06 09:31:25');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('dL2UcZKEwjqNDBsv', '800000', '0', '0', '0', '800000', '2020-03-20 16:48:52');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('Gsc4eWCduFxmSqYR', '205000000', '0', '0', '0', '205000000', '2020-03-09 18:20:11');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('KoOCtQ0lNzwXWiSa', '1500000', '0', '0', '0', '1500000', '2020-03-20 08:16:41');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT0219576', '24000', '0', '0', '0', '24000', '2020-03-04 15:01:20');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT0624851', '720000', '0', '0', '0', '720000', '2020-03-04 15:16:07');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT1243956', '48000', '0', '0', '0', '48000', '2020-03-05 19:03:28');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT3280967', '720000', '0', '0', '0', '720000', '2020-03-04 15:00:06');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT3605217', '720000', '0', '0', '0', '720000', '2020-03-04 15:00:53');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT4309761', '24000', '0', '0', '0', '24000', '2020-03-04 15:03:15');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT5321674', '240000', '0', '0', '0', '240000', '2020-03-20 16:40:13');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT5392870', '240000', '0', '0', '0', '240000', '2020-03-20 16:36:58');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT7129068', '720000', '0', '0', '0', '720000', '2020-03-04 14:53:49');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('OUT8673920', '240000', '0', '0', '0', '240000', '2020-03-20 16:38:46');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('PO.090320001', '525000', '0', '52500', '0', '577500', '2020-03-09 11:14:06');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('tCJY3kyKjnXqNLU4', '1000000', '0', '0', '0', '1000000', '2020-03-20 08:13:28');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('tgEjyDVuIn5azWFB', '1500000', '0', '0', '0', '1500000', '2020-03-20 16:30:00');
INSERT INTO `tabel_perhitungan_order` (`no_order`, `total_keranjang`, `diskon`, `pajak`, `ongkir`, `grand_total`, `timestamp`) VALUES ('wNPBVDyLUaXHJIux', '1300000', '50000', '125000', '0', '1375000', '2020-03-06 10:51:54');


#
# TABLE STRUCTURE FOR: tabel_role
#

DROP TABLE IF EXISTS `tabel_role`;

CREATE TABLE `tabel_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) NOT NULL,
  `menu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES (1, 'Kasir', '4,1,14,25');
INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES (2, 'Admin', '5,16,2,17,15');
INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES (3, 'Sales', '3,8');
INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES (4, 'Supervisor', '6,21,9,10,24');
INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES (5, 'Manager', '7,23,9,12,11,13,20');
INSERT INTO `tabel_role` (`id`, `nama_role`, `menu`) VALUES (6, 'Superuser', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20');


#
# TABLE STRUCTURE FOR: tabel_submenu
#

DROP TABLE IF EXISTS `tabel_submenu`;

CREATE TABLE `tabel_submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_menu` varchar(255) NOT NULL,
  `nama_submenu` varchar(255) NOT NULL,
  `link` varchar(512) NOT NULL,
  `ket` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (1, '1', 'Transaksi Penjualan', 'manajemen_penjualan/penjualanbarang', 'Kasir Penjualan Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (2, '1', 'Daftar Transaksi', 'manajemen_penjualan/daftartransaksipenjualan', 'Kasir Daftar Penjualan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (5, '16', 'Purchase Order', 'manajemen_penjualan/purchaseorderadmin', 'Admin P.O');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (6, '16', 'Retur Penjualan', 'manajemen_penjualan/returpenjualan', 'Admin Retur Penjualan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (7, '16', 'Daftar Retur Penjualan', 'manajemen_penjualan/returpenjualan/daftar_retur', 'Admin Retur Penjualan Daftar');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (8, '2', 'Transaksi Pembelian', 'manajemen_pembelian/pembelianbarang', 'Admin Pembelian Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (9, '2', 'Daftar Transaksi', 'manajemen_pembelian/daftartransaksipembelian', 'Admin Daftar Pembelian Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (10, '2', 'Retur Pembelian', 'manajemen_pembelian/returpembelian', 'Admin Retur Pembelian');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (11, '2', 'Daftar Retur Pembelian', 'manajemen_pembelian/returpembelian/daftar_retur', 'Admin Daftar Retur Pembelian');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (12, '9', 'Master Persediaan', 'manajemen_persediaan/masterpersediaan', 'Supervisor Master Persediaan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (13, '9', 'Kartu Persediaan', 'manajemen_persediaan/kartupersediaan', 'Supervisor Kartu Persediaan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (14, '17', 'Saldo Awal Persediaan', 'manajemen_persediaan/saldoawalpersediaan', 'Admin Saldo Awal Persediaan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (15, '17', 'Stok Opname', 'manajemen_persediaan/stokopname', 'Admin Stok Opname');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (16, '9', 'Stok Opname', 'manajemen_persediaan/reviewstokopname', 'Supervisor Review Stok Opname');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (17, '10', 'Master Barang', 'manajemen_barang/masterbarang', 'Admin Master Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (18, '10', 'Master Satuan Barang', 'manajemen_data/mastersatuan ', 'Admin Satuan Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (19, '10', 'Master Jenis Barang', 'manajemen_data/masterjenisbarang', 'Admin Jenis Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (20, '10', 'Master Merek Barang', 'manajemen_data/mastermerekbarang', 'Admin Merek Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (21, '14', 'Master Pelanggan', 'manajemen_data/masterpelanggan', 'Kasir Master Pelanggan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (22, '10', 'Master Supplier', 'manajemen_data/mastersupplier', 'Admin Master Supplier');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (23, '11', 'Master User', 'manajemen_pegawai/masteruser', 'Manager Master User');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (24, '11', 'Master Pegawai', 'manajemen_pegawai/masterpegawai', 'Manager Master Pegawai');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (25, '22', 'Master Barang', 'manajemen_barang/masterbarang', 'Supervisor Data Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (26, '8', 'Purchase Order', 'manajemen_penjualan/purchaseordersales', 'Sales P.O');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (27, '8', 'Daftar Purchase Order', 'manajemen_penjualan/purchaseordersales/daftar', 'Sales Daftar P.O');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (28, '8', 'Insentif', 'manajemen_sales/insentif', 'Sales Insentif Monitor');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (29, '15', 'Master Piutang', 'manajemen_keuangan/masterpiutang/daftar_piutang', 'Admin Master Piutang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (30, '15', 'Master Utang', 'manajemen_keuangan/masterutang/daftar_utang', 'Admin Master Utang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (31, '12', 'Insentif Sales', 'manajemen_pegawai/insentifsales', 'Manajer Insentif Sales');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (32, '21', 'Daftar Transaksi Penjualan', 'manajemen_penjualan/daftartransaksipenjualan', '');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (33, '21', 'Daftar Transaksi Pembelian', 'manajemen_pembelian/daftartransaksipembelian', '');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (34, '23', 'Daftar Penjualan', 'manajemen_penjualan/daftartransaksipenjualan', 'Manajer Daftar Transaksi Penjualan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (35, '23', 'Daftar Pembelian', 'manajemen_pembelian/daftartransaksipembelian', 'Manajer Daftar Transaksi Pembelian');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (36, '12', 'Master Utang', '	\r\nmanajemen_keuangan/masterutang/daftar_utang', 'Manajer Master Utang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (37, '12', 'Master Piutang', '	\r\nmanajemen_keuangan/masterpiutang/daftar_piutang', 'Manajer Master Piutang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (39, '24', 'Master Gaji', 'manajemen_keuangan/mastergaji/', 'Supervisor Master Gaji');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (40, '24', 'Master Biaya', 'manajemen_keuangan/masterbiaya/', 'Supervisor Master Biaya');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (41, '10', 'Master Kategori Biaya', 'manajemen_data/masterkategoribiaya', 'Supervisor Kategori Biaya');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (42, '9', 'Transfer Retur Barang', 'manajemen_persediaan/returpersediaan', 'Supervisor Transfer Retur Barang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (43, '13', 'Laporan Laba / Rugi Usaha', 'laporan/laba', 'Manajer Laporan Laba / Rugi');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (44, '24', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Supervisor COH');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (45, '12', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Manajer Master Kas');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (46, '25', 'Master Dana', 'manajemen_keuangan/mastercoh/', 'Kasir Master Dana COH');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (47, '1', 'Daftar Pending Transaksi', 'manajemen_penjualan/pendingtransaksi', 'Kasir Pending Transaksi');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (48, '13', 'Laporan Utang / Piutang', 'laporan/utangpiutang', 'Manajer Laporan Utang / Piutang');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (49, '23', 'Daftar Retur Penjualan', 'manajemen_penjualan/returpenjualan', 'Manajer Daftar Retur Penjualan');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (50, '23', 'Daftar Retur Pembelian', 'manajemen_pembelian/returpembelian', 'Manajer Daftar Retur Pembelian');
INSERT INTO `tabel_submenu` (`id`, `main_menu`, `nama_submenu`, `link`, `ket`) VALUES (51, '13', 'Laporan Persediaan', 'laporan/laporanpersediaan', 'Manajer Laporan Persediaan');


#
# TABLE STRUCTURE FOR: temp_purchase_order
#

DROP TABLE IF EXISTS `temp_purchase_order`;

CREATE TABLE `temp_purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_penjualan` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `no_order` (`no_order`),
  CONSTRAINT `master_po` FOREIGN KEY (`no_order`) REFERENCES `master_purchase_order` (`no_order`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: temp_tabel_keranjang_pembelian
#

DROP TABLE IF EXISTS `temp_tabel_keranjang_pembelian`;

CREATE TABLE `temp_tabel_keranjang_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` datetime NOT NULL,
  `no_order_pembelian` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `total_harga` double NOT NULL,
  `tanggal_input` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: temp_tabel_keranjang_penjualan
#

DROP TABLE IF EXISTS `temp_tabel_keranjang_penjualan`;

CREATE TABLE `temp_tabel_keranjang_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: timeline_po
#

DROP TABLE IF EXISTS `timeline_po`;

CREATE TABLE `timeline_po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `pesan` text NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `timeline_po` (`id`, `no_order`, `urutan`, `tanggal`, `pesan`, `user`) VALUES (1, 'PO.090320001', 1, '2020-03-09 05:14:18', 'Proses', 'hadi');
INSERT INTO `timeline_po` (`id`, `no_order`, `urutan`, `tanggal`, `pesan`, `user`) VALUES (2, 'PO.090320001', 2, '2020-03-20 02:12:55', '<span class=\"text-danger\">Reject</span><br>', 'dini');


