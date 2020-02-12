<!-- detail stok selisih data -->
<div id="detail_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail Selisih</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-3 col-form-label">Kode Barang</label>
                    <div class="col-6">
                        <input style="text-transform:uppercase" name="kode_satuan" id="kode_satuan" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Jumlah Selisih</label>

                    <div class="col-6">
                        <div class="input-group">
                            <input name="nama_satuan" id="nama_satuan" type="text" class="form-control" placeholder="" required>
                            <div class="input-group-append">
                                <span class="input-group-text btn-inverse">Pieces</span>
                            </div>
                        </div><!-- input-group -->
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label  m-t-5">Detail</label>
                    <div class="col-1  m-t-5">
                        <button type="button" id="add_data" class="btn btn-primary waves-effect waves-light">+</button>
                    </div>
                    <div class="col-9 m-t-5">
                        <ol id="data_selisih">
                            <li>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" placeholder="Qty">
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Keterangan">
                                    </div>
                                    <div class="col-1">
                                        <button type="button" id="add_data" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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