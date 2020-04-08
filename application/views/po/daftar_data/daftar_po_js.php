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
        $('#tambah_data').on('click', function() {
            window.location.href = "<?= base_url('po/pocabang/tambah_data'); ?>"
        })
        init_table();
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

        var table = $('#datatable-daftar-request').DataTable({
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
                "url": '<?= base_url("po/pocabang/get_daftar_request/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    targets: 0,
                    width: 20,
                    render: function(data, type, full, meta) {
                        return "";
                    }
                }, {
                    data: "tanggal_input",
                    targets: 1,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "tanggal_transaksi",
                    targets: 2,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: 'no_order_po',
                    targets: 3,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "status",
                    targets: 4,
                    width: 100,
                    render: function(data, type, full, meta) {
                        if (data == 0) {
                            var display = '<span class="badge badge-warning">Belum Terkirim</span>'
                        } else if (data == 1) {
                            var display = '<span class="badge badge-primary">Terkirim</span>'
                        } else if (data == 2) {
                            var display = '<span class="badge badge-success">Approved</span>'
                        } else if (data == 99) {
                            var display = '<span class="badge badge-danger">Rejected</span>'
                        }
                        return display;
                    }
                },
                {
                    data: {
                        'id': 'id',
                        'no_order_po': 'no_order_po',
                        'cabang': 'cabang',
                        'status': 'status'
                    },
                    targets: 5,
                    width: 100,
                    render: function(data, type, full, meta) {
                        var kirim = '<a type="button" onClick = "kirim(\'' + data.no_order_po + '\',\'' + data.cabang + '\')" class="btn btn-icon waves-effect waves-light btn-primary btn-sm"><i class="fa fa-send" ></i> </a>';
                        var del = '<a type="button" onClick = "warning_delete(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-trash" ></i> </a>';
                        var detail = '<a type="button" onClick = "detail(\'' + data.no_order_po + '\')" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm"><i class="fa fa-print" ></i> </a>';

                        if (data.status == 0) {
                            return kirim + ' ' + del + ' ' + detail
                        } else if (data.status == 1) {
                            return detail
                        } else if (data.status == 2) {
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

        var table = $('#datatable-daftar-receive').DataTable({
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
                "url": '<?= base_url("po/pocabang/get_daftar_receive/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    targets: 0,
                    width: 20,
                    render: function(data, type, full, meta) {
                        return "";
                    }
                }, {
                    data: "tanggal_masuk",
                    targets: 1,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "dari",
                    targets: 2,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: 'no_order_po',
                    targets: 3,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: 'grand_total',
                    targets: 4,
                    width: 100,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "status",
                    targets: 5,
                    width: 100,
                    render: function(data, type, full, meta) {
                        if (data == 0) {
                            var display = '<span class="badge badge-primary">Pending</span>'
                        } else if (data == 2) {
                            var display = '<span class="badge badge-success">Approved</span>'
                        } else if (data == 99) {
                            var display = '<span class="badge badge-danger">Rejected</span>'
                        }
                        return display;
                    }
                },
                {
                    data: {
                        'id': 'id',
                        'dari': 'dari',
                        'no_order_po': 'no_order_po',
                        'status': 'status'
                    },
                    targets: 6,
                    width: 100,
                    render: function(data, type, full, meta) {
                        var approve = '<a type="button" onClick = "approve(\'' + data.id + '\',\'' + data.no_order_po + '\',\'' + data.dari + '\')" class="btn btn-icon waves-effect waves-light btn-primary btn-sm"><i class="fa fa-check" ></i> </a>';
                        var reject = '<a type="button" onClick = "reject(\'' + data.id + '\',\'' + data.no_order_po + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-ban" ></i> </a>';
                        var detail = '<a type="button" onClick = "detail_receive(\'' + data.no_order_po + '\',\'' + data.dari + '\')" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm"><i class="fa fa-print" ></i> </a>';
                        var del = '<a type="button" onClick = "warning_delete(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm"><i class="fa fa-trash" ></i> </a>';

                        if (status == 0) {
                            return approve + ' ' + reject + ' ' + detail;
                        } else if (status == 2) {
                            return detail;
                        } else if (status == 99) {
                            return "";
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

    async function url_tujuan(kode_cabang_tujuan) {
        var result;
        await $.ajax({
            url: 'https://pusat.bbmakmur.com/api/info/kantor/get_url_cabang',
            type: "post",
            data: {
                kode_cabang: kode_cabang_tujuan
            },
            dataType: 'json',
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                result = data;
            }
        })
        return result;
    }

    async function kirim(no_order_po, cabang) {
        var data = {};
        var kode_perusahaan = $('#kode_perusahaan').text();
        var url = await url_tujuan(cabang)
        var aww = await get_data_untuk_dikirim(no_order_po)
        data = aww;
        data['kode_perusahaan'] = kode_perusahaan
        data['tujuan'] = cabang
        console.log(url)
        console.log(aww)
        if (url !== "") {
            await do_kirim(data, url);
            await ubah_status(no_order_po, 1);
            $('#datatable-daftar-request').DataTable().ajax.reload();
        } else {
            Swal.fire(
                'Konseksi Error!',
                'PO belum terkirim, silahkan mengirim ulang di Menu Daftar PO Cabang!',
                'error'
            )
        }

    }

    async function do_kirim(data, url) {
        await $.ajax({
            url: 'https://' + url + '/api/po/receive',
            type: "post",
            data: data,
            success: function(data) {
                if (data == 'sukses') {
                    Swal.fire(
                        'Terikirim!',
                        'Silahkan hubungi tujuan untuk konfirmasi lebih lanjut.',
                        'success'
                    )
                } else if (data == 'ada') {
                    Swal.fire(
                        'Oopss!',
                        'Data sudah terkirim sebelumnya',
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Oopss!',
                        'Silahkan ulangi!',
                        'error'
                    )
                }
            },
            beforeSend: function() {
                $.LoadingOverlay("show", {
                    text: "Proses Kirim Po",
                    image: '',
                });
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            }
        })
    }

    async function get_data_untuk_dikirim(no_order_po) {
        var result = {}
        await $.ajax({
            url: "<?= base_url('po/pocabang/get_data_po'); ?>",
            type: "post",
            dataType: 'json',
            data: {
                no_order_po: no_order_po,
            },
            beforeSend: function() {
                $.LoadingOverlay("show", {
                    image: '',
                    text: "Fetch Detail Purchase Order Nomor : " + no_order_po
                });
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                result['no_order_po'] = data.no_order_po;
                result['tanggal_transaksi'] = data.tanggal_transaksi;
                result['total_pembelian'] = data.total_pembelian;
                result['biaya_lainnya'] = data.biaya_lainnya;
                result['grand_total'] = data.grand_total;
                result['keterangan'] = data.keterangan;
            }
        })
        return result;
    }

    function ubah_status(no_order_po, status) {
        $.ajax({
            url: "<?= base_url('po/pocabang/ubah_status_po'); ?>",
            type: "post",
            dataType: 'json',
            data: {
                status: status,
                no_order_po: no_order_po,
            },
        })
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
                delete_data(id);
            }
        });
    }

    function delete_data(id) {
        $.ajax({
            url: "<?= base_url('po/pocabang/delete_po/'); ?>",
            type: "post",
            data: {
                id: id
            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
                $('#datatable-daftar-request').DataTable().ajax.reload();
            }
        });
    }
</script>
<!-- receive -->
<script>
    async function approve(id, no_order_po, dari) {
        var url = await url_tujuan(dari)
        var data = no_order_po.split("-")
        var no_order_po = data[1]
        console.log(url)
        if (url !== "") {
            await do_approve(no_order_po, url, 2)
            await ubah_status_receive(id, 2)
            $('#datatable-daftar-receive').DataTable().ajax.reload();
        } else {
            Swal.fire(
                'Konseksi Error!',
                'Silahkan Ulangi!',
                'error'
            )
        }
    }

    async function do_approve(no_order_po, url, status) {
        await $.ajax({
            url: 'https://' + url + '/api/po/ubah_status_receive',
            type: "post",
            dataType: 'json',
            data: {
                no_order_po: no_order_po,
                status: status,
            },
            success: function(data) {
                if (data == 'sukses') {
                    Swal.fire(
                        'Approved!',
                        '',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Oopss!',
                        'Silahkan ulangi!',
                        'error'
                    )
                }
                $('#datatable-daftar-request').DataTable().ajax.reload();
                $('#datatable-daftar-receive').DataTable().ajax.reload();

            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            }
        })
    }

    function ubah_status_receive(id, status) {
        $.ajax({
            url: "<?= base_url('po/pocabang/ubah_status_by_id'); ?>",
            type: "post",
            dataType: 'json',
            data: {
                status: status,
                id: id,
            },
        })
    }
</script>

<script>
    async function reject(id, no_order_po, dari) {
        var url = await url_tujuan(dari)
        var data = no_order_po.split("-")
        var no_order_po = data[1]
        console.log(url)
        if (url !== "") {
            await do_reject(no_order_po, url, 99)
            await ubah_status_receive(id, 99)
            $('#datatable-daftar-receive').DataTable().ajax.reload();
        } else {
            Swal.fire(
                'Konseksi Error!',
                'Silahkan Ulangi!',
                'error'
            )
        }
    }

    async function do_reject(no_order_po, url, status) {
        await $.ajax({
            url: 'https://' + url + '/api/po/ubah_status_receive',
            type: "post",
            dataType: 'json',
            data: {
                no_order_po: no_order_po,
                status: status,
            },
            success: function(data) {
                if (data == 'sukses') {
                    Swal.fire(
                        'Rejected!',
                        '',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Oopss!',
                        'Silahkan ulangi!',
                        'error'
                    )
                }
                $('#datatable-daftar-request').DataTable().ajax.reload();
                $('#datatable-daftar-receive').DataTable().ajax.reload();

            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            }
        })
    }
</script>


<!-- detail request -->
<script>
    function detail(no_order_po) {
        window.location.replace("<?= base_url('po/pocabang/detail/'); ?>" + no_order_po)
    }
</script>

<!-- detail request -->
<script>
    async function detail_receive(no_order_po, dari) {
        var url = await url_tujuan(dari)
        var data = no_order_po.split("-")
        var no_order_po = data[1]
        console.log(url)
        if (url !== "") {
            await get_data_recieve(no_order_po, url)
        } else {
            Swal.fire(
                'Konseksi Error!',
                'Silahkan Ulangi!',
                'error'
            )
        }
    }

    async function get_data_recieve(no_order_po, url) {
        await $.ajax({
            url: 'https://' + url + '/api/po/get_data_po',
            type: "post",
            dataType: 'json',
            data: {
                no_order_po: no_order_po,
            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                print_receive(data)
            },
        })
    }

    function print_receive(data) {
        $.ajax({
            url: "<?= base_url('po/pocabang/print_lx_receive/'); ?>",
            type: "post",
            contentType: false,
            data: data,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                window.open(this.url, '_blank');
            },
        })
    }
</script>