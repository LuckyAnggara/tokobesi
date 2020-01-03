<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-4">
                    <div class="card-box">
                        <div class="form-group row">
                            <h4 class="m-t-0 header-title">Data Pelanggan</h4>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">ID Pelanggan</label>

                            <div class="col-sm-6">
                                <input id="id_pelanggan" autocomplete="off" name="id_pelanggan" type="text" class="form-control" placeholder="Isi ID Pelanggan, jika ada">
                                <small id="id_pelanggan_help" class="form-text text-muted">Kosong kan jika tidak ada ID Pelanggan</small>
                            </div>
                            <div class="col-sm-2">
                  
                        <button id="cari-button" name="cari-button" class="btn btn-icon waves-effect btn-success m-b-5"> <i class="fa fa-search"></i> </button>
                                <!-- <button id="cari-button" name="cari-button" type="button" class="btn btn-rounded btn-primary waves-effect"><i class="fa fa-search"></i> Cari</button> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea id="alamat" name="alamat" type="text" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-sm-form-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input id="nomor_telepon" name="nomor_telepon" type="text" class="form-control">
                            </div>
                        </div>
                        <small id="data_pelanggan_help" class="form-text text-muted">Silahkan gunakan fitur Cari, jika Pelanggan memiliki ID.</small>


                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card-box">
                        <div class="form-group row">
                            
                            <h4 class="col-4 m-t-0 header-title">Data Barang</h4>
                            <div class="col-8 float-right">
                                    <div class="radio radio-info form-check-inline">
                                        <input type="radio" id="simple" value="option1" name="radioInline" checked>
                                        <label for="inlineRadio1"> Simple  </label>
                                    </div>
                                    <div class="radio form-check-inline">
                                        <input type="radio" id="advance" value="option2" name="radioInline">
                                        <label for="inlineRadio2"> Advance </label>
                                    </div>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-2 col-sm-form-label">Cari Nama Barang</label>
                            <div class="col-sm-10">
                                <select name="select_nama_barang" id="select_nama_barang" class="form-control">
                                </select>
                                <input autocomplete="off" placeholder="Kolom Pencarian Barang.." id="cari_barang" name="cari_barang" type="text" class="form-control">
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
                    <div class="card-box">
                        <h4 class="m-t-0 header-title">Keranjang Belanja</h4>
                        <h4 id="no_order" hidden><?= $no_order;?></h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">

                                    <table id="datatable-keranjang-penjualan" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

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
                                <h3 class="m-t-0" id="total_keranjang">Rp. 0 </h3>
                            </div>
                            <div class="col-sm-6 pull-left">
                                <h3 class="m-t-0" id="terbilang_keranjang">Nol Rupiah</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-t-30">
                                    <button id="checkout" type="submit" class="btn  btn-lg btn-secondary waves-effect waves-light"><i class="dripicons-cart"></i> Checkout</button>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


        </div> <!-- container -->

    </div> <!-- content -->

    <?php $this->view('template/template_footer'); ?>


</div>