<!-- modal tambah data -->
<div id="add_data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Permintaan Cash</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Cash Awal</label>
                        <div class="col-9">
                            <input name="permintaan_cash" id="permintaan_cash" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <textarea name="keterangan" id="keterangan" type="text" class="form-control" placeholder="" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="md-close" name="button-close" type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog md-sm">
        <div class="modal-content">
        <form data-parsley-validate novalidate autocomplete="off" id="passwordForm" method="post" enctype="multipart/form-data" class="form-horizontal">

            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Input Password</label>
                    <input type="password" id="password_input" class="form-control" aria-describedby="emailHelp" placeholder="Password">
                </div>
            </div>
            <div class="modal-footer">
                <button id="password-md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" id="button-password-add" data-dismiss="modal" class="btn btn-danger waves-effect waves-light">Approve</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>