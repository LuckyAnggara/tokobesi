<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Stock Opname</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Data Barang</h4>
                    </div>
                </div>
                <hr>
                <div class="row" id="barang_div">

                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label  m-t-10 ">Nomor Referensi</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input id="nomor_referensi" autocomplete="off" name="nomor_referensi" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <button id="apply_random" name="apply_random" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-random"></i></button>
                                    </div>
                                </div>
                                <small id="id_pelanggan_help" class="form-text text-muted">Klik, untuk membuat nomor referensi secara otomatis</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Tanggal Stock Opname</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Keterangan</label>
                            <div class="col-7">
                                <textarea type="text" rows="2" class="form-control" placeholder="(optional)" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Upload</label>
                            <div class="col-7">
                                <input type="file" rows="2" class="form-control" placeholder="(optional)">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Upload</label>
                            <button name="download_format" id="download_format"  class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-20">
                                <i class="fa fa-plus"></i>
                                <span>Tambah Data</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-stock-opname" class="table-hover table-striped table table-compact dt-responsive nowrap" width="100%">
                                <thead class="thead-dark text-center">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Saldo (Buku)</th>
                                        <th>Saldo (Fisik)</th>
                                        <th>Selisih</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div>
    </div>


</div> <!-- container -->