<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/buttons.print.min.js"></script>
<!-- shake effect -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chartjs/chart.bundle.min.js"></script>
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
    $('#kode_kategori_biaya').on('keyup', function() {
        $.ajax({
            url: '<?= base_url("manajemen_data/masterkategoribiaya/Cek_Kode_kategori_biaya_Input/"); ?>' + $('#kode_kategori_biaya').val(),
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
        if ($('#kode_kategori_biaya').val() == "") {
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
        $('#add_modal').on('hidden.bs.modal', function(e) {
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
            $("#nav_detail_data_kategori_biaya").addClass("active show");
            $("#detail_data_kategori_biaya").addClass("active show");
            $("#nav_tabel_data_kategori_biaya").removeClass("active show");
            $("#tabel_data_kategori_biaya").removeClass("active show");
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
        var table = $('#datatable-master-kategori_biaya').DataTable({
            destroy: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "fixedColumns": true,
            "lengthChange": true,
            "searching": true,
            "buttons": ['copy', 'excel', 'pdfHtml5', 'print'],
            "dom": 'Bfrtip',
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_data/masterkategoribiaya/getData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "id",
                    width: 20,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },{
                    data: "nama_biaya",
                    width: 100,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "keterangan",
                    width: 300,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "status",
                    width: 50,
                    targets: 3,
                    render: function(data, type, full, meta) {
                            if (data == 0) {
                                var display = '<span class="badge badge-primary">Aktif</span>';
                            } else {
                                var display = '<span class="badge badge-danger">Tidak Aktif</span>';;
                            }
                            return display;
                    }
                },
                {
                    data: {"id" : "id","status":"status"},
                    width: 50,
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var edit = '<a type="button" onClick = "show_edit_modal(\'' + data.id + '\')"" data-button="' + data.id + '" class="btn btn-icon waves-effect waves-light btn-primary btn-sm"><i class="fa fa-edit" ></i> </a>';
                        var del = '<a type="button" onClick = "warning_delete(\'' + data.id + '\')" data-button="' + data.id + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-trash" ></i> </a>';
                        if(data.status == 1)
                        {
                            return ""
                        }else{
                            return edit + " " + del;
                        }
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
    });
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#submitForm').submit(function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById("submitForm"));
            $.ajax({
                url: "<?= Base_url('manajemen_data/masterkategoribiaya/tambah_data'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-kategori_biaya').DataTable().ajax.reload();
                    $('#add_modal').modal('hide');
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
    function warning_delete(id) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "Status data akan di ubah!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                deleteData(id);
                swal.fire(
                    'Changed!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(id) {
        $.ajax({
            url: "<?= base_url('manajemen_data/masterkategoribiaya/delete_data/'); ?>" + id,
            async: false,
            success: function(data) {
                $('#datatable-master-kategori_biaya').DataTable().ajax.reload();
            }
        });
    }
</script>

<!-- Script Edit Data -->
<script type="text/javascript">
    function show_edit_modal(id) {
        fetchdata_edit_modal(id);
    }

    function fetchdata_edit_modal(id) {
        var edit_data_label = $('#edit_data_label');
        var edit_id = $('#edit_id');
        var edit_kode_kategori_biaya = $('#edit_kode_kategori_biaya');
        var edit_nama_biaya = $('#edit_nama_biaya');
        var edit_keterangan = $('#edit_keterangan');
        var edit_tanggal_input = $('#edit_tanggal_input');
        $.ajax({
            url: '<?= base_url("manajemen_data/masterkategoribiaya/view_edit_data/"); ?>' + id,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                edit_data_label.text("Edit Data");
                edit_id.text(data.id);
                edit_nama_biaya.val(data.nama_biaya);
                edit_keterangan.val(data.keterangan);
                edit_tanggal_input.text(data.tanggal_input);
                $('#edit_Modal').modal('show');
            }
        });
    }

    // submit edit data
    $(document).ready(function() {

        function warning_edit(id) {
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
                    editData(id);
                    swal.fire(
                        'Edited!!!',
                        'Data telah diubah!',
                        'success'
                    )
                }
            });
        }

        function editData(id) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('manajemen_data/masterkategoribiaya/edit_data/'); ?>" + id,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-kategori_biaya').DataTable().ajax.reload();
                    $('#edit_Modal').modal('hide');
                }
            })

        }
        $('#edit_form').submit(function(e) {
            var id = $('#edit_id').text();
            e.preventDefault();
            warning_edit(id);
        });

    });
</script>

<script>
    function panggilDaftarTabelJenisBarang(id) {
        var table_satuan = $('#datatable-daftar-master-jenis-barang').DataTable({
            destroy: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "fixedColumns": true,
            "lengthChange": true,
            "searching": true,
            "buttons": ['copy', 'excel', 'pdfHtml5', 'print'],
            "dom": 'Bfrtip',
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_data/masterkategoribiaya/get_Data_Dengan_kategori_biaya/"); ?>' + id,
                "type": "POST",
            },
            "columnDefs": [{
                    data: "kode_barang",
                    width: 100,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_barang",
                    width: 300,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }
            ],
        });
    }
</script>