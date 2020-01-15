<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card-box">
                        <div class="form-group row">
                            <h4 class="m-t-0 header-title">Data Pelanggan</h4>
                        </div>
                        <hr>
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
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea id="alamat" name="alamat" type="text" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input placeholder="Optional" id="nomor_telepon" name="nomor_telepon" type="text" class="form-control">
                            </div>
                        </div>
                        <small id="data_pelanggan_help" class="form-text text-muted">Silahkan gunakan fitur Cari, jika Pelanggan memiliki ID.</small>


                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card-box">
                         <div class="form-group row">
                            <h4 class="col-4 m-t-0 header-title">Data Barang</h4>
                            <div class="col-8 text-right">
                                <label for="inlineRadio1"> Simple </label>
                                <input id="check_type" type="checkbox" data-plugin="switchery" data-color="#1AB394" data-secondary-color="#ED5565" />
                                <label for="inlineRadio2"> Advance </label>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-2 col-sm-form-label">Cari Nama Barang</label>
                            <div class="col-sm-10">
                                <select name="select_nama_barang" id="select_nama_barang" class="form-control">
                                </select>
                                <input autocomplete="off" placeholder="Kolom Pencarian Barang.." id="cari_barang" name="cari_barang" type="text" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="result_page">
                            <div class="col-12 text-center">
                                <p>Cari Data Barang di Kolom Pencarian</p>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="m-t-0 header-title">Keranjang Belanja</h4>
                                <h4>Nomor Order : <span id="no_order"><?= $no_order; ?></span></h4>
                            </div>
                            <!-- <div class="col-6">
                                <button disabled type="submit" id="simpan_checkout" name="simpan_checkout" class="btn btn-success waves-effect waves-light pull-right"><i class="fa fa-check"></i> Simpan</button>
                            </div> -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable-keranjang-penjualan" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Qty</th>
                                                <th>Diskon</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <hr>
                        <div class="row">
                            <div class="col-sm-2">
                                <h3 class="m-t-0">Total :</h3>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="m-t-0" id="total_keranjang">Rp. 0</h3>
                            </div>
                            <div class="col-sm-6 pull-left">
                                <h3 class="m-t-0" id="terbilang_keranjang">Nol Rupiah</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-t-30">
                                    <button id="checkout" name="checkout" type="button" class="btn  btn-lg btn-secondary waves-effect waves-light"><i class="dripicons-cart"></i> Checkout</button>
                                    <!-- <a href="#custom-modal" class="btn  btn-lg btn-secondary waves-effect waves-light m-r-5 m-b-10" data-animation="makeway" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a"><i class="dripicons-cart"></i> Checkout</a> -->
                                    <!-- <a id="checkout" type="submit" class="btn btn-lg btn-secondary waves-effect waves-light m-r-5 m-b-10"><i class="dripicons-cart"></i> Checkout</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


        </div> <!-- container -->

    </div> <!-- content -->

    <?php $this->view('template/template_footer'); ?>


</div>

<!-- Modal Checkout -->
<div  id="checkout_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="data_label_chekcout">Checkout No Order : xxxxx</h3>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
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
                    <!-- <div class="col-7">
                        <h4 id="checkout_pajak">Rp. 0,-</h4>
                    </div> -->

                    <div class="col-7">
                        <div class="input-group">
                            <input  readonly id="checkout_pajak" autocomplete="off" name="checkout_pajak" type="text" class="form-control" val="0">
                            <div class="input-group-append">
                                <button id="apply_pajak" name="apply_pajak" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>
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
                <div id="kredit_div" class="form-group row">
                    <label class="col-5 col-form-label m-t-5">Tanggal Jatuh Tempo</label>
                    <div class="col-7">
                        <input type="text">
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
                <div class="col-8 text-left">
                    <label for="inlineRadio1"> Tunai </label>
                    <input id="check_type" type="checkbox" data-plugin="switchery" data-color="#1AB394" data-secondary-color="#ED5565" />
                    <label for="inlineRadio2"> Kredit </label>
                </div>
                <button id="batal_checkout" name="batal_checkout" type="button" data-dismiss="modal" class="btn btn-default waves-effect">Batal</button>
                <button type="submit" id="bayar_checkout" name="bayar_checkout" class="btn btn-primary waves-effect waves-light">Bayar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Modal Cari Data Pelanggan -->

<div id="pelanggan_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog md-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="data_label_chekcout">Database Pelanggan</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
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
                <h5 class="modal-title" id="label_kode_barang"></h5>
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