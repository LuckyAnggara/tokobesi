<!-- modal tambah data -->
<div id="tarik_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tarik Dana</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="tarikForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Jumlah</label>
                        <div class="col-9">
                            <input value="Rp.0" name="tarik_dana" id="tarik_dana" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button id="md-close-tarik" name="button-close" type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="setor_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Setor Dana</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="setorForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Jumlah</label>
                        <div class="col-9">
                            <input name="setor_dana" id="setor_dana" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="md-close-setor" name="button-close" type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal tambah data -->
<div id="transfer_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Transfer Dana Antar Kasir</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="transferForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kasir</label>
                        <div class="col-9">
                            <select name="no_ref_kasir" id="no_ref_kasir" class="form-control" placeholder="" required></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nominal</label>
                        <div class="col-9">
                            <input value="Rp.0" name="transfer_dana" id="transfer_dana" class="form-control" placeholder="" required>
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