            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-20">
                            <button id="sign" type="button" class="btn btn-danger" data-toggle="dropdown" aria-expanded="false">Closed</button>
                        </div>
                        <h4 class="page-title">Selamat Datang <i><b><?= $this->session->userdata['nama']; ?></b></i></h4>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user ">
                            <h4 class="header-title mt-0 m-b-30">Dana Tersedia</h4>
                            <div>
                                <img src="<?= base_url('assets/images/'); ?>money.png    " class="img-responsive rounded-circle" alt="user">
                                <div class="wid-u-info text-right">
                                    <h3 class="mb-0 counterRupiah" id="dana_tersedia">0</h3>
                                    <p class="text-muted">hari ini</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Total Pengeluaran</h4>
                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <div class="btn-group  pull-left">
                                        <span class="badge dropdown-toggle badge-pill   " data-toggle="dropdown" aria-expanded="false" id="penjualan_trending">0% <i class="mdi mdi-trending-up"></i> </span>
                                        <div class="dropdown-menu" id="dropdown_penjualan">
                                        </div>
                                    </div>
                                    <h3 class="mb-0 counterRupiah" id="pengeluaran">0</h3>
                                    <p class="text-muted">hari ini</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Pending Approval</h4>
                            <div class="table-responsive">
                                <table class="table" id="datatable-daftar-pending">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>##</th>
                                            <th>Task</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                            </div>
                            <h4 class="header-title mt-0">Top Produk</h4>
                            <div class="form-group row m-b-10 col-xl-6 col-sm-12 col-lg-6 col-md-6">
                                <label class="col-3 col-form-label">Waktu</label>
                                <div class="col-9">
                                    <select class="form-control" id="top_produk">
                                        <option value="1">Hari Ini</option>
                                        <option value="2">Bulan Ini</option>
                                    </select>
                                </div>
                            </div>
                            <canvas id="topProdukChart"></canvas>
                        </div>
                    </div><!-- end col -->


                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Monitor Persediaan</h4>
                            <div class="table-responsive">
                                <table class="table" id="datatable-master-persediaan">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Persediaan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->

                </div>
            </div> <!-- container -->