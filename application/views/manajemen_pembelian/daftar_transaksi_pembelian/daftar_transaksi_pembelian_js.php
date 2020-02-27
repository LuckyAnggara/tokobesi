<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

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
        destroy: true,
        init_table();

        function init_table(status_bayar = null, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
            var input = {
                status_bayar: status_bayar,
                tanggal_awal: tanggal_awal,
                tanggal_akhir: tanggal_akhir
            }

            console.log(input)
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
            if (role > 3) {
                var visible = true
            } else {
                var visible = false
            }
            var table = $('#datatable-daftar-pembelian').DataTable({
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
                    "url": '<?= base_url("manajemen_pembelian/daftartransaksipembelian/getData/"); ?>',
                    "data": input,
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
                            var date = new Date(data);
                            date = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                            return date;
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
                        data: "nama_supplier",
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "total_pembelian",
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data.toString(), 'Rp.');
                            return display;
                        }
                    }, {
                        data: "diskon",
                        targets: 5,
                        render: function(data, type, full, meta) {
                            var display = '<b class="text-danger">' + formatRupiah(data.toString(), 'Rp.') + "</b>"
                            return display;
                        }
                    }, {
                        data: "pajak_keluaran",
                        targets: 6,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data.toString(), 'Rp.');
                            return display;
                        }
                    }, {
                        data: "ongkir",
                        targets: 7,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data.toString(), 'Rp.');
                            return display;
                        }
                    }, {
                        data: "grand_total",
                        targets: 8,
                        render: function(data, type, full, meta) {
                            var display = '<b>' + formatRupiah(data.toString(), 'Rp.') + "</b>"
                            return display;
                        }
                    },
                    {
                        data: "kredit",
                        targets: 9,
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
                    }, {

                        data: "nama_pegawai",
                        targets: 10,
                        visible: visible,
                        render: function(data, type, full, meta) {
                            return data
                        }
                    },
                    {
                        data: {
                            "nomor_transaksi": "nomor_transaksi",
                            "lampiran": "lampiran",
                        },
                        targets: 11,
                        render: function(data, type, full, meta) {
                            var display1 = '<a type="button" onClick = "view_detail(\'' + data.nomor_transaksi + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-search" ></i> </a>';
                            var upload = '<a type="button" onClick = "upload_lampiran(\'' + data.nomor_transaksi + '\')" data-button="' + data.nomor_transaksi + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-upload" ></i> </a>';
                            var download = '<a type="button" onClick = "download_lampiran(\'' + data.lampiran + '\')" data-button="' + data.nomor_transaksi + '" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm"><i class="fa fa-download" ></i> </a>';

                            var del = '<a type="button" onClick = "warning_delete(\'' + data.nomor_transaksi + '\')" data-button="' + data.nomor_transaksi + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-trash" ></i> </a>';
                            if (data.lampiran == "") {
                                return display1 + ' ' + upload;
                            } else {
                                return display1 + ' ' + download;
                            }
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


        $('#filter').on('click', function() {
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();
            var status_bayar = $('#status_bayar').val();
            init_table(status_bayar, tanggal_awal, tanggal_akhir);
        });
    });
</script>


<!-- Script Filter -->

<script>
    function view_detail(nomor_transaksi) {
        window.location.href = "<?= base_url('manajemen_pembelian/detailtransaksipembelian/nomor_transaksi/'); ?>" + nomor_transaksi;
    }
</script>

<!-- Script Download dan Upload -->
<script>
    $('#lampiran').dropify({
        messages: {
            'default': 'Drag dan drop Lampiran disini',
            'replace': 'Drag dan drop Lampiran untuk mengganti',
            'remove': 'Hapus',
            'error': 'Ooops, terjadi sesuatu, silahkan coba lagi.'
        },
        tpl: {
            clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
        },
        error: {
            'fileSize': 'File terlalu besar (10 Mb max).',
            'imageFormat': 'Format Lampiran tidak Support, hanya ({{ value }} saja).'
        },
    });

    $('#upload_lampiran').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        $('.dropify-clear').click();
    });


    function upload_lampiran(nomor_transaksi) {
        $('#nomor_transaksi_lampiran').text(nomor_transaksi);
        $('#upload_lampiran').modal('show');
    }

    // Upload Lampiran
    $('#lampiran_form').submit(function(e) {
        $.LoadingOverlay("show", true);
        e.preventDefault();
        var nomor_transaksi = $('#nomor_transaksi_lampiran').text();
        var data = new FormData(document.getElementById("lampiran_form"));
        data.append('nomor_transaksi', nomor_transaksi);
        $.ajax({
            url: '<?= base_url("manajemen_pembelian/daftartransaksipembelian/setlampiran/"); ?>',
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#upload_lampiran').modal('hide');
                Swal.fire(
                    'Sukes',
                    'Lampiran telah di Upload!',
                    'success'
                );
                $('#datatable-daftar-pembelian').DataTable().ajax.reload();
            },
            complete: function(data) {
                $.LoadingOverlay("show", true);
            }
        })
    })

    function download_lampiran(lampiran) {
        window.location.href = "<?= base_url('assets/upload/bukti/pembelian/'); ?>" + lampiran;
    }
</script>