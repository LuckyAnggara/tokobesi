<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-picture card-box row">
                        <div class="col-sm-4">
                            <img src="<?= base_url('assets/'); ?>images/barang/batubata.jpg" alt="profile-image" class="card-img-top img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#detail_barang" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Detail Barang
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#data_supplier" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        Data Supplier
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#histori_harga" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Histori Harga Barang
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#settings1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Settings
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="detail_barang">

                                    <form class="form-horizontal" role="form">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Kode Barang</label>
                                            <div class="col-10">
                                                <input id="kode_barang" type="text" class="form-control" value="<?= $persediaan['kode_barang']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Nama Barang</label>
                                            <div class="col-10">
                                                <input id="nama_barang" type="text" class="form-control" value="<?= $persediaan['nama_barang']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Jumlah Persediaan</label>
                                            <div class="col-10">
                                                <input id="jumlah_persediaan" type="text" class="form-control" value="<?= $persediaan['jumlah_persediaan']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Harga Satuan Terkahir</label>
                                            <div class="col-10">
                                                <input id="harga_satuan" type="text" class="form-control" value="<?= $persediaan['harga_satuan']; ?>" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Total Persediaan Batu Bata </label>
                                            <div class="col-3">
                                                <h3>Rp. <?= $persediaan['jumlah_persediaan'] * $persediaan['harga_satuan']; ?></h3>
                                            </div>
                                            <div class="col-4">
                                                <h4>(Empat Ratus Juta Rupiah)</h4>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="data_supplier">
                                    <table id="datatable-data-supplier" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="histori_harga">
                                    <table id="datatable-histori-harga" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <thead>
                                                <tr>
                                                    <th class="w-25">Tanggal Update</th>
                                                    <th class="w-25">Harga</th>
                                                </tr>
                                            </thead>

                                        <tbody>
                                            <tr>
                                                <td>20 November 2019</td>
                                                <td>Rp. 5.000</td>
                                            </tr>
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings1">
                                    <p>Trust fund seitan letterpress,
                                        keytar raw denim keffiyeh etsy art party before they sold out master
                                        cleanse gluten-free squid scenester freegan cosby sweater. Fanny
                                        pack portland seitan DIY, art party locavore wolf cliche high life
                                        echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before
                                        they sold out farm-to-table VHS viral locavore cosby sweater. Lomo
                                        wolf viral, mustache readymade thundercats keffiyeh craft beer marfa
                                        ethical. Wolf salvia freegan, sartorial keffiyeh echo park
                                        vegan.</p>
                                </div>
                            </div>

                            <!-- <div class="profile-info-detail">
                                <h4 class="m-0">Batu Bata</h4>
                                <p class="text-muted m-b-20"><i>Web Designer</i></p>
                                <p>Hi I'm Alexandra Clarkson,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC,making it over 2000 years old.Contrary to popular belief, Lorem Ipsum is not simplyrandom text. It has roots in a piece of classical Latin literature from 45 BC.</p>
                            </div> -->

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!--/ meta -->



                    <div method="post" class="card-box">
                        <ul class="nav nav-pills profile-pills m-t-10">
                            <li>
                                <a href="#"><i class="fa fa-user"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-location-arrow"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class=" fa fa-camera"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-smile-o"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

        </div> <!-- container -->

    </div> <!-- content -->
    <?php $this->view('template/template_footer'); ?>

</div>