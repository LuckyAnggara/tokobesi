<!-- Modal Cari Data Pelanggan -->

<div id="modal_detail_pembelian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog md-lg">
        <div class="modal-content">
            <form data-parsley-validate novalidate autocomplete="off" id="password_form" method="post" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="label_kode_barang"></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Quantity</label>
                        <input id="qty" type="text" value="1" name="qty" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="true" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Harga</label>
                        <input id="dummy_harga_beli" autocomplete="off" name="dummy_harga_beli" type="text" class="form-control" placeholder="">
                        <input hidden id="harga_beli" autocomplete="off" name="harga_beli" type="text" class="form-control" placeholder="">
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label">Diskon</label>
                        <input id="dummy_diskon" autocomplete="off" name="diskon" type="text" class="form-control" val="0">
                        <input hidden id="diskon" autocomplete="off" name="diskon" type="text" class="form-control" val="0">
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button id="pembelian-md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" id="button-pembelian-add" data-dismiss="modal" class="btn btn-primary waves-effect waves-light">Tambah</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>