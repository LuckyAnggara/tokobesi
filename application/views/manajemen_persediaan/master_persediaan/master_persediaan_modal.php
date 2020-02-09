<div id="view_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="view_data_label">Detail Persediaan <b><span id="kode_barang">31-01-2020</span></b> per <span id="awal_modal">31-01-2020</span> s.d <span id="akhir_modal">31-01-2020</span></h4>
                <span id="kode_barang" hidden></span>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-pills ">
                    <li class="nav-item">
                        <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            Saldo Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                            Saldo Keluar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Saldo Keranjang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#settings1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Saldo Keranjang P.O
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade show active" id="home1">
                        <h6>Saldo awal barang, berdasarkan dari pembelian barang</h6>
                        <div class="table-responsive">
                            <table id="datatable-saldo-awal" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nomor Transaksi</th>
                                        <th>Qty Pembelian</th>
                                        <th>Harga Pembelian</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile1">
                        <h6>Saldo akhir barang, berdasarkan dari penjualan barang</h6>
                        <div class="table-responsive">
                            <table id="datatable-saldo-akhir" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nomor Faktur</th>
                                        <th>Qty Penjualan</th>
                                        <th>Harga Penjualan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="messages1">
                        <h6>Saldo keranjang barang, berdasarkan dari barang yang masih berada di keranjang</h6>
                        <div class="table-responsive">
                            <table id="datatable-saldo-cart" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Input</th>
                                        <th>Nomor Order</th>
                                        <th>Qty</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings1">
                        <h6>Saldo keranjang <i>purchase order</i> barang, berdasarkan dari barang yang masih berada di keranjang</h6>
                        <div class="table-responsive">
                            <table id="datatable-saldo-cartPo" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Input</th>
                                        <th>Nomor Order</th>
                                        <th>Qty</th>
                                        <th>Sales</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="view_md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>