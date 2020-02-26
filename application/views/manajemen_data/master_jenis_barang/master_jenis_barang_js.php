<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- shake effect -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.bundle.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Input Mask Js dan Max Length-->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<!-- script validasi -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#submitForm').parsley();
    });
</script>

<!-- Script Cek Kode Jenis Barang yang di Input User -->
<script>
    $('#kode_jenis_barang').on('keyup', function() {
        $.ajax({
            url: '<?= base_url("manajemen_data/masterjenisbarang/Cek_Kode_Jenis_Barang_Input/"); ?>' + $('#kode_jenis_barang').val(),
            success: function(result) {
                if (result == "ada") {
                    $('#inputhelp').text('Kode Jenis Barang Sudah Ada di Database!!')
                    $('#inputhelp').effect("shake")
                    $('#inputhelp').removeClass("text-muted");
                    $('#inputhelp').addClass("text-danger");
                    $('#status').removeClass("text-success fa fa-check");
                    $('#status').addClass("text-danger fa fa-window-close");
                } else {
                    $('#inputhelp').text('Kode Jenis Barang bersifat Unik, tidak bisa sama dengan data lainnya');
                    $('#inputhelp').removeClass("text-danger");
                    $('#inputhelp').addClass("text-muted");
                    $('#status').removeClass("text-danger fa fa-window-close");
                    $('#status').addClass("text-success fa fa-check");
                }
            }
        });
        if ($('#kode_jenis_barang').val() == "") {
            $('#inputhelp').text('Kode Jenis Barang bersifat Unik, tidak bisa sama dengan data lainnya');
            $('#inputhelp').removeClass("text-danger");
            $('#inputhelp').addClass("text-muted");
            $('#status').removeClass("text-danger fa fa-window-close");
            $('#status').removeClass("text-success fa fa-check");
        }

    });
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

            $('#inputhelp').text('Kode Jenis Barang bersifat Unik, tidak bisa sama dengan data lainnya');
            $('#inputhelp').removeClass("text-danger");
            $('#inputhelp').addClass("text-muted");
            $('#status').removeClass("text-danger fa fa-window-close");
            $('#status').removeClass("text-success fa fa-check");
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
            $("#nav_detail_data_jenis_barang").addClass("active show");
            $("#detail_data_jenis_barang").addClass("active show");
            $("#nav_tabel_data_jenis_barang").removeClass("active show");
            $("#tabel_data_jenis_barang").removeClass("active show");
            $('#datatable-daftar-master-jenis-barang').DataTable().destroy();
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
        var table = $('#datatable-master-jenis_barang').DataTable({
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": false,
            "order": [],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url("manajemen_data/masterjenisbarang/getData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    title: "No",
                    data: "id_jenis_barang",
                    searching: true,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Kode Jenis Barang",
                    data: "kode_jenis_barang",
                    searching: true,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Nama Jenis Barang",
                    data: "nama_jenis_barang",
                    searching: true,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Action",
                    data: "id_jenis_barang",
                    searching: true,
                    targets: 3,
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
                $('#datatable-master-jenis_barang').DataTable().destroy();
                var input = $('#searchInput').val();
                var table = $('#datatable-master-jenis_barang').DataTable({
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
                        "url": '<?= base_url("manajemen_data/masterjenisbarang/getData/"); ?>' + input,
                        "type": "POST",
                    },
                    "columnDefs": [{
                            title: "No",
                            data: "id",
                            searching: true,
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Kode Jenis Barang",
                            data: "kode_jenis_barang",
                            searching: true,
                            targets: 1,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Nama Jenis Barang",
                            data: "nama_jenis_barang",
                            searching: true,
                            targets: 2,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Action",
                            data: "id_jenis_barang",
                            searching: true,
                            targets: 3,
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
                url: "<?= Base_url('manajemen_data/masterjenisbarang/tambah_data'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-jenis_barang').DataTable().ajax.reload();
                    $('#add_Modal').modal('hide');
                    Swal.fire(
                        'Sukses!',
                        'Data Jenis Barang telah berhasil di tambahkan.',
                        'success'
                    )
                }
            })
        });
    });
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(id_jenis_barang) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Semua Data Persediaan dengan kode " + id_jenis_barang + " juga akan terhapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(id_jenis_barang);
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(id_jenis_barang) {
        $.ajax({
            url: "<?= base_url('manajemen_data/masterjenisbarang/delete_data/'); ?>" + id_jenis_barang,
            async: false,
            success: function(data) {
                $('#datatable-master-jenis_barang').DataTable().ajax.reload();
            }
        });
    }
</script>

<!-- Script Edit Data -->
<script type="text/javascript">
    function show_edit_modal(id_jenis_barang) {
        fetchdata_edit_modal(id_jenis_barang);
    }

    function fetchdata_edit_modal(id_jenis_barang) {
        var edit_data_label = $('#edit_data_label');
        var edit_id_jenis_barang = $('#edit_id_jenis_barang');
        var edit_kode_jenis_barang = $('#edit_kode_jenis_barang');
        var edit_nama_jenis_barang = $('#edit_nama_jenis_barang');
        var edit_keterangan = $('#edit_keterangan');
        var edit_tanggal_input = $('#edit_tanggal_input');
        $.ajax({
            url: '<?= base_url("manajemen_data/masterjenisbarang/view_edit_data/"); ?>' + id_jenis_barang,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                edit_data_label.text("Edit Data Jenis Barang Kode :" + data.kode_jenis_barang);
                edit_id_jenis_barang.val(data.id_jenis_barang);
                edit_kode_jenis_barang.val(data.kode_jenis_barang);
                edit_nama_jenis_barang.val(data.nama_jenis_barang);
                edit_keterangan.val(data.keterangan);
                edit_tanggal_input.text(data.tanggal_input);
                $('#edit_Modal').modal('show');
            }
        });
    }

    // submit edit data
    $(document).ready(function() {

        function warning_edit(id_jenis_barang) {
            swal.fire({
                title: 'Apa anda yakin akan mengubah data ini?',
                text: "Semua Data Jenis Barang ini juga akan terubah",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Ya, Ubah ini!'
            }).then((result) => {
                if (result.value) {
                    editData(id_jenis_barang);
                    swal.fire(
                        'Edited!!!',
                        'Data telah diubah!',
                        'success'
                    )
                }
            });
        }

        function editData(id_jenis_barang) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('manajemen_data/masterjenisbarang/edit_data/'); ?>" + id_jenis_barang,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-jenis_barang').DataTable().ajax.reload();
                    $('#edit_Modal').modal('hide');
                }
            })

        }
        $('#edit_form').submit(function(e) {
            var id_jenis_barang = $('#edit_id_jenis_barang').val();
            e.preventDefault();
            warning_edit(id_jenis_barang);
        });

    });
</script>

<!-- Script Edit Modal -->
<script type="text/javascript">
    function show_view_modal(id_jenis_barang) {
        viewfetchdata(id_jenis_barang);
    }

    function viewfetchdata(id_jenis_barang) {
        var view_data_label = $('#view_data_label');
        var view_kode_jenis_barang = $('#view_kode_jenis_barang');
        var view_nama_jenis_barang = $('#view_nama_jenis_barang');
        var view_tanggal_input = $('#view_tanggal_input');
        var view_histori_tanggal_input = $('#histori_tanggal_input');
        var view_keterangan = $('#view_keterangan');
        var nav_tabel_data_jenis_barang = $('#nav_tabel_data_jenis_barang');
        $.ajax({
            url: '<?= base_url("manajemen_data/masterjenisbarang/view_edit_data/"); ?>' + id_jenis_barang,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                view_data_label.text("Edit Data Jenis Barang Kode : " + data.kode_jenis_barang);
                view_kode_jenis_barang.val(data.kode_jenis_barang);
                view_nama_jenis_barang.val(data.nama_jenis_barang);
                view_keterangan.val(data.keterangan);
                view_tanggal_input.text(data.tanggal_input);
                view_histori_tanggal_input.text(data.tanggal_input);
                nav_tabel_data_jenis_barang.text('Daftar Barang Jenis ' + data.nama_jenis_barang);
                panggilDaftarTabelJenisBarang(data.id_jenis_barang);
                $('#view_Modal').modal('show');
            }
        });
    }
</script>

<script>
    function panggilDaftarTabelJenisBarang(id) {
        var table_satuan = $('#datatable-daftar-master-jenis-barang').DataTable({
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url("manajemen_data/masterjenisbarang/get_Data_Dengan_Jenis_Barang/"); ?>' + id,
                "type": "POST",
            },
            "columnDefs": [{
                    title: "Kode Barang",
                    data: "kode_barang",
                    searching: true,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Nama Barang",
                    data: "nama_barang",
                    searching: true,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }
            ],
        });
    }
</script>