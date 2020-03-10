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
    })

    function nl2br(str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
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


    $('#add_data').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });



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

        var table = $('#datatable-master-permintaan-coh').DataTable({
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
                "url": '<?= base_url("manajemen_keuangan/mastercoh/get_data_master_permintaan/"); ?>',
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
                data: "nama_pegawai",
                targets: 2,
                width: 100,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: "nominal",
                targets: 3,
                width: 150,
                render: function(data, type, full, meta) {
                    return formatRupiah(data, 'Rp.');
                }
            }, {
                data: "jenis_permintaan",
                targets: 4,
                width: 150,
                render: function(data, type, full, meta) {
                    if (data == 1) {
                        var display = "Permintaan Dana";
                    } else if (data == 2) {
                        var display = "Penyetoran Dana"
                    } else if (data == 0) {
                        var display = "Cash awal hari"
                    } else if (data == 3) {
                        var display = "Buka Kas"
                    } else if (data == 5) {
                        var display = "Tutup Kas"
                    }
                    return display;
                }
            }, {
                data: "status",
                targets: 5,
                width: 50,
                render: function(data, type, full, meta) {
                    if (data == "1") {
                        var display = '<span class="badge badge-primary">Pending</span>'
                    } else if (data == "2") {
                        var display = '<span class="badge badge-success">Approve</span>'
                    } else if (data == "99") {
                        var display = '<span class="badge badge-danger">Reject</span>'

                    }
                    return display;
                }
            }, {
                data: {
                    "id": "id",
                    "nomor_referensi": "nomor_referensi",
                    "nominal": "nominal",
                    "jenis_permintaan": "jenis_permintaan",
                    "status": "status"
                },
                targets: 6,
                width: 50,
                render: function(data, type, full, meta) {

                    var approve = '<a type="button" onClick = "approve_data(\'' + data.id + '\', \'' + data.nomor_referensi + '\',  \'' + data.nominal + '\',  \'' + data.jenis_permintaan + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-check" ></i> </a>';
                    var reject = '<a type="button" onClick = "reject_data(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" ><i class="fa fa-times-rectangle" ></i> </a>';

                    if (data.status == 1) {
                        return approve + ' ' + reject;
                    } else {
                        return "";
                    }
                }
            }],
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

    function approve_data(id, no_ref, nominal, jenis_permintaan) {
        swal.fire({
            title: 'Approve?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('manajemen_keuangan/mastercoh/manajer_approve_coh'); ?>",
                    type: "post",
                    data: {
                        id: id,
                        no_ref: no_ref,
                        jenis: jenis_permintaan,
                        nominal: nominal
                    },
                    async: false,
                    success: function(data) {
                        if (data == 'sukses') {
                            swal.fire(
                                'Approved!',
                                '',
                                'success'
                            )
                        } else {
                            swal.fire(
                                'Rejected!',
                                '',
                                'success'
                            )
                        }
                        $('#datatable-master-permintaan-coh').DataTable().ajax.reload();
                    }
                });

            }
        });
    }

    function reject_data(id) {
        swal.fire({
            title: 'Reject?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('manajemen_keuangan/mastercoh/manajer_reject_coh'); ?>",
                    type: "post",
                    data: {
                        id: id
                    },
                    async: false,
                    success: function(data) {
                        if (data == 'sukses') {
                            swal.fire(
                                'Approved!',
                                '',
                                'success'
                            )
                        } else {
                            swal.fire(
                                'Rejected!',
                                '',
                                'success'
                            )
                        }
                        $('#datatable-master-permintaan-coh').DataTable().ajax.reload();
                    }
                });

            }
        });
    }
</script>