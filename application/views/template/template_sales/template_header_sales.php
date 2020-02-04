<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>PT Besi Baja Makmur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>images/favicon.ico">
    <?php $this->load->view($css); ?>
    <!-- App css -->
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/'); ?>css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/'); ?>js/modernizr.min.js"></script>
</head>

<body>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">

                    <!-- Image Logo -->
                    <a href="index.html" class="logo">
                        <img src="<?= base_url('assets/images/') . $setting_perusahaan['logo_perusahaan']; ?>" alt="" height="24" class="logo-large">
                        <span class="logo-large"> <?= $setting_perusahaan['nama_perusahaan']; ?></span>
                    </a>
                </div>
                <!-- End Logo container-->

                <div class="menu-extras topbar-custom">

                    <ul class="list-unstyled topbar-right-menu float-right mb-0">

                        <li class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <!-- <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-shopping-cart"><span class="badge badge-primary badge-pill">15</span></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ti-user m-r-5"></i> <?= $this->session->userdata['username']; ?>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ti-settings m-r-5"></i> Settings
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ti-lock m-r-5"></i> Lock screen
                                </a>
                                <a href=" <?= base_url('login/logout'); ?> " class="dropdown-item notify-item">
                                    <i class="ti-power-off m-r-5"></i> Logout
                                </a>
                            </div>
                        </li> -->
                        <li>
                            <!-- Notification -->
                            <div class="notification-box">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a href="javascript:void(0);" class="right-bar-toggle">
                                            <i class="fa fa-shopping-cart"><span class="badge badge-danger badge-pill" id="jumlah_keranjang">0</span></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Notification bar -->
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url('assets/images/users/') . $this->session->userdata['avatar']; ?>" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ti-user m-r-5"></i> <?= $this->session->userdata['username']; ?>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ti-settings m-r-5"></i> Settings
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ti-lock m-r-5"></i> Lock screen
                                </a>
                                <a href=" <?= base_url('login/logout'); ?> " class="dropdown-item notify-item">
                                    <i class="ti-power-off m-r-5"></i> Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->