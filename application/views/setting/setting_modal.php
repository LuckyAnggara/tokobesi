<div id="edit_gambar_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit_data_label"></h4>
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="edit_gambar_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Upload Gambar Baru</label>
                        <div>
                            <input data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" name="edit_gambar" id="edit_gambar" required type="file" />
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

<div id="modal_periode" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit_data_label"></h4>
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="periodeForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Periode</label>
                        <div class="col-9">
                            <input name="periode" id="periode" type="text" class="form-control" placeholder="Contoh Periode : 2020" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label m-t-5">Tanggal Awal</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="periode_awal" id="periode_awal">
                                <div class="input-group-append">
                                    <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label m-t-5">Tanggal Akhir</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="periode_akhir" id="periode_akhir">
                                <div class="input-group-append">
                                    <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
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
</div>

<div id="modal_bank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit_data_label"></h4>
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="bankForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Bank</label>
                        <div class="col-9">
                            <input name="nama_bank" id="nama_bank" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nomor Rekening</label>
                        <div class="col-9">
                            <input name="nomor_rekening" id="nomor_rekening" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
                <hr>
                <table id="datatable-bank" class="table table-striped table-bordered  dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama Bank</th>
                                <th>Nomor Rekening</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>