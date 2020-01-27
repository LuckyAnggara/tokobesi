<script src="<?= base_url('assets/'); ?>plugins/jquery-loader/jquery.loading.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/counterup/waypoint.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/counterup/jquery.counterup.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- CHART.js -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/chart.bundle.min.js"></script>


<!-- SCRIPT DASHBOARD AWAL -->
<script>
    $(document).ready(function() {

        setData();
        initTableLatestOrder();
        // trigger top sales berdasarkan bulan berjalan
        var dt = new Date();
        var d = dt.getMonth() + 1; // kenapa di tambah 1, karena default nya januari itu 0 biar ga binggung di tambah 1 aja
        $('#top_sales_bulan').val(d).trigger('change'); // init sales dari auto pilih bulan berjalan
        counterJalan();
    })

    function setData() {
        $.ajax({
            url: "<?= Base_url('dashboard/data'); ?>",
            async: false,
            dataType: "JSON",
            success: function(data) {
                $('#penjualan_value').text(data.total_penjualan);
                $('#pembelian_value').text(data.total_pembelian);
                $('#transaksi_value').text(data.transaksi);
                $('#produk_terjual_value').text(data.total_produk_terjual);

                $('#penjualan_trending').text(data.trend_penjualan);
                $('#pembelian_trending').text(data.trend_pembelian);
                $('#transaksi_trending').text(data.trend_transaksi);
                $('#produk_terjual_trending').text(data.trend_produk_terjual);


                // $("#transaksi_trending").append(trend(data.trend_transaksi));
                // $("#penjualan_trending").append(trend(data.trend_penjualan));
                // $("#pembelian_trending").append(trend(data.trend_pembelian));
                // $("#produk_terjual_trending").append(trend(data.trend_produk_terjual));

                $("#penjualan_trending").addClass(trendUpDown(data.trend_penjualan));
                $("#pembelian_trending").addClass(trendUpDown(data.trend_pembelian));
                $("#transaksi_trending").addClass(trendUpDown(data.trend_transaksi));
                $("#produk_terjual_trending").addClass(trendUpDown(data.trend_produk_terjual));

                dropdown_detail(data);


            }
        });

    }

    function dropdown_detail(data) {

        if (data.dropdown_penjualan == 0) {
            var display = '<div class="col-12 text-center"><p>Belum ada Data</p></div>';
            $("#dropdown_penjualan").append(display);
        } else {
            for (var i in data.dropdown_penjualan) {
                var display = '<a class="dropdown-item">' + formatDate(data.dropdown_penjualan[i].tanggal) + ' : <b><span class="counterRupiah">' + +data.dropdown_penjualan[i].total_penjualan + '</span></b></a>'
                $("#dropdown_penjualan").append(display);
            }
        }

        if (data.dropdown_pembelian == 0) {
            var display = '<div class="col-12 text-center"><p>Belum ada Data</p></div>';
            $("#dropdown_pembelian").append(display);
        } else {
            for (var i in data.dropdown_pembelian) {
                var display = '<a class="dropdown-item">' + formatDate(data.dropdown_pembelian[i].tanggal) + ' : <b><span class="counterRupiah">' + +data.dropdown_pembelian[i].total_pembelian + '</span></b></a>'
                $("#dropdown_pembelian").append(display);
            }
        }

        if (data.dropdown_produk_terjual == 0) {
            var display = '<div class="col-12 text-center"><p>Belum ada Data</p></div>';
            $("#dropdown_produk_terjual").append(display);
        } else {
            for (var i in data.dropdown_produk_terjual) {
                var display = '<a class="dropdown-item">' + formatDate(data.dropdown_produk_terjual[i].tanggal) + ' : <b><span class="counterSatuan">' + +data.dropdown_produk_terjual[i].jumlah_penjualan + '</span></b> Unit </a>'
                $("#dropdown_produk_terjual").append(display);
            }
        }

        if (data.dropdown_transaksi_penjualan == 0) {
            var display = '<div class="col-12 text-center"><p>Belum ada Data</p></div>';
            $("#dropdown_transaksi_penjualan").append(display);
        } else {
            for (var i in data.dropdown_transaksi_penjualan) {
                var display = '<a class="dropdown-item">' + formatDate(data.dropdown_transaksi_penjualan[i].tanggal) + ' : <b><span class="counterSatuan">' + +data.dropdown_transaksi_penjualan[i].jumlah + '</span></b> Trx</a>'
                $("#dropdown_transaksi_penjualan").append(display);
            }
        }

    }

    function trend(data) {
        if (data >= 0) {
            return '<i class="mdi mdi-trending-up"></i>'
        } else {
            return '<i class="mdi mdi-trending-down"></i>'
        }

    }

    function trendUpDown(data) {
        if (data >= 0) {
            return 'badge-primary'
        } else {
            return 'badge-danger'
        }
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

    function counterSales() {
        $('.counterSales').counterUp({

            time: 1000,
            offset: 70,
            formatter: function(n) {
                return formatRupiah(n, 'Rp.');
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
</script>

<!-- SCRIPT TOP SALES -->
<script>
    $('#top_sales_bulan').change(function() {
        var data = $(this).val();
        topSales(data);
        counterSales()
    });

    function topSales(bulan) {
        $.ajax({
            url: "<?= Base_url('dashboard/top_sales'); ?>",
            async: false,
            type: "post",
            dataType: "JSON",
            data: {
                bulan: bulan
            },
            beforeSend: function() {
                $("#top_sales").loading()
            },
            success: function(data) {
                $("#top_sales").empty();
                if (data == "") {
                    var display = '<div class="col-12 text-center"><p>Belum ada Data</p></div>';
                    $("#top_sales").append(display);
                } else {
                    for (var i in data) {
                        var display = '<a>' +
                            '<div class="inbox-item">' +
                            '<div class="inbox-item-img"><img src="<?= base_url('assets/images/users/'); ?>' + data[i].detail.avatar + '" class="rounded-circle" alt=""></div>' +
                            '<p class="inbox-item-author counterSales">' + data[i].total_penjualan + '</p>' +
                            '<p class="inbox-item-text">' + data[i].detail.nama + '</p>' +
                            '</div>' +
                            '</a>';
                        $("#top_sales").append(display);
                    }
                }
                $("#top_sales").loading('stop')

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
        var table = $('#table-penjualan-terakhir').DataTable({
            destroy: true,
            paging: false,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "bInfo": false,
            "searching": false,
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "ajax": {
                "url": '<?= base_url("Dashboard/data_penjualan_terakhir/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "no_faktur",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "jam",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "no_faktur",
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "total_penjualan",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        var display = formatRupiah(data, 'Rp.')
                        return display;
                    }
                },
                {
                    data: "nama",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return data;
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


<!-- Chart js total laba -->

<script>
    $(document).ready(function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            responsive: false,
            type: 'bar',
            data: {
                datasets: []
            },
            options: {
                scales: {
                    yAxes: [{
                        id: "y-axis-1",
                        position: "left"
                    }, {
                        id: "y-axis-2",
                        position: "right"
                    }]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(t, d) {
                            if (t.datasetIndex === 0) {
                                return formatRupiah(t.yLabel.toString(), 'Rp.') + ' Juta';
                            } else if (t.datasetIndex === 1) {
                                if (t.yLabel.toString().length === 9) {
                                    return formatRupiah(t.yLabel.toString(), 'Rp.') + ' Juta';
                                } else return formatRupiah(t.yLabel.toString(), 'Rp.') + ' Juta';
                            }
                        },
                        title: function(t, d) {
                            return "Tanggal " + t[0].label;
                        }
                    },
                }
            }
        });

        $('#laba_bulan').change(function() {
            var data = $(this).val();
            var dt = new Date();
            var tahun = dt.getFullYear();
            updateChartLaba(data, tahun, chart)
        });
        var dt = new Date();
        var d = dt.getMonth() + 1; // kenapa di tambah 1, karena default nya januari itu 0 biar ga binggung di tambah 1 aja
        $('#laba_bulan').val(d).trigger('change'); // init laba dari auto pilih bulan berjalan
        function updateChartLaba(bulan, tahun) {

            var label;
            var total;
            var harian;
            // init data dan label
            $.ajax({
                url: "<?= Base_url('dashboard/data_total_laba'); ?>",
                async: false,
                type: "post",
                data: {
                    bulan: bulan,
                    tahun: tahun
                },
                dataType: "JSON",
                beforeSend: function() {

                },
                success: function(data) {
                    label = data.label;
                    total = data.total;
                    harian = data.harian;
                }
            });
            chart.data.labels = label;
            chart.data.datasets[0] = {
                type: 'line',
                label: 'Laba Berjalan',
                data: total,
                fill: false,
                borderColor: '#EC932F',
                backgroundColor: '#EC932F',
                tension: 0,
                yAxisID: 'y-axis-2'
            };
            chart.data.datasets[1] = {
                type: 'bar',
                label: 'Laba Harian',
                data: harian,
                backgroundColor: '#71B37C',
                yAxisID: 'y-axis-1'
            };
            chart.update();
        }
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
        });
        $('#top_produk').change(function() {
            var data = $(this).val();
            updateDonutTopProduk(data)
        }); // kenapa di tambah 1, karena default nya januari itu 0 biar ga binggung di tambah 1 aja
        $('#top_produk').val(1).trigger('change'); // init laba dari auto pilih bulan berjalan
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

<!-- Chart produktifitas Sales -->

<script>
    $(document).ready(function() {
        var ctx = document.getElementById('produktifitasSalesChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Produktifitas',
                    backgroundColor: '#71B37C',
                    yAxisID: 'y-axis-2'
                    // barPercentage: 0.5,
                    // barThickness: 6,
                    // maxBarThickness: 8,
                    // minBarLength: 2,
                    //data: [10, 20, 30, 40, 50, 60, 70]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        id: "y-axis-2",
                        position: "right",
                        ticks: {
                            beginAtZero: true,
                            stepSize: 600,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Rp. ' + formatSatuan(value.toString()) + ' Juta';
                            }
                        }
                    }]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(t, d) {
                            if (t.datasetIndex === 0) {
                                return formatRupiah(t.yLabel.toString(), 'Rp.') + ' Juta';
                            }
                        },
                        title: function(t, d) {
                            console.log(t);
                            return "Bulan " + t[0].label;
                        }
                    }
                },

            }
        });
        $('#produktifitas_sales').change(function() {
            var data = $(this).val();
            updateBarSales(data)
        }); // kenapa di tambah 1, karena default nya januari itu 0 biar ga binggung di tambah 1 aja
        $("#produktifitas_sales").val($("#produktifitas_sales option:first").val()).trigger('change');

        function updateBarSales(kode_sales) {

            var label;
            var total;
            var harian;
            // init data dan label
            $.ajax({
                url: "<?= Base_url('dashboard/data_produktifitas_sales'); ?>",
                async: false,
                type: "post",
                data: {
                    kode_sales: kode_sales
                },
                dataType: "JSON",
                beforeSend: function() {},
                success: function(data) {
                    label = data.bulan;
                    value = data.value;
                }
            });
            barChart.data.labels = label;
            barChart.data.datasets[0].data = value;
            barChart.update();
        }
    })
</script>