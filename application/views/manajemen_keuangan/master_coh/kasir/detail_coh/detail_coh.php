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
            <h4 class="page-title">Detail Cash on Hand</h4>
            <span id="nomor_referensi" hidden><?= $detail_data['nomor_referensi']; ?></span>
            <span id="nomor_referensi_spv" hidden><?= $detail_data['nomor_referensi_spv']; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-t-0 header-title">Detail Data</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label m-t-10">Tanggal</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control" id="tanggal" disabled value="<?= $detail_data['tanggal']; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-5 col-sm-form-label  m-t-10 ">Cash on Hand</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <input id="saldo_akhir" autocomplete="off" name="saldo_akhir" type="text" class="form-control" readonly value="<?= rupiah($detail_data['saldo_akhir']); ?>">
                                    <div class=" input-group-append">
                                        <span class="input-group-text btn-inverse"><i class="ti-money"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button name="tarik" id="tarik" class="btn btn-danger waves-effect waves-light" data-target="#tarik_modal" data-toggle="modal">
                                    <i class="fa fa-download"></i>
                                    <span>Tarik Dana</span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button name="setor" id="setor" class="btn btn-primary waves-effect waves-light" data-target="#setor_modal" data-toggle="modal">
                                    <i class="fa fa-upload"></i>
                                    <span>Setor Dana</span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button name="setor" id="setor" class="btn btn-inverse waves-effect waves-light" data-target="#transfer_modal" data-toggle="modal">
                                    <i class="fa fa-exchange"></i>
                                    <span>Transfer Dana</span>
                                </button>
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
                        <ul class="nav nav-tabs nav-pills ">
                            <li class="nav-item">
                                <a href="#transaksi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Detail Transaksi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#notifikasi" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    Daftar Permintaan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#pending" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    Daftar Pending
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="transaksi">
                                <div class="table-responsive">
                                    <table id="datatable-detail-coh" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Jam</th>
                                                <th>Kas Masuk</th>
                                                <th>Kas Keluar</th>
                                                <th>Saldo </th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="notifikasi">
                                <div class="table-responsive">
                                    <table id="datatable-daftar-permintaan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Jam</th>
                                                <th>User</th>
                                                <th>Keterangan</th>
                                                <th>Nominal</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="pending">
                                <div class="table-responsive">
                                    <table id="datatable-daftar-pending" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Jam</th>
                                                <th>Keterangan</th>
                                                <th>Nominal</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div> <!-- container -->