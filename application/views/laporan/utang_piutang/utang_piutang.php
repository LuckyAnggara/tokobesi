<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Cetak Laporan Utang / Piutang</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Filter Data</h4>
                </div>
                <hr>
                <form data-parsley-validate novalidate autocomplete="off" id="utang_form" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url('laporan/utangpiutang/laporan_utang/');?>" method="post">
                    <div class="form-group row">
                        <label class="col-3 col-sm-form-label">Penyajian Data</label>
                        <div class="col-9">
                            <select name="data" id="data" class="form-control">
                                <option value="0">Faktur</option>
                                <option value="1">Supplier</option>
                                <option value="2">Lengkap</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Tanggal Data</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal" name="tanggal" required>
                                <div class="input-group-append">
                                    <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-book"> </i>Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>