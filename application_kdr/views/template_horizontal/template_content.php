<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Datatables</h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
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

</div> <!-- end container -->