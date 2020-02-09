<!-- Modal Checkout -->
<div id="checkout_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="data_label_chekcout">Checkout No Order : xxxxx</h3>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Tanggal Faktur</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_faktur">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="ti-calendar"></i></span>
                            </div>
                        </div><!-- input-group -->
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Total Order</label>
                    <div class="col-7">
                        <h4 id="total_checkout">Rp. 100.000.0000,-</h4>
                        <small id="total_checkout_terbilang" class="form-text text-muted">(Seratus Juta Rupiah)</small>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Discount</label>
                    <div class="col-7">
                        <h4 id="checkout_discount">Rp. 0,-</h4>
                    </div>
                </div>
                <div id="div_checkout_pajak" class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Pajak <span>(PPN 10%)</span></label>
                    <div class="col-7">
                        <div class="input-group">
                            <input readonly id="total_pajak" autocomplete="off" name="total_pajak" type="text" class="form-control" value="Rp. 0">
                            <div class="input-group-append" id="div_cari-pajak">
                                <button id="apply_pajak" name="apply_pajak" onClick="apply_pajak();" class=" btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                        <small id="id_pelanggan_help" class="form-text text-muted">Klik cek untuk menambah Pajak PPN</small>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Sub-Total</label>
                    <div class="col-7">
                        <h4 id="total_setelah_pajak">Rp. 0,-</h4>
                        <small id="total_setelah_pajak_terbilang" class="form-text text-muted">(Seratus Juta Rupiah)</small>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-5 colform-label m-t-5">Ongkos Kirim</label>
                    <div class="col-7">
                        <div class="input-group">
                            <input id="ongkir" autocomplete="off" name="ongkir" type="text" class="form-control" val="0">
                            <div class="input-group-append">
                                <button id="apply_ongkir" name="apply_ongkir" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                        <small id="id_pelanggan_help" class="form-text text-muted">Input ongkos kirim jika ada dan centang ceklist</small>
                    </div>
                </div>

                <hr>
                <div class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Grand Total</label>
                    <div class="col-7">
                        <h2 id="checkout_grand_total">Rp. 0,-</h2>
                        <p id="checkout_grand_total_terbilang">( Nol Rupiah )</p>
                    </div>
                </div>
                <hr>
                <div hidden id="kredit_div">
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
            </div>
            <!-- dummy input -->
            <small hidden id="total_checkout_dummy" class="form-text text-muted"></small>
            <small hidden id="chekcout_discount_dummy" class="form-text text-muted"></small>
            <small hidden id="checkout_pajak_dummy" class="form-text text-muted"></small>
            <small hidden id="ongkir_dummy" class="form-text text-muted"></small>
            <small hidden id="grand_total_dummy" class="form-text text-muted"></small>
            <div class="modal-footer">
                <div id="div_tombol_kredit" class="col-6 text-left">
                    <label for="inlineRadio1"> Tunai </label>
                    <input id="check_pembayaran" type="checkbox" data-plugin="switchery" data-color="#ED5565" data-secondary-color="#00b845" />
                    <label for="inlineRadio2"> Kredit </label>
                </div>
                <div class="col-6 text-right">
                    <button id="batal_checkout" name="batal_checkout" type="button" data-dismiss="modal" class="btn btn-default waves-effect">Batal</button>
                    <button type="submit" id="bayar_checkout" name="bayar_checkout" class="btn btn-primary waves-effect waves-light">Proses</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>