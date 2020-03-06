<?php
$str = explode("-", $pegawai['nomor_rekening']);
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Detail Pegawai</h4>
        </div>
    </div>
    <!-- Content -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card m-b-20">
                <div id="div_gambar">
                    <img id="gambar_pegawai" src="<?= base_url('assets/images/pegawai/') . $pegawai['gambar']; ?>" class="img-thumbnail" alt="profile-image">
                </div>
                <p hidden id="hide_kode_pegawai"></p>
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
                    <li class="nav-item"><a href="#second" data-toggle="tab" class="nav-link">Data Alamat</a></li>
                    <li class="nav-item"><a href="#third" data-toggle="tab" class="nav-link">Data Pekerjaan</a></li>
                    <li class="nav-item"><a href="#forth" data-toggle="tab" class="nav-link">Lainnya</a></li>
                </ul>
                <div class="tab-content mb-0 b-0">
                    <div class="tab-pane fade  show active" id="first">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_umum" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nomor Induk Pegawai</label>
                                    <div class="col-9">
                                        <input name="nip" id="nip" type="text" class="form-control" value="<?= $pegawai['nip']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nomor KTP</label>
                                    <div class="col-9">
                                        <input name="ktp" id="ktp" type="number" class="form-control" value="<?= $pegawai['ktp']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-9">
                                        <input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control" value="<?= $pegawai['nama_lengkap']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Tanggal Lahir</label>
                                    <div class="col-9">
                                        <input name="tanggal_lahir" id="tanggal_lahir" type="text" class="form-control" value="<?= $pegawai['tanggal_lahir']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-9">
                                        <select name="jenis_kelamin" id="jenis_kelamin" value="<?= $pegawai['jenis_kelamin']; ?>" class="form-control" disabled>
                                            <option value="0">Laki - Laki</option>
                                            <option value="1">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Pendidikan Terkhir</label>
                                    <div class="col-9">
                                        <input name="pendidikan_terakhir" id="pendidikan_terakhir" type="text" class="form-control" value="<?= $pegawai['pendidikan_terakhir']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <button type="button" id="edit_trigger_umum" name="edit_trigger_umum" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                    </div>
                                    <div id="edit_button_umum_div" hidden>
                                        <button id="edit_batal_umum" name="edit_batal_umum" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit_batal_umum" name="submit_batal_umum" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="second">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_alamat" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Alamat Rumah</label>
                                    <div class="col-9">
                                        <textarea name="alamat" id="alamat" type="text" rows="2" class="form-control" readonly><?= $pegawai['alamat']; ?></textarea>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-3 col-form-label">Kelurahan</label>
                                    <div class="col-3">
                                        <input name="kelurahan" id="kelurahan" type="text" class="form-control" value="<?= $pegawai['kelurahan']; ?>" readonly>
                                    </div>
                                    <label class="col-3 col-form-label">Kecamatan</label>
                                    <div class="col-3">
                                        <input name="kecamatan" id="kecamatan" type="text" class="form-control" value="<?= $pegawai['kecamatan']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Kota / Kabupaten</label>
                                    <div class="col-9">
                                        <input name="kota" id="kota" type="text" class="form-control" value="<?= $pegawai['kota']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <button type="button" id="edit_trigger_alamat" name="edit_trigger_alamat" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                    </div>
                                    <div id="edit_button_alamat_div" hidden>
                                        <button id="edit_batal_alamat" name="edit_batal_alamat" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit_batal_alamat" name="submit_batal_alamat" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="third">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_pekerjaan" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Jabatan</label>
                                    <div class="col-9">
                                        <input name="jabatan" id="jabatan" type="text" class="form-control" value="<?= $pegawai['jabatan']; ?>" readonly required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-3 col-form-label">Gaji Pokok</label>
                                        <div class="col-9">
                                            <input name="gaji_pokok" id="gaji_pokok" type="text" class="form-control" value="<?= $pegawai['gaji_pokok']; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Uang Makan</label>
                                        <div class="col-9">
                                            <input name="uang_makan" id="uang_makan" type="text" class="form-control" value="<?= $pegawai['uang_makan']; ?>" readonly required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Tanggal Mulai Bekerja</label>
                                    <div class="col-9">
                                        <input name="tanggal_masuk" id="tanggal_masuk" type="text" class="form-control" value="<?= $pegawai['tanggal_masuk']; ?>" readonly required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <button type="button" id="edit_trigger_pekerjaan" name="edit_trigger_pekerjaan" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                    </div>
                                    <div id="edit_button_pekerjaan_div" hidden>
                                        <button id="edit_batal_pekerjaan" name="edit_batal_pekerjaan" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit_batal_pekerjaan" name="submit_batal_pekerjaan" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="forth">
                        <form data-parsley-validate novalidate autocomplete="off" id="form_lainnya" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nomor Telepon / HP</label>
                                    <div class="col-9">
                                        <input name="nomor_telepon" id="nomor_telepon" type="number" class="form-control" value="<?= $pegawai['nomor_telepon']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nomor Rekening</label>
                                    <div class="col-3">
                                        <input name="nomor_rekening" id="nomor_rekening" type="number" class="form-control" value="<?= $str[0]; ?>" readonly>
                                    </div>
                                    <label class="col-3 col-form-label">Nama Bank</label>
                                    <div class="col-3">
                                        <input name="nama_bank" id="nama_bank" type="text" class="form-control" value="<?= $str[1]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">NPWP</label>
                                    <div class="col-9">
                                        <input name="npwp" id="npwp" type="text" class="form-control" value="<?= $pegawai['npwp']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <button type="button" id="edit_trigger_lainnya" name=" edit_trigger_lainnya" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                    </div>
                                    <div id="edit_button_lainnya_div" hidden>
                                        <button id="edit_batal_lainnya" name="edit_batal_lainnya" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="submit_batal_lainnya" name="submit_batal_lainnya" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <small class="text-muted">Last Update : <i id="edit_tanggal_input" readonly><?= $pegawai['timestamp']; ?></i> </small>
            </div>
        </div>
    </div>
</div> <!-- container -->