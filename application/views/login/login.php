<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?= base_url('assets/');?>images/favicon.ico">

        <title>Adminto - Responsive Admin Dashboard Template</title>

        <!-- App css -->
        <link href="<?= base_url('assets/');?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/');?>css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/');?>css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?= base_url('assets/');?>js/modernizr.min.js"></script>

    </head>

    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>Toko<span> Besi</span> xxxxxx</span></a>
                <!-- <h5 class="text-muted m-t-0 font-600">Responsive Admin Dashboard</h5> -->
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
                </div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20" action="index.html">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <select class="form-control" type="password" required="" placeholder="Password">
                                    <option>Cashier</option>
                                    <option>Admin Gudang</option>
                                    <option>Executive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Lupa Password? Kontak Admin</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end card-box-->           
        </div>
        <!-- end wrapper page -->



        <!-- jQuery  -->
        <script src="<?= base_url('assets/');?>js/jquery.min.js"></script>
        <script src="<?= base_url('assets/');?>js/popper.min.js"></script>
        <script src="<?= base_url('assets/');?>js/bootstrap.min.js"></script>
        <script src="<?= base_url('assets/');?>js/detect.js"></script>
        <script src="<?= base_url('assets/');?>js/fastclick.js"></script>
        <script src="<?= base_url('assets/');?>js/jquery.blockUI.js"></script>
        <script src="<?= base_url('assets/');?>js/waves.js"></script>
        <script src="<?= base_url('assets/');?>js/jquery.nicescroll.js"></script>
        <script src="<?= base_url('assets/');?>js/jquery.slimscroll.js"></script>
        <script src="<?= base_url('assets/');?>js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url('assets/');?>js/jquery.core.js"></script>
        <script src="<?= base_url('assets/');?>js/jquery.app.js"></script>
	
	</body>
</html>