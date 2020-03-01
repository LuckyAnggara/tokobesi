<!-- modal tambah data -->
<div id="add_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Saldo Piutang</label>
                        <div class="col-9">
                            <input name="saldo_piutang" id="saldo_piutang" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Tanggal</label>
                        <div class="col-9">
                            <input name="tanggal" id="tanggal" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nominal</label>
                        <div class="col-9">
                            <input name="nominal_pembayaran" id="nominal_pembayaran" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <input name="keterangan" id="keterangan" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Bukti Transaksi</label>
                        <div class="col-9">
                            <input data-allowed-file-extensions="png jpg jpeg pdf" name="bukti" id="bukti" data-max-file-size="5M" type="file" />
                            <small id="id_pelanggan_help" class="form-text text-muted">*(optional)</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="upload_lampiran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="data_label">Upload Lampiran</h4>
                <span hidden id="id_lampiran"></span>
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="lampiran_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12">
                            <input data-allowed-file-extensions="pdf jpg jpeg png" data-max-file-size="4M" name="bukti" id="lampiran" type="file" />
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