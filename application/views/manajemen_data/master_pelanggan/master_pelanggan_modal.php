<!-- modal tambah data -->
<div id="add_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Pelanggan</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Pelanggan</label>
                        <div class="col-9">
                            <input name="id_pelanggan" id="id_pelanggan" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Tipe Pelanggan</label>
                        <div class="col-9">
                            <select name="tipe_pelanggan" id="tipe_pelanggan" type="text" class="form-control tipe_pelanggan" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Pelanggan</label>
                        <div class="col-9">
                            <input name="nama_pelanggan" id="nama_pelanggan" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Alamat</label>
                        <div class="col-9">
                            <textarea type="text" id="alamat" name="alamat" rows="2" placeholder="" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            <input name="email" id="email" type="email" class="form-control" placeholder="Optional">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nomor Telepon</label>
                        <div class="col-9">
                            <input name="nomor_telepon" id="nomor_telepon" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nomor NPWP</label>
                        <div class="col-9">
                            <input type="text" placeholder="" data-mask="99.999.999.9-999.999" class="form-control" maxlength="20" name="npwp" id="npwp">
                            <!-- <input name="npwp" id="npwp" type="text" class="form-control" placeholder=""> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3  m-t-30 col-form-label">Rekening</label>
                        <div class="form-group col-md-2">
                            <label for="inputCity" class="col-form-label">Nama Bank</label>
                            <input name="bank_rekening" id="bank_rekening" type="text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputState" class="col-form-label">Nomor Rekening</label>
                            <input name="nomor_rekening" id="nomor_rekening" type="text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputZip" class="col-form-label">Pemilik Rekening</label>
                            <input name="nama_rekening" id="nama_rekening" type="text" class="form-control" required>
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
</div><!-- /.modal -->

<div id="edit_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit_data_label">Edit Data Pelanggan</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="edit_form" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Pelanggan</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input name="edit_id_pelanggan" id="edit_id_pelanggan" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" required>
                                <input name="dummy_edit_id_pelanggan" id="dummy_edit_id_pelanggan" type="text" hidden>
                                <div class="input-group-append">
                                    <button id="generate_id" name="generate_id" class=" btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-braille"></i> Generate ID</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Tipe Pelanggan</label>
                        <div class="col-9">
                            <select name="edit_tipe_pelanggan" id="edit_tipe_pelanggan" type="text" class="form-control tipe_pelanggan" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Pelanggan</label>
                        <div class="col-9">
                            <input name="edit_nama_pelanggan" id="edit_nama_pelanggan" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Alamat</label>
                        <div class="col-9">
                            <textarea type="text" id="edit_alamat" name="edit_alamat" rows="2" placeholder="" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            <input name="edit_email" id="edit_email" type="email" class="form-control" placeholder="Optional">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nomor Telepon</label>
                        <div class="col-9">
                            <input name="edit_nomor_telepon" id="edit_nomor_telepon" type="text" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nomor NPWP</label>
                        <div class="col-9">
                            <input type="text" placeholder="" data-mask="99.999.999.9-999.999" class="form-control" maxlength="20" name="edit_npwp" id="edit_npwp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3  m-t-30 col-form-label">Rekening</label>
                        <div class="form-group col-md-2">
                            <label for="inputCity" class="col-form-label">Nama Bank</label>
                            <input name="edit_bank_rekening" id="edit_bank_rekening" type="text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputState" class="col-form-label">Nomor Rekening</label>
                            <input name="edit_nomor_rekening" id="edit_nomor_rekening" type="text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputZip" class="col-form-label">Pemilik Rekening</label>
                            <input name="edit_nama_rekening" id="edit_nama_rekening" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <h6 class="text-muted col-12">Last Update : <i id="edit_tanggal_input" readonly> </i></h6>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="edit_md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="view_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="view_data_label">View Data Pelanggan</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#detail_barang" id="nav_detail_barang" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Detail Data Pelanggan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#histori" id="nav_histori" data-toggle="tab" aria-expanded="true" class="nav-link">
                                History Pembelian dari Pelanggan
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="detail_barang">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Kode Pelanggan</label>
                                <div class="col-9">
                                    <input readonly name="view_id_pelanggan" id="view_id_pelanggan" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" readonly required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Tipe Pelanggan</label>
                                <div class="col-9">
                                    <select disabled name="view_tipe_pelanggan" id="view_tipe_pelanggan" type="text" class="form-control tipe_pelanggan">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nama Pelanggan</label>
                                <div class="col-9">
                                    <input readonly name="view_nama_pelanggan" id="view_nama_pelanggan" type="text" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Alamat</label>
                                <div class="col-9">
                                    <textarea readonly type="text" id="view_alamat" name="view_alamat" rows="2" placeholder="" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Email</label>
                                <div class="col-9">
                                    <input name="view_email" id="view_email" type="email" class="form-control" placeholder="Optional">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nomor Telepon</label>
                                <div class="col-9">
                                    <input readonly name="view_nomor_telepon" id="view_nomor_telepon" type="text" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nomor NPWP</label>
                                <div class="col-9">
                                    <input type="text" readonly placeholder="" data-mask="99.999.999.9-999.999" class="form-control" maxlength="20" name="view_npwp" id="view_npwp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nomor Rekening</label>
                                <div class="col-9">
                                    <input readonly name="view_bank_rekening" id="view_bank_rekening" type="text" class="form-control" placeholder="Nama Bank" required>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <h6 class="text-muted col-12">Last Update : <i id="view_tanggal_input" readonly> </i></h6>
                            </div>
                            <br>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="histori">
                            <table id="datatable-master-pelanggan-history" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            </table>
                            <div class="form-group pull-right">
                                <h6 class="text-muted col-12">Last Update : <i id="histori_tanggal_input" readonly> </i></h6>
                            </div>
                            <br>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="view_Md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>