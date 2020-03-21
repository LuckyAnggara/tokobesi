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
<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Input Mask Js dan Max Length-->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>




<!-- script init -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tanggal_awal').datepicker({
            autoclose: true,
            todayHighlight: true,
            constrainInput: false,

        });
        $('#tanggal_awal').datepicker("setDate", "01-01-" + new Date().getFullYear());
        $('#tanggal_akhir').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('#tanggal_akhir').datepicker("setDate", "12-31-" + new Date().getFullYear());
    });
</script>


<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {
        destroy: true,
        init_table();

        function init_table(tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
            var input = {
                tanggal_awal: tanggal_awal,
                tanggal_akhir: tanggal_akhir
            }

            console.log(input)
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
            var role = "<?php echo $this->session->userdata('role'); ?>";
            if (role == "1" || role == "2") {
                var visible = true
            } else {
                var visible = false
            }
            var table = $('#datatable-daftar-retur-penjualan').DataTable({
                destroy: true,
                paging: true,
                "oLanguage": {
                    sProcessing: "Sabar yah...",
                    sZeroRecords: "Tidak ada Data..."
                },
                "buttons": ['copy', 'excel', 'pdf', 'print'],
                dom: 'Bfrtip',
                "searching": true,
                "fixedColumns": true,
                "processing": true,
                "serverSide": false,
                "ordering": false,
                "ajax": {
                    "url": '<?= base_url("manajemen_penjualan/returpenjualan/getDataRetur/"); ?>',
                    "data": input,
                    "type": "POST",
                },
                "columnDefs": [{
                        data: "nomor_faktur",
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "tanggal",
                        targets: 1,
                        render: function(data, type, full, meta) {
                            var date = new Date(data);
                            date = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                            return date;
                        }
                    },
                    {
                        data: "nomor_faktur",
                        targets: 2,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "nama_pelanggan",
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    }, {
                        data: "retur_total",
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data.toString(), 'Rp.');
                            return display;
                        }
                    }, {
                        data: "retur_diskon",
                        targets: 5,
                        render: function(data, type, full, meta) {
                            var display = '<span class="text-danger">' + formatRupiah(data.toString(), 'Rp.') + '</span>'
                            return display;
                        }
                    }, {
                        data: "retur_pajak",
                        targets: 6,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data.toString(), 'Rp.');
                            return display;
                        }
                    },
                    {
                        data: "retur_grand_total",
                        targets: 7,
                        render: function(data, type, full, meta) {
                            var display = '<b>' + formatRupiah(data.toString(), 'Rp.'); + '</b>'
                            return display;
                        }
                    },
                    {

                        data: "nama_pegawai",
                        targets: 8,
                        visible: visible,
                        render: function(data, type, full, meta) {
                            return data
                        }
                    },
                    {
                        data: {
                            "nomor_faktur": "nomor_faktur",
                            "user": "user"
                        },
                        targets: 9,
                        render: function(data, type, full, meta) {
                            var user = "<?php echo $this->session->userdata('username'); ?>";
                            var detail = '<a type="button" onClick = "view_faktur(\'' + data.nomor_faktur + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Detail"><i class="fa fa-search" ></i> </a>';
                            var del = '<a type="button" onClick = "warning_delete(\'' + data.nomor_faktur + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';

                            if (data.user == user) {
                                return detail;
                            } else {
                                return detail;
                            }
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


        $('#filter').on('click', function() {
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();
            init_table(tanggal_awal, tanggal_akhir);
        });
    });
</script>


<!-- Script Filter -->

<script>
    function view_faktur(nomor_faktur) {
        window.location.href = "<?= base_url('manajemen_penjualan/returpenjualan/faktur/'); ?>" + nomor_faktur;
    }
</script>
<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(nomor_faktur) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Menghapus data ini akan mempengaruhi pendapatan !!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(nomor_faktur);
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(nomor_faktur) {
        $.ajax({
            url: "<?= base_url('manajemen_penjualan/returpenjualan/delete_faktur/'); ?>",
            type: "post",
            data: {
                nomor_faktur: nomor_faktur
            },
            async: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                $('#datatable-daftar-retur-penjualan').DataTable().ajax.reload();
            }
        });
    }
</script>