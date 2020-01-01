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
                        <div class="row pull-right">
                            <label class="col-4 col-form-label">Cari Data</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="searchInput" placeholder="Kata Kunci..">
                            </div>
                        </div>
                        <table id="datatable-master-barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- content -->
    <?php $this->view('template/template_footer'); ?>

</div>

<!-- modal tambah data -->
<div id="add_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Barang</label>
                        <div class="col-9">
                            <input name="kode_barang" id="kode_barang" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Barang</label>
                        <div class="col-9">
                            <input name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Nama Barang yang Akan di Input.. contoh : Besi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Satuan Harga</label>
                        <div class="col-5">
                            <input type="text" id="harga_satuan_dummy" name="harga_satuan_dummy" placeholder="Input harga barang, hanya angka" class="form-control" required>
                            <input type="text" name="harga_satuan" id="harga_satuan" placeholder="Input harga barang, hanya angka" class="form-control" hidden>
                        </div>
                        <label class="col-1 col-form-label">Satuan</label>
                        <div class="col-3">
                            <select name="satuan" id="satuan" class="form-control" required>
                                <option value="0" selected disabled>-- Satuan Barang --</option>
                                <?php foreach ($satuan as $value) : ?>
                                    <option value=<?= $value['satuan']; ?>><?= $value['satuan']; ?></option>
                                <?php endforeach; ?>
                                <!-- <option value="0" selected disabled>-- Satuan Barang --</option>
                                <option value="pieces">Pieces</option>
                                <option value="meter">Meter</option>
                                <option value="gram">Gram</option>
                                <option value="kilogram">Kilogram</option>
                                <option value="ton">Ton</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Gambar Produk</label>
                        <div class="col-5">
                            <input data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" name="gambar" id="gambar" type="file" />
                        </div>
                    </div>
                    <div class="col-12">
                        <span>*Upload Gambar Produk jika Ada.. (Tidak Mandatory)</span>
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
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="edit_form" method="post" enctype="multipart/form-data">

                    <div class="profile-info-name">
                        <!-- <img id="edit_image" src="<?= base_url('assets/'); ?>/images/barang/default.jpg"
                                             class="img-thumbnail" alt="profile-image"> -->
                        <div class="profile-info-detail">
                            <h4 class="m-0" id="edit_data_label"></h4>
                            <div class="form-group row">
                                <label class="col-4 col-form-label">Kode Barang</label>
                                <div class="col-8">
                                    <input id="edit_kode_barang" name="edit_kode_barang" type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-form-label">Nama Barang</label>
                                <div class="col-8">
                                    <input id="edit_nama_barang" name="edit_nama_barang" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-form-label">Harga Jual</label>
                                <div class="col-4">
                                    <input id="edit_harga_satuan_dummy" name="edit_harga_satuan_dummy" type="text" class="form-control">
                                    <input id="edit_harga_satuan" hidden name="edit_harga_satuan" type="text" class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <select id="edit_satuan" name="edit_satuan" class="form-control">
                                        <option value="0" disabled>-- Satuan Barang --</option>
                                        <?php foreach ($satuan as $value) : ?>
                                            <option value=<?= $value['satuan']; ?>><?= $value['satuan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-form-label">Foto Barang</label>
                                <div class="col-8">
                                    <input data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" name="edit_gambar_dropfy" id="edit_gambar_dropfy" type="file" />
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <h6 class="text-muted col-12">Terakhir Edit : <i id="edit_tanggal_input"> </i></h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="edit_button-close" name="edit_button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit_button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>



<div id="view_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="view_data_label"></h4>

            </div>
            <div class="modal-body">
                <div class="profile-info-name">
                    <img id="view_image" src="<?= base_url('assets/'); ?>/images/barang/default.jpg" class="img-thumbnail" alt="profile-image">
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
                                                    <option disabled value=<?= $value['satuan']; ?>><?= $value['satuan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pull-right">
                                        <h6 class="text-muted col-12">Terakhir Edit : <i id="view_tanggal_input" readonly> </i></h6>
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