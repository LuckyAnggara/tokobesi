<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Cetak Laporan Sales</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Laporan Sales</h4>
                </div>
                <hr>
                <form data-parsley-validate novalidate autocomplete="off" id="penjualan_form" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url('laporan/sales/laporan_penjualan/'); ?>" method="post">
                    <div class="form-group row">
                        <label class="col-3 col-sm-form-label">Penyajian Data</label>
                        <div class="col-9">
                            <select name="data" class="form-control">
                                <option value="1">Laporan Penjualan Per Sales</option>
                                <option value="0">Laporan Piutang Per Sales</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Tanggal Data</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" name="tanggal" id="tanggal" required>
                                <div class="input-group-append">
                                    <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Download</button>
                    </div>
                </form>
            </div>
            <div class="card-box">
                <h4 class="header-title">Top 5 Sales</h4>
                <div class="form-group">
                    <select class="form-control" id="top_sales_bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="inbox-widget nicescroll" id="top_sales">
                    <div class="col-12 text-center">
                        <p>Belum ada Data</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-12">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                </div>
                <h4 class="header-title mt-0">Produktifitas Sales</h4>
                <div class="form-group row m-b-10 col-xl-6 col-sm-12 col-lg-6 col-md-6">
                    <label class="col-5 col-form-label">Nama Sales</label>
                    <div class="col-7">
                        <select class="form-control" id="produktifitas_sales">
                            <?php foreach ($sales as $key => $value) : ?>
                                <option value="<?= $value['username']; ?>"><?= $value['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <canvas id="produktifitasSalesChart"></canvas>
            </div>
        </div>
    </div>
</div>