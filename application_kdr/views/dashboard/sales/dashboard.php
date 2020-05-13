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
                            <h4 class="header-title mt-0 m-b-30">Daftar P.O Pending</h4>
                            <div class="table-responsive">
                                <table class="table" id="datatable-daftar-po">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>##</th>
                                            <th>Nomor P.O</th>
                                            <th>Grand Total</th>
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

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-30">Insentif Kamu</h4>
                            <div class="form-group">
                                <label><b>Bulan</b></label>
                                <select class="form-control" id="bulan">
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
                            <div class="table-responsive">
                                <table id="datatable-daftar-insentif" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Nomor Faktur</th>
                                            <th>Total Insentif</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label><b>Total Perolehan Insentif <span id="label_bulan">Januari</span></b></label>
                                <h4 class="counterRupiah" id='insentif'>null</h4>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container -->