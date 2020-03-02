<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.select.min.js"></script>
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
        init_table();



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
        var table = $('#datatable-daftar-gaji').DataTable({
            "destroy": true,
            "bInfo": false,
            "paging": false,
            "lengthChange": false,
            "oLanguage": {
                "sProcessing": "Sabar yah...",
                "sZeroRecords": "Tidak ada Data..."
            },
            // "buttons": ['copy', 'excel', 'pdf', 'print'],
            // "dom": 'Bfrtip',
            "searching": false,
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ordering": true,
            select: {
                style: 'multi+shift',
                selector: 'td:not(:last-child)',
                blurable: true
            },
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/mastergaji/get_data_pegawai/"); ?>',
                "data": input,
                "type": "POST",
            },
            "columnDefs": [{
                data: "nip",
                orderable: false,
                className: 'select-checkbox checkbox-danger',
                width: 5,
                targets: 0,
                render: function(data, type, full, meta) {
                    return "";
                }
            }, {
                data: "nama_lengkap",
                targets: 1,
                width: 200,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: "jabatan",
                targets: 2,
                width: 50,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: "gaji_pokok",
                targets: 3,
                width: 50,
                render: function(data, type, full, meta) {
                    return formatRupiah(data.toString(), 'Rp.');
                }
            }, {
                data: "uang_makan",
                targets: 4,
                width: 50,
                render: function(data, type, full, meta) {
                    return formatRupiah(data.toString(), 'Rp.');
                }
            }, {
                data: "bonus",
                targets: 5,
                width: 50,
                render: function(data, type, full, meta) {
                    return formatRupiah(data.toString(), 'Rp.');
                }
            }, {
                data: "total",
                targets: 6,
                width: 50,
                render: function(data, type, full, meta) {
                    return formatRupiah(data.toString(), 'Rp.');
                }
            }, ],

        });
    }

    $('#tambah_btn').click(function() {
        var table = $('#datatable-daftar-gaji').DataTable();
        var data = table.rows('.selected').data();
        console.log(data);
    });

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