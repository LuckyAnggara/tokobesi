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

<!-- Script Cek Kode Satuan yang di Input User -->
<script>
    $('#kode_satuan').on('keyup', function() {
        $.ajax({
            url: '<?= base_url("manajemen_data/mastersatuan/Cek_Kode_Satuan_Input/"); ?>' + $('#kode_satuan').val(),
            success: function(result) {
                if (result == "ada") {
                    $('#inputhelp').text('Kode Satuan Sudah Ada di Database!!')
                    $('#inputhelp').effect("shake")
                    $('#inputhelp').removeClass("text-muted");
                    $('#inputhelp').addClass("text-danger");
                    $('#status').removeClass("text-success fa fa-check");
                    $('#status').addClass("text-danger fa fa-window-close");
                } else {
                    $('#inputhelp').text('Kode Satuan bersifat Unik, tidak bisa sama dengan data lainnya');
                    $('#inputhelp').removeClass("text-danger");
                    $('#inputhelp').addClass("text-muted");
                    $('#status').removeClass("text-danger fa fa-window-close");
                    $('#status').addClass("text-success fa fa-check");
                }
            }
        });
        if ($('#kode_satuan').val() == "") {
            $('#inputhelp').text('Kode Satuan bersifat Unik, tidak bisa sama dengan data lainnya');
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

            $('#inputhelp').text('Kode Satuan bersifat Unik, tidak bisa sama dengan data lainnya');
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
            $("#nav_detail_data_satuan").addClass("active show");
            $("#detail_data_satuan").addClass("active show");
            $("#nav_data_barang").removeClass("active show");
            $("#detail_data_barang").removeClass("active show");
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
        var table = $('#datatable-master-satuan').DataTable({
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "buttons": ['copy', 'excel', 'pdfHtml5', 'print'],
            "dom": 'Bfrtip',
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_data/mastersatuan/getData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "id_satuan",
                    width: 20,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "kode_satuan",
                    width: 75,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_satuan",
                    width: 400,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Action",
                    width: 100,
                    data: "id_satuan",
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
    });
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#submitForm').submit(function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById("submitForm"));
            $.ajax({
                url: "<?= Base_url('manajemen_data/mastersatuan/tambah_data'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-satuan').DataTable().ajax.reload();
                    $('#add_Modal').modal('hide');
                    Swal.fire(
                        'Sukses!',
                        'Data Satuan telah berhasil di tambahkan.',
                        'success'
                    )
                }
            })
        });
    });
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(id_satuan) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(id_satuan);
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(id_satuan) {
        $.ajax({
            url: "<?= base_url('manajemen_data/mastersatuan/delete_data/'); ?>" + id_satuan,
            async: false,
            success: function(data) {
                $('#datatable-master-satuan').DataTable().ajax.reload();
            }
        });
    }
</script>

<!-- Script Edit Data -->
<script type="text/javascript">
    function show_edit_modal(id_satuan) {
        fetchdata_edit_modal(id_satuan);
    }

    function fetchdata_edit_modal(id_satuan) {
        var edit_data_label = $('#edit_data_label');
        var edit_id_satuan = $('#edit_id_satuan');
        var edit_kode_satuan = $('#edit_kode_satuan');
        var edit_nama_satuan = $('#edit_nama_satuan');
        var edit_keterangan = $('#edit_keterangan');
        var edit_tanggal_input = $('#edit_tanggal_input');
        $.ajax({
            url: '<?= base_url("manajemen_data/mastersatuan/view_edit_data/"); ?>' + id_satuan,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                edit_data_label.text("Edit Data Satuan Kode :" + data.kode_satuan);
                edit_id_satuan.val(data.id_satuan);
                edit_kode_satuan.val(data.kode_satuan);
                edit_nama_satuan.val(data.nama_satuan);
                edit_keterangan.val(data.keterangan);
                edit_tanggal_input.text(data.tanggal_input);
                $('#edit_Modal').modal('show');
            }
        });
    }

    // submit edit data
    $(document).ready(function() {

        function warning_edit(id_satuan) {
            swal.fire({
                title: 'Apa anda yakin akan mengubah data ini?',
                text: "Semua Data Satuan ini juga akan terubah",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Ya, Ubah ini!'
            }).then((result) => {
                if (result.value) {
                    editData(id_satuan);
                    swal.fire(
                        'Edited!!!',
                        'Data telah diubah!',
                        'success'
                    )
                }
            });
        }

        function editData(id_satuan) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('manajemen_data/mastersatuan/edit_data/'); ?>" + id_satuan,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-satuan').DataTable().ajax.reload();
                    $('#edit_Modal').modal('hide');
                }
            })

        }
        $('#edit_form').submit(function(e) {
            var id_satuan = $('#edit_id_satuan').val();
            e.preventDefault();
            warning_edit(id_satuan);
        });

    });
</script>

<!-- Script Edit Modal -->
<script type="text/javascript">
    function show_view_modal(id_satuan) {
        viewfetchdata(id_satuan);
    }

    function viewfetchdata(id_satuan) {
        var view_data_label = $('#view_data_label');
        var view_kode_satuan = $('#view_kode_satuan');
        var view_nama_satuan = $('#view_nama_satuan');
        var view_tanggal_input = $('#view_tanggal_input');
        var view_histori_tanggal_input = $('#histori_tanggal_input');
        var view_keterangan = $('#view_keterangan');
        var nav_tabel_data_satuan = $('#nav_tabel_data_satuan');
        $.ajax({
            url: '<?= base_url("manajemen_data/mastersatuan/view_edit_data/"); ?>' + id_satuan,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                view_data_label.text("Edit Data Satuan Kode : " + data.kode_satuan);
                view_kode_satuan.val(data.kode_satuan);
                view_nama_satuan.val(data.nama_satuan);
                view_keterangan.val(data.keterangan);
                view_tanggal_input.text(data.tanggal_input);
                view_histori_tanggal_input.text(data.tanggal_input);
                nav_tabel_data_satuan.text('Daftar Barang Merek ' + data.nama_satuan);
                panggilDaftarTabelSatuan(data.id_satuan);
                $('#view_Modal').modal('show');
            }
        });
    }
</script>

<script>
    function panggilDaftarTabelSatuan(id) {
        var table_satuan = $('#datatable-daftar-master-satuan').DataTable({
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
                "url": '<?= base_url("manajemen_data/mastersatuan/get_Data_Dengan_Satuan/"); ?>' + id,
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