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
                        return Terbilang($x - 10) . " Belas";
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

                $tanggal = $data_order['tanggal'];

                function tgl_indo($tanggal)
                {
                    $bulan = array(
                        1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    );
                    $pecahkan = explode('-', $tanggal);

                    // variabel pecahkan 0 = tanggal
                    // variabel pecahkan 1 = bulan
                    // variabel pecahkan 2 = tahun

                    switch ($pecahkan[3]) {
                        case 'Sun':
                            $hari_ini = "Minggu";
                            break;

                        case 'Mon':
                            $hari_ini = "Senin";
                            break;

                        case 'Tue':
                            $hari_ini = "Selasa";
                            break;

                        case 'Wed':
                            $hari_ini = "Rabu";
                            break;

                        case 'Thu':
                            $hari_ini = "Kamis";
                            break;

                        case 'Fri':
                            $hari_ini = "Jumat";
                            break;

                        case 'Sat':
                            $hari_ini = "Sabtu";
                            break;

                        default:
                            $hari_ini = "Tidak di ketahui";
                            break;
                    }

                    return $hari_ini . ', ' . $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
                }
                $tanggal = tgl_indo(date("Y-m-d-D", strtotime($tanggal)));
                ?>

             <!-- ============================================================== -->
             <!-- Start right Content here -->
             <!-- ============================================================== -->
             <!-- Start content -->
             <div class="container-fluid">
                 <!-- Page-Title -->
                 <div class="row">
                     <div class="col-sm-12">
                         <h4 class="page-title">Faktur Retur</h4>
                     </div>
                 </div>
                 <footer class="content-page">
                     <div class="row">
                         <div class="col-md-12">
                             <div class="card-box">
                                 <div class="panel-body">
                                     <div class="clearfix">
                                         <div class="widget-user row">
                                             <div class="col-9">
                                                 <img src="<?= base_url('assets/images/logo-perusahaan.png'); ?>" class="m-t-30 col-1 img-responsive" alt="user">
                                                 <div class="wid-u-info col-9">
                                                     <ul style="list-style-type:none">
                                                         <li>
                                                             <h3><strong><?= $setting_perusahaan['nama_perusahaan']; ?></strong>
                                                             </h3>
                                                         <li>
                                                     </ul>
                                                     <ul style="list-style-type:none">
                                                         <li class="text-left"><?= nl2br($setting_perusahaan['alamat_perusahaan']); ?><br></li>
                                                         <li class="text-left" title=" Phone"> Telp : <?= $setting_perusahaan['nomor_telepon']; ?> / Fax : <?= $setting_perusahaan['nomor_fax']; ?></li>
                                                         <li class="text-left" title="Email"> Email : <?= $setting_perusahaan['alamat_email']; ?></li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <div class="col-3 text-right">
                                                 <h4><b>Faktur Retur Penjualan</b></h4>
                                                 <p><?= $tanggal; ?></p>
                                             </div>
                                         </div>

                                     </div>
                                     <hr>
                                     <div class="row">
                                         <div class="col-6">
                                             <div class="clearfix row m-t-10">
                                                 <ul class="col-3" style="list-style-type:none">
                                                     <li class="text-left m-b-3">Nama Pelanggan</li>
                                                     <li class="text-left m-b-3">Alamat</li>
                                                 </ul>
                                                 <ul class="col-1" style="list-style-type:none">
                                                     <li class="text-center m-b-3"> : </li>
                                                     <li class="text-center m-b-3"> : </li>
                                                 </ul>
                                                 <ul class="col-8" style="list-style-type:none">
                                                     <li class="text-left m-b-3"><?= $data_order['nama_pelanggan']; ?></li>
                                                     <li class="text-left m-b-3"><?= $data_order['alamat']; ?></li>
                                                 </ul>
                                             </div>
                                             <!-- end row -->
                                         </div>
                                         <div class="col-2">
                                         </div>
                                         <div class="col-4">
                                             <div class="clearfix row m-t-10">
                                                 <ul class="col-4" style="list-style-type:none">
                                                     <li class="text-left m-b-3">Nomor Faktur</li>
                                                 </ul>
                                                 <ul class="col-1" style="list-style-type:none">
                                                     <li class="text-left m-b-3"> : </li>
                                                 </ul>
                                                 <ul class="col-7" style="list-style-type:none">
                                                     <li class="text-left m-b-3">#<?= $data_order['nomor_faktur']; ?></li>
                                                 </ul>
                                             </div>
                                             <!-- end row -->
                                         </div>
                                     </div>


                                     <div class="m-h-10"></div>

                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="table-responsive">
                                                 <table class="table table-sm m-t-10 table-striped table-bordered">
                                                     <thead class="thead-dark">
                                                         <tr>
                                                             <th style="width: 5%">#</th>
                                                             <th style="width: 10%">Kode Barang</th>
                                                             <th style="width: 35%">Nama Barang / Jasa</th>
                                                             <th style="width: 10%">Satuan</th>
                                                             <th style="width: 10%">Harga</th>
                                                             <th style="width: 5%">Qty</th>
                                                             <th style="width: 10%">Diskon</th>
                                                             <th style="width: 25%">Total Harga</th>
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
                                                                 <td><?= rupiah($value['harga_retur']); ?></td>
                                                                 <td><?= $value['jumlah_retur']; ?></td>
                                                                 <td><?= rupiah($value['diskon']); ?></td>
                                                                 <td><?= rupiah($value['total_retur']); ?></td>
                                                             </tr>
                                                         <?php endforeach; ?>
                                                     </tbody>
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-6">
                                             <div class="clearfix m-t-10">
                                                 <h4 class="text-inverse"><b><u>Note</u></b></h4>
                                                 <p>
                                                     <?= nl2br($setting_perusahaan['note_retur_faktur_jual']); ?>
                                                 </p>
                                             </div>
                                         </div>
                                         <div class="col-6">
                                             <div class="clearfix row m-t-10">
                                                 <ul class="col-5" style="list-style-type:none">
                                                     <li class="text-right m-b-3"><b>Sub-total</b></li>
                                                     <li class="text-right m-b-3">Diskon</li>
                                                     <li class="text-right m-b-3">Pajak (PPN 10%)</li>
                                                     <!-- <li class="text-right m-b-3">Ongkos Kirim</li> -->
                                                 </ul>
                                                 <ul class="col-1" style="list-style-type:none">
                                                     <li class="text-right m-b-3"><b> : </b></li>
                                                     <li class="text-right m-b-3"> : </li>
                                                     <li class="text-right m-b-3"> : </li>
                                                     <!-- <li class="text-right m-b-3"> : </li> -->
                                                 </ul>
                                                 <ul class="col-4" style="list-style-type:none">
                                                     <li class="text-right m-b-3"><b><?= rupiah($data_order['retur_total']); ?></b></li>
                                                     <li class="text-right m-b-3">(<?= rupiah($data_order['retur_diskon']); ?>)</li>
                                                     <li class="text-right m-b-3"><?= rupiah($data_order['retur_pajak']); ?></li>
                                                     <!-- <li class="text-right m-b-3"><?= rupiah($data_order['ongkir']); ?></li> -->
                                                 </ul>
                                             </div>
                                             <hr>
                                             <div class="clearfix row">
                                                 <ul class="col-5" style="list-style-type:none">
                                                     <li class="text-right">
                                                         <b>Grand-Total</b>
                                                     </li>
                                                 </ul>
                                                 <ul class="col-1" style="list-style-type:none">
                                                     <li class="text-right">
                                                         <b> : </b>
                                                     </li>
                                                 </ul>
                                                 <ul class="col-4" style="list-style-type:none">
                                                     <li class="text-right">
                                                         <b><?= rupiah($data_order['retur_grand_total']); ?></b>
                                                     </li>

                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                     <hr>
                                     <div class="row text-center">
                                         <div class="col-6">
                                             <p>Hormat Kami</p> <br>
                                             <p>( <?= $data_order['nama_pegawai']; ?> )</p>
                                         </div>
                                         <!-- <div class="col-6">
                                                <p>Pelanggan</p><br><br>
                                                <p>( <?= $data_order['nama_pelanggan']; ?> )</p>
                                            </div> -->
                                     </div>
                                     <hr>
                                     <div class="d-print-none">
                                         <div class="pull-right">
                                             <!-- <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a> -->
                                             <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
                                         </div>
                                         <div class="clearfix"></div>
                                     </div>
                                     </p>
                                 </div>

                             </div>

                         </div>
                         <!-- end row -->
                     </div> <!-- container -->
                 </footer>
             </div> <!-- end container -->