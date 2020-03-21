<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Daftar Data Biaya</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-pills ">
                        <li class="nav-item">
                            <a href="#transaksi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Hari Ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#notifikasi" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Hari Lalu
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="transaksi">
                            <div class='row'>
                                <button name="tambah_data" id="tambah_data" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-20">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Data</span>
                                </button>
                                <div class="table-responsive">
                                    <table id="datatable-daftar-biaya" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Jam</th>
                                                <th>Kategori</th>
                                                <th>Keterangan</th>
                                                <th>Total Biaya</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="text-right" id="div_saldo_akhir">
                                <div class="form-group row">
                                    <label class="col-6 col-form-label"></label>
                                    <label class="col-3 col-form-label">Saldo Akhir</label>
                                    <div class="col-3">
                                        <input name="saldo_akhir" id="saldo_akhir" type="text" class="form-control" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="notifikasi">
                            <div class="row">
                                <div class=" form-group row">
                                    <label class="col-sm-1 col-sm-form-label m-t-10">Tanggal</label>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_awal">
                                            <div class="input-group-append">
                                                <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                    <label class="col-sm-1 col-sm-form-label text-center m-t-10">S.D</label>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_akhir">
                                            <div class="input-group-append">
                                                <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <button name="filter" id="filter" class="btn btn-primary waves-effect waves-light">
                                            <i class="fa fa-filter"></i>
                                            <span> Filter</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable-daftar-biaya-histori" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Keterangan</th>
                                                <th>Total Biaya</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="text-right" id="div_saldo_akhir">
                                <div class="form-group row">
                                    <label class="col-6 col-form-label"></label>
                                    <label class="col-3 col-form-label">Saldo Akhir</label>
                                    <div class="col-3">
                                        <input name="saldo_akhir_histori" id="saldo_akhir_histori" type="text" class="form-control" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>