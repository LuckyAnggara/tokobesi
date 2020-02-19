<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/counterup/waypoint.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/counterup/jquery.counterup.min.js"></script>
<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Isi Data Tabel -->

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
            paging: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": false,
            "paging": false,
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