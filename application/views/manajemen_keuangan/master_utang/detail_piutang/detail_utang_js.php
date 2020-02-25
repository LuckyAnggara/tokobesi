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

    var nominal = document.getElementById('nominal_pembayaran');
    nominal.addEventListener('keyup', function(e) {
        var data = $('#nominal_pembayaran').val();
        nominal.value = formatRupiah(this.value, 'Rp. ');
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

        $('#tanggal').datepicker({
            autoclose: true,
            todayHighlight: true,
            constrainInput: false,
        });
        var nomor_faktur = $('#nomor_faktur').text();
        init_table(nomor_faktur);
        setSaldoPiutang(nomor_faktur);
        setInitStatus(nomor_faktur);
    });

    function init_table(nomor_faktur) {

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
            nomor_faktur: nomor_faktur,
        }

        var table = $('#datatable-detail-pembayaran').DataTable({
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
                    data: "sisa_utang",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var display = '<span class="text-danger"><b>' + formatRupiah(data.toString(), 'Rp.') + '</b></span>'
                        return display;
                    }
                }, {
                    data: "bukti",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        var display = '<a type="button" onClick = "view(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-primary btn-sm"><i class="fa fa-download" ></i> </a>';

                        if (data == "") {
                            return ""
                        } else {
                            return display;

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

    function setSaldoPiutang(nomor_faktur) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterutang/saldoutangdetail/"); ?>',
            type: "POST",
            data: {
                nomor_faktur: nomor_faktur
            },
            dataType: "JSON",
            success: function(data) {
                $('#saldo_utang').val(formatRupiah(data, 'Rp. '));
            }
        });
    }

    function setInitStatus(nomor_faktur) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterutang/statusbayar/"); ?>',
            type: "POST",
            data: {
                nomor_faktur: nomor_faktur
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
                var nomor_faktur = $('#nomor_faktur').text();
                var grand_total = $('#grand_total').val();
                var data = new FormData(document.getElementById("submitForm"));
                data.append('nomor_faktur', nomor_faktur);
                data.append('grand_total', grand_total);
                $.ajax({
                    url: "<?= Base_url('manajemen_keuangan/masterutang/tambahpembayaran'); ?>",
                    type: "post",
                    data: data,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#datatable-detail-pembayaran').DataTable().ajax.reload();
                        $('#add_modal').modal('hide');
                        Swal.fire(
                            'Sukses!',
                            'Pembayaran telah di tambahkan!!',
                            'success'
                        )
                    }
                })
            }
        });

        $('#tambah_btn').on('click', function() {
            var saldo_utang = parseInt(normalrupiah($('#saldo_utang').val()));
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
    });
</script>

<!-- script lainnya -->