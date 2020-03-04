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



<!-- init table -->
<script type="text/javascript">
    $(document).ready(function() {


        setTanggal()
        var pusher = new Pusher('a198692078b54078587e', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if (data.persediaan === 'update') {
                if ($('#filter_status').text() !== 'Tanggal Tertentu') {
                    init_table();
                }
            }
        });

        init_table();

    });

    function setTanggal() {
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
    }
</script>
<!-- filter -->
<script>
    $('#status').on('change', function() {
        var selectedText = $('#status').find("option:selected").text();

        $('#filter_status').text(selectedText);
        if ($('#status').val() == 1) {
            $('#tanggal_filter').attr('hidden', false);
            setTanggal()
        } else {
            $('#tanggal_filter').attr('hidden', true);
        }
    });

    $('#filter').on('click', function() {
        if ($('#status').val() == 0) {
            init_table();
        } else {

            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();
            var status = $('#status').val();
            init_table(status, tanggal_awal, tanggal_akhir);
        }
    });
</script>

<script>
    function formatSatuan(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

    function init_table(status = 0, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
        var input = {
            status: status,
            tanggal_awal: tanggal_awal,
            tanggal_akhir: tanggal_akhir
        }
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
        var table = $('#datatable-master-persediaan').DataTable({
            "destroy": true,
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
                "url": '<?= base_url("manajemen_persediaan/masterpersediaan/getData"); ?>',
                "type": "POST",
                "data": input,
            },
            "columnDefs": [{
                    data: "kode_barang",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "kode_barang",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_barang",
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "saldo_awal",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return formatSatuan(data.qty_awal.toString());
                    }
                },
                {
                    data: "saldo_masuk",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        if (data.jumlah_pembelian == null) {
                            var jumlah_pembelian = "0";
                        } else {
                            var jumlah_pembelian = data.jumlah_pembelian;
                        }
                        if (data.saldo_retur == null) {
                            var saldo_retur = "0";
                        } else {
                            var saldo_retur = data.saldo_retur;
                        }
                        jumlah = parseInt(jumlah_pembelian) + parseInt(saldo_retur);
                        return formatSatuan(jumlah.toString());
                    }
                },
                {
                    data: "saldo_keluar",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        if (data.jumlah_penjualan == null) {
                            var jumlah_penjualan = "0";
                        } else {
                            var jumlah_penjualan = data.jumlah_penjualan;
                        }
                        if (data.saldo_retur == null) {
                            var saldo_retur = "0";
                        } else {
                            var saldo_retur = data.saldo_retur;
                        }
                        jumlah = parseInt(jumlah_penjualan) + parseInt(saldo_retur);
                        var display = '<span class="text-danger">(' + formatSatuan(jumlah.toString()) + ')</span>'
                        return display
                    }
                },
                {
                    data: "saldo_cart",
                    targets: 6,
                    render: function(data, type, full, meta) {
                        if (data.jumlah_penjualan == null) {
                            data.jumlah_penjualan = "0";
                        }
                        var display = '<span class="text-danger">(' + formatSatuan(data.jumlah_penjualan) + ')</span>'
                        return display
                    }
                },
                {
                    data: "saldo_cart_po",
                    targets: 7,
                    render: function(data, type, full, meta) {
                        if (data.jumlah_penjualan == null) {
                            data.jumlah_penjualan = "0";
                        }
                        var display = '<span class="text-danger">(' + formatSatuan(data.jumlah_penjualan) + ')</span>'
                        return display
                    }
                },
                {
                    data: "saldo_akhir",
                    targets: 8,
                    render: function(data, type, full, meta) {
                        if (data == null) {
                            data = "0";
                        }
                        return formatSatuan(data.toString());
                    }
                },
                {
                    data: "kode_barang",
                    searching: true,
                    targets: 9,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_view_modal(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        return display1;
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
</script>

<!-- modal script -->
<script>
    function show_view_modal(kode_barang) {
        var tanggal_awal = $('#tanggal_awal').val();
        var tanggal_akhir = $('#tanggal_akhir').val();
        $('#awal_modal').text(tanggal_awal);
        $('#akhir_modal').text(tanggal_akhir);
        $('#kode_barang').text(kode_barang);

        $('#view_Modal').modal('show');

        init_table_masuk(kode_barang, tanggal_awal, tanggal_akhir);
        init_table_keluar(kode_barang, tanggal_awal, tanggal_akhir);
        init_table_cart(kode_barang, tanggal_awal, tanggal_akhir);
        init_table_cartPo(kode_barang, tanggal_awal, tanggal_akhir);
    }

    function init_table_masuk(kode_barang = 0, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
        var input = {
            kode_barang: kode_barang,
            tanggal_awal: tanggal_awal,
            tanggal_akhir: tanggal_akhir
        }
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
        var table = $('#datatable-saldo-awal').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_persediaan/masterpersediaan/getDataMasuk"); ?>',
                "type": "POST",
                "data": input,
            },
            "columnDefs": [{
                    data: "id",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "tanggal_transaksi",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
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
                    data: "jumlah_pembelian",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return formatSatuan(data.toString());
                    }
                },
                {
                    data: "harga_beli",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data.toString(), 'Rp.');
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

    function init_table_keluar(kode_barang = 0, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
        var input = {
            kode_barang: kode_barang,
            tanggal_awal: tanggal_awal,
            tanggal_akhir: tanggal_akhir
        }
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
        var table = $('#datatable-saldo-akhir').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_persediaan/masterpersediaan/getDataKeluar"); ?>',
                "type": "POST",
                "data": input,
            },
            "columnDefs": [{
                    data: "id",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "tanggal_transaksi",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
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
                    data: "jumlah_penjualan",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return formatSatuan(data.toString());
                    }
                },
                {
                    data: "harga_jual",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data.toString(), 'Rp.');
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

    function init_table_cart(kode_barang = 0, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
        var input = {
            kode_barang: kode_barang,
            tanggal_awal: tanggal_awal,
            tanggal_akhir: tanggal_akhir
        }
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
        var table = $('#datatable-saldo-cart').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_persediaan/masterpersediaan/getDataCart"); ?>',
                "type": "POST",
                "data": input,
            },
            "columnDefs": [{
                    data: "id",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "tanggal_transaksi",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "no_order_penjualan",
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "jumlah_penjualan",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return formatSatuan(data.toString());
                    }
                },
                {
                    data: "nama",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return formatSatuan(data.toString());
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

    function init_table_cartPo(kode_barang = 0, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
        var input = {
            kode_barang: kode_barang,
            tanggal_awal: tanggal_awal,
            tanggal_akhir: tanggal_akhir
        }
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
        var table = $('#datatable-saldo-cartPo').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_persediaan/masterpersediaan/getDataCartPo"); ?>',
                "type": "POST",
                "data": input,
            },
            "columnDefs": [{
                    data: "id",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "tanggal_input",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "no_order",
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "jumlah_penjualan",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return formatSatuan(data.toString());
                    }
                },
                {
                    data: "nama",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return data;
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
</script>