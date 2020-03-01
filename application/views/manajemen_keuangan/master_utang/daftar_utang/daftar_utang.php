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
                                        <span>Filter</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table id="datatable-daftar-utang" class="table table-striped table-bordered  dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nomor Transaksi</th>
                                <th>Supplier</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Total Tagihan</th>
                                <th>Total Pembayaran</th>
                                <th>Sisa Pembayaran</th>
                                <th>Admin / Cashier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <hr>
                <div class="text-right" id="div_saldo_utang">
                    <div class="form-group row">
                        <label class="col-4 col-form-label"></label>
                        <label class="col-3 col-form-label">Saldo Piutang</label>
                        <div class="col-3">
                            <input name="saldo_utang" id="saldo_utang" type="text" class="form-control" placeholder="" readonly>
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