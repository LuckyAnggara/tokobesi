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

        init_table_po()
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
    function init_table_po(status = 1, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
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
        var table = $('#datatable-daftar-po').DataTable({
            destroy: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            scrollY: '50vh',
            scrollCollapse: true,
            "searching": false,
            "processing": true,
            "bInfo": false,
            "paging": false,
            "fixedcolumn": true,
            "serverSide": false,
            "ordering": false,
            "ajax": {
                "url": '<?= base_url("manajemen_penjualan/purchaseordersales/getDataPOSales/"); ?>',
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
                    data: "status_po",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        if (data == "0") {
                            var display = '<span class="badge badge-dark" >Input</span>'
                        } else if (data == "1") {
                            var display = '<span class="badge badge-primary" >Waiting</span>'
                        } else if (data == "2") {
                            var display = '<span class="badge badge-success" >Approve</span>'
                        } else if (data == "3") {
                            var display = '<span class="badge badge-warning" >Return</span>'
                        } else if (data == "99") {
                            var display = '<span class="badge badge-danger" >Rejected</span>'
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
</script>


<script type="text/javascript">
    $(document).ready(function() {
        var dt = new Date();
        var d = dt.getMonth() + 1; // kenapa di tambah 1, karena default nya januari itu 0 biar ga binggung di tambah 1 aja
        $('#bulan').val(d).trigger('change'); // init sales dari auto pilih bulan berjalan

        init_table(d);
        init_data(d);


    });

    function init_table(bulan) {
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
        var table = $('#datatable-daftar-insentif').DataTable({
            destroy: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            scrollY: '50vh',
            scrollCollapse: true,
            "searching": true,
            "bInfo": false,
            "paging": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_sales/insentif/getData/"); ?>',
                "type": "POST",
                "data": {
                    bulan: bulan
                }
            },
            "columnDefs": [{
                    data: "id",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "tanggal",
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
                    data: "total_insentif",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        var display = formatRupiah(data, 'Rp.');
                        return display;
                    }
                },
                {
                    data: "status",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        if (data == "0") {
                            var display = '<span class="badge badge-primary">Waiting Approve</span>'
                        } else if (data == "1") {
                            var display = '<span class="badge badge-success">Approve</span>'
                        } else if (data == "99") {
                            var display = '<span class="badge badge-danger">Reject</span>'
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

    function init_data(bulan) {
        $.ajax({
            url: '<?= base_url("manajemen_sales/insentif/totalInsentif/"); ?>',
            type: "POST",
            data: {
                bulan: bulan
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#label_bulan').text($('#bulan option:selected').text())
                $('#insentif').text(formatRupiah(data, 'Rp.'));
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

    function counter() {
        $('.counterRupiah').counterUp({
            time: 1000,
            offset: 70,
            formatter: function(n) {
                return formatRupiah(n, 'Rp.');
            }
        });
    }

    $('#bulan').change(function() {
        var data = $(this).val();
        init_table(data);
        init_data(data);
    });
</script>

<!-- Chart Js Top Produk -->

<script>
    $(document).ready(function() {
        var ctx = document.getElementById('topProdukChart').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: []
                // These labels appear in the legend and in the tooltips when hovering different arcs
            },
            options: {
                legend: {
                    display: true,
                    labels: {
                        fontColor: 'black',
                        fontSize: 10,
                    },
                    position: 'left'
                }
            }
        });
        $('#top_produk').change(function() {
            var data = $(this).val();
            updateDonutTopProduk(data)
        }); // kenapa di tambah 1, karena default nya januari itu 0 biar ga binggung di tambah 1 aja
        $('#top_produk').val(2).trigger('change'); // init laba dari auto pilih bulan berjalan
        function updateDonutTopProduk(option) {

            var label;
            var total;
            var harian;
            // init data dan label
            $.ajax({
                url: "<?= Base_url('dashboard/data_top_produk'); ?>",
                async: false,
                type: "post",
                data: {
                    option: option
                },
                dataType: "JSON",
                beforeSend: function() {

                },
                success: function(data) {
                    label = data.nama_barang;
                    value = data.jumlah_penjualan;
                }
            });
            myDoughnutChart.data.labels = label;
            myDoughnutChart.data.datasets[0] = {
                data: value,
                backgroundColor: [
                    "#188ae2",
                    "#10c469",
                    "#f9c851"
                ],
                hoverBackgroundColor: [
                    "#188ae2",
                    "#10c469",
                    "#f9c851"
                ],
                hoverBorderColor: "#fff"
            }

            myDoughnutChart.update();
        }
    })
</script>