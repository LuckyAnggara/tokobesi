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
            <h5 class="page-title">Laporan Laba / Rugi Penjualan</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 d-print-none">
            <div class="card-box">
                <div class="row">
                    <div class="col-12">
                        <form data-parsley-validate novalidate autocomplete="off" id="persediaan_form" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url('laporan/labapenjualan/download'); ?>" method="post">
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
                </div>
            </div>
        </div>
        <div class="col-8">
            <footer class="content-page">
                <div class="card-box">

                    <div class="panel-body">
                        <div class="col-12" id="div_laba">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="m-t-0 header-title">Laporan Laba / Rugi Penjualan per Tanggal <span id="display_tanggal"><?= $tanggal_hari_ini; ?></span></h4>
                                </div>
                            </div>
                            <hr>
                            <ul style="list-style-type:none">
                                <h5>
                                    <div>
                                        <li class="row">
                                            <div class="col-6 m-b-10">
                                                <b>Total Penjualan</b>
                                            </div>
                                            <div class="col-6 text-right m-b-10">
                                                <b id="total_penjualan"><?= rupiah($laba_penjualan['total_penjualan']); ?></b>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6">
                                                <b>Diskon Penjulan</b>
                                            </div>
                                            <div class="col-3 text-right" id="diskon_penjualan">
                                                <?= rupiah($laba_penjualan['potongan_penjualan']); ?>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6">
                                                <b>Retur Penjualan</b>
                                            </div>
                                            <div class="col-3 text-right" id="retur_penjualan">
                                                <?= rupiah($laba_penjualan['retur_penjualan']); ?>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6 m-t-10">
                                                <b>Total Potongan Penjualan</b>
                                            </div>
                                            <div class="col-6 text-right m-t-10">
                                                <b><span class="text-danger" id="total_potongan_penjualan">( <?= rupiah($laba_penjualan['total_potongan_penjualan']); ?> )</span></b>
                                            </div>
                                        </li>
                                        <hr>
                                        <li class="row">
                                            <div class="col-6">
                                                <b>Total Penjualan Bersih</b>
                                            </div>
                                            <div class="col-6 text-right  m-t-5">
                                                <b id="total_penjualan_bersih"><?= rupiah($laba_penjualan['total_penjualan'] - $laba_penjualan['total_potongan_penjualan']); ?></b>
                                            </div>
                                        </li>
                                    </div>
                                    <hr>
                                    <div>
                                        <li class="row">
                                            <div class="col-6 m-b-10">
                                                <b>Persediaan Awal Barang</b>
                                            </div>
                                            <div class="col-6 text-right m-b-10">
                                                <b id="persediaan_awal"><?= rupiah($laba_penjualan['persediaan_awal']); ?></b>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6">
                                                <b>Pembelian</b>
                                            </div>
                                            <div class="col-3 text-right" id="total_pembelian">
                                                <?= rupiah($laba_penjualan['total_pembelian']); ?>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6">
                                                <b>Diskon Pembelian</b>
                                            </div>
                                            <div class="col-3 text-right" id="potongan_pembelian">
                                                <?= rupiah($laba_penjualan['potongan_pembelian']); ?>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6">
                                                <b>Retur Pembelian</b>
                                            </div>
                                            <div class="col-3 text-right" id="retur_pembelian">
                                                <?= rupiah($laba_penjualan['retur_pembelian']); ?>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6 m-t-10">
                                                <b>Persediaan Barang Untuk di Jual</b>
                                            </div>
                                            <div class="col-6 text-right m-t-10">
                                                <b><span id="persediaan_tersedia"><?= rupiah($laba_penjualan['persediaan_tersedia']); ?></span></b>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-6 m-t-10">
                                                <b>Total Persediaan Akhir</b>
                                            </div>
                                            <div class="col-6 text-right m-t-10">
                                                <b><span class="text-danger" id="persediaan_akhir">(<?= rupiah($laba_penjualan['persediaan_akhir']); ?>)</span></b>
                                            </div>
                                        </li>
                                        <hr class="m-t-10">
                                        <li class="row">
                                            <div class="col-6">
                                                <b>Harga Pokok Penjualan</b>
                                            </div>
                                            <div class="col-6 text-right">
                                                <b><span id="harga_pokok_penjualan"><?= rupiah($laba_penjualan['harga_pokok_penjualan']); ?></span></b>
                                            </div>
                                        </li>
                                    </div>
                                    <li>
                                        <hr>
                                    </li>
                                    <li class="row">
                                        <div class="col-6">
                                            <b>Laba / Rugi Penjualan</b>
                                        </div>
                                        <div class="col-6 text-right">
                                            <b id="laba_penjualan">
                                                <?php if ($laba_penjualan['laba_penjualan'] < 0) {; ?>
                                                    <span class="text-danger">( <?= rupiah($laba_penjualan['laba_penjualan']); ?> )</span>
                                                <?php } else {; ?>
                                                    <?= rupiah($laba_penjualan['laba_penjualan']); ?>
                                                <?php }; ?>
                                            </b>
                                        </div>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div> <!-- end container -->