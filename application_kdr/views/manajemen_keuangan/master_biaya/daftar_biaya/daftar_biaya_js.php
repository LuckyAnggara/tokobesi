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
<!-- Responsive examples -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>
<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>

<!-- script sendiri -->

<script>
    $(document).ready(function() {
        init_table();
        init_table_histori();
        init_total_biaya()
        init_total_biaya_histori("01/01/" + new Date().getFullYear(), "12/31/" + new Date().getFullYear())
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


    $('#tambah_data').on('click', function() {
        init_kategori();
        set_cash();
        $('#add_data').modal('show');
    })

    $('#filter').on('click', function() {
        var tanggal_awal = $('#tanggal_awal').val();
        var tanggal_akhir = $('#tanggal_akhir').val();
        init_table_histori(tanggal_awal, tanggal_akhir);
        init_total_biaya_histori(tanggal_awal, tanggal_akhir);
    });


    // $('#tambah_data').on('click', function() {
    //     window.location.href = "<?= base_url('manajemen_keuangan/masterbiaya/tambah_data'); ?>"
    // })
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
    var total_biaya = document.getElementById('total_biaya');
    total_biaya.addEventListener('keyup', function(e) {
        total_biaya.value = formatRupiah(this.value, 'Rp.');
    });

    var real_biaya = document.getElementById('real_biaya');
    real_biaya.addEventListener('keyup', function(e) {
        real_biaya.value = formatRupiah(this.value, 'Rp.');
    });


    $('#real_biaya').on('keyup', function() {
        var total_biaya = normalrupiah($('#revisi_total_biaya').val());
        var real_bayar = normalrupiah($('#real_biaya').val())
        var kembali = parseInt(real_bayar) - parseInt(total_biaya);
        if (parseInt(total_biaya) > parseInt(real_bayar)) {
            $('#pengembalian').val(formatRupiah(kembali.toString(), 'Rp.'));
        } else {
            $('#pengembalian').val('Biaya Real lebih besar dari Total Biaya');
        }
    });



    function set_cash() {
        // init data dan label
        $.ajax({
            url: "<?= Base_url('dashboard/laporan_spv'); ?>",
            type: "post",
            dataType: "JSON",
            success: function(data) {
                if (data.cash == null) {
                    $('#saldo_cash').val('Rp. 0')
                } else {
                    $('#saldo_cash').val(formatRupiah(data.cash, 'Rp. '))
                }
            }
        });
    }

    function init_kategori() {
        $('#kategori_biaya').select2({
            dropdownParent: $('#add_data'),
            ajax: {
                url: '<?= base_url("manajemen_keuangan/masterbiaya/get_kategori_biaya/"); ?>',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        query: params.term, // search term
                    };
                },
                processResults: function(data) {
                    var results = [];
                    $.each(data, function(index, item) {
                        results.push({
                            id: item.id,
                            text: item.nama_biaya,
                        });
                    });
                    return {
                        results: results
                    };
                },
            },
        })
    }

    function init_total_biaya(tanggal_awal = null, tanggal_akhir = null) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterbiaya/get_total_biaya"); ?>',
            type: "POST",
            data: {
                tanggal_awal: tanggal_awal,
                tanggal_akhir: tanggal_akhir,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var display = formatRupiah(data.toString(), 'Rp.');
                $('#saldo_akhir').val(display);
            }
        });
    }

    function init_total_biaya_histori(tanggal_awal, tanggal_akhir) {
        $.ajax({
            url: '<?= base_url("manajemen_keuangan/masterbiaya/get_total_biaya"); ?>',
            type: "POST",
            data: {
                tanggal_awal: tanggal_awal,
                tanggal_akhir: tanggal_akhir,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var display = formatRupiah(data.toString(), 'Rp.');
                $('#saldo_akhir_histori').val(display);
            }
        });
    }

    function init_table() {
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

        var table = $('#datatable-daftar-biaya').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "buttons": ['copy', 'excel', 'pdf', 'print'],
            "dom": 'Bfrtip',
            "searching": true,
            "lengthChange": false,
            "responsive": true,
            "processing": true,
            "serverSide": false,
            "fixedColumns": true,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/masterbiaya/get_daftar_biaya_hari_ini/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    targets: 0,
                    width: 20,
                    render: function(data, type, full, meta) {
                        return "";
                    }
                }, {
                    data: "jam",
                    targets: 1,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "nama_biaya",
                    targets: 2,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: {
                        "keterangan": "keterangan",
                        'nomor_jurnal': 'nomor_jurnal'
                    },
                    targets: 3,
                    width: 300,
                    render: function(data, type, full, meta) {
                        return data.keterangan + ' Nomor Jurnal : <span class="text-primary">#' + data.nomor_jurnal + '</span>';
                    }
                }, {
                    data: "total",
                    targets: 4,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');
                    }
                },
                {
                    data: 'id',
                    targets: 5,
                    width: 100,
                    render: function(data, type, full, meta) {
                        var detail = '<a type="button" onClick = "revisi_biaya(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-primary btn-sm"><i class="fa fa-mail-reply" ></i> </a>';
                        var del = '<a type="button" onClick = "warning_delete(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-trash" ></i> </a>';
                        return detail + ' ' + del
                    }
                }
            ],
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

    function init_table_histori(tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
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

        //Init Datatabel Master Stok Persediaan 
        var table = $('#datatable-daftar-biaya-histori').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "buttons": ['copy', 'excel', 'pdf', 'print'],
            "dom": 'Bfrtip',
            "searching": true,
            "lengthChange": false,
            "responsive": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/masterbiaya/get_daftar_biaya_histori/"); ?>',
                "type": "POST",
                'data': input
            },
            "columnDefs": [{
                    data: "jam_tanggal",
                    targets: 0,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "nama_biaya",
                    targets: 1,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: {
                        "keterangan": "keterangan",
                        'nomor_jurnal': 'nomor_jurnal'
                    },
                    targets: 2,
                    width: 300,
                    render: function(data, type, full, meta) {
                        return data.keterangan + ' Nomor Jurnal : <span class="text-primary">#' + data.nomor_jurnal + '</span>';
                    }
                }, {
                    data: "total",
                    targets: 3,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');
                    }
                },
                {
                    data: 'id',
                    targets: 4,
                    width: 100,
                    render: function(data, type, full, meta) {
                        var detail = '<a type="button" onClick = "detail_data(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-mail-reply" ></i> </a>';
                        return ""
                    }
                }
            ]
        });
    }
</script>

<!-- script tambah detail biaya -->
<script>
    $('#add_data').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end();
        $('#kategori_biaya').val(null).trigger('change');
    });

    $(document).ready(function() {
        $('#submitForm').submit(function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById("submitForm"));
            $.ajax({
                url: "<?= Base_url('manajemen_keuangan/masterbiaya/tambah_biaya'); ?>",
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#add_data').LoadingOverlay("show");
                },
                complete: function(data) {
                    $('#add_data').LoadingOverlay("hide");
                },
                success: function(data) {
                    $('#datatable-daftar-biaya').DataTable().ajax.reload();
                    $('#datatable-daftar-biaya-histori').DataTable().ajax.reload();
                    init_total_biaya()
                    init_total_biaya_histori("01/01/" + new Date().getFullYear(), "12/31/" + new Date().getFullYear())
                    $('#add_data').modal('hide');
                    if (data !== 'kurang') {
                        Swal.fire(
                            'Sukses!',
                            '',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Oppss!',
                            'Dana Kurang!',
                            'error'
                        )
                    }
                }
            })
        });
    });
</script>


<!-- edit detail delete -->
<script>
    $('#revisi_data').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end();
        $('#revisi_kategori_biaya').val(null).trigger('change');
    });


    function revisi_biaya(id) {
        set_data_revisi(id);
        $('#revisi_data').modal('show');
    }

    function set_data_revisi(id) {
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/masterbiaya/detail_biaya/'); ?>",
            type: "post",
            data: {
                id: id
            },
            dataType: 'json',
            beforeSend: function() {
                $('#revisi_data').LoadingOverlay("show");
            },
            complete: function(data) {
                $('#revisi_data').LoadingOverlay("hide");
            },
            success: function(data) {
                $('#id_biaya').text(data.id);
                $('#revisi_total_biaya').val(formatRupiah(data.total, 'Rp. '));
                $('#revisi_kategori_biaya').val(data.nama_biaya);
                $('#revisi_keterangan').val(data.ket);
                $('#real_biaya').val(formatRupiah('0', 'Rp. '));
                $('#pengembalian').val(formatRupiah(data.total, 'Rp. '))

            }
        });
    }

    $('#revisiForm').submit(function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("revisiForm"));
        var id = $('#id_biaya').text();
        var ket = $('#pengembalian').val()
        data.append('id', id)
        if (ket !== 'Biaya Real lebih besar dari Total Biaya') {
            $.ajax({
                url: "<?= base_url('manajemen_keuangan/masterbiaya/revisi_biaya/'); ?>",
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#revisi_data').LoadingOverlay("show");
                },
                complete: function(data) {
                    $('#revisi_data').LoadingOverlay("hide");
                },
                success: function(data) {
                    $('#datatable-daftar-biaya').DataTable().ajax.reload();
                    $('#datatable-daftar-biaya-histori').DataTable().ajax.reload();
                    init_total_biaya()
                    init_total_biaya_histori("01/01/" + new Date().getFullYear(), "12/31/" + new Date().getFullYear())
                    $('#revisi_data').modal('hide');
                    Swal.fire(
                        'Sukses!',
                        'Revisi berhasil!',
                        'success'
                    )
                }
            });
        } else {
            swal.fire(
                'Oopss!',
                'Biaya real lebih besar dari Total Biaya!',
                'error'
            )
        }

    });

    function print_report(no_ref) {
        window.location.href = "<?= base_url('laporan/excel/detail_biaya/'); ?>" + no_ref
    }

    function warning_delete(id) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YA!'
        }).then((result) => {
            if (result.value) {
                deleteData(id);
            }
        });
    }

    function deleteData(id) {
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/masterbiaya/delete_biaya/'); ?>",
            type: "post",
            data: {
                id: id
            },
            dataType: 'json',
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                $('#datatable-daftar-biaya').DataTable().ajax.reload();
                $('#datatable-daftar-biaya-histori').DataTable().ajax.reload();
                init_total_biaya()
                init_total_biaya_histori("01/01/" + new Date().getFullYear(), "12/31/" + new Date().getFullYear())
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }
</script>