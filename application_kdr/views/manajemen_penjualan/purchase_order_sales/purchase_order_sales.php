<div class="container-fluid">

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Purchase Order : <span id="no_order"><?= $no_order; ?></span><span class="badge badge-success" id="status_order">new order</span>
            </h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">

        <div class="col-sm-12">
            <div class="card-box">
                <div class="form-group row">
                    <h4 class="col-12 m-t-0 header-title">Data Barang</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-form-label">Cari Nama Barang</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input autocomplete="off" placeholder="Kolom Pencarian Barang.." id="cari_barang" name="cari_barang" type="text" class="form-control">
                            <div class="input-group-append" id="div_cari-button">
                                <button id="searchbtn" name="searchbtn" class=" btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row" id="result_page">
                    <div class="col-12 text-center">
                        <p>Cari Data Barang di Kolom Pencarian</p>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>


</div> <!-- end container -->