<!-- modal tambah data -->
<div id="add_data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Biaya</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Dana Tersedia</label>
                        <div class="col-9">
                            <input readonly name="saldo_cash" id="saldo_cash" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kategori Biaya</label>
                        <div class="col-9">
                            <select name="kategori_biaya" id="kategori_biaya" class="form-control" placeholder="" required></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <input name="keterangan" id="keterangan" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Total</label>
                        <div class="col-9">
                            <input name="total_biaya" id="total_biaya" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="button-close" type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal tambah data -->
<div id="revisi_data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Revisi Data Biaya</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="revisiForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <span hidden id="id_biaya"></span>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Total Biaya</label>
                        <div class="col-9">
                            <input readonly name="revisi_total_biaya" id="revisi_total_biaya" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kategori Biaya</label>
                        <div class="col-9">
                            <input name="revisi_kategori_biaya" id="revisi_kategori_biaya" class="form-control" placeholder="" readonly></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <input name="revisi_keterangan" id="revisi_keterangan" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Biaya Real</label>
                        <div class="col-9">
                            <input name="real_biaya" id="real_biaya" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Pengembalian</label>
                        <div class="col-9">
                            <input readonly name="pengembalian" id="pengembalian" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->