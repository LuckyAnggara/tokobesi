<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Kartu Persediaan Barang</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Data Barang</h4>
                    </div>
                </div>
                <hr>
                <div class="row" id="barang_div">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label m-t-10">Kode</label>
                            <div class="col-9">
                                <select id="select_nama_barang" name="select_nama_barang" type="text" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label  m-t-10 ">Nama</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="nama_barang" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label m-t-10">Metode</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="metode" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
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
        <div class="col-8">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-kartu-persediaan" class="table-hover table-striped table table-compact dt-responsive nowrap " width="100%">
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
                <div class="text-right" id="div_saldo_akhir">
                    <div class="form-group row">
                        <label class="col-4 col-form-label"></label>
                        <label class="col-3 col-form-label">Saldo Akhir</label>
                        <div class="col-3">
                            <input name="saldo_akhir" id="saldo_akhir" type="text" class="form-control" placeholder="" readonly>
                        </div>
                        <!-- <div class="col-3">
                            <input name="sub_total_harga" id="sub_total_harga" type="text" class="form-control" placeholder="" readonly>
                        </div> -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


</div> <!-- container -->