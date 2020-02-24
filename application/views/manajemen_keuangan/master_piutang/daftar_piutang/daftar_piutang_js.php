<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

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
        init_table();
        setSaldoPiutang();


        $('#filter').on('click', function() {
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();
            init_table(tanggal_awal, tanggal_akhir);
        });
    });

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

    function init_table(tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
        var input = {
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
        if (role == "4" || role == "5") {
            var visible = true
        } else {
            var visible = false
        }
        var table = $('#datatable-daftar-piutang').DataTable({
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
                "url": '<?= base_url("manajemen_keuangan/masterpiutang/getData/"); ?>',
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
                    data: "nama_pelanggan",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "tanggal_tempo",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "total_tagihan",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        var display = formatRupiah(data.toString(), 'Rp.');
                        return display;
                    }
                },
                {
                    data: "total_pembayaran",
                    targets: 6,
                    render: function(data, type, full, meta) {
                        var display = formatRupiah(data.toString(), 'Rp.');
                        return display;
                    }
                },
                {
                    data: "sisa_piutang",
                    targets: 7,
                    render: function(data, type, full, meta) {
                        var display = '<span class="text-danger"><b>' + formatRupiah(data.toString(), 'Rp.') + '</b></span>'
                        return display;
                    }
                },
                {
                    data: "nama_sales",
                    targets: 8,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_pegawai",
                    targets: 9,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "no_faktur",
                    targets: 10,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "detail_piutang(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Detail"><i class="fa fa-search" ></i> </a>';

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

    function setSaldoPiutang() {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterpiutang/saldopiutang/"); ?>',
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#saldo_piutang').val(formatRupiah(data, 'Rp. '));
            }
        });
    }
</script>


<!-- Script Filter -->

<script>
    function detail_piutang(nomor_faktur) {
        window.location.href = "<?= base_url('manajemen_keuangan/masterpiutang/detail_piutang/'); ?>" + nomor_faktur;
    }
</script>