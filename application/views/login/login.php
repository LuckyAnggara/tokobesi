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
    <link href="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url('assets/'); ?>js/modernizr.min.js"></script>

</head>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="text-center">
            <a href="index.html" class="logo">
                <span> <?= $setting_perusahaan['nama_perusahaan']; ?></span>
            </a>
            <!-- <a href="index.html" class="logo"><span>Toko<span> Besi</span> xxxxxx</span></a> -->
            <!-- <h5 class="text-muted m-t-0 font-600">Responsive Admin Dashboard</h5> -->
        </div>
        <div class="m-t-40 card-box">
            <div class="text-center">
                <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
            </div>
            <div class="p-20" id="loginDiv">
                <form class="form-horizontal m-t-20" method="post" name="loginForm" id="loginForm">
                    <!--  action="<?= base_url('login/aksi_login'); ?>" -->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required autocomplete="off" placeholder="Username" name="username">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" id="password" type="password" required autocomplete="off" placeholder="Password" name="password">
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="col-xs-12">
                            <select class="form-control" type="password" required="" placeholder="Password" name="role">
                                <option>Cashier</option>
                                <option>Admin Gudang</option>
                                <option>Executive</option>
                                <option>Sales</option>
                                <option>Direktur</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
                            <!-- <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" id="l" type="button">L In</button> -->
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            <a class="text-muted"><i class="fa fa-lock m-r-5"></i> Lupa Password? Kontak Admin</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- end card-box-->
    </div>
    <!-- end wrapper page -->



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

    <!-- Loading Overlay -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>

    <!-- Sweet Alert Js  -->
    <script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url('assets/'); ?>js/jquery.core.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.app.js"></script>

    <!-- My Script -->
    <script>
        $(document).ready(function() {

            $('#loginForm').submit(function(e) {
                e.preventDefault();
                var data = new FormData(document.getElementById("loginForm"));
                $.ajax({
                    url: "<?= Base_url('login/aksi_login'); ?>",
                    type: "post",
                    data: data,
                    async: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function(data) {
                        $('#loginForm').LoadingOverlay("show");
                    },
                    success: function(data) {
                        if (data == "none") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'User tidak Ada!!',
                            });
                        } else {
                            if (data == "notactive") {
                                $('#loginForm').LoadingOverlay("hide");
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'User tidak Aktif',
                                });
                            } else {
                                if (data == "false") {
                                    $('#loginForm').LoadingOverlay("hide");
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Cek kembali Username dan Password',
                                    });
                                    $('#password').val('');
                                } else {
                                    window.location.href = "<?php echo base_url('dashboard'); ?>";
                                }
                            }
                        }

                    },
                    complete: function() {
                        $('#loginForm').LoadingOverlay("hide");
                    },
                })
            });
        });
    </script>

</body>

</html>