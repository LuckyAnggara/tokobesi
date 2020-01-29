<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Kartu Persediaan Barang</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Data Barang</h4>
                    </div>
                </div>
                <hr>
                <div class="row" id="barang_div">
                    <div class="col-6">
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label m-t-10">Kode Barang</label>
                            <div class="col-9">
                                <select id="select_nama_barang" name="select_nama_barang" type="text" class="form-control"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label  m-t-10 ">Nama Barang</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="nama_barang" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label m-t-10">Metode</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="metode" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label  m-t-10">Satuan</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="satuan" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-kartu-persediaan" class="cell-border table-striped table table-bordered dt-responsive nowrap" width="100%">
                                <thead class="thead-dark text-center">
                                    <tr class="text-center">
                                        <th>Tanggal</th>
                                        <th>Nomor Transaksi</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Saldo</th>
                                        <th>Keterangan</th>
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