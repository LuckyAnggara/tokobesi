<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Saldo Awal per Tanggal : 01-Jan-<?= date('Y'); ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <button name="contoh" id="contoh" data-target="#add_modal" data-toggle="modal" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-20">
                    <i class="fa fa-plus"></i>
                    <span>Tambah Data</span>
                </button>
                <div class="table-responsive">
                    <table id="datatable-master-saldo-awal" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <hr>
                <div class="text-right">
                    <div class="form-group row">
                        <label class="col-4 col-form-label"></label>
                        <label class="col-3 col-form-label">Sub Total</label>
                        <div class="col-2">
                            <input name="sub_total_qty" id="sub_total_qty" type="text" class="form-control" placeholder="" readonly>
                        </div>
                        <div class="col-3">
                            <input name="sub_total_harga" id="sub_total_harga" type="text" class="form-control" placeholder="" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>