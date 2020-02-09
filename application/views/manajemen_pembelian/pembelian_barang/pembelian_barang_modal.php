<!-- Modal Checkout -->
<div id="proses_kredit_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="data_label_chekcout">Proses Nomor Transaksi : xxxxx</h3>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Grand Total</label>
                    <div class="col-7">
                        <h2 id="checkout_grand_total">Rp. 0,-</h2>
                        <p id="checkout_grand_total_terbilang">( Nol Rupiah )</p>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-5 colform-label m-t-5">Down Payment (DP)</label>
                    <div class="col-7">
                        <div class="input-group">
                            <input id="dummy_dp" autocomplete="off" name="ongkir" type="text" class="form-control" val="0">
                            <input hidden id="dp" autocomplete="off" name="ongkir" type="text" class="form-control" val="0">
                            <div class="input-group-append">
                                <button id="apply_dp" name="apply_dp" class="btn btn-dark waves-effect waves-light" type="button">0%</button>
                            </div>
                        </div>
                        <small id="id_pelanggan_help" class="form-text text-muted">Input ongkos kirim jika ada dan centang ceklist</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Tanggal Jatuh Tempo</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_jatuh_tempo">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="ti-calendar"></i></span>
                            </div>
                        </div><!-- input-group -->
                    </div>
                </div>
            </div>
            <!-- dummy input -->
            <div class="modal-footer">
                <div class="col-6 text-right">
                    <button id="batal_checkout" name="batal_checkout" type="button" data-dismiss="modal" class="btn btn-default waves-effect">Batal</button>
                    <button type="proses_kredit" id="proses_kredit" name="bayar_checkout" data-dismiss="modal" class="btn btn-primary waves-effect waves-light">Proses</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

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
                        <label class="control-label">Harga Beli</label>
                        <input id="dummy_harga_beli" autocomplete="off" name="dummy_harga_beli" type="text" class="form-control" placeholder="">
                        <input hidden id="harga_beli" autocomplete="off" name="harga_beli" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Diskon</label>
                        <input id="dummy_diskon" autocomplete="off" name="diskon" type="text" class="form-control" val="0">
                        <input hidden id="diskon" autocomplete="off" name="diskon" type="text" class="form-control" val="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="pembelian-md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" id="button-pembelian-add" data-dismiss="modal" class="btn btn-primary waves-effect waves-light">Tambah</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>