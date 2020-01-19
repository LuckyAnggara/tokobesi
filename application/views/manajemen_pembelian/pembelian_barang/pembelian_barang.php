<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Transaksi Pembelian</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Pembelian</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Nomor Transaksi</label>
                    <div class="col-sm-8">
                        <input id="nomor_transaksi" autocomplete="off" name="nomor_transaksi" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_transaksi">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="ti-calendar"></i></span>
                            </div>
                        </div><!-- input-group -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Supplier</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Nama Supplier</label>
                    <div class="col-sm-8">
                        <select id="select_nama_supplier" name="select_nama_supplier" type="text" class="form-control"></select>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="col-4 m-t-0 header-title">Data Barang</h4>
                    <div class="col-8 text-right">
                        <!-- <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="simple" value="option1" name="radioInline" checked>
                                    <label for="inlineRadio1"> Simple </label>
                                </div> -->
                        <label for="inlineRadio1"> Simple </label>
                        <input id="check_type" type="checkbox" data-plugin="switchery" data-color="#1AB394" data-secondary-color="#ED5565" />
                        <label for="inlineRadio2"> Advance </label>
                        <!-- <div class="radio form-check-inline">
                                    <input type="radio" id="advance" value="option2" name="radioInline">
                                    <label for="inlineRadio2"> Advance </label>
                                </div> -->
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
                        <span hidden id="no_order_pembelian"><?= $no_order_pembelian; ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-keranjang-pembelian" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                <div id="grand_total_div" class="col-6">
                    <div class="clearfix row m-t-10">
                        <ul class="col-3" style="list-style-type:none">
                            <li class="text-left m-b-5"><b>Sub Total</b></li>
                            <li class="text-left m-b-5">Diskon</li>
                            <hr>
                            <li class="text-left m-b-5"><b>Sub Total</b></li>
                            <li class="text-left m-t-10">Pajak (PPN)</li>
                            <li class="text-left  m-t-40">Ongkos Kirim</li>
                        </ul>
                        <ul class="col-1" style="list-style-type:none">
                            <li class="text-center m-b-5"><b> : </b></li>
                            <li class="text-center m-b-5"> : </li>
                            <hr>
                            <li class="text-center m-b-5"> : </li>
                            <li class="text-center m-t-10"> : </li>
                            <li class="text-center m-t-40"> : </li>
                        </ul>
                        <ul class=" col-8" style="list-style-type:none">
                            <li class="text-left m-b-5" id="total_pembelian"><b>Rp. 0</b></li>
                            <li class="text-left text-danger m-b-5" id="diskon">(Rp. 0)</li>
                            <hr>
                            <li class="text-left m-b-5" id="sub-total"><b>Rp. 0</b></li>
                            <li class="text-left">
                                <div class="input-group">
                                    <input readonly id="pajak_keluaran" autocomplete="off" name="pajak_keluaran" type="text" class="form-control" value="Rp. 0">
                                    <div class="input-group-append">
                                        <button id="apply_pajak" name="apply_pajak" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                                <small id="id_pelanggan_help" class="form-text text-muted">Klik cek untuk menambah Pajak PPN</small>
                            </li>
                            <li class="text-left">
                                <div class="input-group">
                                    <input id="ongkir" autocomplete="off" name="ongkir" type="text" class="form-control" value="Rp. 0">
                                    <div class="input-group-append">
                                        <button id="apply_ongkir" name="apply_ongkir" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="clearfix row m-t-10">
                        <ul class="col-3" style="list-style-type:none">
                            <li class="text-left">
                                <h4>Grand Total</h4>
                            </li>
                        </ul>
                        <ul class="col-1" style="list-style-type:none">
                            <li class="text-center">
                                <h4> : </h4>
                            </li>
                        </ul>
                        <ul class="col-8" style="list-style-type:none">
                            <li class="text-left">
                                <h4 id="grand_total">Rp.0</h4>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <p id="terbilang_grand_total">Nol Rupiah</p>
                    </div>
                    <!-- end row -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-right m-t-30">
                            <button disabled id="proses_button" name="proses_button" type="button" class="btn  btn-lg btn-success waves-effect waves-light"></i> Proses</button>

                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div> <!-- container -->