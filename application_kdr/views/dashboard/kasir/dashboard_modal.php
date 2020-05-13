<!-- modal tambah data -->
<div id="print_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Print Laporan</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="tanggalForm" method="post" enctype="multipart/form-data" action="<?= base_url('laporan/kasir/laporan_harian/'); ?>" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <input hidden name="kasir" value="<?= $this->session->userdata['username']; ?>">
                        <label class="col-3 col-form-label m-t-5">Tanggal</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="tanggal" id="tanggal">
                                <div class="input-group-append">
                                    <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="md-close-setor" name="button-close" type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Download</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->