<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Master Persediaan<span class="badge badge-danger" id="filter_status">Real Time</span></h4>
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
                            <label class="col-sm-1 col-sm-form-label">Status</label>
                            <div class="col-sm-11 col-md-7 col-lg-7 m-b-10">
                                <select name="status" id="status" class="form-control">
                                    <option value="0">Real Time</option>
                                    <option value="1">Tanggal Tertentu</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <button name="filter" id="filter" class="btn btn-primary waves-effect waves-light">
                                    <i class="fa fa-filter"></i>
                                    <span> Filter</span>
                                </button>
                            </div>

                        </div>
                        <div class="form-group row" id="tanggal_filter" hidden>
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
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table id="datatable-master-persediaan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Saldo Awal</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>In Cart</th>
                                <th>In Cart (PO)</th>
                                <th>Saldo Akhir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>