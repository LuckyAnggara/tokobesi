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
        var status = "<?= $detail_data['status']; ?>";
        if (status == 0) {
            $('.btn').attr('disabled', true);
        }
        var no_ref = $('#nomor_referensi').text();
        init_table(no_ref)
    })

    function normalrupiah(angka) {

    var tanparp = angka.replace(/[^0-9]+/g, "");
    var tanparp = tanparp.replace("Rp", "");
    var tanparp = tanparp.replace(",-", "");
    var tanpatitik = tanparp.split(".").join("");
    return tanpatitik;
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

    function nl2br(str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
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

        var table = $('#datatable-detail-coh').DataTable({
            "destroy": true,
            "oLanguage": {
                "sProcessing": "Sabar yah...",
                "sZeroRecords": "Tidak ada Data..."
            },
            "buttons": ['copy', 'excel', 'pdf', 'print'],
            "dom": 'Bfrtip',
            "searching": false,
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ordering": true,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/mastercoh/get_detail_data/"); ?>',
                "type": "POST",
                "data": {
                    no_ref: no_ref
                }
            },
            "columnDefs": [{
                data: "jam",
                targets: 0,
                width: 20,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: {
                    "nominal": "nominal",
                    "jenis": "jenis"
                },
                targets: 1,
                width: 100,
                render: function(data, type, full, meta) {
                    var display = formatRupiah(data.nominal, 'Rp.');
                    if (data.jenis == 1 || data.jenis == 2) {
                        return display;
                    } else {
                        return "";
                    }

                }
            }, {
                data: {
                    "nominal": "nominal",
                    "jenis": "jenis"
                },
                targets: 2,
                width: 100,
                render: function(data, type, full, meta) {
                    var display = formatRupiah(data.nominal, 'Rp.');
                    if (data.jenis == 3 || data.jenis == 4) {
                        return display;
                    } else {
                        return "";
                    }

                }
            }, {
                data: "saldo",
                targets: 3,
                width: 150,
                render: function(data, type, full, meta) {
                    return formatRupiah(data, 'Rp.');
                }
            }, {
                data: "keterangan",
                targets: 4,
                width: 400,
                render: function(data, type, full, meta) {
                    return nl2br(data);
                }
            }],
        });
    }
</script>
<!-- modal script -->
<script>
    $('#tarik_modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });

    $('#setor_modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });

    var tarik = document.getElementById('tarik_dana');
    tarik.addEventListener('keyup', function(e) {
        tarik.value = formatRupiah(this.value, 'Rp.');
    });

    var setor = document.getElementById('setor_dana');
    setor.addEventListener('keyup', function(e) {
        setor.value = formatRupiah(this.value, 'Rp.');
    });
</script>

<!-- jalan kan tarik setor -->

<script>
    $('#tarikForm').submit(function(e) {
        e.preventDefault();
        var no_ref = $('#nomor_referensi').text();
        var data = new FormData(document.getElementById("tarikForm"));
        data.append('no_ref', no_ref);
        $.ajax({
            url: "<?= base_url("manajemen_keuangan/mastercoh/permintaan_tarik_dana"); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data == 'sukses') {
                    swal.fire(
                        'Sukses!',
                        'Permintaan dana telah di kirim kan ke atasan',
                        'success'
                    );
                } else {
                    swal.fire(
                        'Oopss!',
                        'Ada kesalahan sistem, silahkan ulangi!',
                        'error'
                    );
                }

                $('#tarik_modal').modal('hide');
            }
        })
    })

    $('#setorForm').submit(function(e) {
        e.preventDefault();
        var cash_on_hand = parseInt(normalrupiah($('#saldo_akhir').val()));
        var setor = parseInt(normalrupiah($('#setor_dana').val()));
        if (setor > cash_on_hand) {
            Swal.fire(
                'Oopss!',
                'Nominal setor lebih besar dari Cash on Hands!',
                'error'
        )
        }else{

        var no_ref = $('#nomor_referensi').text();
        var data = new FormData(document.getElementById("setorForm"));
        data.append('no_ref', no_ref);
        $.ajax({
            url: "<?= base_url("manajemen_keuangan/mastercoh/permintaan_setor_dana"); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data == 'sukses') {
                    swal.fire(
                        'Sukses!',
                        'Permintaan setor dana telah di kirim kan ke atasan',
                        'success'
                    );
                } else {
                    swal.fire(
                        'Oopss!',
                        'Ada kesalahan sistem, silahkan ulangi!',
                        'error'
                    );
                }
                $('#setor_modal').modal('hide');
            }
        })
    }
    })
</script>