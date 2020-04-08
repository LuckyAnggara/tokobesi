<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/counterup/waypoint.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/counterup/jquery.counterup.min.js"></script>


<script src="<?= base_url('assets/'); ?>plugins/moment/moment.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- CHART.js -->
<script src="<?= base_url('assets/'); ?>plugins/chartjs/chart.bundle.min.js"></script>



<!-- script init -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tanggal').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            format: 'MM/DD/YYYY',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
        });

        var dt = new Date();
        var d = dt.getMonth() + 1; // kenapa di tambah 1, karena default nya januari itu 0 biar ga binggung di tambah 1 aja
        $('#top_sales_bulan').val(d).trigger('change'); // init sales dari auto pilih bulan berjalan
    });
</script>

<script>
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
                }]
            },
            options: {
                legend: {
                    display: true,
                    labels: {
                        fontColor: 'black',
                        fontSize: 10,
                    },
                    position: 'left'
                },
                scales: {
                    yAxes: [{
                        id: "y-axis-2",
                        position: "right",
                        ticks: {
                            beginAtZero: true,
                            stepSize: 600,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return formatRupiah(value.toString(), 'Rp. ');
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
                                return formatRupiah(t.yLabel.toString(), 'Rp. ');
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