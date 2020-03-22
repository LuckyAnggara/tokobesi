<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Daftar Piutang</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Filter Data</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-sm-1 col-sm-form-label m-t-10">Tanggal</label>
                            <div class="col-sm-5 col-lg-3 col-md-3">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_awal">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                            <label class="col-sm-1 col-sm-form-label text-center m-t-10">S.D</label>
                            <div class="col-sm-5 col-lg-3 col-md-3">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_akhir">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2 col-lg-2">
                                    <button name="filter" id="filter" class="btn btn-primary waves-effect waves-light">
                                        <i class="fa fa-filter"></i>
                                        <span> Filter</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="div_saldo_utang">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Saldo Piutang</label>
                                <div class="col-3">
                                    <input name="saldo_piutang" id="saldo_piutang" type="text" class="form-control text-right" placeholder="" readonly>
                                </div>
                                <!-- <div class="col-3">
                            <input name="sub_total_harga" id="sub_total_harga" type="text" class="form-control" placeholder="" readonly>
                        </div> -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="card-box">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-pills ">
                        <li class="nav-item">
                            <a href="#transaksi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Master Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#notifikasi" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Daftar Pembayaran
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="transaksi">
                            <div class="table-responsive">
                                <table id="datatable-daftar-piutang" class="table table-striped table-bordered  dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Nomor Faktur</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Tanggal Jatuh Tempo</th>
                                            <th>Total Tagihan</th>
                                            <th>Total Pembayaran</th>
                                            <th>Sisa Pembayaran</th>
                                            <th>Sales</th>
                                            <th>Admin / Cashier</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="notifikasi">
                            <div class="table-responsive">
                                <table id="datatable-detail-pembayaran-piutang" class="table table-striped table-bordered  dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Nominal Pembayaran</th>
                                            <th>Keterangan</th>
                                            <th>Admin / Cashier</th>
                                            <th>Bukti</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>