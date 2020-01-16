
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
                                    <input type="text" autocomplete= "off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_transaksi">
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
                        <!-- <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">ID Supplier</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input id="id_pelanggan" autocomplete="off" name="id_pelanggan" type="text" class="form-control" placeholder="Isi ID Pelanggan, jika ada">
                                    <div class="input-group-append" id="div_cari-button">
                                        <button id="cari-button" name="cari-button" onClick="cari_pelanggan();" class=" btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
                                                <th>Nama Barang</th>
                                                <th>Harga Beli</th>
                                                <th>Jumlah Pembelian</th>
                                                <th>Total Harga</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <hr>
                        <div hidden id="grand_total_div" class="col-6">
                            <div class="clearfix row m-t-10">
                                <ul class="col-3" style="list-style-type:none">
                                    <li class="text-left m-b-5">Total</li>
                                    <li class="text-left m-b-5">Diskon</li>
                                    <li class="text-left checkbox checkbox-primary ">
                                        <input id="checkbox" type="checkbox">
                                        <label for="checkbox">
                                            Pajak (PPN)
                                        </label>
                                    </li>
                                </ul>
                                <ul class="col-1" style="list-style-type:none">
                                    <li class="text-center m-b-5"> : </li>
                                    <li class="text-center m-b-5"> : </li>
                                    <li class="text-center "> : </li>
                                </ul>
                                <ul class="col-8" style="list-style-type:none">
                                    <li class="text-left m-b-5" id="total_pembelian">Rp. 0</li>
                                    <li class="text-left m-b-5" id="diskon">Rp. 0</li>
                                    <li class="text-left" id="pajak_keluaran">Rp. 0</li>
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
                                    <button disabled id="confim_button" name="confim_button" type="button" class="btn  btn-lg btn-success waves-effect waves-light"><i class="fa fa-check"></i> Confirm</button>
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

