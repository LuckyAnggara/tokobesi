<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Laporan Laba</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="col-6">
                    <ul style="list-style-type:none">
                        <li class="row">
                            <div class="col-6">
                                <h4><b>Penjualan Bersih</b>
                                    <h4>
                            </div>
                            <div class="col-6 text-right">
                                <h4><?= rupiah($penjualan_bersih); ?><h4>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-6">
                                <h4><b>Retur Penjualan</b>
                                    <h4>
                            </div>
                            <div class="col-6 text-right">
                                <h4 class="text-danger">(<?= rupiah($retur_penjualan); ?>)<h4>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-6">
                                <h4><b>Harga Pokok Penjualan</b>
                                    <h4>
                            </div>
                            <div class="col-6 text-right">
                                <h4 class="text-danger">(<?= rupiah($harga_pokok_penjualan); ?>)<h4>
                            </div>
                        </li>
                        <li>
                            <hr>
                        </li>
                        <li class="row">
                            <div class="col-6">
                                <h4><b>Laba Kotor</b>
                                    <h4>
                            </div>
                            <div class="col-6 text-right">
                                <h4 class=""><?= rupiah($laba_kotor); ?><h4>
                            </div>
                        </li>
                        <li><b>
                                <hr></b></li>
                        <li>
                            <h4><b>Pendapatan lain - lain</b>
                                <h4>
                                    <ul>
                                        <li>1</li>
                                    </ul>
                        </li>
                        <li>
                            <h4><b>Total Pendapatan lain - lain</b>
                                <h4>
                        </li>
                        <li><b>
                                <hr></b></li>
                        <li>
                            <h4><b>Beban Usaha</b>
                                <h4>
                                    <ul>
                                        <li>1</li>
                                    </ul>
                        </li>
                        <li>
                            <h4><b>Total Beban Usaha</b>
                                <h4>
                        </li>
                        <li><b>
                                <hr></b></li>
                        <li>
                            <h4><b>Laba Operasi</b>
                                <h4>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div> <!-- end container -->