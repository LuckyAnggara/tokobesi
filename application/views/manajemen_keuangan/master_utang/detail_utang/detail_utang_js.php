<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
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

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>


<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Input Mask Js dan Max Length-->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>




<!-- script Uploader -->
<script type="text/javascript">
    $('#bukti').dropify({
        messages: {
            'default': 'Drag dan drop Bukti Barang disini',
            'replace': 'Drag dan drop Bukti untuk mengganti',
            'remove': 'Hapus',
            'error': 'Ooops, terjadi sesuatu, silahkan coba lagi.',
        },
        tpl: {
            clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
        },
        error: {
            'fileSize': 'File terlalu besar (5 Mb max).',
            'imageFormat': 'Format Gambar tidak Support, hanya ({{ value }} saja).'
        }
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

    function normalrupiah(angka) {

        var tanparp = angka.replace(/[^0-9]+/g, "");
        var tanparp = tanparp.replace("Rp", "");
        var tanparp = tanparp.replace(",-", "");
        var tanpatitik = tanparp.split(".").join("");
        return tanpatitik;
    }
</script>


<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {
        var nomor_transaksi = $('#nomor_transaksi').text();



        var pusher = new Pusher('a198692078b54078587e', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if (data.utangpiutang === nomor_transaksi) {
                $('#datatable-detail-pembayaran').DataTable().ajax.reload();
            }
        });

        $('#tanggal').datepicker({
            autoclose: true,
            todayHighlight: true,
            constrainInput: false,
        });


        init_table(nomor_transaksi);
        setSaldoUtang(nomor_transaksi);
        setInitStatus(nomor_transaksi);
    });

    function init_table(nomor_transaksi) {

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
        var input = {
            nomor_transaksi: nomor_transaksi,
        }

        var table = $('#datatable-detail-pembayaran').DataTable({
            destroy: true,
            paging: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "buttons": ['copy', 'excel', 'pdf', 'print'],
            dom: 'Bfrtip',
            "searching": true,
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/masterutang/getDetailPembayaran/"); ?>',
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
                }, {
                    data: "keterangan",
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nominal_pembayaran",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        var display = formatRupiah(data.toString(), 'Rp.');
                        return display;
                    }
                }, {
                    data: "saldo",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var display = '<span class="text-danger"><b>' + formatRupiah(data.toString(), 'Rp.') + '</b></span>'
                        return display;
                    }
                }, {
                    data: {
                        "bukti": "bukti",
                        "id": "id",
                        "user": "user"
                    },
                    width: 20,
                    targets: 5,
                    render: function(data, type, full, meta) {
                        var user = '<?php echo $this->session->userdata['username']; ?>'

                        var dp = '<span class="badge badge-inverse"> DP </span>'
                        var upload = '<a type="button" onClick = "upload_lampiran(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-upload" ></i> </a>';
                        var download = '<a type="button" onClick = "download_lampiran(\'' + data.bukti + '\')" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm"><i class="fa fa-download" ></i> </a>';
                        if (data.bukti == "") {
                            if (user == data.user) {
                                return upload;
                            } else {
                                return ""
                            }
                        } else if (data.bukti == "1") {
                            return dp;
                        } else {
                            return download;
                        }
                    }
                }, {
                    data: {
                        "id": "id",
                        "bukti": "bukti",
                        "user": "user",
                    },
                    targets: 6,
                    width: 20,
                    render: function(data, type, full, meta) {
                        var user = '<?php echo $this->session->userdata['username']; ?>'

                        var deletedata = '<a type="button" onClick = "warning_delete(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-trash" ></i> </a>';
                        if (data.bukti != "1" && user == data.user) {
                            return deletedata;
                        } else {
                            return "";
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

    function setSaldoUtang(nomor_transaksi) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterutang/saldoutangdetail/"); ?>',
            type: "POST",
            data: {
                nomor_transaksi: nomor_transaksi
            },
            dataType: "JSON",
            success: function(data) {
                $('#saldo_utang').val(formatRupiah(data, 'Rp. '));
            }
        });
    }

    function setInitStatus(nomor_transaksi) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterutang/statusbayar/"); ?>',
            type: "POST",
            data: {
                nomor_transaksi: nomor_transaksi
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== '1') {
                    $('#tambah_btn').attr('hidden', false);
                }
            }
        });
    }
</script>


<!-- Script View Bukti -->

<script>
    function view(data) {
        window.location.href = "<?= base_url('assets/upload/bukti/utang/'); ?>" + data;
    }
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#add_modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $('.dropify-clear').click();
        });



        $('#submitForm').submit(function(e) {
            e.preventDefault();
            $.LoadingOverlay('show', true);
            var saldo_utang = parseInt(normalrupiah($('#saldo_utang').val()));
            var nominal = parseInt(normalrupiah($('#nominal_pembayaran').val()));
            console.log(nominal > saldo_utang);
            if (nominal > saldo_utang) {
                Swal.fire(
                    'Oopss!',
                    'Nominal pembayaran lebih besar dari sisa Piutang!!',
                    'error'
                )
            } else {
                var nomor_transaksi = $('#nomor_transaksi').text();
                var grand_total = $('#grand_total').val();
                var data = new FormData(document.getElementById("submitForm"));
                data.append('nomor_transaksi', nomor_transaksi);
                data.append('grand_total', grand_total);
                $.ajax({
                    url: "<?= Base_url('manajemen_keuangan/masterutang/tambahpembayaran'); ?>",
                    type: "post",
                    data: data,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#add_modal').modal('hide');
                        Swal.fire(
                            'Sukses!',
                            'Pembayaran telah di tambahkan!!',
                            'success'
                        )
                    },
                    complete: function(data) {
                        $.LoadingOverlay('hide', true);
                    }
                })
            }
        });

        $('#tambah_btn').on('click', function() {
            var nomor_transaksi = $('#nomor_transaksi').text();
            setSaldoUtang(nomor_transaksi);
            var saldo_utang = $('#saldo_utang_text').text();
            if (saldo_utang == 0) {
                Swal.fire(
                    'Oopss!',
                    'Saldo utang sudah 0, silahkan refresh browser!!',
                    'error'
                ).then((result) => {
                    if (result.value) {
                        location.reload(true);
                    }
                })
            } else {
                $('#add_modal').modal('show');
            }
        })
        var dp = document.getElementById('nominal_pembayaran');
        dp.addEventListener('keyup', function(e) {
            dp.value = formatRupiah(this.value, 'Rp. ');
            var nominal_pembayaran = (normalrupiah(dp.value));
            var saldo_utang = parseInt(normalrupiah($('#saldo_utang').val()));

            if (nominal_pembayaran > saldo_utang) {
                Swal.fire({
                    icon: 'error',
                    title: 'Over',
                    text: 'Nominal pembayaran melebihi saldo Utang !!',
                });
                dp.value = '';
            }

        });
    });

    $('#lampiran').dropify({
        messages: {
            'default': 'Drag dan drop bukti disini',
            'replace': 'Drag dan drop bukti untuk mengganti',
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


    function upload_lampiran(id) {
        $('#id_lampiran').text(id);
        $('#upload_lampiran').modal('show');
    }

    // Upload Lampiran
    $('#lampiran_form').submit(function(e) {
        $('#upload_lampiran').LoadingOverlay("show", true);
        e.preventDefault();
        var id = $('#id_lampiran').text();
        var nomor_transaksi = $('#nomor_transaksi').text();
        var data = new FormData(document.getElementById("lampiran_form"));
        data.append('id', id);
        data.append('nomor_transaksi', nomor_transaksi);
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterutang/setlampiran/"); ?>',
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#upload_lampiran').modal('hide');
                $('#datatable-detail-pembayaran').DataTable().ajax.reload();
            },
            complete: function(data) {
                $('#upload_lampiran').LoadingOverlay("hide", true);
                Swal.fire(
                    'Sukes',
                    'Lampiran telah di Upload!',
                    'success'
                );
            }
        })
    })

    function download_lampiran(bukti) {
        window.location.href = "<?= base_url('assets/upload/bukti/utang/'); ?>" + bukti;
    }
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(id) {
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(id);

            }
        })
    }

    function deleteData(id) {
        var nomor_transaksi = $('#nomor_transaksi').text();
        $.LoadingOverlay("show", true);
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/masterutang/delete_data/'); ?>",
            data: {
                id: id,
                nomor_transaksi: nomor_transaksi,
            },
            type: "post",
            async: false,
            success: function(data) {
                $('#datatable-detail-pembayaran').DataTable().ajax.reload();
            },
            complete: function(data) {
                $.LoadingOverlay("hide", true);
                Swal.fire(
                    'Deleted!',
                    '',
                    'success'
                )
            }
        });
    }
</script>

<!-- script lainnya -->