<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="form-group row pull-right">
                            <label class="col-4 col-form-label">Cari Data</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="searchInput" placeholder="Kata Kunci ....">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="datatable-master-persediaan" class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php $this->view('template/template_footer'); ?>

</div>