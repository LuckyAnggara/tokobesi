<!-- modal tambah data -->
<div id="add_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data User</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nomor Induk Pegawai</label>
                        <div class="col-9">
                            <select name="nip" id="nip" type="text" class="form-control" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Pegawai</label>
                        <div class="col-9">
                            <input name="nama_pegawai" id="nama_pegawai" type="text" class="form-control" placeholder="" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Role</label>
                        <div class="col-9">
                            <select name="role" id="role" type="text" class="form-control" required>
                                <option value="1">Cashier</option>
                                <option value="2">Admin</option>
                                <option value="3">Sales</option>
                                <option value="4">Supervisor</option>
                                <option value="5">Manajer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Username</label>
                        <div class="col-9">
                            <input name="username" id="username" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input name="password" id="password" type="text" class="form-control" placeholder="Default : 123456" readonly>
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

<div id="view_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data User</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="viewForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Pegawai</label>
                        <div class="col-9">
                            <input name="view_nip" id="view_nip" type="text" class="form-control" placeholder="" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Pegawai</label>
                        <div class="col-9">
                            <input name="view_nama_pegawai" id="view_nama_pegawai" type="text" class="form-control" placeholder="" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Role</label>
                        <div class="col-9">
                            <select name="view_role" id="view_role" type="text" disabled class="form-control">
                                <option value="1">Manajer</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Admin</option>
                                <option value="4">Cashier</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Username</label>
                        <div class="col-9">
                            <input readonly name="view_username" id="view_username" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <button type="button" id="reset_pw" class="btn btn-primary waves-effect waves-light">Reset Password</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="close_view" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->