<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Penggajian</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Data Umum</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label  m-t-10 ">Nomor Referensi</label>
                            <div class="col-7">
                                <input id="nomor_referensi" autocomplete="off" name="nomor_referensi" type="text" class="form-control" value="<?= $master_gaji['nomor_referensi']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Tanggal</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="mm/dd/yyyy" id="tanggal" value="<?= $master_gaji['tanggal']; ?>" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Keterangan</label>
                            <div class="col-7">
                                <textarea type="text" rows="2" class="form-control" placeholder="(optional)" name="keterangan" id="keterangan" readonly><?= $master_gaji['keterangan']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Pemutus</label>
                            <div class="col-7">
                                <input name="maker" id="maker" type="text" class="form-control" placeholder="" value="<?= $master_gaji['nama_admin']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Jumlah Pembayaran</label>
                            <div class="col-7">
                                <input name="jumlah_pembayaran" id="jumlah_pembayaran" type="text" class="form-control" placeholder="" value="<?= rupiah($master_gaji['total_pembayaran']); ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable-daftar-gaji" class="table table-bordered  dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Uang Makan</th>
                                        <th>Bonus</th>
                                        <th>Total Gaji</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div> <!-- container -->