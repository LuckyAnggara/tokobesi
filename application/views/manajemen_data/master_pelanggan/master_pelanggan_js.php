<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

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
        $('.tipe_pelanggan').select2({
            placeholder: 'Tipe Pelanggan',
            minimumResultsForSearch: Infinity,
            data: [
            {
                "id": "general",
                "text": "General Costumer"
            },
            {
                "id": "rekanan",
                "text": "Rekanan"
            }
            ],
        });

        $('#generate_id').on('click', function()
        {
            console.log('aw');
            var id_pelanggan = $('#edit_id_pelanggan');
            $.ajax({
                url: '<?= base_url("Manajemen_Data/MasterPelanggan/generate_id_pelanggan/"); ?>',
                success: function(result) {
                    id_pelanggan.val(result);
                }
            });
        })

    });
</script>
<!-- Script Auto Generate Kode Barang -->

<script>
    var nama_pelanggan = $('#nama_pelanggan');
    var id_pelanggan = $('#id_pelanggan');
    nama_pelanggan.focusout(function() {
        $.ajax({
            url: '<?= base_url("Manajemen_Data/MasterPelanggan/generate_id_pelanggan/"); ?>',
            success: function(result) {
                id_pelanggan.val(result);
            }
        });
    });

</script>

<!-- script format NPWP -->

<script>
    jQuery(document).ready(function() {
        $('input#npwp').maxlength({
            warningClass: "badge badge-success",
            limitReachedClass: "badge badge-danger"
        });
    })
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
        destroy : true,
        
        init_table();
        function init_table(input = "")
        {
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
            var table = $('#datatable-master-pelanggan').DataTable({
                    destroy : true,
                    paging: true,
                    "oLanguage": {
                        sProcessing: "Sabar yah...",
                        sZeroRecords: "Tidak ada Data..."
                    },
                    "searching": false,
                    "processing": true,
                    "serverSide": false,    
                    "ajax": {
                        "url": '<?= base_url("Manajemen_Data/MasterPelanggan/getData/"); ?>' + input,
                        "type": "POST",
                    },
                    "columnDefs": [{
                            data: "id_pelanggan",
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            data: "id_pelanggan",
                            targets: 1,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            data: "nama_pelanggan",
                            targets: 2,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            data: "nomor_telepon",
                            targets: 3,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            data: "id_pelanggan",
                            targets: 4,
                            render: function(data, type, full, meta) {
                                var display1 = '<a type="button" onClick = "show_view_modal(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                                var display2 = '<a type="button" onClick = "show_edit_modal(\'' + data + '\')"" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Edit Data"><i class="fa fa-edit" ></i> </a>';
                                var display3 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                                return display1 + " " + display2 + " " + display3;
                            }
                        }
                    ],
                    "deferRender": true,
                    "rowCallback": function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
        }

        $('#searchInput').on('keypress', function(e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                // $('#datatable-master-pelanggan').DataTable().destroy();
                var input = $('#searchInput').val();
                init_table(input);
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
                url: "<?= Base_url('Manajemen_Data/MasterPelanggan/tambah_data'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-pelanggan').DataTable().ajax.reload();
                    $('#add_Modal').modal('hide');
                    Swal.fire(
                        'Sukses!',
                        'Gambar telah di Upload.',
                        'success'
                    );

                }
            })
        });
    });
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(id_pelanggan) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Semua Data Pelanggan dengan kode " + id_pelanggan + " juga akan terhapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(id_pelanggan);
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(id_pelanggan) {
        $.ajax({
            url: "<?= base_url('Manajemen_Data/MasterPelanggan/delete_data/'); ?>" + id_pelanggan,
            async: false,
            success: function(data) {
                $('#datatable-master-pelanggan').DataTable().ajax.reload();
            }
        });
    }
</script>

<!-- Script Edit Data -->
<script type="text/javascript">
    function show_edit_modal(id_pelanggan) {
        fetchdata_edit_modal(id_pelanggan);
    }

    function fetchdata_edit_modal(id_pelanggan) {
        var edit_data_label = $('#edit_data_label');
        var edit_id_pelanggan = $('#edit_id_pelanggan');
        var dummy_edit_id_pelanggan = $('#dummy_edit_id_pelanggan');
        var edit_tipe_pelanggan = $('#edit_tipe_pelanggan');
        var edit_nama_pelanggan = $('#edit_nama_pelanggan');
        var edit_alamat = $('#edit_alamat');
        var edit_nomor_telepon = $('#edit_nomor_telepon');
        var edit_npwp = $('#edit_npwp');
        var edit_bank_rekening = $('#edit_bank_rekening');
        var edit_nomor_rekening = $('#edit_nomor_rekening');
        var edit_nama_rekening = $('#edit_nama_rekening');
        var edit_keterangan = $('#edit_keterangan');
        var edit_tanggal_input = $('#edit_tanggal_input');
        $.ajax({
            url: '<?= base_url("Manajemen_Data/MasterPelanggan/view_edit_data/"); ?>' + id_pelanggan,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                // split rekening
                var bank = data.nomor_rekening.split("-");
                // set data ke view
                edit_data_label.text("Edit Data Pelanggan Kode :" + data.id_pelanggan);
                edit_id_pelanggan.val(data.id_pelanggan);
                dummy_edit_id_pelanggan.val(data.id_pelanggan);
                edit_tipe_pelanggan.val(data.tipe_pelanggan);
                edit_nama_pelanggan.val(data.nama_pelanggan);
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
        function warning_edit(id_pelanggan) {
            swal.fire({
                title: 'Apa anda yakin akan mengubah data ini?',
                text: "Semua Data Pelanggan dengan kode " + id_pelanggan + " juga akan terubah",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Ya, Ubah ini!'
            }).then((result) => {
                if (result.value) {
                    editData(id_pelanggan);
                    swal.fire(
                        'Edited!!!',
                        'Data ' + id_pelanggan + ' telah diubah!',
                        'success'
                    )
                }
            });
        }

        function editData(id_pelanggan) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('Manajemen_Data/MasterPelanggan/edit_data/'); ?>" + id_pelanggan,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-pelanggan').DataTable().ajax.reload();
                    $('#edit_Modal').modal('hide');
                }
            })

        }
        $('#edit_form').submit(function(e) {
            var id_pelanggan = $('#dummy_edit_id_pelanggan').val();
            e.preventDefault();
            warning_edit(id_pelanggan);
        });

    });
</script>

<!-- Script Edit Modal -->
<script type="text/javascript">
    function show_view_modal(id_pelanggan) {
        viewfetchdata(id_pelanggan);
    }

    function viewfetchdata(id_pelanggan) {
        var view_data_label = $('#view_data_label');
        var view_id_pelanggan = $('#view_id_pelanggan');
        var view_nama_pelanggan = $('#view_nama_pelanggan');
        var view_tipe_pelanggan = $('#view_tipe_pelanggan');
        var view_alamat = $('#view_alamat');
        var view_nomor_telepon = $('#view_nomor_telepon');
        var view_npwp = $('#view_npwp');
        var view_bank_rekening = $('#view_bank_rekening');
        var view_keterangan = $('#view_keterangan');
        var view_tanggal_input = $('#view_tanggal_input');
        var histori_tanggal_input = $('#histori_tanggal_input');
        $.ajax({
            url: '<?= base_url("Manajemen_Data/MasterPelanggan/view_edit_data/"); ?>' + id_pelanggan,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                view_data_label.text("Edit Data Pelanggan Kode : " + data.id_pelanggan);
                view_id_pelanggan.val(data.id_pelanggan);
                view_tipe_pelanggan.val(data.tipe_pelanggan);
                view_nama_pelanggan.val(data.nama_pelanggan);
                view_alamat.val(data.alamat);
                view_nomor_telepon.val(data.nomor_telepon);
                view_npwp.val(data.npwp);
                view_bank_rekening.val(data.nomor_rekening);
                view_keterangan.val(data.keterangan);
                view_tanggal_input.text(data.tanggal_input);
                histori_tanggal_input.text(data.tanggal_input);
                $('#view_Modal').modal('show');
            }
        });
    }
</script>