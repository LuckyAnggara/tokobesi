<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Daftar Data Purchase Order Cabang</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-pills ">
                        <li class="nav-item">
                            <a href="#transaksi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Request
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#notifikasi" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Receive
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="transaksi">
                            <div class='row'>
                                <button name="tambah_data" id="tambah_data" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-20">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Data</span>
                                </button>
                                <div class="table-responsive">
                                    <table id="datatable-daftar-request" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal Input</th>
                                                <th>Tanggal PO</th>
                                                <th>Nomor Order PO</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="notifikasi">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="datatable-daftar-receive" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Asal</th>
                                                <th>Nomor Order PO</th>
                                                <th>Grand Total</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>