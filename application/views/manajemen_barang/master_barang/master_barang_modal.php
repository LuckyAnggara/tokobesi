<!-- modal tambah data -->
<div id="add_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div id="rootwizard" class="pull-in">
                        <ul class="nav nav-pills nav-tabs nav-justified">
                            <li class="nav-item"><a href="#first" data-toggle="tab" class="nav-link">Umum</a></li>
                            <li class="nav-item"><a href="#second" data-toggle="tab" class="nav-link">Satuan & Harga</a></li>
                            <li class="nav-item"><a href="#third" data-toggle="tab" class="nav-link">Insentif</a></li>
                            <li class="nav-item"><a href="#forth" data-toggle="tab" class="nav-link">Lainnya</a></li>
                        </ul>

                        <div class="tab-content mb-0 b-0">
                            <div class="tab-pane fade" id="first">
                                <!-- <div class="form-group row">
                                    <label class="col-3 col-form-label">Tipe Barang</label>
                                    <div class="col-9">
                                        <select name="tipe_barang" id="tipe_barang" class="form-control select2" required>
                                            <option value="0" selected disabled hidden>-Tipe-</option>
                                            <?php foreach ($tipe as $value) : ?>
                                                <option value=<?= $value['id_tipe']; ?>><?= $value['nama_tipe']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Kode Barang*</label>
                                    <div class="col-9">
                                        <input name="kode_barang" id="kode_barang" type="text" class="form-control" placeholder="Auto" readonly required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama Barang*</label>
                                    <div class="col-9">
                                        <input name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Nama Barang yang Akan di Input.. contoh : Besi" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Jenis Barang</label>
                                    <div class="col-3">
                                        <select name="jenis_barang" id="jenis_barang" class="form-control select2">
                                            <option value="0" selected disabled hidden>-Jenis-</option>
                                            <?php foreach ($jenis as $value) : ?>
                                                <option value=<?= $value['id_jenis_barang']; ?>><?= $value['nama_jenis_barang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-3 col-form-label text-right">Merek Barang</label>
                                    <div class="col-3">
                                        <select name="merek_barang" id="merek_barang" class="form-control select2">
                                            <option value="0" selected disabled hidden>-Merek-</option>
                                            <?php foreach ($merek as $value) : ?>
                                                <option value=<?= $value['id_merek_barang']; ?>><?= $value['nama_merek_barang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama Supplier</label>
                                    <div class="col-9">
                                        <select name="kode_supplier" id="kode_supplier" class="select2 form-control">
                                            <option class="text-muted" value="0" selected disabled hidden>-Supplier-</option>
                                            <?php foreach ($supplier as $value) : ?>
                                                <option value=<?= $value['kode_supplier']; ?>><?= $value['nama_supplier']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small id="inputhelp" class="form-text text-muted">*Optional</small>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="second">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Satuan Dasar*</label>
                                    <div class="col-9">
                                        <select name="satuan" id="satuan" class="form-control select2" required>
                                            <option value="0" selected disabled hidden>-- Satuan Barang --</option>
                                            <?php foreach ($satuan as $value) : ?>
                                                <option value=<?= $value['kode_satuan']; ?>><?= $value['nama_satuan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Persediaan Minimum*</label>
                                    <div class="col-5">
                                        <input type="text" id="persediaan_minimum" name="persediaan_minimum" class="form-control" required>
                                    </div>
                                    <label class="col-1 col-form-label">/</label>
                                    <div class="col-3">
                                        <input type="text" id="satuan_minimum" name="satuan_minimum" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Metode Persediaan*</label>
                                    <div class="col-9">
                                        <select name="metode_hpp" id="metode_hpp" class="form-control select2" required>
                                            <option value="0" selected disabled hidden>--</option>
                                            <option value="FIFO">FIFO</option>
                                            <option value="LIFO">LIFO</option>
                                            <option value="AVERAGE">AVERAGE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label" hidden>Harga Pokok</label>
                                    <div class="col-9">
                                        <input type="text" id="harga_pokok_dummy" name="harga_pokok_dummy" class="form-control" value="0" hidden>
                                        <input type="text" name="harga_pokok" id="harga_pokok" class="form-control" val="0" hidden>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Base Harga Jual</label>
                                    <div class="col-9">
                                        <input type="text" id="harga_satuan_dummy" name="harga_satuan_dummy" class="form-control" value="Rp.0" required>
                                        <input type="text" name="harga_satuan" id="harga_satuan" class="form-control" hidden>
                                        <small id="inputhelp" class="form-text text-muted">*Harga jual dapat di rubah pada saat penjualan berlangsung</small>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="third">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Komisi Sales / Item</label>
                                    <div class="col-9">
                                        <input type="text" id="komisi_sales_dummy" name="komisi_sales_dummy" class="form-control" value="Rp.0" required>
                                        <input type="text" name="komisi_sales" id="komisi_sales" class="form-control" value="0" hidden>
                                        <small id="inputhelp" class="form-text text-muted">*Untuk penentuan komisi sales, jika status sales komisi per item</small>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="forth">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Status Jual</label>
                                    <div class="col-9">
                                        <select name="status_jual" id="status_jual" class="form-control select2" placeholder="ssss" required>
                                            <option value="0" selected disabled hidden>-Status-</option>
                                            <option value="1">Dijual</option>
                                            <option value="1">Tidak Dijual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Gambar Produk</label>
                                    <div class="col-5">
                                        <input data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" name="gambar" id="gambar" type="file" />
                                    </div>
                                    <small id="id_pelanggan_help" class="form-text text-muted">*Upload Gambar Produk jika Ada.. (optional)</small>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Deskripsi Barang</label>
                                    <div class="col-9">
                                        <textarea type="text" id="keterangan" name="keterangan" rows="2" class="form-control" placeholder="(optional)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline mb-0 mt-4 pager wizard">
                                <li class="previous list-inline-item"><a class="btn btn-primary waves-effect waves-light">Previous</a>
                                </li>
                                <li class="next list-inline-item float-right"><a id="submit-add" class="btn btn-primary waves-effect waves-light">Next</a></li>
                                <!-- <li class="finish list-inline-item float-right "><a href="#" class="btn btn-primary waves-effect waves-light">Finish</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button id="md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                    <button type="button" id="next" name="next" class="btn btn-primary waves-effect waves-light">Next</button>
                </div> -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="status_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm">
        <div class="modal-content">
            <form data-parsley-validate novalidate autocomplete="off" id="statusUpdateForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label hidden id="status_kode_barang"></label>
                        <label class="col-form-label">Status Jual</label>
                        <select name="status_update" id="status_update" type="text" class="form-control" required>
                            <option value="0">Di Jual</option>
                            <option value="1">Tidak di Jual</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->