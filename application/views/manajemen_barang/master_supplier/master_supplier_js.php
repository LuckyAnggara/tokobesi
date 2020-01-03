<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.bundle.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>


<!-- script validasi -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#submitForm').parsley();
    });
</script>
<!-- Script Auto Generate Kode Barang -->

<script>
    var nama_supplier = $('#nama_supplier');
    var kode_supplier = $('#kode_supplier');
    nama_supplier.focusout(function() {
    $.ajax({
            url: '<?= base_url("manajemen_barang/MasterSupplier/generate_kode_supplier/"); ?>',
            success: function(result) {
                kode_supplier.val(result);
                console.log(result);
            }
        });
    });

</script>

<!-- script format NPWP -->

<script>
var npwp = $('#npwp');

npwp.focusout(function() {
    no_npwp = npwp.val();
    no_npwp = formatNpwp(no_npwp);
    no_npwp = no_npwp.substring(0, 20);
    npwp.val(no_npwp);
});

function formatNpwp(value) {
  if (typeof value === 'string') {
    return value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6');
  }
}
</script>

<!-- script close modal reset data -->

<script>
    $(document).ready(function() {
        $('#add_Modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });

        $('#edit_Modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });

        $('#view_Modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#detail_barang").addClass("active show");
            $("#nav_detail_barang").addClass("active show");
            $("#nav_data_penjualan").removeClass("active show");
            $("#data_penjualan").removeClass("active show");
        });
    });
</script>

<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        //Init Datatabel Master Stock Persediaan 
        var table = $('#datatable-master-supplier').DataTable({
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": false,
            "order": [],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url("manajemen_barang/MasterSupplier/getData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    title: "No",
                    data: "kode_supplier",
                    searching: true,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Kode Supplier",
                    data: "kode_supplier",
                    searching: true,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Nama Supplier",
                    data: "nama_supplier",
                    searching: true,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Nomor Telepon",
                    data: "nomor_telepon",
                    searching: true,
                    targets: 3,
                    render: function(data, type, full, meta) {

                            return data;
                    }
                },
                {
                    title: "Action",
                    data: "kode_supplier",
                    searching: true,
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_view_modal(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        var display2 = '<a type="button" onClick = "show_edit_modal(\'' + data + '\')"" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Edit Data"><i class="fa fa-edit" ></i> </a>';
                        var display3 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                        return display1 + " " + display2 + " " + display3;
                    }
                }
            ],
            "rowCallback": function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        $('#searchInput').on('keypress', function(e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                $('#datatable-master-supplier').DataTable().destroy();
                var input = $('#searchInput').val();
                var table = $('#datatable-master-supplier').DataTable({
                    "oLanguage": {
                        sProcessing: "Sabar yah...",
                        sZeroRecords: "Tidak ada Data..."
                    },
                    "searching": false,
                    "deferRender": true,
                    "order": [],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": '<?= base_url("manajemen_barang/mastersupplier/getData/"); ?>' + input,
                        "type": "POST",
                    },
                    "columnDefs": [{
                    title: "No",
                    data: "kode_supplier",
                    searching: true,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Kode Supplier",
                    data: "kode_supplier",
                    searching: true,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Nama Supplier",
                    data: "nama_supplier",
                    searching: true,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Nomor Telepon",
                    data: "nomor_telepon",
                    searching: true,
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Action",
                    data: "kode_supplier",
                    searching: true,
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_view_modal(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        var display2 = '<a type="button" onClick = "show_edit_modal(\'' + data + '\')"" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Edit Data"><i class="fa fa-edit" ></i> </a>';
                        var display3 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                        return display1 + " " + display2 + " " + display3;
                    }
                }
            ],
                    "rowCallback": function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            }
        });
    });
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#submitForm').submit(function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById("submitForm"));
            $.ajax({
                url: "<?= Base_url('manajemen_barang/MasterSupplier/tambah_data'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-supplier').DataTable().ajax.reload();
                    $('#add_Modal').modal('hide');
                }
            })
        });
    });
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(kode_supplier) {
        swal({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Semua Data Persediaan dengan kode " + kode_supplier + " juga akan terhapus",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            deleteData(kode_supplier);
            swal(
                'Deleted!',
                'Data ' + kode_supplier + ' telah dihapus!',
                'success'
            )
        });
    }

    function deleteData(kode_supplier) {
        $.ajax({
            url: "<?= base_url('manajemen_barang/MasterSupplier/delete_data/'); ?>" + kode_supplier,
            async: false,
            success: function(data) {
                $('#datatable-master-supplier').DataTable().ajax.reload();
            }
        });
    }
</script>

<!-- Script Edit Data -->
<script type="text/javascript">
    function show_edit_modal(kode_supplier) {
        fetchdata(kode_supplier);
    }
    function fetchdata(kode_supplier) {
        var edit_data_label = $('#edit_data_label');
        var edit_kode_supplier = $('#edit_kode_supplier');
        var edit_nama_supplier = $('#edit_nama_supplier');
        var edit_alamat = $('#edit_alamat');
        var edit_nomor_telepon = $('#edit_nomor_telepon');
        var edit_npwp = $('#edit_npwp');
        var edit_bank_rekening = $('#edit_bank_rekening');
        var edit_nomor_rekening = $('#edit_nomor_rekening');
        var edit_nama_rekening = $('#edit_nama_rekening');
        var edit_keterangan = $('#edit_keterangan');
        var edit_tanggal_input = $('#edit_tanggal_input');
        $.ajax({
            url: '<?= base_url("manajemen_barang/MasterSupplier/view_edit_data/"); ?>' + kode_supplier,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                // split rekening
                var bank = data.nomor_rekening.split("-");
                console.log(bank);
                // set data ke view
                edit_data_label.text("Edit Data Supplier Kode :" + data.kode_supplier);
                edit_kode_supplier.val(data.kode_supplier);
                edit_nama_supplier.val(data.nama_supplier);
                edit_alamat.val(data.alamat);
                edit_nomor_telepon.val(data.nomor_telepon);
                edit_npwp.val(data.npwp);
                edit_bank_rekening.val(bank[0]);
                edit_nomor_rekening.val(bank[1]);
                edit_nama_rekening.val(bank[2]);
                edit_keterangan.val(data.keterangan);
                edit_tanggal_input.text(data.tanggal_input);
                $('#edit_Modal').modal('show');
            }
        });
    }

    // submit edit data
    $(document).ready(function() {

        function warning_edit(kode_supplier) {
            swal({
                title: 'Apa anda yakin akan mengubah data ini?',
                text: "Semua Data Supplier dengan kode " + kode_supplier + " juga akan terubah",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Ya, Ubah ini!'
            }).then(function() {
                editData(kode_supplier);
                swal(
                    'Edited!!!',
                    'Data ' + kode_supplier + ' telah diubah!',
                    'success'
                )
            });
        }

        function editData(kode_supplier) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('manajemen_barang/MasterSupplier/edit_data/'); ?>" + kode_supplier,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-supplier').DataTable().ajax.reload();
                    $('#edit_Modal').modal('hide');
                }
            })

        }
        $('#edit_form').submit(function(e) {
            var kode_supplier = $('#edit_kode_supplier').val();
            e.preventDefault();
            warning_edit(kode_supplier);
        });

    });
</script>

<!-- Script Edit Modal -->
<script type="text/javascript">
    function show_view_modal(kode_supplier) {
        viewfetchdata(kode_supplier);
    }

    function viewfetchdata(kode_supplier) {
        var view_data_label = $('#view_data_label');
        var view_kode_supplier = $('#view_kode_supplier');
        var view_nama_supplier = $('#view_nama_supplier');
        var view_harga_satuan_dummy = $('#view_harga_satuan_dummy');
        var view_harga_satuan = $('#view_harga_satuan');
        var view_satuan = $('#view_satuan');
        var view_tanggal_input = $('#view_tanggal_input');
        var view_image = $('#view_image');
        //var edit_image = $('#edit_image');

        $.ajax({
            url: '<?= base_url("manajemen_barang/MasterSupplier/view_edit_data/"); ?>' + kode_supplier,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                // rupiah = formatRupiah(data.harga_satuan, 'Rp.');
                view_data_label.text("View Data Barang Kode :" + data.kode_supplier);
                view_kode_supplier.val(data.kode_supplier);
                view_nama_supplier.val(data.nama_supplier);
                view_harga_satuan_dummy.val(rupiah);
                view_harga_satuan.val(data.harga_satuan);
                view_satuan.val(data.satuan);
                view_tanggal_input.text(data.tanggal_input);
                //view_image.attr('data-default-file', "<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                view_image.attr('src', "<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                $('#view_Modal').modal('show');
            }
        });
    }
</script>