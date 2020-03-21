<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- script sendiri -->

<script>
    $(document).ready(function() {
        init_table()
        init_table_histori()
        init_table_coh_kasir()
    })
    $('#tambah_data').on('click', function() {
        cek();
    })

    function nl2br(str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }


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
                } else if (data == 2) {
                    swal.fire(
                        'Ooopss!',
                        'Status masih ada yang terbuka',
                        'error'
                    )
                } else if (data == 1) {
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
                $('#datatable-master-coh').DataTable().ajax.reload();
                swal.fire(
                    'Sukses!',
                    '',
                    'success'
                );
                $('#add_data').modal('hide');
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

        var table = $('#datatable-master-coh').DataTable({
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
                "url": '<?= base_url("manajemen_keuangan/mastercoh/get_data_master/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "tanggal",
                    targets: 0,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "saldo_awal",
                    targets: 1,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');
                    }
                }, {
                    data: "saldo_akhir",
                    targets: 2,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');
                    }
                }, {
                    data: "keterangan",
                    targets: 3,
                    width: 400,
                    render: function(data, type, full, meta) {
                        return nl2br(data);
                    }
                }, {
                    data: "status",
                    targets: 4,
                    width: 50,
                    render: function(data, type, full, meta) {
                        if (data == "0") {
                            var display = '<span class="badge badge-primary">Pending</span>'
                        } else if (data == "1") {
                            var display = '<span class="badge badge-success">Open</span>'
                        } else if (data == "2") {
                            var display = '<span class="badge badge-inverse">Close</span>'
                        } else if (data == "4") {
                            var display = '<span class="badge badge-primary">Pending</span>'
                        }
                        return display;
                    }
                },
                {
                    data: {
                        "id": "id",
                        "status": "status"
                    },
                    targets: 5,
                    width: 100,
                    render: function(data, type, full, meta) {
                        var detail = '<a type="button" onClick = "detail_data(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-search" ></i> </a>';
                        var tutup = '<a type="button" onClick = "tutup_data(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-warning btn-sm" ><i class="fa fa-window-close-o" ></i> </a>';
                        var del = '<a type="button" onClick = "warning_delete(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" ><i class="fa fa-trash" ></i> </a>';
                        var print = '<a type="button" onClick = "print_report(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm" ><i class="fa fa-print" ></i> </a>';
                        if (data.status == 0) {
                            return del;
                        } else if (data.status == 1) {
                            return detail + ' ' + tutup;
                        } else if (data.status == 2) {
                            return detail + ' ' + print;
                        } else if (data.status == 4) {
                            return "Tutup Kas";
                        }
                    }
                }
            ],
        });
    }

    function init_table_histori() {
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

        var table = $('#datatable-master-coh-histori').DataTable({
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
                "url": '<?= base_url("manajemen_keuangan/mastercoh/get_data_master_histori/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    targets: 0,
                    width: 20,
                    render: function(data, type, full, meta) {
                        return "";
                    }
                }, {
                    data: "tanggal",
                    targets: 1,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "saldo_awal",
                    targets: 2,
                    width: 150,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');
                    }
                }, {
                    data: "saldo_akhir",
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
                }, {
                    data: "status",
                    targets: 5,
                    width: 50,
                    render: function(data, type, full, meta) {
                        if (data == "0") {
                            var display = '<span class="badge badge-primary">Pending</span>'
                        } else if (data == "1") {
                            var display = '<span class="badge badge-success">Open</span>'
                        } else if (data == "2") {
                            var display = '<span class="badge badge-inverse">Close</span>'
                        } else if (data == "4") {
                            var display = '<span class="badge badge-primary">Pending</span>'
                        }
                        return display;
                    }
                },
                {
                    data: {
                        "id": "id",
                        "status": "status"
                    },
                    targets: 6,
                    width: 100,
                    render: function(data, type, full, meta) {
                        var detail = '<a type="button" onClick = "detail_data(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-search" ></i> </a>';
                        var print = '<a type="button" onClick = "print_report(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm" ><i class="fa fa-print" ></i> </a>';
                        if (data.status == 0) {
                            return del;
                        } else if (data.status == 1) {
                            return detail + ' ' + tutup;
                        } else if (data.status == 2) {
                            return detail + ' ' + print;
                        } else if (data.status == 4) {
                            return "Tutup Kas";
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

    function init_table_coh_kasir() {
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

        var table = $('#datatable-detail-coh-kasir').DataTable({
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
                "url": '<?= base_url("manajemen_keuangan/mastercoh/get_data_master_kasir_aktif/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                data: "nama_kasir",
                targets: 0,
                width: 100,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: "saldo_awal",
                targets: 1,
                width: 150,
                render: function(data, type, full, meta) {
                    return formatRupiah(data, 'Rp.');
                }
            }, {
                data: "saldo_akhir",
                targets: 2,
                width: 150,
                render: function(data, type, full, meta) {
                    return formatRupiah(data, 'Rp.');
                }
            }, {
                data: "status",
                targets: 3,
                width: 50,
                render: function(data, type, full, meta) {
                    if (data == "0") {
                        var display = '<span class="badge badge-primary">Pending</span>'
                    } else if (data == "1") {
                        var display = '<span class="badge badge-success">Open</span>'
                    } else if (data == "2") {
                        var display = '<span class="badge badge-inverse">Close</span>'
                    } else if (data == "4") {
                        var display = '<span class="badge badge-primary">Pending</span>'
                    }
                    return display;
                }
            }, ],
        });
    }

    function detail_data(no_ref) {
        window.location.href = "<?= base_url('manajemen_keuangan/mastercoh/detail_data/'); ?>" + no_ref
    }


    function tutup_data(id) {
        swal.fire({
            title: 'Tutup Kas?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tutup!'
        }).then((result) => {
            if (result.value) {
                tutupData(id)
            }
        });
    }

    function tutupData(id) {
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastercoh/tutup_master_coh'); ?>",
            type: "post",
            data: {
                id: id
            },
            async: false,
            success: function(data) {
                if (data == 0) {
                    $('#datatable-master-coh').DataTable().ajax.reload();
                    swal.fire(
                        'Terkirim!',
                        'Permintaan terkirim ke atasan!',
                        'success'
                    )
                } else if (data == "masih_aktif") {
                    swal.fire(
                        'Oopss!',
                        'Master Cash On Hand Kasir masih Aktif!',
                        'error'
                    );
                } else {
                    swal.fire(
                        'Oopss!',
                        'Masih ada sisa saldo sebesar ' + formatRupiah(data.toString(), 'Rp. '),
                        'error'
                    );
                }

            }
        });
    }

    function warning_delete(id) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(id);

            }
        });
    }

    function deleteData(id) {
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastercoh/delete_master_coh'); ?>",
            type: "post",
            data: {
                id: id
            },
            async: false,
            success: function(data) {
                $('#datatable-master-coh').DataTable().ajax.reload();
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function print_report(id) {
        $.ajax({
            url: "<?= base_url('laporan/cash/laporan_cash_spv/'); ?>" + id,
            // dataType:'json',
            success: function(data) {
                window.open(this.url, '_blank');
            }
        })
    }
</script>