<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Purchase Order Cabang</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="col-12 header-title">Data Pruchase Order</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Kirim Ke</label>
                    <div class="col-sm-8">
                        <select id="select_nama_cabang" name="select_nama_cabang" type="text" class="form-control"></select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Tanggal P.O</label>
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
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="col-12 m-t-0 header-title">Data Barang</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <select name="select_nama_barang" id="select_nama_barang" class="form-control">
                        </select>
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
        </div>
        <div class="col-8">

            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Keranjang Purchase Order</h4>
                        Nomor : #<span id="no_order_po"><?= $no_order_po; ?></span>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <button disabled id="proses_button" name="proses_button" type="button" class="btn  btn-lg btn-success waves-effect waves-light"></i> Proses</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-keranjang-po" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
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
                    <div id="grand_total_div" class="col-6">
                        <div class="clearfix row m-t-10">
                            <ul class="col-4" style="list-style-type:none">
                                <li class="text-left m-b-5"><b>Sub Total</b></li>
                                <li class="text-left  m-t-15">Biaya Lain</li>
                            </ul>
                            <ul class="col-1" style="list-style-type:none">
                                <li class="text-center m-b-5"> : </li>
                                <li class="text-center m-t-15"> : </li>
                            </ul>
                            <ul class=" col-7" style="list-style-type:none">
                                <li class="text-left m-b-5" id="sub-total"><b>Rp. 0</b></li>
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
                            <ul class="col-4" style="list-style-type:none">
                                <li class="text-left">
                                    <h4>
                                        <b>
                                            Grand Total
                                        </b>
                                    </h4>
                                </li>
                            </ul>
                            <ul class="col-1" style="list-style-type:none">
                                <li class="text-center">
                                    <h4> : </h4>
                                </li>
                            </ul>
                            <ul class="col-7" style="list-style-type:none">
                                <li class="text-left">
                                    <h4 id="grand_total">Rp.0</h4>
                                </li>
                            </ul>
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Catatan</label>
                            <textarea type="text" rows="40" class="form-control" id="keterangan" name="keterangan" placeholder="Catatan untuk tujuan">asdasdas</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- container -->