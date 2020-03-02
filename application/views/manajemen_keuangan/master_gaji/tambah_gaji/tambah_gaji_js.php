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
        $('#tanggal').datepicker({
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left",
        });


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
            "scrollY": '50vh',
            "scrollCollapse": true,
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
                "url": '<?= base_url("manajemen_keuangan/mastergaji/get_detail_master_gaji/"); ?>',
                "data": {
                    no_ref: no_ref
                },
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


    $('#confirm').on('click', function() {
        var table = $('#datatable-daftar-gaji').DataTable();
        var data = table.rows('.selected').data();
        var no_ref = $('#nomor_referensi').val();
        var total_pembayaran = 0;
        var id = {};
        var output = [];
        $.each(data, function(index, item) {
            total_pembayaran += parseInt(item.total)
            output.push(item.idid);
            console.log(item.idid);
        });
        $('#select_row').text(data.length);
        $('#jumlah_pembayaran').val(formatRupiah(total_pembayaran.toString(), 'Rp.'))
        console.log(output);
        Swal.fire({
            title: formatRupiah(total_pembayaran.toString(), 'Rp.'),
            text: 'Bayarkan ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Bayar!'
        }).then((result) => {
            if (result.value) {
                proses_bayar(output, no_ref, total_pembayaran)
            }
        })
    })
</script>


<!-- Script Membuat Master dan Detail nya -->

<script>
    function tambah_master(no_ref, tanggal, ket) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/mastergaji/tambah_master_gaji"); ?>',
            type: "POST",
            data: {
                nomor_referensi: no_ref,
                tanggal: tanggal,
                keterangan: ket,
            },
            dataType: "JSON",
            async: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function() {
                $.LoadingOverlay("hide");
            }
        });
    }

    function proses_bayar(output, no_ref, total_pembayaran) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/mastergaji/proses_bayar"); ?>',
            type: "POST",
            data: {
                output: output,
                no_ref: no_ref,
                total_pembayaran: total_pembayaran
            },
            async: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function() {
                $.LoadingOverlay("hide");
            }
        });
    }
</script>
<!-- Script Button Type -->
<script>
    $('#proses_init_data').on('click', function() {
        var no_ref = $('#nomor_referensi');
        var tanggal = $('#tanggal');
        var ket = $('#keterangan').val();
        if (no_ref.val() !== "" && tanggal.val() !== "") {
            $('#button_data_div').attr('hidden', false);
            $('#confirm').attr('hidden', false);
            no_ref.attr('readonly', true);
            tanggal.attr('readonly', true);
            $('#proses_init_data').attr('hidden', true)
            tambah_master(no_ref.val(), tanggal.val(), ket)
            init_table(no_ref.val());;
        } else {
            Swal.fire(
                'Data Stok Opname belum di isi !',
                'Silahkan Cek Kembali',
                'error'
            )
        }
    });
    $('#apply_random').on('click', function() {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/mastergaji/random_ref/"); ?>',
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#nomor_referensi').val(data);
            }
        });
    })
</script>

<!-- script modal -->

<script>
    function show_modal(id, saldo) {
        $("#data_selisih").empty()
        show_detail_selisih_stok_opname(id);
        $('#box_selisih').attr('hidden', false);
        $('html, body').animate({
            scrollTop: $('#box_selisih').offset().top
        }, 'slow', function() {
            $('#box_selisih').focus();
        });
    }

    function fisik_modal(id, saldo_fisik, saldo_fisik) {
        if ($('#confirm').text() == "Reject") {
            swal.fire(
                'Rejected!',
                'Data sudah tidak bisa di <b>Ubah!</b>',
                'error'
            )
        } else if ($('#confirm').text() == "Waiting Approve") {
            swal.fire(
                'Wait!!',
                'Data menunggu Approve <b>Supervisor</b>',
                'warning'
            )
        } else {
            $('#fisik_id').text(id);
            $('#saldo_fisik').val(saldo_fisik)
            $('#saldo_buku').val(saldo_fisik)
            $('#fisik_modal').modal('show');
            $('#box_selisih').hide();
        }
    }


    function show_detail_selisih_stok_opname(id) {
        $.ajax({
            url: '<?= base_url("manajemen_persediaan/stokopname/show_detail_selisih_stok_opname"); ?>',
            type: "POST",
            data: {
                id: id
            },
            dataType: "JSON",
            async: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#detail_kode_barang').val(data.kode_barang);
                $('#detail_qty_selisih').val(data.selisih);
                $('#detail_sisa_selisih').val(data.selisih - data.koreksi);
                $('#id').text(data.id);
                if (data.data.length > 0) {
                    for (var i in data.data) {
                        id = data.data[i].id
                        qty = data.data[i].qty
                        ket = data.data[i].keterangan
                        display_li(id, qty, ket);
                    }
                }

            },
            complete: function() {
                $.LoadingOverlay("hide");
            }
        });
    }
</script>