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

<!-- script sendiri -->

<script>
    $(document).ready(function() {
        var no_ref = $('#nomor_referensi').val()
        init_table(no_ref)


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

    function init_table(no_ref) {
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

        //Init Datatabel Master Stok Persediaan 
        var table = $('#datatable-daftar-gaji').DataTable({
            "destroy": true,
            "bInfo": false,
            "paging": false,
            "lengthChange": false,
            "oLanguage": {
                "sProcessing": "Sabar yah...",
                "sZeroRecords": "Tidak ada Data..."
            },
            "buttons": ['copy', 'excel', 'pdf', 'print'],
            "dom": 'Bfrtip',
            "searching": false,
            "processing": true,
            "serverSide": false,
            "ordering": true,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/mastergaji/get_view_detail_gaji/"); ?>',
                "data": {
                    no_ref: no_ref
                },
                "type": "POST",
            },
            "columnDefs": [{
                data: "nip",
                orderable: false,
                width: "5%",
                targets: 0,
                render: function(data, type, full, meta) {
                    return "";
                }
            }, {
                title: 'Nama Pegawai',
                data: "nama_lengkap",
                targets: 1,
                width: 200,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                title: 'Jabatan',
                data: "jabatan",
                targets: 2,
                width: 50,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                title: 'Gaji Pokok',
                data: {
                    "id": "id",
                    "gaji_pokok": "gaji_pokok"
                },
                targets: 3,
                width: 50,
                render: function(data, type, full, meta) {
                    var angka = formatRupiah(data.gaji_pokok.toString(), 'Rp.');
                    return angka;
                }
            }, {
                title: 'Uang Makan',
                data: {
                    "id": "id",
                    "uang_makan": "uang_makan"
                },
                targets: 4,
                width: 50,
                render: function(data, type, full, meta) {
                    var angka = formatRupiah(data.gaji_pokok.toString(), 'Rp.');
                    return angka;
                }
            }, {
                title: 'Bonus',
                data: {
                    "id": "id",
                    "bonus": "bonus"
                },
                targets: 5,
                width: 50,
                render: function(data, type, full, meta) {
                    var angka = formatRupiah(data.gaji_pokok.toString(), 'Rp.');
                    return angka;
                }
            }, {
                title: 'Total',
                data: "total",
                targets: 6,
                width: 50,
                render: function(data, type, full, meta) {
                    var angka = formatRupiah(data.toString(), 'Rp.');
                    var display = '<b>' + angka + '</b>';
                    return display;
                }
            }, ],
            "rowCallback": function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
                // $(row).find('td:eq(2)').css('color', 'blue');
            }

        });
    }
</script>


<!-- Script Membuat Master dan Detail nya -->