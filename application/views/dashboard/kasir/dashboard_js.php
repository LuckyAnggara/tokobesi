<script src="<?= base_url('assets/'); ?>plugins/jquery-loader/jquery.loading.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Pusher Notif Sendiri -->
<script src="<?= base_url('assets/'); ?>js/pusher.notif.js"></script>



<!-- SCRIPT DASHBOARD AWAL -->
<script>
    $(document).ready(function() {

        initTableLatestOrder();
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
            "searching": true,
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "ajax": {
                "url": '<?= base_url("Dashboard/data_penjualan_terakhir_kasir/"); ?>',
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
                    data: "tanggal",
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
                                '<a class="dropdown-item">' + formatRupiah(data.sisa_piutang.toString(), 'Rp.') + '</a>' +
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