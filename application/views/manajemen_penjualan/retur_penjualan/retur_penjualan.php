<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Transaksi Pembelian</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Faktur</h4>
                </div>
                <hr>
                <div class="form-group">
                    <label>Nomor Faktur</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">RTR-</span>
                        </div>
                        <input type="text" class="form-control form-control-lg" id="nomor_faktur">
                        <div class="input-group-append">
                            <button id="btn_cari" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row" id="data_div" hidden>
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Pelanggan</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">ID Pelanggan</label>
                    <div class="col-sm-8">
                        <input id="id_pelanggan" name="id_pelanggan" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Nama Pelanggan</label>
                    <div class="col-sm-8">
                        <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Nomor Telepon</label>
                    <div class="col-sm-8">
                        <input id="nomor_telepon" name="nomor_telepon" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Alamat</label>
                    <div class="col-sm-8">
                        <textarea id="alamat" name="alamat" type="text" class="form-control" readonly></textarea>
                    </div>
                </div>
                <div class=" clearfix"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Pembayaran</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-5">Tanggal Transaksi</label>
                    <div class="col-sm-8">
                        <input id="tanggal_transaksi" name="tanggal_transaksi" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Status Pembayaran</label>
                    <div class="col-sm-8">
                        <input id="status_pembayaran" name="status_pembayaran" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Grand Total</label>
                    <div class="col-sm-8">
                        <input id="grand_total" name="grand_total" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Daftar Barang</h4>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-1">
                        <label class="col-form-label"><b>#</b></label>
                        <hr>
                        <div id="nomor">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label"><b>Nama Barang</b></label>
                        <hr>
                        <div id="nama_barang">
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label class="col-form-label"><b>Qty</b></label>
                        <hr>
                        <div id="qty">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="col-form-label"><b>Harga</b></label>
                        <hr>
                        <div id="harga">
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label class="col-form-label"><b>Qty Retur</b></label>
                        <hr>
                        <div id="qty_retur">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="col-form-label"><b>Keterangan</b></label>
                        <hr>
                        <div id="keterangan">

                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label class="col-form-label"><b>Action</b></label>
                        <hr>
                        <button class="btn btn-primary waves-effect waves-light" type="button"><i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->