            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Selamat Datang <?= $this->session->userdata['nama']; ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Penjualan Terakhir</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered  dt-responsive nowrap" id="table-penjualan-terakhir">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>##</th>
                                            <th>Nomor Faktur</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->


            </div> <!-- container -->