<div id="edit_gambar_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit_data_label"></h4>
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="edit_gambar_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">

                        <div class="col-12">
                            <input data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" name="gambar" id="gambar" type="file" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit_gambar_close" name="edit_gambar_close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="edit_gambar_ganti" class="btn btn-primary waves-effect waves-light">Upload</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>