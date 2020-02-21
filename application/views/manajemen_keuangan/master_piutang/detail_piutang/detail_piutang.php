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
$tanggal_transaksi = $data_order['tanggal_transaksi'];
$tanggal_transaksi = tgl_indo(date("Y-m-d-D", strtotime($tanggal_transaksi)));

if ($data_order['status_pelanggan'] == 1) {
    $id_pelanggan = "Walk in Costumer";
} else {
    $id_pelanggan = $data_order['id_pelanggan'];
}

if ($data_order['status_bayar'] == 1) {
    $status_pembayaran = '<span class="badge badge-success  m-t-15">Lunas</span>';
} else {
    $status_pembayaran = '<span class="badge badge-danger  m-t-15">Belum Lunas</span>';
}
?>

<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Detail Piutang</h4> <span hidden id="nomor_faktur"><?= $data_order['no_faktur']; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Pelanggan</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">ID Pelanggan</label>
                    <div class="col-sm-8">
                        <input id="id_pelanggan" name="id_pelanggan" type="text" class="form-control" value="<?= $id_pelanggan; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Nama Pelanggan</label>
                    <div class="col-sm-8">
                        <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="form-control" value="<?= $data_order['nama_pelanggan']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Nomor Telepon</label>
                    <div class="col-sm-8">
                        <input id="nomor_telepon" name="nomor_telepon" type="text" class="form-control" value="<?= $data_order['nomor_telepon']; ?>" readonly>
                    </div>
                </div>
                <div class=" clearfix"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="m-t-0 header-title">Data Pembayaran</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-5">Tanggal Transaksi</label>
                    <div class="col-sm-8">
                        <input id="tanggal_transaksi" name="tanggal_transaksi" type="text" class="form-control" value="<?= $tanggal_transaksi; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Status Pembayaran</label>
                    <div class="col-sm-8">
                        <?= $status_pembayaran; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-form-label m-t-10">Grand Total</label>
                    <div class="col-sm-8">
                        <div class="input-group" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <input type="text" class="form-control" value=" <?= rupiah($data_order['grand_total']); ?>" readonly>
                            <input hidden type="text" id="grand_total" class="form-control" value=" <?= $data_order['grand_total']; ?>" readonly>
                            <div class="input-group-append" id="div_cari-button">
                                <a id="cari-button" name="cari-button" class="btn btn-inverse waves-effect waves-light" type="button"><i>Klik Untuk Detail</i></a>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item"><b><u>Diskon</u></b> : <?= rupiah($data_order['diskon']); ?></a>
                            <a class="dropdown-item"><b><u>Pajak</u></b> : <?= rupiah($data_order['pajak_masukan']); ?></a>
                            <a class="dropdown-item"><b><u>Ongkos Kirim</u></b> : <?= rupiah($data_order['ongkir']); ?></a>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-12">
                        <div class="pull-right">
                            <button id="tambah_btn" type="button" hidden class="btn btn-primary waves-effect waves-light">Tambah Data</button>
                        </div>
                        <h4 class="m-t-0 header-title">Detail Pembayaran</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-detail-pembayaran" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Nominal</th>
                                        <th>Sisa Saldo</th>
                                        <th>Bukti</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->