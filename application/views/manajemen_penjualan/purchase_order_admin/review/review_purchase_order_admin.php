<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function status($x)
{
    switch ($x) {
        case "1":
            return "Waiting Approve";
            break;
        case "2":
            return "Approve";
            break;
        case "3":
            return "Review Sales";
            break;
        case "99":
            return "Reject";
            break;
    }
}

function status_warna($x)
{
    switch ($x) {
        case "1":
            return "primary";
            break;
        case "2":
            return "success";
            break;
        case "3":
            return "warning";
            break;
        case "99":
            return "danger";
            break;
    }
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
$tanggal_transaksi = $data_po['tanggal_input'];
$tanggal_transaksi = tgl_indo(date("Y-m-d-D", strtotime($tanggal_transaksi)));

if ($data_po['status_pelanggan'] == 1) {
    $id_pelanggan = "Walk in Costumer";
} else {
    $id_pelanggan = $data_po['id_pelanggan'];
}

function status_approve($x)
{
    switch ($x) {
        case "1":
            return "";
            break;
        case "2":
            return "hidden";
            break;
        case "3":
            return "hidden";
            break;
        case "99":
            return "hidden";
            break;
    }
}

?>


<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right m-t-20">
                <a class="btn btn-<?= status_warna($data_po['status_po']); ?> "><?= status($data_po['status_po']); ?></a>
            </div>
            <h4 class="page-title">Review Order : <span id="no_order"><?= $data_po['no_order']; ?></span>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Umum</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Tanggal Order</label>
                    <div class="col-sm-8">
                        <input id="id_sales" autocomplete="off" name="id_sales" type="text" class="form-control" readonly value="<?= $tanggal_transaksi; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">ID Sales</label>
                    <div class="col-sm-8">
                        <input id="id_sales" autocomplete="off" name="id_sales" type="text" class="form-control" readonly value="<?= $data_po['user']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Nama Sales</label>
                    <div class="col-sm-8">
                        <input id="nama_sales" name="nama_sales" type="text" class="form-control" readonly value="<?= $data_po['nama']; ?>">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Pelanggan</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">ID Pelanggan</label>
                    <div class="col-sm-8">
                        <input id="id_pelanggan" autocomplete="off" name="id_pelanggan" type="text" class="form-control" disabled value="<?= $id_pelanggan; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Nama Pelanggan</label>
                    <div class="col-sm-8">
                        <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="form-control" readonly value="<?= $data_po['nama_pelanggan']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea id="alamat" name="alamat" type="text" class="form-control" readonly><?= $data_po['alamat']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label">No Telepon</label>
                    <div class="col-sm-8">
                        <input readonly id="nomor_telepon" name="nomor_telepon" type="text" class="form-control" value="<?= $data_po['nomor_telepon']; ?>">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card-box" id="loading_tambah">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-keranjang-po" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($review_order as $key => $value) : ?>
                                        <tr>
                                            <td><?= ++$key; ?></td>
                                            <td><?= $value['kode_barang']; ?></td>
                                            <td><?= $value['nama_barang']; ?></td>
                                            <td><?= rupiah($value['harga_jual']); ?></td>
                                            <td><?= $value['jumlah_penjualan']; ?></td>
                                            <td><?= rupiah($value['diskon']); ?></td>
                                            <td><?= rupiah($value['total_harga']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
                <hr>
                <div class="row">
                    <div class="col-sm-2">
                        <h3 class="m-t-0">Total :</h3>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="m-t-0" id="total_keranjang"><?= rupiah($data_po['total_penjualan']); ?>,-</h3>
                    </div>
                    <div class="col-sm-6 pull-left">
                        <h3 class="m-t-0" id="terbilang_keranjang"><?= terbilang($data_po['total_penjualan']); ?> Rupiah</h3>
                    </div>
                </div>
                <div class="row" <?= status_approve($data_po['status_po']); ?>>
                    <div class="col-sm-12">
                        <div class="text-right m-t-30">
                            <button id="checkout" name="checkout" type="button" class="btn btn-success waves-effect waves-light m-r-10"> <i class="fa fa-thumbs-o-up"></i> Approve</button>
                            <button id="return" name="return" type="button" class="btn btn-warning waves-effect waves-light"><i class="fa fa-share-square-o"></i> Return</button>
                            <button id="reject" name="reject" type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-thumbs-o-down"></i> Reject</button>
                        </div>


                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


</div> <!-- end container -->