<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
$tanggal_hari_ini = date("d M Y");

?>
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h5 class="page-title">Laporan Pengeluaran</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 d-print-none">
            <div class="card-box">
                <form data-parsley-validate novalidate autocomplete="off" id="persediaan_form" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url('laporan/pengeluaran/download'); ?>" method="post">
                    <div class="form-group row">
                        <label class="col-3 col-sm-form-label m-t-10">Tanggal</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal" name="tanggal">
                                <div class="input-group-append">
                                    <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="button" name="proses" id="proses" class="btn btn-primary waves-effect waves-light">
                                <span>Generate</span>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <span>Download</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Laporan Pengeluaran Harian</h4>
                </div>
                <hr>
                <form data-parsley-validate novalidate autocomplete="off" id="utang_form" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url('laporan/pengeluaran/data_laporan_harian/'); ?>" method="post">
                    <div class="form-group row">
                        <label class="col-3">Tanggal</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" name="tanggal" id="tanggal_data" required>
                                <div class="input-group-append">
                                    <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Download</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card-box">
                <div class="panel-body">
                    <div class="col-12" id="div_laba">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="m-t-0 header-title">Laporan Pengeluaran Berjalan s/d Tanggal <span id="display_tanggal"><?= $tanggal_hari_ini; ?></span></h4>
                            </div>
                        </div>
                        <hr>
                        <ul style="list-style-type:none">
                            <div>
                                <li class="row">
                                    <div class="col-4 m-b-10">
                                        <b>Beban Operasional</b>
                                    </div>
                                </li>
                                <div id="beban_operasional">
                                    <?php foreach ($kategori_biaya as $key => $value) : ?>
                                        <li class="row">
                                            <div class="col-4">
                                                <b>- <?= $value['nama_biaya']; ?></b>
                                            </div>
                                            <div class="col-4 text-right">
                                                <?= rupiah($value['total']); ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </div>
                                <li class="row">
                                    <div class="col-4 m-t-10">
                                        <b>Total Beban Operasional</b>
                                    </div>
                                    <div class="col-6 text-right m-t-10">
                                        <b><span class="text-danger" id="total_beban_operasional">( <?= rupiah($total_beban_operasional); ?> )</span></b>
                                    </div>
                                </li>
                            </div>
                            <hr class="m-t-10">
                            <div>
                                <li class="row">
                                    <div class="col-4 m-b-10">
                                        <b>Beban Gaji</b>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-4">
                                        <b>- Gaji Pokok</b>
                                    </div>
                                    <div class="col-4 text-right" id="gaji_pokok">
                                        <?= rupiah($beban_gaji['gaji_pokok']); ?>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-4">
                                        <b>- Uang Makan</b>
                                    </div>
                                    <div class="col-4 text-right" id="uang_makan">
                                        <?= rupiah($beban_gaji['uang_makan']); ?>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-4">
                                        <b>- Bonus</b>
                                    </div>
                                    <div class="col-4 text-right" id="bonus">
                                        <?= rupiah($beban_gaji['bonus']); ?>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-4 m-t-10">
                                        <b>Total Beban Gaji</b>
                                    </div>
                                    <div class="col-6 text-right m-t-10">
                                        <b><span class="text-danger" id="total_beban_gaji">( <?= rupiah($total_beban_gaji); ?> )</span></b>
                                    </div>
                                </li>
                            </div>
                            <hr>
                            <div>
                                <h4>
                                    <li class="row">
                                        <div class="col-6 m-t-10">
                                            <b>Total Beban Usaha</b>
                                        </div>
                                        <div class="col-6 text-right m-t-10">
                                            <b><span class="text-danger" id="total_beban_usaha">( <?= rupiah($total_beban_operasional + $total_beban_gaji); ?> )</span></b>
                                        </div>
                                    </li>
                                </h4>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end container -->