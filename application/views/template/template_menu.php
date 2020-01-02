<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <img src="<?= base_url('assets/'); ?>images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
            </div>
            <h5><a href="#">Cashier</a> </h5>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#">
                        <i class="mdi mdi-settings"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="#" class="text-custom">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End User -->
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Navigation</li>

                <li>
                    <a href="index.html" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-view-list"></i> <span> Manajemen Barang </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('manajemen_barang/masterpersediaan'); ?>">Master Persediaan Barang</a></li>
                        <li><a href="<?= base_url('manajemen_barang/masterbarang'); ?>">Master Data Barang</a></li>
                        <li><a href="<?= base_url('manajemen_barang/mastersupplier'); ?>">Master Data Supplier </a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" mdi mdi-cart"></i> <span> Manajemen Penjualan </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('manajemen_penjualan/penjualanbarang'); ?>">Penjualan Barang</a></li>
                        <li><a href="<?= base_url('manajemen_barang/masterpelanggan'); ?>">Master Data Barang</a></li>
                        <li><a href="<?= base_url('manajemen_barang/masterhistori'); ?>">Master Data Supplier </a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->