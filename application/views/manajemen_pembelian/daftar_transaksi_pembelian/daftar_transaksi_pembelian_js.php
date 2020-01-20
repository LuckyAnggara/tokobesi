<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

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

        function init_table(status_bayar = null, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
            var input = {
                status_bayar: status_bayar,
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
            var table = $('#datatable-daftar-pembelian').DataTable({
                destroy: true,
                paging: true,
                "oLanguage": {
                    sProcessing: "Sabar yah...",
                    sZeroRecords: "Tidak ada Data..."
                },
                "searching": true,
                "processing": true,
                "serverSide": false,
                "ordering": false,
                "ajax": {
                    "url": '<?= base_url("Manajemen_Pembelian/DaftarTransaksiPembelian/getData/"); ?>',
                    "data": input,
                    "type": "POST",
                },
                "columnDefs": [{
                        data: "nomor_transaksi",
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "tanggal_transaksi",
                        targets: 1,
                        render: function(data, type, full, meta) {
                            var date = new Date(data);
                            date = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                            return date;
                        }
                    },
                    {
                        data: "nomor_transaksi",
                        targets: 2,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "nama_supplier",
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "grand_total",
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data.toString(), 'Rp.');
                            return display;
                        }
                    },
                    {
                        data: "kredit",
                        targets: 5,
                        render: function(data, type, full, meta) {
                            var date = new Date(data.tanggal_jatuh_tempo);
                            date = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                            if (data !== "") {
                                var display =
                                    '<div class="btn-group">' +
                                    '<span class="badge badge-danger dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Belum Lunas <span class="caret"></span></span>' +
                                    '<div class="dropdown-menu">' +
                                    '<a class="dropdown-item"><b><u>Jatuh Tempo</u></b></a>' +
                                    '<a class="dropdown-item">' + date + '</a>' +
                                    '<a class="dropdown-item"><b><u>Sisa</u></b></a>' +
                                    '<a class="dropdown-item">' + formatRupiah(data.sisa_pembayaran.toString(), 'Rp.') + '</a>' +
                                    '</div></div>'
                            } else {
                                var display = '<span class="badge badge-success">Lunas</span>'
                            }
                            return display;
                        }
                    },
                    {
                        data: "nomor_transaksi",
                        targets: 6,
                        render: function(data, type, full, meta) {
                            var display1 = '<a type="button" onClick = "view_detail(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Detail"><i class="fa fa-search" ></i> </a>';
                            var display2 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                            return display1;
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
            var status_bayar = $('#status_bayar').val();
            init_table(status_bayar, tanggal_awal, tanggal_akhir);
        });
    });
</script>


<!-- Script Filter -->

<script>
    function view_detail(nomor_transaksi) {
        window.location.href = "<?= base_url('Manajemen_Pembelian/DetailTransaksiPembelian/Nomor_Transaksi/'); ?>" + nomor_transaksi;
    }
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
            url: "<?= base_url('Manajemen_Pembelian/DaftarTransaksiPembelian/delete_data/'); ?>" + id_pelanggan,
            async: false,
            success: function(data) {
                $('#datatable-master-pelanggan').DataTable().ajax.reload();
            }
        });
    }
</script>