<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Review Order : <span id="no_order"><?= $no_order; ?></span>
        </div>
    </div>

    <div class="row" id="loading">
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box" id="total_loading">
                <div class="clearfix row">
                    <ul class="col-3" style="list-style-type:none">
                        <li class="text-left">Total</li>
                    </ul>
                    <ul class="col-1" style="list-style-type:none">
                        <li class="text-left"> : </li>
                    </ul>
                    <ul class="col-6" style="list-style-type:none">
                        <b>
                            <li class="text-left" id="grand_total"></li>
                        </b>
                    </ul>
                </div>
                <div class="collapse" id="total_collapse">
                    <div class="well">
                        <hr>
                        <div class="clearfix row">
                            <ul class="col-3" style="list-style-type:none">
                                <li class="text-left m-b-10">Total</li>
                                <li class="text-left m-b-15">Diskon</li>
                                <li class="text-left m-b-3">Pajak</li>
                            </ul>
                            <ul class="col-1" style="list-style-type:none">
                                <li class="text-left m-b-10"> : </li>
                                <li class="text-left m-b-15"> : </li>
                                <li class="text-left m-b-3"> : </li>
                            </ul>
                            <ul class="col-8" style="list-style-type:none">
                                <li class="text-left m-b-10" id="total_penjualan"></li>
                                <li class="text-left m-b-10 text-danger">(<span id="total_diskon"></span>)</li>
                                <li class="text-left m-b-3">
                                    <div class="input-group">
                                        <input readonly id="total_pajak" autocomplete="off" name="total_pajak" type="text" class="form-control" value="Rp. 0">
                                        <div class="input-group-append" id="div_cari-pajak">
                                            <button id="apply_pajak" name="apply_pajak" onClick="apply_pajak();" class=" btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <hr>

                <p aria-controls="total_collapse" aria-expanded="false" class="text-center text-primary" data-toggle="collapse" href="#total_collapse">
                    Expand..
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box" id="pelanggan_loading">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Pelanggan</h4>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">ID Pelanggan</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input id="id_pelanggan" autocomplete="off" name="id_pelanggan" type="text" class="form-control" placeholder="">
                            <div class="input-group-append" id="div_cari-button">
                                <button id="cari-button" name="cari-button" onClick="cari_pelanggan();" class=" btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <small id="id_pelanggan_help" class="form-text text-muted">Kosong kan jika tidak ada ID Pelanggan</small>
                    </div>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="well">

                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">Alamat Pengiriman</label>
                            <div class="col-sm-8">
                                <textarea id="alamat" name="alamat" type="text" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input required id="nomor_telepon" name="nomor_telepon" type="text" class="form-control">
                            </div>
                        </div>
                        <small id="data_pelanggan_help" class="form-text text-muted">Silahkan gunakan fitur Cari, jika Pelanggan memiliki ID.</small>
                    </div>
                </div>
                <hr>

                <p aria-controls="collapseExample" aria-expanded="false" class="text-center text-primary" data-toggle="collapse" href="#collapseExample">
                    Expand..
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box text-center">
                <button type="submit" id="proses" class="btn btn-success waves-effect waves-light">Proses</button>
                <button type="submit" id="batal" class="btn btn-danger waves-effect waves-light">Batal</button>
            </div>
        </div>
    </div>

</div> <!-- end container -->