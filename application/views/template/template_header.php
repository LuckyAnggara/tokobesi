<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $setting_perusahaan['nama_perusahaan']; ?></title>
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

    <link href="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

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
                        <!-- <li class="hide-phone">
                            <form class="app-search">
                                <input type="text" placeholder="Search..." class="form-control">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li> -->
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

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url('assets/images/users/') . $this->session->userdata['avatar']; ?>" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ti-user m-r-5"></i> <?= $this->session->userdata['nama']; ?>
                                </a>
                                <a href=" <?= base_url('manajemen_pegawai/masteruser/detail_user'); ?> " class="dropdown-item notify-item">
                                    <i class="ti-key m-r-5"></i> Setting
                                </a>
                                <!-- item-->
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