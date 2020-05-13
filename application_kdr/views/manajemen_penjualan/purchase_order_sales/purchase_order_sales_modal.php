<div id="pelanggan_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog md-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="data_label_chekcout">Database Pelanggan</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <table id="datatable-master-pelanggan" class="table table-striped table-bordered  dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Pelanggan</th>
                            <th>Nama Pelanggan</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button id="pelanggan-md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal_detail_penjualan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog md-lg">
        <div class="modal-content">
            <form data-parsley-validate novalidate autocomplete="off" id="password_form" method="post" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" hidden id="label_kode_barang"></h5>
                    <h4 class="modal-title" id="label_nama_barang"></h4>
                </div>
                <div class="modal-body">
                    <h5 class="text-uppercase">Sisa Persediaan <span class="text-danger" id="sisa_persediaan"></span> <span id="sisa_satuan"></span></h4>
                        <div class="form-group">
                            <label class="control-label">Quantity</label>
                            <input id="qty" type="text" value="1" name="qty" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="true" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Harga Jual</label>
                            <div class="input-group">
                                <input readonly id="dummy_harga_jual" autocomplete="off" name="dummy_harga_jual" type="text" class="form-control" placeholder="">
                                <input hidden id="harga_jual" autocomplete="off" name="harga_jual" type="text" class="form-control" placeholder="">
                                <div class="input-group-append" id="div_cari-button">
                                    <button id="btn_harga_jual" name="btn_harga_jual" onClick="overide_harga();" class=" btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Diskon</label>
                            <input id="dummy_diskon" autocomplete="off" name="diskon" type="text" class="form-control" val="0">
                            <input hidden id="diskon" autocomplete="off" name="diskon" type="text" class="form-control" val="0">
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="penjualan-md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" id="button-penjualan-add" data-dismiss="modal" class="btn btn-primary waves-effect waves-light">Tambah</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog md-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Password Overide</label>
                    <input type="password" id="password_input" class="form-control" aria-describedby="emailHelp" placeholder="Password">
                </div>
            </div>
            <div class="modal-footer">
                <button id="password-md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" id="button-password-add" data-dismiss="modal" class="btn btn-danger waves-effect waves-light">Submit</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>