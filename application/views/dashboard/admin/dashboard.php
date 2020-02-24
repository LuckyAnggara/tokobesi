            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Selamat Datang <i><b><?= $this->session->userdata['nama']; ?></b></i></h4>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Pembelian</h4>
                            <div class="table-responsive">
                                <table class="table" id="table-pembelian-terakhir">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>##</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Daftar Pending P.O Sales</h4>
                            <div class="table-responsive">
                                <table class="table" id="table-po-sales">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>##</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Total</th>
                                            <th>Sales</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container -->