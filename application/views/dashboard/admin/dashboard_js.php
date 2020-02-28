<script src="<?= base_url('assets/'); ?>plugins/counterup/waypoint.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/counterup/jquery.counterup.min.js"></script>
<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Pusher Notif Sendiri -->
<script src="<?= base_url('assets/'); ?>js/pusher.notif.js"></script>

<!-- CHART.js -->
<script src="<?= base_url('assets/'); ?>plugins/chartjs/chart.bundle.min.js"></script>


<!-- SCRIPT DASHBOARD AWAL -->
<script>
    $(document).ready(function() {

        initTableLatestOrder();
        init_table()
    })


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

    function formatSatuan(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatDate(date) {
        var date = new Date(date);
        var monthNames = [
            "Jan", "Feb", "Mar",
            "Apr", "Mei", "Jun", "Jul",
            "Ags", "Sept", "Okt",
            "Nov", "Des"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }

    function counterJalan() {
        $('.counter').counterUp();
        $('.counterRupiah').counterUp({
            time: 1000,
            offset: 70,
            formatter: function(n) {
                return formatRupiah(n, 'Rp.');
            }
        });
        $('.counterTrend').counterUp({
            time: 1000,
            offset: 70,
            beginAt: 100,
            formatter: function(n) {
                return n + '%' + trend(n);
            }
        });
        $('.counterSatuan').counterUp({
            time: 1000,
            offset: 70,
            beginAt: 100,
            formatter: function(n) {
                return formatSatuan(n);
            }
        });
    }
</script>

<!-- SCRIPT LATEST ORDER PENJUALAN -->

<script>
    function initTableLatestOrder() {
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
        var table = $('#table-pembelian-terakhir').DataTable({
            destroy: true,
            scrollY: '50vh',
            scrollCollapse: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "bInfo": false,
            "paging": false,
            "searching": false,
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "ajax": {
                "url": '<?= base_url("dashboard/data_pembelian_terakhir/"); ?>',
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
                    data: "total_pembelian",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        var display = formatRupiah(data, 'Rp.')
                        return display;
                    }
                },
                {
                    data: "kredit",
                    targets: 4,
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
                                '<a class="dropdown-item">' + formatRupiah(data.sisa_utang.toString(), 'Rp.') + '</a>' +
                                '</div></div>'
                        } else {
                            var display = '<span class="badge badge-success">Lunas</span>'
                        }
                        return display;
                    }
                },
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

    function init_table(status = null, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
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
        var role = "<?php echo $this->session->userdata('role'); ?>";
        if (role == "Direktur") {
            var visible = true
        } else {
            var visible = false
        }
        var table = $('#table-po-sales').DataTable({
            destroy: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            scrollY: '50vh',
            scrollCollapse: true,
            "searching": true,
            "processing": true,
            "bInfo": false,
            "paging": false,
            "serverSide": false,
            "ordering": false,
            "ajax": {
                "url": '<?= base_url("dashboard/getDataPendingPO/"); ?>',
                "data": input,
                "type": "POST",
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
                        var date = new Date(data);
                        date = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                        return date;
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
                    data: "grand_total",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        var display = formatRupiah(data, 'Rp.');
                        return display;
                    }
                },
                {
                    data: "sales",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return data.nama;
                    }
                },
                {
                    data: "status_po",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        if (data == "1") {
                            var display = '<span class="badge badge-primary" >Waiting Approve</span>'
                        } else if (data == "2") {
                            var display = '<span class="badge badge-success" >Approve</span>'
                        } else if (data == "3") {
                            var display = '<span class="badge badge-warning" >Review Sales</span>'
                        } else if (data == "99") {
                            var display = '<span class="badge badge-danger" >Rejected</span>'

                        }
                        return display;
                    }
                },
                {
                    data: "no_order",
                    targets: 6,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" href="<?= base_url('manajemen_penjualan/purchaseorderadmin/review/'); ?>' + data + '" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Review"><i class="fa fa-sticky-note-o" ></i> </a>';
                        var display2 = '<a type="button" href="<?= base_url('manajemen_penjualan/reviewpurchaseorder/timeline/'); ?>' + data + '" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm" data-toggle="tooltip" data-placement="left" title="Timeline"><i class="fa fa-clock-o"></i> </a>';
                        return display1 + ' ' + display2;
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
</script>