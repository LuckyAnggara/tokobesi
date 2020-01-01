<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>images/favicon.ico">

    <title>Adminto - Responsive Admin Dashboard Template</title>

    <!-- App css -->
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/'); ?>css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet" type="text/css" />

    <!-- <?php $css; ?> -->

    <script src="<?= base_url('assets/'); ?>js/modernizr.min.js"></script>

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo"><span>Admin<span>to</span></span><i class="mdi mdi-layers"></i></a>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">

                    <!-- Page title -->
                    <ul class="nav navbar-nav list-inline navbar-left">
                        <li class="list-inline-item">
                            <button class="button-menu-mobile open-left">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                        <li class="list-inline-item">
                            <!-- <h4 class="page-title"><?= $title; ?></h4> -->
                        </li>
                    </ul>

                    <nav class="navbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a href="javascript:void(0);" class="right-bar-toggle">
                                                <i class="mdi mdi-bell-outline noti-icon"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>

                            <li class="hide-phone">
                                <form class="app-search">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </li>

                        </ul>
                    </nav>
                </div><!-- end container -->
            </div><!-- end navbar -->

        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">

                <!-- User -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="<?= base_url('assets/'); ?>images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                        <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                    </div>
                    <h5><a href="#">Mat Helme</a> </h5>
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
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="bg-picture card-box row">
                                <div class="col-sm-4">
                                    <img src="<?= base_url('assets/'); ?>images/barang/batubata.jpg" alt="profile-image" class="card-img-top img-fluid">
                                </div>
                                <div class="col-sm-8">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#detail_barang" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                Detail Barang
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#data_supplier" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                Data Supplier
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#histori_harga" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Histori Harga Barang
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#settings1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Settings
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade show active" id="detail_barang">

                                            <form class="form-horizontal" role="form">
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Kode Barang</label>
                                                    <div class="col-10">
                                                        <input id="kode_barang" type="text" class="form-control" value="<?= $persediaan['kode_barang']; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Nama Barang</label>
                                                    <div class="col-10">
                                                        <input id="nama_barang" type="text" class="form-control" value="<?= $persediaan['nama_barang']; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Jumlah Persediaan</label>
                                                    <div class="col-10">
                                                        <input id="jumlah_persediaan" type="text" class="form-control" value="<?= $persediaan['jumlah_persediaan']; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Harga Satuan Terkahir</label>
                                                    <div class="col-10">
                                                        <input id="harga_satuan" type="text" class="form-control" value="<?= $persediaan['harga_satuan']; ?>" disabled>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">Total Persediaan Batu Bata </label>
                                                    <div class="col-3">
                                                        <h3>Rp. <?= $persediaan['jumlah_persediaan'] * $persediaan['harga_satuan']; ?></h3>
                                                    </div>
                                                    <div class="col-4">
                                                        <h4>(Empat Ratus Juta Rupiah)</h4>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="data_supplier">
                                            <table id="datatable-data-supplier" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="histori_harga">
                                            <table id="datatable-histori-harga" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <thead>
                                                        <tr>
                                                            <th class="w-25">Tanggal Update</th>
                                                            <th class="w-25">Harga</th>
                                                        </tr>
                                                    </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>20 November 2019</td>
                                                        <td>Rp. 5.000</td>
                                                    </tr>
                                                </tbody>
                                                </thead>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="settings1">
                                            <p>Trust fund seitan letterpress,
                                                keytar raw denim keffiyeh etsy art party before they sold out master
                                                cleanse gluten-free squid scenester freegan cosby sweater. Fanny
                                                pack portland seitan DIY, art party locavore wolf cliche high life
                                                echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before
                                                they sold out farm-to-table VHS viral locavore cosby sweater. Lomo
                                                wolf viral, mustache readymade thundercats keffiyeh craft beer marfa
                                                ethical. Wolf salvia freegan, sartorial keffiyeh echo park
                                                vegan.</p>
                                        </div>
                                    </div>

                                    <!-- <div class="profile-info-detail">
                                <h4 class="m-0">Batu Bata</h4>
                                <p class="text-muted m-b-20"><i>Web Designer</i></p>
                                <p>Hi I'm Alexandra Clarkson,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC,making it over 2000 years old.Contrary to popular belief, Lorem Ipsum is not simplyrandom text. It has roots in a piece of classical Latin literature from 45 BC.</p>
                            </div> -->

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!--/ meta -->



                            <div method="post" class="card-box">
                                <ul class="nav nav-pills profile-pills m-t-10">
                                    <li>
                                        <a href="#"><i class="fa fa-user"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-location-arrow"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class=" fa fa-camera"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-smile-o"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                </div> <!-- container -->

                <footer class="footer text-right">
                    AWAWAW
                </footer>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="side-bar right-bar">
            <a href="javascript:void(0);" class="right-bar-toggle">
                <i class="mdi mdi-close-circle-outline"></i>
            </a>
            <h4 class="">Notifications</h4>
            <div class="notification-list nicescroll">
                <ul class="list-group list-no-border user-list">
                    <li class="list-group-item">
                        <a href="#" class="user-list-item">
                            <div class="avatar">
                                <img src="<?= base_url('assets/'); ?>images/users/avatar-2.jpg" alt="">
                            </div>
                            <div class="user-desc">
                                <span class="name">Michael Zenaty</span>
                                <span class="desc">There are new settings available</span>
                                <span class="time">2 hours ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="user-list-item">
                            <div class="icon bg-info">
                                <i class="mdi mdi-account"></i>
                            </div>
                            <div class="user-desc">
                                <span class="name">New Signup</span>
                                <span class="desc">There are new settings available</span>
                                <span class="time">5 hours ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="user-list-item">
                            <div class="icon bg-pink">
                                <i class="mdi mdi-comment"></i>
                            </div>
                            <div class="user-desc">
                                <span class="name">New Message received</span>
                                <span class="desc">There are new settings available</span>
                                <span class="time">1 day ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item active">
                        <a href="#" class="user-list-item">
                            <div class="avatar">
                                <img src="<?= base_url('assets/'); ?>images/users/avatar-3.jpg" alt="">
                            </div>
                            <div class="user-desc">
                                <span class="name">James Anderson</span>
                                <span class="desc">There are new settings available</span>
                                <span class="time">2 days ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item active">
                        <a href="#" class="user-list-item">
                            <div class="icon bg-warning">
                                <i class="mdi mdi-settings"></i>
                            </div>
                            <div class="user-desc">
                                <span class="name">Settings</span>
                                <span class="desc">There are new settings available</span>
                                <span class="time">1 day ago</span>
                            </div>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="<?= base_url('assets/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/detect.js"></script>
    <script src="<?= base_url('assets/'); ?>js/fastclick.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.blockUI.js"></script>
    <script src="<?= base_url('assets/'); ?>js/waves.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.nicescroll.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.slimscroll.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.scrollTo.min.js"></script>
    <!-- App js -->
    <script src="<?= base_url('assets/'); ?>js/jquery.core.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.app.js"></script>


</body>

</html>