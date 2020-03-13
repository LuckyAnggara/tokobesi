            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Selamat Datang <u><b><?= $this->session->userdata['nama']; ?></b></u></h4>
                    </div>
                </div>
                <div class="row">
                <div class="col-xl-12">
                        <div class="card-box">
                            <div class="btn-group pull-right">
                                <a type="button" id="print_btn" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print"> </i> Laporan </a>
                            </div>
                            <h4 class="header-title mt-0 m-b-30">Laporan Kasir - <?= date('d F, Y');?></h4>
                            <div class="row">
                            <div class="table-responsive col-6">
                                <table class="table" id="table-omzet-kasir">
                                    <thead>
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
                            <div class="col-1" id="d">
                            </div>
                            <div class="col-5" id="data_kasir">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Cash on Hand</label>
                                    <div class="col-9">
                                <input name="cash_on_hand" id="cash_on_hand" class="form-control text-right" placeholder="" readonly value="Rp. 0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Total Transaksi</label>
                                    <div class="col-9">
                                <input name="total_transaksi" id="total_transaksi" class="form-control  text-right" placeholder="" readonly value="0 Transaksi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Total Omzet</label>
                                    <div class="col-9">
                                <input name="total_omzet" id="total_omzet" class="form-control text-right" placeholder="" readonly value="Rp. 0">
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Penjualan Terakhir</h4>
                            <div class="table-responsive">
                                <table class="table" id="table-penjualan-terakhir">
                                    <thead>
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
                <!-- end row -->
            </div> <!-- container -->