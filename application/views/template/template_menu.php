        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            <a href="<?= base_url('Dashboard'); ?>"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Transaksi Penjualan </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('manajemen_penjualan/PenjualanBarang'); ?>">Penjualan Barang</a></li>
                                        <hr>
                                        <li><a href="<?= base_url('manajemen_penjualan/purchaseordersales'); ?>">P.O Sales - Sales</a></li>
                                        <li><a href="<?= base_url('manajemen_penjualan/purchaseordersales/daftar'); ?>">P.O Sales - Daftar</a></li>
                                        <li><a href="<?= base_url('manajemen_penjualan/purchaseorderadmin'); ?>">P.O Sales - Admin</a></li>
                                        <hr>
                                        <li><a href="<?= base_url('manajemen_penjualan/DaftarTransaksiPenjualan'); ?>">Daftar Transaksi</a></li>
                                        <li><a href="<?= base_url('manajemen_penjualan/ReturPenjualan'); ?>">Retur Transaksi Penjualan</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Transaksi Pembelian </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('manajemen_pembelian/PembelianBarang'); ?>">Pembelian Barang</a></li>
                                        <hr>
                                        <li><a href="<?= base_url('manajemen_pembelian/DaftarTransaksiPembelian'); ?>">Daftar Transaksi</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Master Persediaan </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('manajemen_persediaan/MasterPersediaan'); ?>">Master Persediaan</a></li>
                                        <li><a href="<?= base_url('manajemen_persediaan/KartuPersediaan'); ?>">Kartu Persediaan</a></li>
                                        <hr>
                                        <li><a href="<?= base_url('manajemen_persediaan/SaldoAwalPersediaan'); ?>">Saldo Awal Persediaan</a></li>
                                        <li><a href="<?= base_url('manajemen_persediaan/stokopname'); ?>">Stok Opname</a></li>
                                        <li><a href="<?= base_url('manajemen_persediaan/reviewstokopname'); ?>">Review Stok Opname</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Master Data </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('Manajemen_Barang/MasterBarang'); ?>">Master Barang</a></li>
                                        <hr>
                                        <li><a href="<?= base_url('Manajemen_Data/MasterPelanggan'); ?>">Master Data Pelanggan </a></li>
                                        <li><a href="<?= base_url('Manajemen_Data/MasterSupplier'); ?>">Master Data Supplier </a></li>
                                        <hr>
                                        <li><a href="<?= base_url('Manajemen_Data/MasterJenisBarang'); ?>">Master Data Jenis Barang </a></li>
                                        <li><a href="<?= base_url('Manajemen_Data/MasterMerekBarang'); ?>">Master Data Merk Barang </a></li>
                                        <li><a href="<?= base_url('Manajemen_Data/MasterSatuan'); ?>">Master Data Satuan </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->
        <div class="wrapper">