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
                            <input name="tarik_dana" id="tarik_dana" class="form-control" placeholder="" required>
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

<div id="masuk_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Dana Masuk</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="masukForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Jumlah</label>
                        <div class="col-9">
                            <input name="dana_masuk" id="dana_masuk" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <textarea name="keterangan_dana_masuk" id="keterangan_dana_masuk" class="form-control" placeholder="" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="md-close-masuk" name="button-close" type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->