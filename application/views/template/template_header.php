<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?= base_url('assets/');?>images/favicon.ico">

        <title>Adminto - Responsive Admin Dashboard Template</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="<?= base_url('assets/');?>plugins/morris/morris.css">

        <!-- App css -->
        <link href="<?= base_url('assets/');?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/');?>css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/');?>css/style.css" rel="stylesheet" type="text/css" />

        <?php $css; ?>

        <script src="<?= base_url('assets/');?>js/modernizr.min.js"></script>

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
                                <h4 class="page-title"><?= $title;?></h4>
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
                                        <input type="text" placeholder="Search..."
                                               class="form-control">
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
                            <img src="<?= base_url('assets/');?>images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                        </div>
                        <h5><a href="#">Mat Helme</a> </h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" >
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











