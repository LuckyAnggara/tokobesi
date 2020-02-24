            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Dashboard Executive</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mt-0">Total Laba</h4>
                            <div class="form-group row m-b-10 col-xl-6 col-sm-12 col-lg-6 col-md-6">
                                <label class="col-2 col-form-label">Bulan</label>
                                <div class="col-9">
                                    <select class="form-control" id="laba_bulan">
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <canvas id="myChart" height="100"></canvas>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Total Penjualan</h4>
                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <div class="btn-group  pull-left">
                                        <span class="badge dropdown-toggle badge-pill counterTrend" data-toggle="dropdown" aria-expanded="false" id="penjualan_trending">0% <i class="mdi mdi-trending-up"></i> </span>
                                        <div class="dropdown-menu" id="dropdown_penjualan">
                                        </div>
                                    </div>
                                    <h3 class="mb-0 counterRupiah" id="penjualan_value">0</h3>
                                    <p class="text-muted">hari ini</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Total Pembelian</h4>
                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <div class="btn-group  pull-left">
                                        <span class="badge dropdown-toggle badge-pill counterTrend" data-toggle="dropdown" aria-expanded="false" id="pembelian_trending">0% <i class="mdi mdi-trending-up"></i> </span>
                                        <div class="dropdown-menu" id="dropdown_pembelian">
                                        </div>
                                    </div>
                                    <h3 class="mb-0 counterRupiah" id="pembelian_value">0</h3>
                                    <p class="text-muted">hari ini</p>

                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Produk Terjual</h4>
                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <div class="btn-group  pull-left">
                                        <span class="badge dropdown-toggle badge-pill counterTrend" data-toggle="dropdown" aria-expanded="false" id="produk_terjual_trending">0% <i class="mdi mdi-trending-up"></i> </span>
                                        <div class="dropdown-menu" id="dropdown_produk_terjual">
                                        </div>
                                    </div>
                                    <h3 class="mb-0"><span class="counterSatuan" id="produk_terjual_value">0</span><span> Unit</span></h3>
                                    <p class="text-muted">hari ini</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->



                    <div class="col-xl-3 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Transaksi Penjualan</h4>
                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <div class="btn-group  pull-left">
                                        <span class="badge dropdown-toggle badge-pill counterTrend" data-toggle="dropdown" aria-expanded="false" id="transaksi_trending">0% <i class="mdi mdi-trending-up"></i> </span>
                                        <div class="dropdown-menu" id="dropdown_transaksi_penjualan">
                                        </div>
                                    </div>
                                    <h3 class="mb-0"><span class="counterSatuan" id="transaksi_value">0</span><span> Transaksi</span></h3>
                                    <p class="text-muted">hari ini</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                </div>


                <!-- end row -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card-box">
                            <h4 class="header-title">Top 5 Sales</h4>
                            <div class="form-group">
                                <select class="form-control" id="top_sales_bulan">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="inbox-widget nicescroll" id="top_sales">
                                <div class="col-12 text-center">
                                    <p>Belum ada Data</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col-xl-8">
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
                                            <th>User</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                            </div>
                            <h4 class="header-title mt-0">Top Produk</h4>
                            <div class="form-group row m-b-10 col-xl-6 col-sm-12 col-lg-6 col-md-6">
                                <label class="col-3 col-form-label">Filter</label>
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

                    <div class="col-xl-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                            </div>
                            <h4 class="header-title mt-0">Produktifitas Sales</h4>
                            <div class="form-group row m-b-10 col-xl-6 col-sm-12 col-lg-6 col-md-6">
                                <label class="col-5 col-form-label">Nama Sales</label>
                                <div class="col-7">
                                    <select class="form-control" id="produktifitas_sales">
                                        <?php foreach ($sales as $key => $value) : ?>
                                            <option value="<?= $value['username']; ?>"><?= $value['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <canvas id="produktifitasSalesChart"></canvas>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Top Piutang</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered  dt-responsive nowrap" id="table-piutang">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor Faktur</th>
                                            <th>Tangal Jt Tempo</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Top Utang</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered  dt-responsive nowrap" id="table-hutang">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor Faktur</th>
                                            <th>Tangal Jt Tempo</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->


            </div> <!-- container -->