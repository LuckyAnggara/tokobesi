<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- script sendiri -->

<script>
    $('#tambah_data').on('click', function() {
        cek();
    })


    function cek() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

            date = mm + '/' + dd + '/' + yyyy;
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastercoh/cek_data'); ?>",
            type: "post",
            data: {
                tanggal: date
            },
            async: false,
            success: function(data) {
                if (data == 0) {
                    $('#add_data').modal('show');
                } else {
                    swal.fire(
                        'Ooopss!',
                        'Anda telah memulai transaksi hari ini',
                        'error'
                    )
                }
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

    var permintaan_cash = document.getElementById('permintaan_cash');
    permintaan_cash.addEventListener('keyup', function(e) {
        permintaan_cash.value = formatRupiah(this.value, 'Rp.');
    });

    $('#add_data').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });

    $('#submitForm').submit(function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("submitForm"));
        $.ajax({
            url: "<?= base_url("manajemen_keuangan/mastercoh/tambah_data"); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#datatable-daftar-gaji').DataTable().ajax.reload();
            }
        })
    })

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

        //Init Datatabel Master Stok Persediaan 
        var table = $('#datatable-master-coh').removeAttr('width').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "processing": true,
            "serverSide": false,
            "fixedColumns": true,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/mastergaji/get_master_gaji/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "id",
                    targets: 0,
                    width: 20,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "tanggal",
                    targets: 1,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "nomor_referensi",
                    targets: 2,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "total_pembayaran",
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
                        return data;
                    }
                }, {
                    data: "status",
                    targets: 5,
                    width: 50,
                    render: function(data, type, full, meta) {
                        if (data == "0") {
                            var display = '<span class="badge badge-dark">Input</span>'
                        } else if (data == "1") {
                            var display = '<span class="badge badge-primary">Waiting Approve</span>'
                        } else if (data == "2") {
                            var display = '<span class="badge badge-success">Dibayarkan</span>'
                        } else if (data == "3") {
                            var display = '<span class="badge badge-warning">Input Ulang</span>'
                        } else if (data == "99") {
                            var display = '<span class="badge badge-danger">Rejected</span>'
                        }
                        return display;
                    }
                },
                {
                    data: {
                        "nomor_referensi": "nomor_referensi",
                        "status": "status"
                    },
                    targets: 6,
                    width: 70,
                    render: function(data, type, full, meta) {
                        var detail = '<a type="button" onClick = "detail_data(\'' + data.nomor_referensi + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-search" ></i> </a>';
                        var edit = '<a type="button" onClick = "edit_data(\'' + data.nomor_referensi + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" ><i class="fa fa-search" ></i> </a>';
                        var del = '<a type="button" onClick = "warning_delete(\'' + data.nomor_referensi + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" ><i class="fa fa-trash" ></i> </a>';
                        var print = '<a type="button" onClick = "print_report(\'' + data.nomor_referensi + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" ><i class="fa fa-print" ></i> </a>';
                        if (data.status == 0) {
                            return edit + ' ' + del;
                        } else if (data.status == 2) {
                            return detail + ' ' + print;
                        } else {
                            return detail
                        }
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

    function detail_data(no_ref) {
        window.location.href = "<?= base_url('manajemen_keuangan/mastergaji/detail_data/'); ?>" + no_ref
    }

    function edit_data(no_ref) {
        window.location.href = "<?= base_url('manajemen_keuangan/mastergaji/edit_data/'); ?>" + no_ref
    }

    function print_report(no_ref) {
        window.location.href = "<?= base_url('laporan/excel/detail_gaji/'); ?>" + no_ref
    }

    function warning_delete(no_ref) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: no_ref + " akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(no_ref);
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(no_ref) {
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastergaji/delete_master_gaji'); ?>",
            type: "post",
            data: {
                no_ref: no_ref
            },
            async: false,
            success: function(data) {
                $('#datatable-master-coh').DataTable().ajax.reload();
            }
        });
    }
</script>