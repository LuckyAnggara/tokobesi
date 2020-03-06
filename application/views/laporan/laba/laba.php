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
            <h5 class="page-title">Laporan Laba / Rugi</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <footer class="content-page">
            <div class="card-box">
                
                <div class="panel-body">
                <div class="col-12">
                    <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Laporan Laba / Rugi <span id="display_tanggal"><?= $tanggal_hari_ini; ?></span></h4>
                    </div>
                    </div>
                    <hr>
                    <ul style="list-style-type:none">
                        <h5><li class="row">
                            <div class="col-6 m-b-10">
                                <b>Total Penjualan</b>
                            </div>
                            <div class="col-6 text-right m-b-10">
                                <b id="total_penjualan"><?= rupiah($total_penjualan); ?></b>
                            </div>
                        </li>
                         <li class="row">
                            <div class="col-6">
                                <b>Diskon Penjulan</b>
                            </div>
                            <div class="col-3 text-right" id="potongan_penjualan">
                                <?= rupiah($potongan_penjualan); ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-6">
                                <b>Retur Penjualan</b>
                            </div>
                            <div class="col-3 text-right"  id="retur_penjualan">
                                <?= rupiah($retur_penjualan); ?>
                            </div>
                        </li>
                          <li class="row">
                            <div class="col-6 m-t-10">
                                <b>Total Potongan Penjualan</b>
                            </div>
                            <div class="col-6 text-right m-t-10">
                                <b>(<span class="text-danger" id="total_potongan_penjualan"><?= rupiah($total_potongan_penjualan); ?></span>)</b>
                            </div>
                        </li>

                         <li>
                            <hr>
                        </li>
                        <li class="row">
                            <div class="col-6">
                                <b>Penjualan Kotor</b>
                            </div>
                            <div class="col-6 text-right">
                                <b id="penjualan_kotor"><?= rupiah($penjualan_kotor); ?></b>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-6">
                                <b>Harga Pokok Penjualan</b>
                            </div>
                            <div class="col-6 text-right">
                                <b>(<span class="text-danger" id="harga_pokok_penjualan"><?= rupiah($harga_pokok_penjualan); ?></span>)</b>
                            </div>
                        </li>
                        <li>
                            <hr>
                        </li>
                        <li class="row">
                            <div class="col-6">
                                <b>Laba / Rugi Kotor</b>
                            </div>
                            <div class="col-6 text-right">
                                <b id="laba_rugi_kotor">
                                <?php if($laba_rugi_kotor < 0){;?>
                                <span class="text-danger">(<?= rupiah($laba_rugi_kotor); ?>)</span>
                                <?php } else { ; ?>
                                <?= rupiah($laba_rugi_kotor); ?>
                                <?php };?>
                                </b>
                            </div>
                        </li>
                        <li><hr></li>
                        <li class="m-b-10"><b>Pendapatan lain - lain</b></li>
                        <li>
                            <ul style="list-style-type: circle;">
                                <li class="row" class="m-t-10">
                                    <div class="col-6">
                                        <b>Ongkos Kirim</b>
                                    </div>
                                    <div class="col-3 text-right" id="ongkos_kirim">
                                        <?= rupiah($ongkos_kirim); ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="row m-t-10">
                           <div class="col-6">
                                <b>Total Pendapatan Lain - Lain</b>
                            </div>
                            <div class="col-6 text-right">
                                <b id="pendapatan_lain"><?= rupiah($pendapatan_lain); ?></b>
                            </div>
                        </li>
                        <li><hr></li>
                        <li class="m-b-10"><b>Beban Operasional Usaha</b></li>
                        <li>
                            <ul style="list-style-type: circle;">
                                <li class="row" id="beban_operasional_usaha">
                                    <?php foreach ($beban_operasional_usaha as $key => $value) :?>
                                    <div class="col-6">
                                        <b><?= $value['nama_biaya'];?></b>
                                    </div>
                                    <div class="col-3 text-right">
                                        <?= rupiah($value['total']); ?>
                                    </div>
                                    <?php endforeach; ?>
                                </li>
                            </ul>
                        </li>
                        <li class="m-t-10 m-b-10"><b>Beban Gaji</b></li>
                        <li>
                                <ul style="list-style-type: circle;">
                                    <li class="row">
                                        <div class="col-6">
                                            <b>Gaji Pokok</b>
                                        </div>
                                         <div class="col-3 text-right" id="gaji_pokok">
                                            <?= rupiah($beban_gaji['gaji_pokok']); ?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-6">
                                            <b>Uang Makan</b>
                                        </div>
                                         <div class="col-3 text-right"  id="uang_makan">
                                            <?= rupiah($beban_gaji['uang_makan']); ?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-6">
                                            <b>Bonus</b>
                                        </div>
                                         <div class="col-3 text-right" id="bonus">
                                            <?= rupiah($beban_gaji['bonus']); ?>
                                        </div>
                                    </li>
                                </ul>
                        </li>
                        <li class="row">
                           <div class="col-6 m-t-10">
                                <b>Total Beban</b>
                            </div>
                            <div class="col-6 text-right">
                                <b class="text-danger">(<span id="total_beban"><?= rupiah($total_beban); ?></span>)</b>
                            </div>
                        </li>
                        <li><b>
                                <hr></b></li>
                       <li class="row">
                            <div class="col-6">
                                <b>Laba / Rugi</b>
                            </div>
                            <div class="col-6 text-right">
                                <b id="laba_rugi" >
                                <?php if($laba_rugi < 0){;?>
                                <span class="text-danger">(<?= rupiah($laba_rugi); ?>)</span>
                                <?php } else { ; ?>
                                <?= rupiah($laba_rugi); ?>
                                <?php };?>
                                </b>
                            </div>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            </footer>
        </div>
          <div class="col-4 d-print-none">
             <div class="card-box">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-3 col-sm-form-label m-t-10">Tanggal</label>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button name="proses" id="proses" class="btn btn-primary waves-effect waves-light">
                                    <span>Generate</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end container -->