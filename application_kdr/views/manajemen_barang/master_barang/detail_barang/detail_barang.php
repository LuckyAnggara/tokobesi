<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Detail Barang</h4>
        </div>
    </div>
    <!-- Content -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card m-b-20">
                <div id="div_gambar">
                    <img id="gambar_barang" src="<?= base_url('assets/images/barang/') . $detail['gambar']; ?>" class="img-thumbnail" alt="profile-image">
                </div>
                <p hidden id="hide_kode_barang"><?= $kode_barang; ?></p>
                <div class="card-body">
                    <div>
                        <button type="submit" id="edit_gambar_button" name="edit_gambar_button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-image"></i> Ganti Gambar</button>
                    </div>

                </div>
            </div>
            <!--/ meta -->
        </div>
        <div class="col-sm-9">
            <div class="card-box">
                <ul class="nav nav-tabs nav-justified nav-pills">
                    <li class="nav-item">
                        <a href="#data_umum" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            Data Umum
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#satuan_harga" data-toggle="tab" aria-expanded="true" class="nav-link">
                            Satuan & Harga
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#komisi" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Komisi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#lainnya" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Lainnya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#statistik" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Statistik Penjualan
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade show active" id="data_umum">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_umum" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                <div class="form-group row" hidden>
                                    <label class="col-3 col-form-label">Tipe Barang</label>
                                    <div class="col-9">
                                        <select name="edit_tipe_barang" id="edit_tipe_barang" class="form-control select2" required disabled>
                                            <option value="0" selected disabled hidden>-Tipe-</option>
                                            <?php foreach ($tipe as $value) : ?>
                                                <option value=<?= $value['id_tipe']; ?>><?= $value['nama_tipe']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Kode Barang</label>
                                    <div class="col-9">
                                        <input name="edit_kode_barang" id="edit_kode_barang" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" readonly required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Jenis Barang</label>
                                    <div class="col-3">
                                        <select name="edit_jenis_barang" id="edit_jenis_barang" class="form-control select2" disabled>
                                            <option value="0" disabled hidden>-Jenis-</option>
                                            <?php foreach ($jenis as $value) : ?>
                                                <option value=<?= $value['id_jenis_barang']; ?>><?= $value['nama_jenis_barang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-3 col-form-label text-right">Merek Barang</label>
                                    <div class="col-3">
                                        <select name="edit_merek_barang" id="edit_merek_barang" class="form-control select2" disabled>
                                            <option value="0" selected disabled hidden>-Merek-</option>
                                            <?php foreach ($merek as $value) : ?>
                                                <option value=<?= $value['id_merek_barang']; ?>><?= $value['nama_merek_barang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama Barang</label>
                                    <div class="col-9">
                                        <input readonly name="edit_nama_barang" id="edit_nama_barang" type="text" class="form-control" placeholder="Nama Barang yang Akan di Input.. contoh : Besi" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama Supplier</label>
                                    <div class="col-9">
                                        <select name="edit_kode_supplier" id="edit_kode_supplier" class="select2 form-control" disabled>
                                            <option class="text-muted" value="0" selected disabled hidden>-Supplier-</option>
                                            <?php foreach ($supplier as $value) : ?>
                                                <option value=<?= $value['kode_supplier']; ?>><?= $value['nama_supplier']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Deskripsi Barang</label>
                                    <div class="col-9">
                                        <textarea readonly type="text" id="edit_keterangan" name="edit_keterangan" rows="2" class="form-control" placeholder="(optional)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="button" id="edit_trigger_umum" name="edit_trigger_umum" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                                <div id="edit_button_umum_div" hidden>
                                    <button id="edit_batal_umum" name="edit_batal_umum" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" id="submit_batal_umum" name="submit_batal_umum" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="satuan_harga">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_harga" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Satuan Dasar</label>
                                    <div class="col-9">
                                        <select name="edit_satuan" id="edit_satuan" class="form-control" placeholder="ssss" required disabled>
                                            <!-- <option value="0" selected disabled hidden>-- Satuan Barang --</option> -->
                                            <?php foreach ($satuan as $value) : ?>
                                                <option value=<?= $value['id_satuan']; ?>><?= $value['nama_satuan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Persediaan Minimum</label>
                                    <div class="col-5">
                                        <input readonly type="text" id="edit_persediaan_minimum" name="edit_persediaan_minimum" placeholder="Hanya Angka" class="form-control" required>
                                    </div>
                                    <label class="col-1 col-form-label">/</label>
                                    <div class="col-3">
                                        <input type="text" id="edit_satuan_minimum" name="edit_satuan_minimum" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Harga Pokok</label>
                                    <div class="col-9">
                                        <input readonly type="text" id="edit_harga_pokok_dummy" name="edit_harga_pokok_dummy" placeholder="Hanya Angka" class="form-control" required>
                                        <input type="text" name="edit_harga_pokok" id="edit_harga_pokok" placeholder="Hanya Angka" class="form-control" hidden>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Harga Konsumen</label>
                                    <div class="col-9">
                                        <input readonly type="text" id="edit_harga_satuan_dummy" name="edit_harga_satuan_dummy" placeholder="Hanya Angka" class="form-control" required>
                                        <input type="text" name="edit_harga_satuan" id="edit_harga_satuan" placeholder="Hanya Angka" class="form-control" hidden>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Harga Material</label>
                                    <div class="col-9">
                                        <input readonly type="text" id="edit_harga_kedua_dummy" name="edit_harga_kedua_dummy" placeholder="Hanya Angka" class="form-control" required>
                                        <input type="text" name="edit_harga_kedua" id="edit_harga_kedua" placeholder="Hanya Angka" class="form-control" hidden>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Harga Toko Besar</label>
                                    <div class="col-9">
                                        <input readonly type="text" id="edit_harga_ketiga_dummy" name="edit_harga_ketiga_dummy" placeholder="Hanya Angka" class="form-control" required>
                                        <input type="text" name="edit_harga_ketiga" id="edit_harga_ketiga" placeholder="Hanya Angka" class="form-control" hidden>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Metode Persediaan</label>
                                    <div class="col-9">
                                        <select name="metode_hpp" id="metode_hpp" class="form-control select2" required disabled>
                                            <option value="0" selected disabled hidden>--</option>
                                            <option value="FIFO">FIFO</option>
                                            <option value="LIFO">LIFO</option>
                                            <option value="AVERAGE">AVERAGE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div>
                                    <button type="button" id="edit_trigger_harga" name="edit_trigger_harga" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                                <div id="edit_button_harga_div" hidden>
                                    <button id="edit_batal_harga" name="edit_batal_harga" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" id="submit_batal_harga" name="submit_batal_harga" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="komisi">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_komisi" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Komisi Sales / Item</label>
                                <div class="col-9">
                                    <input type="text" id="edit_komisi_sales_dummy" name="edit_komisi_sales_dummy" class="form-control" value="Rp.0" required readonly>
                                    <input type="text" name="edit_komisi_sales" id="edit_komisi_sales" class="form-control" value="0" hidden>
                                    <small id="inputhelp" class="form-text text-muted">*Untuk penentuan komisi sales, jika status sales komisi per item</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="button" id="edit_trigger_komisi" name="edit_trigger_komisi" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                                <div id="edit_button_komisi_div" hidden>
                                    <button id="edit_batal_komisi" name="edit_batal_komisi" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" id="submit_batal_komisi" name="submit_batal_komisi" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="lainnya">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_lainnya" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Status Jual</label>
                                <div class="col-9">
                                    <select name="edit_status_jual" id="edit_status_jual" class="form-control select2" required disabled>
                                        <option selected disabled hidden>-Status-</option>
                                        <option value="0">Dijual</option>
                                        <option value="1">Tidak Dijual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="button" id="edit_trigger_lainnya" name="edit_trigger_lainnya" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                                <div id="edit_button_lainnya_div" hidden>
                                    <button id="edit_batal_lainnya" name="edit_batal_lainnya" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" id="submit_batal_lainnya" name="submit_batal_lainnya" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="statistik">
                        <div class="form-group row">
                            <label class="col-sm-1 col-sm-form-label m-t-10">Tanggal</label>
                            <div class="col-sm-5 col-lg-5 col-md-5">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_awal">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                            <label class="col-sm-1 col-sm-form-label m-t-10">S.D</label>
                            <div class="col-sm-5 col-lg-5 col-md-5">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal_akhir">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div id="loadingMessage"></div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <small class="text-muted">Last Update : <i id="edit_tanggal_input" readonly> </i> </small>
                </div>
            </div>
        </div>
    </div> <!-- container -->