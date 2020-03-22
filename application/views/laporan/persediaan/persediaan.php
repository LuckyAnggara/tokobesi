<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Cetak Laporan Persediaan</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Laporan Persediaan</h4>
                </div>
                <hr>
                <form data-parsley-validate novalidate autocomplete="off" id="persediaan_form" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url('laporan/laporanpersediaan/laporan_persediaan/'); ?>" method="post">
                    <div class="form-group row">
                        <label class="col-3 col-sm-form-label">Penyajian Data</label>
                        <div class="col-9">
                            <select name="data" class="form-control">
                                <option value="0">Per Barang</option>
                                <option value="1">Barang dan Harga</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Tanggal Data</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" name="tanggal" id="tanggal_utang" required>
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