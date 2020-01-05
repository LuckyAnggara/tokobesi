<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <button name="contoh" id="contoh" data-target="#add_Modal" data-toggle="modal" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-20">
                            <i class="fa fa-plus"></i>
                            <span>Tambah Data</span>
                        </button>
                        <div class="form-group row pull-right">
                            <label class="col-4 col-form-label">Cari Data</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="searchInput" placeholder="Kata Kunci ....">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable-master-barang" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- content -->
    <?php $this->view('template/template_footer'); ?>

</div>

<!-- modal tambah data -->
<div id="add_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Tipe Barang</label>
                        <div class="col-9">
                            <select name="tipe_barang" id="tipe_barang" class="form-control select2" required>
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
                            <input name="kode_barang" id="kode_barang" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" readonly required>
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
                            <small id="inputhelp" class="form-text text-muted">*Optional</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Barang</label>
                        <div class="col-9">
                            <input name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Nama Barang yang Akan di Input.. contoh : Besi" required>
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
                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Harga Pokok</label>
                        <div class="col-9">
                            <input type="text" id="harga_pokok_dummy" name="harga_pokok_dummy" placeholder="Hanya Angka" class="form-control" required>
                            <input type="text" name="harga_pokok" id="harga_pokok" placeholder="Hanya Angka" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Harga Jual</label>
                        <div class="col-9">
                            <input type="text" id="harga_satuan_dummy" name="harga_satuan_dummy" placeholder="Hanya Angka" class="form-control" required>
                            <input type="text" name="harga_satuan" id="harga_satuan" placeholder="Hanya Angka" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Satuan Dasar</label>
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
                        <label class="col-3 col-form-label">Persediaan Minimum</label>
                        <div class="col-5">
                            <input type="text" id="persediaan_minimum" name="persediaan_minimum" placeholder="Hanya Angka" class="form-control" required>
                        </div>
                        <label class="col-1 col-form-label">/</label>
                        <div class="col-3">
                            <input type="text" id="satuan_minimum" name="satuan_minimum" placeholder="Hanya Angka" class="form-control" readonly>
                        </div>
                    </div>
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

                    <hr>
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
                <div class="modal-footer">
                    <button id="md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="edit_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit_data_label"></h4>
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="edit_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Tipe Barang</label>
                        <div class="col-9">
                            <select name="edit_tipe_barang" id="edit_tipe_barang" class="form-control select2" required>
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
                            <select name="edit_jenis_barang" id="edit_jenis_barang" class="form-control select2">
                                <option value="0" selected disabled hidden>-Jenis-</option>
                                <?php foreach ($jenis as $value) : ?>
                                    <option value=<?= $value['id_jenis_barang']; ?>><?= $value['nama_jenis_barang']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-3 col-form-label text-right">Merek Barang</label>
                        <div class="col-3">
                            <select name="edit_merek_barang" id="edit_merek_barang" class="form-control select2">
                                <option value="0" selected disabled hidden>-Merek-</option>
                                <?php foreach ($merek as $value) : ?>
                                    <option value=<?= $value['id_merek_barang']; ?>><?= $value['nama_merek_barang']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small id="inputhelp" class="form-text text-muted">*Optional</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Barang</label>
                        <div class="col-9">
                            <input name="edit_nama_barang" id="edit_nama_barang" type="text" class="form-control" placeholder="Nama Barang yang Akan di Input.. contoh : Besi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Supplier</label>
                        <div class="col-9">
                            <select name="edit_kode_supplier" id="edit_kode_supplier" class="select2 form-control">
                                <option class="text-muted" value="0" selected disabled hidden>-Supplier-</option>
                                <?php foreach ($supplier as $value) : ?>
                                    <option value=<?= $value['kode_supplier']; ?>><?= $value['nama_supplier']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small id="inputhelp" class="form-text text-muted">*Optional</small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Harga Pokok</label>
                        <div class="col-9">
                            <input type="text" id="edit_harga_pokok_dummy" name="edit_harga_pokok_dummy" placeholder="Hanya Angka" class="form-control" required>
                            <input type="text" name="edit_harga_pokok" id="edit_harga_pokok" placeholder="Hanya Angka" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Harga Jual</label>
                        <div class="col-9">
                            <input type="text" id="edit_harga_satuan_dummy" name="edit_harga_satuan_dummy" placeholder="Hanya Angka" class="form-control" required>
                            <input type="text" name="edit_harga_satuan" id="edit_harga_satuan" placeholder="Hanya Angka" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Satuan Dasar</label>
                        <div class="col-9">
                            <select name="edit_satuan" id="edit_satuan" class="form-control select2" placeholder="ssss" required>
                                <option value="0" selected disabled hidden>-- Satuan Barang --</option>
                                <?php foreach ($satuan as $value) : ?>
                                    <option value=<?= $value['kode_satuan']; ?>><?= $value['nama_satuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Persediaan Minimum</label>
                        <div class="col-9">
                            <input type="text" id="edit_persediaan_minimum" name="edit_persediaan_minimum" placeholder="Hanya Angka" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Status Jual</label>
                        <div class="col-9">
                            <select name="edit_status_jual" id="edit_status_jual" class="form-control select2" placeholder="ssss" required>
                                <option value="0" selected disabled hidden>-Status-</option>
                                <option value="1">Dijual</option>
                                <option value="1">Tidak Dijual</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Gambar Produk</label>
                        <div class="col-5">
                            <input data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" name="edit_gambar" id="edit_gambar" type="file" />
                        </div>
                        <small id="id_pelanggan_help" class="form-text text-muted">*Upload Gambar Produk jika Ada.. (optional)</small>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Deskripsi Barang</label>
                        <div class="col-9">
                            <textarea type="text" id="edit_keterangan" name="edit_keterangan" rows="2" class="form-control" placeholder="(optional)"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit_button-close" name="edit_button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="edit_button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<div id="view_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="view_data_label"></h4>

            </div>
            <div class="modal-body">
                <div class="profile-info-name">
                    <img id="view_image" src="<?= base_url('assets'); ?>/images/barang/default.jpg" class="img-thumbnail" alt="profile-image">
                    <div class="profile-info-detail">
                        <h4 class="m-0" id="view_data_label"></h4>
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#detail_barang" id="nav_detail_barang" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Detail Barang
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#data_penjualan" id="nav_data_penjualan" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        Data Penjualan
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="detail_barang">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Kode Barang</label>
                                        <div class="col-8">
                                            <input id="view_kode_barang" name="view_kode_barang" type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Nama Barang</label>
                                        <div class="col-8">
                                            <input id="view_nama_barang" name="view_nama_barang" type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Harga Jual</label>
                                        <div class="col-4">
                                            <input id="view_harga_satuan_dummy" name="view_harga_satuan_dummy" type="text" class="form-control" readonly>
                                            <input id="view_harga_satuan" hidden name="view_harga_satuan" type="text" class="form-control" readonly>
                                        </div>
                                        <div class="col-4">
                                            <select id="view_satuan" name="view_satuan" class="form-control" readonly>
                                                <option value="0" disabled>-- Satuan Barang --</option>
                                                <?php foreach ($satuan as $value) : ?>
                                                    <option disabled value=<?= $value['nama_satuan']; ?>><?= $value['nama_satuan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pull-right">
                                        <h6 class="text-muted col-12">Last Update : <i id="view_tanggal_input" readonly> </i></h6>
                                    </div>
                                    <br>
                                </div>
                                <div role="tabpanel" class="tab-pane fade show card-box" id="data_penjualan">

                                    <canvas id="bar_lucky" width="400" height="200"></canvas>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
            <div class="modal-footer">
                <button id="view_button-close" name="edit_button-close" type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-dialog -->
    </div>
</div>