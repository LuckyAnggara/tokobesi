<div id="fisik_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm">
        <div class="modal-content">
            <form data-parsley-validate novalidate autocomplete="off" id="saldoFisikForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label hidden id="fisik_id"></label>
                        <label class="col-form-label">Saldo (Fisik)</label>
                        <input name="saldo_fisik" id="saldo_fisik" type="text" class="form-control" required>
                        <input name="saldo_buku" id="saldo_buku" type="text" class="form-control" required hidden>
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