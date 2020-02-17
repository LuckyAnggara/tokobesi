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
                    <img id="gambar_barang" src="" class="img-thumbnail" alt="profile-image">
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
                <div id="rootwizard" class="pull-in">
                    <ul class="nav nav-pills nav-tabs nav-justified">
                        <li class="nav-item"><a href="#first" data-toggle="tab" class="nav-link">Data Umum</a></li>
                        <li class="nav-item"><a href="#second" data-toggle="tab" class="nav-link">Data Alamat</a></li>
                        <li class="nav-item"><a href="#third" data-toggle="tab" class="nav-link">Data Pekerjaan</a></li>
                        <li class="nav-item"><a href="#forth" data-toggle="tab" class="nav-link">Lainnya</a></li>
                    </ul>
                    <div class="tab-content mb-0 b-0">
                        <div class="tab-pane fade" id="first">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nomor Induk Pegawai</label>
                                <div class="col-9">
                                    <input name="nip" id="nip" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nomor KTP</label>
                                <div class="col-9">
                                    <input name="ktp" id="ktp" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nama Lengkap</label>
                                <div class="col-9">
                                    <input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-9">
                                    <input name="tanggal_lahir" id="tanggal_lahir" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-9">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="select2 form-control">
                                        <option value="0">Laki - Laki</option>
                                        <option value="1">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Pendidikan Terkhir</label>
                                <div class="col-9">
                                    <input name="pendidikan_terakhir" id="pendidikan_terakhir" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="second">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Alamat Rumah</label>
                                <div class="col-9">
                                    <textarea name="alamat" id="alamat" type="text" rows="2" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Kelurahan</label>
                                <div class="col-3">
                                    <input name="kelurahan" id="kelurahan" type="text" class="form-control" required>
                                </div>
                                <label class="col-3 col-form-label">Kecamatan</label>
                                <div class="col-3">
                                    <input name="kecamatan" id="kecamatan" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Kota / Kabupaten</label>
                                <div class="col-9">
                                    <input name="kota" id="kota" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="third">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Jabatan</label>
                                <div class="col-9">
                                    <input name="jabatan" id="jabatan" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Tanggal Mulai Bekerja</label>
                                <div class="col-9">
                                    <input name="tanggal_masuk" id="tanggal_masuk" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="forth">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nomor Telepon / HP</label>
                                <div class="col-9">
                                    <input name="nomor_telepon" id="nomor_telepon" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nomor Rekening</label>
                                <div class="col-3">
                                    <input name="nomor_rekening" id="nomor_rekening" type="number" class="form-control" required>
                                </div>
                                <label class="col-3 col-form-label">Nama Bank</label>
                                <div class="col-3">
                                    <input name="nama_bank" id="nama_bank" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">NPWP</label>
                                <div class="col-9">
                                    <input name="npwp" id="npwp" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Foto Pegawai</label>
                                <div class="col-5">
                                    <input data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" name="gambar" id="gambar" type="file" />
                                </div>
                                <small id="id_pelanggan_help" class="form-text text-muted">*Upload Foto Pegawai jika Ada.. (optional)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <small class="text-muted">Last Update : <i id="edit_tanggal_input" readonly> </i> </small>
            </div>
        </div>
    </div>
</div> <!-- container -->