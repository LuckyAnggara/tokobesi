<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Cash On Hand Supervisor</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <button name="tambah_data" id="tambah_data" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-20">
                    <span>Start of Day</span>
                </button>
                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-pills ">
                        <li class="nav-item">
                            <a href="#transaksi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Aktif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#notifikasi" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Histori
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="transaksi">
                            <div class="table-responsive">
                                <table id="datatable-master-coh" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Cash Awal</th>
                                            <th>Cash Akhir</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <h5 class="page-title">Cash On Hand Kasir</h5>

                            <div class="table-responsive">
                                <table id="datatable-detail-coh-kasir" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nama Kasir</th>
                                            <th>Cash Awal</th>
                                            <th>Cash Akhir</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="notifikasi">
                            <div class="table-responsive">
                                <table id="datatable-master-coh-histori" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Cash Awal</th>
                                            <th>Cash Akhir</th>
                                            <th>Keterangan</th>
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