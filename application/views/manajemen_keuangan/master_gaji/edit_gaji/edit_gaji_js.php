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
        init_edit_data();

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
                selector: 'td:first-child',
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
                    var display = '<a class="btn" onClick="gaji_pokok_modal(\'' + data.id + '\')"><span>' + angka + '</span></a>';
                    return display;
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
                    var angka = formatRupiah(data.uang_makan.toString(), 'Rp.');
                    var display = '<a class="btn" onClick="uang_makan_modal(\'' + data.id + '\')"><span>' + angka + '</span></a>';
                    return display;
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
                    var angka = formatRupiah(data.bonus.toString(), 'Rp.');
                    var display = '<a class="btn" onClick="bonus_modal(\'' + data.id + '\')"><span>' + angka + '</span></a>';
                    return display;
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

        });
    }


    $('#confirm').on('click', function() {
        var table = $('#datatable-daftar-gaji').DataTable();
        var data = table.rows('.selected').data();
        if (data.length > 0) {
            var no_ref = $('#nomor_referensi').val();
            var total_pembayaran = 0;
            var id = {};
            var output = [];
            $.each(data, function(index, item) {
                total_pembayaran += parseInt(item.total)
                output.push(item.id);
                console.log(item.id);
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
        } else {
            Swal.fire(
                'Oopps!!',
                'Belum ada data yang di Pilih',
                'error'
            )
        }

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
            success: function(data) {
                $('.btn').attr('hidden', true);
                setTimeout(function() {
                    window.location.href = "<?= base_url('manajemen_keuangan/mastergaji/detail_data/'); ?>" + no_ref
                }, 3000);
                Swal.fire(
                    'Terbayarkan !',
                    '',
                    'success'
                ).then((result) => {
                    window.location.href = "<?= base_url('manajemen_keuangan/mastergaji/detail_data/'); ?>" + no_ref
                });
            },
            complete: function() {
                $.LoadingOverlay("hide");
            }
        });
    }
</script>
<!-- Script Init Edit Type -->
<script>
    function init_edit_data() {
        var no_ref = $('#nomor_referensi');
        var tanggal = $('#tanggal');
        var ket = $('#keterangan');
        $('#button_data_div').attr('hidden', false);
        $('#confirm').attr('hidden', false);
        no_ref.attr('readonly', true);
        tanggal.attr('readonly', true);
        ket.attr('readonly', true);
        $('#proses_init_data').attr('hidden', true)
        tambah_master(no_ref.val(), tanggal.val(), ket.text())
        init_table(no_ref.val());;
    }

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
    function gaji_pokok_modal(id) {
        $('#id_gaji_pokok').text(id);
        $('#gaji_pokok_modal').modal('show');
    }

    function uang_makan_modal(id) {
        $('#id_uang_makan').text(id);
        $('#uang_makan_modal').modal('show');
    }

    function bonus_modal(id) {
        $('#id_bonus').text(id);
        $('#bonus_modal').modal('show');
    }
    $('#gaji_pokok_form').submit(function(e) {
        e.preventDefault();
        id = $('#id_gaji_pokok').text();
        var data = new FormData(document.getElementById("gaji_pokok_form"));
        data.append('id', id);
        $.ajax({
            url: "<?= base_url("manajemen_keuangan/mastergaji/ubah_gaji_pokok"); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#gaji_pokok_modal').modal('hide');
                $('#datatable-daftar-gaji').DataTable().ajax.reload();
            }
        })
    })
    $('#uang_makan_form').submit(function(e) {
        e.preventDefault();
        id = $('#id_uang_makan').text();
        var data = new FormData(document.getElementById("uang_makan_form"));
        data.append('id', id);
        $.ajax({
            url: "<?= base_url("manajemen_keuangan/mastergaji/ubah_uang_makan"); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#uang_makan_modal').modal('hide');
                $('#datatable-daftar-gaji').DataTable().ajax.reload();
            }
        })
    })
    $('#bonus_form').submit(function(e) {
        e.preventDefault();
        id = $('#id_bonus').text();
        var data = new FormData(document.getElementById("bonus_form"));
        data.append('id', id);
        $.ajax({
            url: "<?= base_url("manajemen_keuangan/mastergaji/ubah_bonus"); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#bonus_modal').modal('hide');
                $('#datatable-daftar-gaji').DataTable().ajax.reload();
            }
        })
    })

    var gaji_pokok = document.getElementById('gaji_pokok');
    gaji_pokok.addEventListener('keyup', function(e) {
        var data = $('#gaji_pokok').val();
        gaji_pokok.value = formatRupiah(this.value, 'Rp. ');
    });

    var uang_makan = document.getElementById('uang_makan');
    uang_makan.addEventListener('keyup', function(e) {
        var data = $('#uang_makan').val();
        uang_makan.value = formatRupiah(this.value, 'Rp. ');
    });

    var bonus = document.getElementById('bonus');
    bonus.addEventListener('keyup', function(e) {
        var data = $('#bonus').val();
        bonus.value = formatRupiah(this.value, 'Rp. ');
    });

    $('#gaji_pokok_modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });

    $('#uang_makan_modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });

    $('#bonus_modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });
</script>