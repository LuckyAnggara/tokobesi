<!-- modal tambah data -->
<div id="add_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Saldo Awal</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Barang</label>
                        <div class="col-9">
                            <select name="kode_barang" id="kode_barang" class="form-control" placeholder="" required></select>
                            <small id="inputhelp" class="form-text text-muted">Data yang muncul hanya data yang belum di setting Saldo Awal</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Jumlah</label>
                        <div class="col-9">
                            <input name="jumlah" id="jumlah" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Harga</label>
                        <div class="col-9">
                            <input name="harga" id="harga" type="text" class="form-control" placeholder="" required>
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

<div id="edit_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit_data_label">Edit Data Jenis Barang</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="edit_form" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Kode Barang</label>
                            <input name="edit_id" id="edit_id" type="text" class="form-control" hidden>
                            <div class="col-9">
                                <input name="edit_kode_barang" id="edit_kode_barang" type="text" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Jumlah</label>
                            <div class="col-9">
                                <input name="edit_jumlah" id="edit_jumlah" type="text" class="form-control rupiah" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Harga</label>
                            <div class="col-9">
                                <input name="edit_harga" id="edit_harga" type="text" class="form-control satuan" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="edit_md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="view_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="view_data_label">View Data Jenis Barang</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#detail_data_jenis_barang" id="nav_detail_data_jenis_barang" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Detail Data Jenis Barang
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabel_data_jenis_barang" id="nav_tabel_data_jenis_barang" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    Daftar Barang Jenis
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="detail_data_jenis_barang">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Kode Jenis Barang</label>
                                    <div class="col-9">
                                        <input readonly name="view_kode_jenis_barang" id="view_kode_jenis_barang" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" readonly required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama Jenis Barang</label>
                                    <div class="col-9">
                                        <input readonly name="view_nama_jenis_barang" id="view_nama_jenis_barang" type="text" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Keterangan</label>
                                    <div class="col-9">
                                        <textarea readonly type="text" id="view_keterangan" name="view_keterangan" rows="2" placeholder="(optional)" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group pull-right">
                                    <h6 class="text-muted col-12">Last Update : <i id="view_tanggal_input" readonly> </i></h6>
                                </div>
                                <br>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabel_data_jenis_barang">
                                <table id="datatable-daftar-master-jenis-barang" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                </table>
                                <div class="form-group pull-right">
                                    <h6 class="text-muted col-12">Last Update : <i id="histori_tanggal_input" readonly> </i></h6>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="view_Md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>