<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
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
        var table = $('#datatable-stok-opname').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?= base_url("manajemen_persediaan/stokopname/getDataStokOpname/"); ?>' + no_ref,
                "type": "POST",
            },
            "columnDefs": [{
                    data: "id",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "data_barang",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data.kode_barang + ' - ' + data.nama_barang;
                    }
                }, {
                    data: "data_barang",
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data.nama_satuan;
                    }
                }, {
                    data: "saldo_buku",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: {
                        "id": "id",
                        "saldo_buku": "saldo_buku",
                        "saldo_fisik": "saldo_fisik",
                    },
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var display = '<a class="btn" onClick="fisik_modal(\'' + data.id + '\',\'' + data.saldo_fisik + '\',\'' + data.saldo_buku + '\')"><span>' + data.saldo_fisik + '</span></a>';
                        return display;
                    }
                }, {
                    data: "selisih",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "id",
                    searching: true,
                    targets: 6,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_modal(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        return display1;
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
</script>


<!-- Script Membuat Master dan Detail nya -->

<script>
    function tambah_master(no_ref, tanggal, ket) {
        $.ajax({
            url: '<?= base_url("manajemen_persediaan/stokopname/tambah_stokopname"); ?>',
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
</script>
<!-- Script Button Type -->
<script>
    $('#proses_stokopname').on('click', function() {
        var no_ref = $('#nomor_referensi');
        var tanggal = $('#tanggal');
        var ket = $('#keterangan').val();
        if (no_ref.val() !== "" && tanggal.val() !== "") {
            $('#button_data_div').attr('hidden', false);
            $('#confirm').attr('hidden', false);
            no_ref.attr('readonly', true);
            tanggal.attr('readonly', true);
            $('#proses_stokopname').attr('hidden', true)
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
            url: '<?= base_url("manajemen_persediaan/stokopname/random_ref/"); ?>',
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#nomor_referensi').val(data);
            }
        });
    })

    $('#download_format').on('click', function() {
        window.location.href = '<?= base_url("Laporan/excel/stokopname/"); ?>' + $('#nomor_referensi').val();
    })

    $('#upload').on('click', function() {

        var nomor_referensi = $('#nomor_referensi').val();
        var data = new FormData(document.getElementById("upload_form"));
        data.append('nomor_referensi', nomor_referensi);
        $.ajax({
            url: "<?= Base_url('manajemen_persediaan/stokopname/import_data/'); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#datatable-stok-opname').DataTable().ajax.reload();
            }
        })
        // } else {
        //     Swal.fire(
        //         'Data Stok Opname belum di isi !',
        //         'Silahkan Cek Kembali',
        //         'error'
        //     )
        // }
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

<!-- operator -->
<script>
    $('#add_data').on('click', function(e) {
        e.preventDefault();
        var id = $('#id').text();
        $.ajax({
            url: '<?= base_url("manajemen_persediaan/stokopname/tambah_detail_selisih"); ?>',
            type: "POST",
            data: {
                id: id
            },
            dataType: "JSON",
            async: false,
            beforeSend: function() {
                $("#data_selisih").LoadingOverlay("show");
            },
            success: function(data) {
                tambah_li(data);
            },
            complete: function() {
                $("#data_selisih").LoadingOverlay("hide");
            }
        });

    })

    function display_li(id, qty, ket) {

        if ($('#confirm').text() == "Reject" || $('#confirm').text() == "Waiting Approve") {
            var display = '<li id=' + id + ' data-delete="yes"><div class="form-group row">' +
                '<div class="col-sm-3">' +
                '<input type="number" id="qty' + id + '"  class="form-control" placeholder="Qty" readonly value="' + qty + '">' +
                '</div>' +
                '<div class="col-sm-7">' +
                '<input type="text" class="form-control"  id="ket' + id + '" placeholder="-" readonly value="' + ket + '">' +
                '</div>' +
                '<div class="col-1">' +
                '<button  disabled type="button" onClick="remove_data(\'' + id + '\')" class="btn btn-danger waves-effect waves-light"><i class="fa  fa-times"></i></button>' +
                '</div>' +
                '</div></li>';
        } else {
            var display = '<li id=' + id + ' data-delete="yes"><div class="form-group row">' +
                '<div class="col-sm-3">' +
                '<input type="number" id="qty' + id + '"  class="form-control" placeholder="Qty" readonly value="' + qty + '">' +
                '</div>' +
                '<div class="col-sm-7">' +
                '<input type="text" class="form-control"  id="ket' + id + '" placeholder="-" readonly value="' + ket + '">' +
                '</div>' +
                '<div class="col-1">' +
                '<button type="button" onClick="remove_data(\'' + id + '\')" class="btn btn-danger waves-effect waves-light"><i class="fa  fa-times"></i></button>' +
                '</div>' +
                '</div></li>';
        }


        $('#data_selisih').append(display)
    }

    function tambah_li(data) {

        var display = '<li id=' + data + ' data-delete="no"><div class="form-group row">' +
            '<div class="col-sm-3">' +
            '<input type="number" id="qty' + data + '"  class="form-control" placeholder="Qty">' +
            '</div>' +
            '<div class="col-sm-7">' +
            '<input type="text" class="form-control"  id="ket' + data + '" placeholder="-" >' +
            '</div>' +
            '<div class="col-1">' +
            '<button type="button" onClick="apply_data(\'' + data + '\')" id="btn' + data + '" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i></button>' +
            '</div></li>';
        $('#data_selisih').append(display)
    }

    function remove_data(id) {
        var id_ref = $('#id').text();
        $.ajax({
            url: '<?= base_url("manajemen_persediaan/stokopname/delete_detail_selisih"); ?>',
            type: "POST",
            data: {
                id_ref: id_ref,
                id: id
            },
            dataType: "JSON",
            async: false,
            beforeSend: function() {
                $("#data_selisih").LoadingOverlay("show");
            },
            success: function(data) {
                $('#' + id).remove()
                $('#detail_sisa_selisih').val($('#detail_qty_selisih').val() - data);
            },
            complete: function() {
                $("#data_selisih").LoadingOverlay("hide");
            }
        })
    }

    function apply_data(id) {
        var qty = $('#qty' + id);
        var ket = $('#ket' + id);
        var id_ref = $('#id').text();
        var selisih = $('#detail_sisa_selisih').val();

        if ($('#' + id).data('delete') == 'no') {
            if (qty.val() == "" && ket.val() == "") {
                Swal.fire(
                    'Data belum di isi !',
                    'Silahkan Cek Kembali',
                    'error'
                )
            } else {
                if (qty.val() <= parseInt(selisih)) {

                    $.ajax({
                        url: '<?= base_url("manajemen_persediaan/stokopname/edit_detail_selisih"); ?>',
                        type: "POST",
                        data: {
                            id_ref: id_ref,
                            id: id,
                            qty: qty.val(),
                            ket: ket.val(),
                        },
                        dataType: "JSON",
                        async: false,
                        beforeSend: function() {
                            $("#data_selisih").LoadingOverlay("show");
                        },
                        success: function(data) {
                            $('#btn' + id).toggleClass(function() {
                                $(this).empty()
                                $(this).append('<i class="fa fa-times"></i>')
                                $('#' + id).data('delete', 'yes')
                                qty.attr('readonly', true)
                                ket.attr('readonly', true)
                                return $(this).is('.btn-primary, .btn-danger') ? 'btn-primary btn-danger' : 'btn-primary';
                            })

                            $('#detail_sisa_selisih').val($('#detail_qty_selisih').val() - data);
                        },
                        complete: function() {
                            $("#data_selisih").LoadingOverlay("hide");
                        }
                    })
                } else {
                    Swal.fire(
                        'Jumlah input lebih besar dari sisa selisih !',
                        'Silahkan Cek Kembali',
                        'error'
                    )
                }

            }
        } else {
            remove_data(id);
        }
    }

    $(document).ready(function() {
        $('#saldoFisikForm').submit(function(e) {
            e.preventDefault();
            id = $('#fisik_id').text();
            var data = new FormData(document.getElementById("saldoFisikForm"));
            data.append('id', id);
            $.ajax({
                url: "<?= base_url("manajemen_persediaan/stokopname/tambah_saldo_fisik"); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#fisik_modal').modal('hide');
                    $('#datatable-stok-opname').DataTable().ajax.reload();
                }
            })
        })
    })

    $('#confirm').on('click', function() {
        Swal.fire({
            title: 'Kirim ke Supervisor?',
            text: "Data Stok Opname akan di kirim ke SPV untuk persetujuan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim!'
        }).then((result) => {
            if (result.value) {
                proses_spv()
            }
        })
    })

    function proses_spv() {
        var no_ref = $('#nomor_referensi').val();
        var tanggal = $('#keterangan').val();
        if (no_ref == "" && tanggal == "") {
            Swal.fire(
                'Data masih Kosong !',
                'Silahkan Cek Kembali',
                'error'
            )
        } else {
            $.ajax({
                url: "<?= base_url("manajemen_persediaan/stokopname/proses_spv"); ?>",
                type: 'post',
                data: {
                    no_ref: no_ref,
                    keterangan: $('#keterangan').val(),
                    tanggal: tanggal,
                },
                async: false,
                success: function(data) {
                    $('#confirm').toggleClass(function() {
                        $('#confirm').text('Waiting Approve');
                        $('#confirm').attr('disabled', true);
                        $('.btn').attr('disabled', true);
                        return $(this).is('.btn-success, .btn-primary') ? 'btn-success btn-primary' : 'btn-success';
                    })
                }
            })
        }

    }
</script>