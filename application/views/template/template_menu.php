        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            <a href="index.html"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Transaksi Penjualan </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('Manajemen_Penjualan/PenjualanBarang'); ?>">Penjualan Barang</a></li>
                                        <li><a href="<?= base_url('Manajemen_Barang/'); ?>">Daftar Order</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Transaksi Pembelian </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('Manajemen_Pembelian/PembelianBarang'); ?>">Pembelian Barang</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Master Persediaan </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('Manajemen_Barang/MasterPersediaan'); ?>">Master Persediaan</a></li>
                                        <li><a href="<?= base_url('Manajemen_Barang/MasterBarang'); ?>">Master Barang</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-invert-colors"></i> <span> Master Data </span> </a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= base_url('Manajemen_Barang/MasterSupplier'); ?>">Master Data Supplier </a></li>
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