<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Daftar Stock Opname</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Data Stok Opname</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label  m-t-10 ">Nomor Referensi</label>
                            <div class="col-7">
                                <input id="nomor_referensi" autocomplete="off" name="nomor_referensi" type="text" class="form-control" readonly value="<?= $stok_opname['nomor_referensi']; ?>">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Tanggal Stock Opname</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Keterangan</label>
                            <div class="col-7">
                                <textarea type="text" rows="2" class="form-control" placeholder="(optional)" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">Data</h4>
                <div id="ajaxTree"></div>
            </div>
        </div><!-- end col -->
    </div>
</div>