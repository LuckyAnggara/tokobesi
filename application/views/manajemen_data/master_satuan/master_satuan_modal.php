<!-- modal tambah data -->
<div id="add_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Satuan</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Satuan</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i id="status" class=""></i></span>
                                </div>
                                <input style="text-transform:uppercase" name="kode_satuan" id="kode_satuan" type="text" class="form-control" placeholder="Kode Satuan dapat berupa Singkatan, seperti MTR untuk Meter" required aria-describedby="basic-addon1">
                            </div>
                            <small id="inputhelp" class="form-text text-muted">Kode Satuan bersifat Unik, tidak bisa sama dengan data lainnya</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Satuan</label>
                        <div class="col-9">
                            <input name="nama_satuan" id="nama_satuan" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Keterangan</label>
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
                <h4 class="modal-title" id="edit_data_label">Edit Data Satuan</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="edit_form" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Satuan</label>
                        <div class="col-9">
                            <input name="edit_kode_satuan" id="edit_kode_satuan" type="text" class="form-control" placeholder="" required>
                            <input name="edit_id_kode_satuan" id="edit_id_kode_satuan" type="text" class="form-control" placeholder="" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Satuan</label>
                        <div class="col-9">
                            <input name="edit_nama_satuan" id="edit_nama_satuan" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <textarea type="text" id="edit_keterangan" name="edit_keterangan" rows="2" class="form-control" placeholder="(optional)"></textarea>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <h6 class="text-muted col-12">Last Update : <i id="edit_tanggal_input" readonly> </i></h6>
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
                <h4 class="modal-title" id="view_data_label">View Data Satuan</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#detail_data_satuan" id="nav_detail_data_satuan" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Detail Data Satuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#detail_data_satuan_barang" id="nav_detail_satuan_barang" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Satuan Barang
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="detail_data_satuan">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Kode Satuan</label>
                                <div class="col-9">
                                    <input readonly name="view_kode_satuan" id="view_kode_satuan" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" readonly required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nama Satuan</label>
                                <div class="col-9">
                                    <input readonly name="view_nama_satuan" id="view_nama_satuan" type="text" class="form-control" placeholder="" required>
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
                        <div role="tabpanel" class="tab-pane fade" id="detail_data_satuan_barang">
                            <table id="datatable-daftar-master-satuan" class="table table-striped table-bordered" cellspacing="0" width="100%">
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