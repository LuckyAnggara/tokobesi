<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Detail Stok Opname</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Data Stok Opname</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label  m-t-10 ">Nomor Referensi</label>
                            <div class="col-7">
                                <input id="nomor_referensi" autocomplete="off" name="nomor_referensi" type="text" class="form-control" readonly value="<?= $stok_opname['nomor_referensi']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Tanggal Stock Opname</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Keterangan</label>
                            <div class="col-7">
                                <textarea type="text" rows="2" class="form-control" placeholder="(optional)" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">

            <div class="card-box">
                <div class="row">
                    <div class="col-12">
                        <div class="pull-right">
                            <button type="button" id="confirm" class="btn btn-success waves-effect waves-light">Confirm</button>
                        </div>
                        <h4 class="m-t-0 header-title">Data</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-stok-opname" class="table-hover table-striped table table-compact dt-responsive nowrap" width="100%">
                                <thead class="thead-dark text-center">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Saldo (Buku)</th>
                                        <th>Saldo (Fisik)</th>
                                        <th>Selisih</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>

            <!-- Form Selisih -->

            <div class="card-box" id="box_selisih" hidden>
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title" id="myModalLabel">Detail Selisih</h4><small hidden id="id"></small>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-sm-12 col-lg-3 col-md-3 col-form-label">Kode Barang</label>
                            <div class="col-sm-12 col-lg-9 col-md-9">
                                <input style="text-transform:uppercase" name="detail_kode_barang" id="detail_kode_barang" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-lg-3 col-md-3 col-form-label">Jumlah Selisih</label>
                            <div class="col-sm-12 col-lg-9 col-md-9">
                                <div class="input-group">
                                    <input name="detail_qty_selisih" id="detail_qty_selisih" type="text" class="form-control" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse">Pieces</span>
                                    </div>
                                </div><!-- input-group -->
                            </div>

                            <label class="col-sm-12 col-lg-3 col-md-3 col-form-label">Sisa Selisih</label>
                            <div class="col-sm-12 col-lg-3 col-md-3">
                                <div class="input-group">
                                    <input name="detail_sisa_selisih" id="detail_sisa_selisih" type="text" class="form-control" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse">Pieces</span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-11 col-lg-2 col-md-2 col-form-label m-t-5">Detail</label>
                            <div class="col-1 m-t-5">
                                <button type="button" id="add_data" class="btn btn-primary waves-effect waves-light">+</button>
                            </div>
                            <div class="col-sm-12 col-lg-9 col-md-9 m-t-5">
                                <ol id="data_selisih" class="data_selisih">

                                </ol>
                            </div>
                        </div>
                        <hr>

                    </div>
                </div> <!-- end row -->
            </div>
        </div>
    </div>


</div> <!-- container -->