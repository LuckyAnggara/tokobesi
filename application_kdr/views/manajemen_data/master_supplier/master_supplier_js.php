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

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chartjs/chart.bundle.min.js"></script>

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
<!-- Script Auto Generate Kode Barang -->

<script>
    var nama_supplier = $('#nama_supplier');
    var kode_supplier = $('#kode_supplier');
    nama_supplier.focusout(function() {
        $.ajax({
            url: '<?= base_url("manajemen_data/mastersupplier/generate_kode_supplier/"); ?>',
            success: function(result) {
                kode_supplier.val(result);
                console.log(result);
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
            $("#nav_histori").removeClass("active show");
            $("#histori").removeClass("active show");
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
            "buttons": ['copy', 'excel', 'pdfHtml5', 'print'],
            "dom": 'Bfrtip',
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_data/mastersupplier/getData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "kode_supplier",
                    width: 20,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "kode_supplier",
                    width: 75,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_supplier",
                    width: 325,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nomor_telepon",
                    width: 75,
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "kode_supplier",
                    width: 100,
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

    });
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#submitForm').submit(function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById("submitForm"));
            $.ajax({
                url: "<?= Base_url('manajemen_data/mastersupplier/tambah_data'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-supplier').DataTable().ajax.reload();
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
    function warning_delete(kode_supplier) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Semua Data Persediaan dengan kode " + kode_supplier + " juga akan terhapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(kode_supplier);
                swal.fire(
                    'Deleted!',
                    'Data ' + kode_supplier + ' telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(kode_supplier) {
        $.ajax({
            url: "<?= base_url('manajemen_data/mastersupplier/delete_data/'); ?>" + kode_supplier,
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
        fetchdata_edit_modal(kode_supplier);
    }

    function fetchdata_edit_modal(kode_supplier) {
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
            url: '<?= base_url("manajemen_data/mastersupplier/view_edit_data/"); ?>' + kode_supplier,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                // split rekening
                var bank = data.nomor_rekening.split("-");
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
            swal.fire({
                title: 'Apa anda yakin akan mengubah data ini?',
                text: "Semua Data Supplier dengan kode " + kode_supplier + " juga akan terubah",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Ya, Ubah ini!'
            }).then((result) => {
                if (result.value) {
                    editData(kode_supplier);
                    swal.fire(
                        'Edited!!!',
                        'Data ' + kode_supplier + ' telah diubah!',
                        'success'
                    )
                }
            });
        }

        function editData(kode_supplier) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('manajemen_data/mastersupplier/edit_data/'); ?>" + kode_supplier,
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
        var view_alamat = $('#view_alamat');
        var view_nomor_telepon = $('#view_nomor_telepon');
        var view_npwp = $('#view_npwp');
        var view_bank_rekening = $('#view_bank_rekening');
        var view_keterangan = $('#view_keterangan');
        var view_tanggal_input = $('#view_tanggal_input');
        var histori_tanggal_input = $('#histori_tanggal_input');
        $.ajax({
            url: '<?= base_url("manajemen_data/mastersupplier/view_edit_data/"); ?>' + kode_supplier,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                view_data_label.text("Edit Data Supplier Kode :" + data.kode_supplier);
                view_kode_supplier.val(data.kode_supplier);
                view_nama_supplier.val(data.nama_supplier);
                view_alamat.val(data.alamat);
                view_nomor_telepon.val(data.nomor_telepon);
                view_npwp.val(data.npwp);
                view_bank_rekening.val(data.nomor_rekening);
                view_keterangan.val(data.keterangan);
                view_tanggal_input.text(data.tanggal_input);
                histori_tanggal_input.text(data.tanggal_input);
                panggildaftarpembelian(data.kode_supplier);
                $('#view_Modal').modal('show');
            }
        });
    }
</script>

<script>
    function panggildaftarpembelian(kode_supplier) {
        var table_satuan = $('#datatable-master-supplier-history').DataTable({
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
                "url": '<?= base_url("manajemen_data/mastersupplier/getDataPembelian/"); ?>',
                "type": "POST",
                "data": {
                    kode_supplier: kode_supplier
                }
            },
            "columnDefs": [{
                    data: "nomor_transaksi",
                    width: 20,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nomor_transaksi",
                    width: 100,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "total_pembelian",
                    width: 100,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');
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

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>