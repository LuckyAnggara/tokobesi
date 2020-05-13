<!-- modal tambah data -->
<div id="add_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Biaya</label>
                        <div class="col-9">
                            <input name="nama_biaya" id="nama_biaya" type="text" class="form-control" placeholder="" required>
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
                <span id='edit_id' hidden></span>
                <h4 class="modal-title" id="edit_data_label">Edit Data</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="edit_form" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Biaya</label>
                        <div class="col-9">
                            <input name="edit_nama_biaya" id="edit_nama_biaya" type="text" class="form-control" placeholder="" required>
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
