            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <footer class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <h3><strong><?= $nama_perusahaan; ?></strong>
                                                </h3>
                                                <address>
                                                    Jl Raya Bandung Tasik Limbangan Timur<br>
                                                    Garut<br>
                                                    <abbr title="Phone">Telp:</abbr> 082119349199
                                                </address>
                                            </div>
                                            <div class="pull-right">
                                                <h4>Faktur Penjualan <br>
                                                    <!-- <strong>#<?= $data_order['no_faktur']; ?></strong> -->
                                                </h4>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="pull-left">
                                                    <p><strong>Nama Pelanggan: </strong> <?= $data_order['nama_pelanggan']; ?></p>
                                                    <p><strong>Alamat: </strong> <span class="label label-pink"><?= $data_order['alamat']; ?></span></p>
                                                    <p><strong>Cashier: </strong> Udin</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="pull-right">
                                                    <p><strong>Tanggal Order: </strong> <?=$data_order['tanggal_input']; ?></p>
                                                    <p><strong>Status Pembayaran: </strong> <span class="label label-pink">Lunas</span></p>
                                                    <p><strong>Nomor Faktur: </strong> #<?= $data_order['no_faktur']; ?></p>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="m-h-10"></div>

                                        <?php
                                        function rupiah($angka)
                                        {
                                            $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
                                            return $hasil_rupiah;
                                        }
                                        function Terbilang($x)
                                        {
                                            $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                                            if ($x < 12)
                                                return " " . $abil[$x];
                                            elseif ($x < 20)
                                                return Terbilang($x - 10) . "Belas";
                                            elseif ($x < 100)
                                                return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
                                            elseif ($x < 200)
                                                return " Seratus" . Terbilang($x - 100);
                                            elseif ($x < 1000)
                                                return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
                                            elseif ($x < 2000)
                                                return " Seribu" . Terbilang($x - 1000);
                                            elseif ($x < 1000000)
                                                return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
                                            elseif ($x < 1000000000)
                                                return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
                                        }
                                        ?>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table m-t-10">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Kode Barang</th>
                                                                <th>Nama Barang / Jasa</th>
                                                                <th>Satuan</th>
                                                                <th>Harga Satuan</th>
                                                                <th>Qty</th>
                                                                <th>Total Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($detail_order as $key => $value) : ?>
                                                                <tr>
                                                                    <td><?php $no = 1;
                                                                        echo $no; ?></td>
                                                                    <td><?= $value['kode_barang']; ?></td>
                                                                    <td><?= $value['nama_barang']; ?></td>
                                                                    <td><?= $value['kode_satuan']; ?></td>
                                                                    <td><?= rupiah($value['harga_satuan']); ?></td>
                                                                    <td><?= $value['jumlah_pembelian']; ?></td>
                                                                    <td><?= rupiah($value['harga_total']); ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="clearfix m-t-20">
                                                    <h5 class="small text-inverse font-600">Note</h5>
                                                    <small>
                                                        Pembayaran Transfer Melalui <br>
                                                        BCA : xxxxxxxxxxxxxxxx <br>
                                                        BNI : xxxxxxxxxxxxxxxx <br>
                                                        BRI : xxxxxxxxxxxxxxxx <br>
                                                        BCA : xxxxxxxxxxxxxxxx
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="clearfix m-t-20 row">
                                                    <div class="col-5">
                                                        <p class="text-right"><b>Sub-total</b></p>
                                                        <p class="text-right">Diskon</p>
                                                        <p class="text-right">Pajak</p>
                                                        <p class="text-right">Ongkos Kirim</p>
                                                    </div>
                                                    <div class="col-1">
                                                        <p class="text-right"><b> : </b></p>
                                                        <p class="text-right"> : </p>
                                                        <p class="text-right"> : </p>
                                                        <p class="text-right"> : </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p class="text-right"><?= rupiah($data_order['total_keranjang']); ?> </p>
                                                        <p class="text-right">(<?= rupiah($data_order['diskon']); ?>)</p>
                                                        <p class="text-right"><?= rupiah($data_order['pajak']); ?></p>
                                                        <p class="text-right"><?= rupiah($data_order['ongkir']); ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="clearfix row">
                                                    <div class="col-5">
                                                        <h3 class="text-right"><b>Grand-Total</b></h3>
                                                    </div>
                                                    <div class="col-1">
                                                        <h3 class="text-right"><b> : </b></h3>
                                                    </div>
                                                    <div class="col-5">
                                                        <h3 class="text-right"><?= rupiah($data_order['grand_total']); ?></h3>

                                                    </div>
                                                </div>
                                                <div class="clearfix row">
                                                    <div class="col-11">
                                                        <h5 class="text-right">( <?= terbilang($data_order['grand_total']); ?> Rupiah )</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <p>Cashier</p> <br><br>
                                                <p>( Udin )</p>
                                            </div>
                                            <div class="col-6">
                                                <p>Pelanggan</p><br><br>
                                                <p>( <?= $data_order['nama_pelanggan']; ?> )</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-print-none">
                                            <div class="pull-right">
                                                <!-- <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a> -->
                                                <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        </>
                                    </div>

                                </div>

                            </div>
                            <!-- end row -->

                        </div> <!-- container -->

                    </div> <!-- content -->

                    <?php $this->view('template/template_footer'); ?>

            </footer>