<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <button name="contoh" id="contoh" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-20">
                            <i class="fa fa-plus"></i>
                            <span>Tambah Data</span>
                        </button>
                        <div class="row pull-right">
                            <label class="col-4 col-form-label">Cari Data</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="searchInput" placeholder="Kata Kunci..">
                            </div>
                        </div>
                        <table id="datatable-master-barang" class="table table-striped table-bordered" width="100%">
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- content -->
    <?php $this->view('template/template_footer'); ?>

</div>

<!-- modal tambah data -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Barang</label>
                        <div class="col-9">
                            <input name="kode_barang" id="kode_barang" type="text" class="form-control" placeholder="Generate otomatis oleh sistem" Disabled required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Barang</label>
                        <div class="col-9">
                            <input name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Nama Barang yang Akan di Input.. contoh : Besi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Satuan Harga</label>
                        <div class="col-5">
                            <input type="text" id="harga_satuan_dummy" placeholder="Input harga barang, hanya angka" class="form-control" required>
                            <input type="text" id="harga_satuan" placeholder="Input harga barang, hanya angka" class="form-control" hidden>
                        </div>
                        <label class="col-1 col-form-label">Satuan</label>
                        <div class="col-3">
                            <select name="satuan" id="satuan" class="form-control" required>
                                <option value="0" selected disabled>-- Satuan Barang --</option>
                                <option value="pieces">Pieces</option>
                                <option value="meter">Meter</option>
                                <option value="gram">Gram</option>
                                <option value="kilogram">Kilogram</option>
                                <option value="ton">Ton</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Gambar Produk</label>
                        <div class="col-5">
                            <input name="gambar" id="gambar" type="file" />
                        </div>
                    </div>
                    <div class="col-12">
                        <span>*Upload Gambar Produk jika Ada.. (Tidak Mandatory)</span>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="md-close" name="button-close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" name="button-add" class="btn btn-primary waves-effect waves-light">Submit</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="addLampiran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Upload Lampiran</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            </div>
            <div class="modal-body">
                <form data-parsley-validate novalidate autocomplete="off" id="submitUpload" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Lampiran*</label>
                        <div class="col-5">
                            <!-- <input type="file" name="my-pond" id="my-pond" class="my-pond" data-max-file-size="10MB"
                                data-max-files="3"> -->
                            <input name="file" id="file" type="file" />
                        </div>
                    </div>
                    <div class="col-12">
                        <span>*Lampiran adalah hasil scan SK/ST/SP dalam format PDF</span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --