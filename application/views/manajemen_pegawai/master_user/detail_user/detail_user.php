
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Detail User</h4>
        </div>
    </div>
    <!-- Content -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card m-b-20">
                <div id="div_gambar">
                    <img id="gambar_user" class="img-thumbnail" alt="profile-image">
                </div>
                <p hidden id="hide_kode_user"></p>
                <div class="card-body">
                    <div>
                        <button type="submit" id="edit_gambar_button" name="edit_gambar_button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-image"></i> Ganti Gambar</button>
                    </div>
                </div>
            </div>
            <!--/ meta -->
        </div>
        <div class="col-sm-9">
            <div class="card-box">
                <ul class="nav nav-pills nav-tabs nav-justified">
                    <li class="nav-item"><a href="#first" data-toggle="tab" class="nav-link active">Data Umum</a></li>
                    <li class="nav-item"><a href="#second" data-toggle="tab" class="nav-link">Keamanan</a></li>
                </ul>
                <div class="tab-content mb-0 b-0">
                    <div class="tab-pane fade  show active" id="first">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_umum" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                 <div class="form-group row">
                                    <label class="col-3 col-form-label">Username</label>
                                    <div class="col-9">
                                        <input name="username" id="username" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-9">
                                        <input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control"  readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="second">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_password" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Password Lama</label>
                                    <div class="col-9">
                                        <input required name="password_lama" id="password_lama" type="password"class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <div class=" form-group row">
                                     <label class="col-3 col-form-label">Password Baru</label>
                                    <div class="col-9">
                                        <input required name="password_baru" id="password_baru" type="password"class="form-control">
                                    </div>
                                </div>
                                <div class=" form-group row">
                                     <label class="col-3 col-form-label">Konfirm Password</label>
                                    <div class="col-9">
                                        <input required name="konfirm_password" id="konfirm_password" type="password"class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <button type="button" id="ubah_password" name="ubah_password" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Ubah Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->