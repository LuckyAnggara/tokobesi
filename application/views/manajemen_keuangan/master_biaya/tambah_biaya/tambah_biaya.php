<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Master Biaya</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Data Umum</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label  m-t-10 ">Nomor Referensi</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input id="nomor_referensi" autocomplete="off" name="nomor_referensi" type="text" class="form-control" value="<?= $master_biaya['nomor_referensi'];?>">
                                    <div class="input-group-append">
                                        <button id="apply_random" name="apply_random" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-random"></i></button>
                                    </div>
                                </div>
                                <small id="id_pelanggan_help" class="form-text text-muted">Klik, untuk membuat nomor referensi secara otomatis</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Tanggal Stock Opname</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal"  value="<?= $master_biaya['tanggal'];?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Keterangan</label>
                            <div class="col-7">
                                <textarea type="text" rows="2" class="form-control" placeholder="(optional)" name="keterangan" id="keterangan"><?= $master_biaya['keterangan'];?></textarea>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col-12">
                                <button name="proses_biaya" id="proses_biaya" class="btn btn-success waves-effect waves-light">
                                    <i class="fa  fa-send"></i>
                                    <span>Proses</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="total_biaya_div" hidden>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label  m-t-10 ">Total Biaya</label>
                            <div class="col-7">
                                <input readonly id="sum_total_biaya" name="sum_total_biaya" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col-12">
                                <button name="close" id="tutup" class="btn btn-inverse waves-effect waves-light">
                                    <i class="fa fa-window-close-o"></i>
                                    <span> Tutup</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-12">
                        <div class="pull-right">
                            <button hidden type="button" id="tambah_data" class="btn btn-primary waves-effect waves-light">Tambah Data</button>
                        </div>
                        <h4 class="m-t-0 header-title">Daftar Rincian Biaya</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-daftar-biaya" class="table table-bordered  dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Total Biaya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div> <!-- container -->