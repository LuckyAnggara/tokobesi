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
        if (status == 2) {
            $('.btn').attr('disabled', true);
        }
        var no_ref = $('#nomor_referensi').text();
        init_table(no_ref)
        init_table_permintaan(no_ref)
        init_table_pending(no_ref)
        init_jumlah_permintaan(no_ref)
        init_jumlah_pending(no_ref)
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
            "paging": true,
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
                    if (data.jenis == 1 || data.jenis == 4) {
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
                    if (data.jenis == 2 || data.jenis == 3) {
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

    function init_table_permintaan(no_ref) {
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
        var tanggal = $('#tanggal').val();
        var table = $('#datatable-daftar-permintaan').DataTable({
            "destroy": true,
            "oLanguage": {
                "sProcessing": "Sabar yah...",
                "sZeroRecords": "Tidak ada Data..."
            },
            "searching": true,
            "fixedColumns": true,
            "scrollCollapse": true,
            "processing": true,
            "serverSide": false,
            "ordering": true,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/mastercoh/get_data_permintaan_spv/"); ?>',
                "type": "POST",
                "data": {
                    tanggal: tanggal,
                    no_ref: no_ref
                }
            },
            "columnDefs": [{
                data: "jam",
                targets: 0,
                width: 10,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: "nama_pegawai",
                targets: 1,
                width: 50,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: "jenis_permintaan",
                targets: 2,
                width: 100,
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
                data: "nominal",
                targets: 3,
                width: 75,
                render: function(data, type, full, meta) {
                    return formatRupiah(data, 'Rp.');
                }
            }, {
                data: "status",
                targets: 4,
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
                    "nomor_referensi_spv": "nomor_referensi_spv",
                    "nomor_referensi": "nomor_referensi",
                    "nominal": "nominal",
                    "jenis_permintaan": "jenis_permintaan",
                    "status": "status",
                    "nama_pegawai": "nama_pegawai"
                },
                targets: 5,
                width: 50,
                render: function(data, type, full, meta) {

                    var approve = '<a type="button" onClick = "approve_data(\'' + data.id + '\', \'' + data.nomor_referensi + '\',  \'' + data.nomor_referensi_spv + '\', \'' + data.nominal + '\',  \'' + data.jenis_permintaan + '\',  \'' + data.nama_pegawai + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm"><i class="fa fa-check" ></i> </a>';
                    var reject = '<a type="button" onClick = "reject_data(\'' + data.id + '\', \'' + data.nomor_referensi + '\',  \'' + data.nomor_referensi_spv + '\', \'' + data.nominal + '\',  \'' + data.jenis_permintaan + '\',  \'' + data.nama_pegawai + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" ><i class="fa fa-times-rectangle" ></i> </a>';

                    if (data.status == 1) {
                        return approve + ' ' + reject;
                    } else {
                        return "";
                    }
                }
            }],
        });
    }

    function init_table_pending(no_ref) {
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
        var tanggal = $('#tanggal').val();
        var table = $('#datatable-daftar-pending').DataTable({
            "destroy": true,
            "oLanguage": {
                "sProcessing": "Sabar yah...",
                "sZeroRecords": "Tidak ada Data..."
            },
            "searching": true,
            "fixedColumns": true,
            "scrollCollapse": true,
            "processing": true,
            "serverSide": false,
            "ordering": true,
            "ajax": {
                "url": '<?= base_url("manajemen_keuangan/mastercoh/get_data_pending/"); ?>',
                "type": "POST",
                "data": {
                    tanggal: tanggal,
                    no_ref: no_ref
                }
            },
            "columnDefs": [{
                data: "jam",
                targets: 0,
                width: 10,
                render: function(data, type, full, meta) {
                    return data;
                }
            }, {
                data: "jenis_permintaan",
                targets: 1,
                width: 300,
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
                data: "nominal",
                targets: 2,
                width: 100,
                render: function(data, type, full, meta) {
                    return formatRupiah(data, 'Rp.');
                }
            }, {
                data: "status",
                targets: 3,
                width: 20,
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
                    "status": "status"
                },
                targets: 4,
                width: 50,
                render: function(data, type, full, meta) {
                    var del = '<a type="button" onClick = "delete_data_permintaan(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" ><i class="fa fa-times-rectangle" ></i> </a>';
                    if (data.status == 1) {
                        return del;
                    } else {
                        return "";
                    }
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
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#tarik_modal').LoadingOverlay("show");
            },
            complete: function(data) {
                $('#tarik_modal').LoadingOverlay("hide");
            },
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
                $('#datatable-daftar-pending').DataTable().ajax.reload();

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
                'Nominal setor lebih besar dari Dana di tangan!',
                'error'
            )
        } else {

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
                    $('#datatable-daftar-pending').DataTable().ajax.reload();
                    $('#setor_modal').modal('hide');
                }
            })
        }
    })
</script>


<!-- Delete Data Permintaan -->
<script>
    function delete_data_permintaan(id) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.value) {
                deleteData(id);

            }
        });
    }

    function deleteData(id) {
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastercoh/delete_permintaan'); ?>",
            type: "post",
            data: {
                id: id
            },
            async: false,
            success: function(data) {
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
                $('#datatable-daftar-pending').DataTable().ajax.reload();
            }
        });
    }

    async function approve_data(id, no_ref, no_ref_spv, nominal, jenis_permintaan, nama_pegawai) {
        const {
            value: password
        } = await Swal.fire({
            title: 'Input Password',
            input: 'password',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Approve !'
        })
        if (password) {
            $.ajax({
                url: "<?= base_url('manajemen_keuangan/mastercoh/supervisor_approve_coh'); ?>",
                type: "post",
                data: {
                    id: id,
                    no_ref_spv: no_ref_spv,
                    no_ref: no_ref,
                    jenis: jenis_permintaan,
                    nominal: nominal,
                    password: password,
                    nama_pegawai: nama_pegawai
                },
                beforeSend: function() {
                    $.LoadingOverlay("show");
                },
                complete: function(data) {
                    $.LoadingOverlay("hide");
                },
                success: function(data) {
                    if (data == 'sukses') {
                        swal.fire(
                            'Approved!',
                            '',
                            'success'
                        )
                    } else if (data == 'salah') {
                        swal.fire(
                            'Oppss!',
                            'Password salah!',
                            'error'
                        )

                    } else {
                        swal.fire(
                            'Oppss!',
                            'Error, silahkan ulangi',
                            'error'
                        )
                    }
                    $('#datatable-detail-coh').DataTable().ajax.reload();
                    $('#datatable-daftar-permintaan').DataTable().ajax.reload();
                    $('#datatable-daftar-pending').DataTable().ajax.reload();
                    saldo_refresh()
                }
            });
        }
    }

    async function reject_data(id, no_ref, no_ref_spv, nominal, jenis_permintaan, nama_pegawai) {
        const {
            value: password
        } = await Swal.fire({
            title: 'Input Password',
            input: 'password',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reject !'
        })
        if (password) {
            $.ajax({
                url: "<?= base_url('manajemen_keuangan/mastercoh/supervisor_reject_coh'); ?>",
                type: "post",
                data: {
                    id: id,
                    no_ref_spv: no_ref_spv,
                    no_ref: no_ref,
                    jenis: jenis_permintaan,
                    nominal: nominal,
                    password: password,
                    nama_pegawai: nama_pegawai
                },
                beforeSend: function() {
                    $.LoadingOverlay("show");
                },
                complete: function(data) {
                    $.LoadingOverlay("hide");
                },
                success: function(data) {
                    if (data == 'sukses') {
                        swal.fire(
                            'Rejected!',
                            '',
                            'success'
                        )
                    } else if (data == 'salah') {
                        swal.fire(
                            'Oppss!',
                            'Password salah!',
                            'error'
                        )

                    } else {
                        swal.fire(
                            'Oppss!',
                            'Error, silahkan ulangi',
                            'error'
                        )
                    }
                    $('#datatable-detail-coh').DataTable().ajax.reload();
                    $('#datatable-daftar-permintaan').DataTable().ajax.reload();
                    $('#datatable-daftar-pending').DataTable().ajax.reload();
                    saldo_refresh()
                }
            });
        }
    }


    // function reject_data(id) {
    //     swal.fire({
    //         title: 'Reject?',
    //         text: "",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes!'
    //     }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 url: "<?= base_url('manajemen_keuangan/mastercoh/supervisor_reject_coh'); ?>",
    //                 type: "post",
    //                 data: {
    //                     id: id
    //                 },
    //                 beforeSend: function() {
    //                     $.LoadingOverlay("show");
    //                 },
    //                 complete: function(data) {
    //                     $.LoadingOverlay("hide");
    //                 },
    //                 success: function(data) {
    //                     if (data == 'sukses') {
    //                         swal.fire(
    //                             'Rejected!',
    //                             '',
    //                             'success'
    //                         )
    //                     } else {
    //                         swal.fire(
    //                             'Oopss!',
    //                             '',
    //                             'error'
    //                         )
    //                     }

    //                 }
    //             });
    //         }
    //     });
    // }
</script>

<!-- menghitung jumlah pending dan permintaan -->
<script>
    function init_jumlah_pending(no_ref) {
        var tanggal = $('#tanggal').val();
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastercoh/get_jumlah_data_pending'); ?>",
            type: "post",
            data: {
                tanggal: tanggal,
                no_ref: no_ref
            },
            async: false,
            success: function(data) {
                var jumlah_pending = $('#jumlah_pending')
                jumlah_pending.text(data);
            }
        });
    }


    function init_jumlah_permintaan(no_ref) {
        var tanggal = $('#tanggal').val();
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastercoh/get_jumlah_data_permintaan'); ?>",
            type: "post",
            data: {
                tanggal: tanggal,
                no_ref: no_ref
            },
            async: false,
            success: function(data) {
                var jumlah_permintaan = $('#jumlah_permintaan')
                jumlah_permintaan.text(data);
            }
        });
    }

    function saldo_refresh(no_ref) {
        var no_ref = $('#nomor_referensi').text();
        $.ajax({
            url: "<?= base_url('manajemen_keuangan/mastercoh/saldo_akhir'); ?>",
            type: "post",
            dataType: 'json',
            data: {
                no_ref: no_ref
            },
            beforeSend: function() {
                $('#saldo_akhir').LoadingOverlay("show");
            },
            complete: function(data) {
                $('#saldo_akhir').LoadingOverlay("hide");
            },
            success: function(data) {
                $('#saldo_akhir').val(formatRupiah(data.toString(), 'Rp.'))
            }
        });
    }
</script>