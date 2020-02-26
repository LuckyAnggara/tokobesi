<div id="upload_lampiran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="data_label">Upload Lampiran</h4>
                <span hidden id="nomor_transaksi_lampiran"></span>
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="lampiran_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Lampiran</label>
                        <div class="col-9">
                            <input data-allowed-file-extensions="pdf jpg jpeg png" data-max-file-size="10M" name="lampiran" id="lampiran" type="file" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="lampiran_close" name="lampiran_close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="lampiran_ganti" class="btn btn-primary waves-effect waves-light">Upload</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>