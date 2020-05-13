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
                $data_po = $po['data_po'];

                $tanggal_po = $data_po['tanggal_masuk'];
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
                $tanggal_po = tgl_indo(date("Y-m-d-D", strtotime($tanggal_po)));
                $no = 1;
                ?>

             <!-- ============================================================== -->
             <!-- Start right Content here -->
             <!-- ============================================================== -->
             <!-- Start content -->
             <div class="container-fluid customFont">
                 <!-- Page-Title -->
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="btn-group pull-right page-title">
                             <?php if ($data_po['status']  == 0) { ?>
                                 <a type="button" id="print_btn" class="m-t-20 btn btn-primary waves-effect waves-light"> Pending </a>
                             <?php } else if ($data_po['status']  == 2) { ?>
                                 <a type="button" id="print_btn" class="m-t-20 btn btn-success waves-effect waves-light"> Approved </a>
                             <?php } else if ($data_po['status']  == 99) { ?>
                                 <a type="button" id="print_btn" class="m-t-20 btn btn-danger waves-effect waves-light"> Rejected </a>
                             <?php } ?>

                         </div>
                         <h4 class="page-title">Purchase Order Cabang</h4>
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
                                                 <img src="<?= 'https://www.'.$data_po['url'] . '/assets/images/' . $data_po['logo_perusahaan']; ?>" class="m-t-30 col-1 img-responsive" alt="user">
                                                 <div class="wid-u-info col-9">
                                                     <ul style="list-style-type:none">
                                                         <li>
                                                             <h3><strong><?= $data_po['nama_perusahaan']; ?></strong>
                                                             </h3>
                                                         <li>
                                                     </ul>
                                                     <ul style="list-style-type:none">
                                                         <li class="text-left"><?= nl2br($data_po['alamat_perusahaan']); ?><br></li>
                                                         <li class="text-left" title=" Phone"> Telp : <?= $data_po['nomor_telepon']; ?> / Fax : <?= $data_po['nomor_fax']; ?></li>
                                                         <li class="text-left" title="Email"> Email : <?= $data_po['alamat_email']; ?></li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <div class="col-3 text-right">
                                                 <h4><b>Purchase Order Cabang</b></h4>
                                                 <p><?= $tanggal_po; ?></p>
                                             </div>
                                         </div>

                                     </div>
                                     <hr>
                                     <div class="row">
                                         <div class="col-12">
                                             <div class="clearfix row m-t-10">
                                                 <ul class="col-4" style="list-style-type:none">
                                                     <li class="text-left m-b-3">Nomor Order PO</li>
                                                 </ul>
                                                 <ul class="col-1" style="list-style-type:none">
                                                     <li class="text-left m-b-3"> : </li>
                                                 </ul>
                                                 <ul class="col-7" style="list-style-type:none">
                                                     <li class="text-left m-b-3">#<?= $data_po['no_order_po']; ?></li>
                                                 </ul>
                                             </div>
                                             <!-- end row -->
                                         </div>
                                     </div>
                                     <div class="m-h-10"></div>
                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="table-responsive">
                                                 <table class="table table-bordered">
                                                     <thead class="">
                                                         <tr>
                                                             <th style="width: 5%">#</th>
                                                             <th style="width: 50%">Nama Barang / Jasa</th>
                                                             <th style="width: 5%">Satuan</th>
                                                             <th style="width: 15%">Harga</th>
                                                             <th style="width: 5%">Qty</th>
                                                             <th style="width: 25%">Total Harga</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody">
                                                         <?php foreach ($po['detail_po'] as $key => $value) : ?>
                                                             <tr>
                                                                 <td><?php
                                                                        echo $no++; ?></td>
                                                                 <td><?= $value['nama_barang']; ?></td>
                                                                 <td><?= $value['nama_satuan']; ?></td>
                                                                 <td class="text-right"><?= rupiah($value['harga_beli']); ?></td>
                                                                 <td class="text-right"><?= $value['jumlah_pembelian']; ?></td>
                                                                 <td class="text-right"><?= rupiah($value['total_harga']); ?></td>
                                                             </tr>
                                                         <?php endforeach; ?>
                                                     </tbody">
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-6">
                                             <div class="clearfix m-t-10">
                                                 <h4 class="text-inverse"><b><u>Note</u></b></h4>
                                                 <p>
                                                     <?= $data_po['keterangan'] ?>
                                                 </p>
                                             </div>
                                         </div>
                                         <div class="col-6">
                                             <div class="clearfix row m-t-10">
                                                 <ul class="col-5" style="list-style-type:none">
                                                     <li class="text-right m-b-3"><b>Sub-total</b></li>
                                                     <li class="text-right m-b-3">Biaya Lainnya</li>
                                                 </ul>
                                                 <ul class="col-1" style="list-style-type:none">
                                                     <li class="text-right m-b-3"><b> : </b></li>
                                                     <li class="text-right m-b-3"> : </li>
                                                 </ul>
                                                 <ul class="col-4" style="list-style-type:none">
                                                     <li class="text-right m-b-3"><b><?= rupiah($data_po['total_pembelian']); ?></b></li>
                                                     <li class="text-right m-b-3">(<?= rupiah($data_po['biaya_lainnya']); ?>)</li>
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
                                                         <b><?= rupiah($data_po['grand_total']); ?></b>
                                                     </li>

                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                     <hr>
                                     <div class="row text-center">
                                         <div class="col-6">
                                             <p>Hormat Kami</p>
                                             <p><?= $data_po['nama_perusahaan'];; ?></p>
                                         </div>
                                     </div>
                                     <hr>
                                     <div class="d-print-none">
                                         <div class="pull-right">
                                             <a id="print_lx" class="btn btn-inverse waves-effect waves-light" type="button"><i class="fa fa-print"></i> Lx Print </a>
                                             <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
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