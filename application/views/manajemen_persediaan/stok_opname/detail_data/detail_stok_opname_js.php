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
        init_data($('#nomor_referensi').val());

        init_table($('#nomor_referensi').val());
    })

    function init_data(no_ref) {

        $.ajax({
            url: '<?= base_url("manajemen_persediaan/stokopname/getDetailMasterStokOpname"); ?>',
            type: "POST",
            data: {
                no_ref: no_ref
            },
            dataType: "JSON",
            async: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#tanggal').datepicker("setDate", new Date(data.tanggal));
            },
            complete: function() {
                $.LoadingOverlay("hide");
            }
        });
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

        //Init Datatabel Master Stock Persediaan 
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
                    data: "saldo_fisik",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "selisih",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },

                {
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
            url: '<?= base_url("Manajemen_Persediaan/stokopname/tambah_stokopname"); ?>',
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


<!-- script modal -->

<script>
    function show_modal(id) {
        $("#data_selisih").empty()

        show_detail_selisih_stok_opname(id);
        $('#box_selisih').attr('hidden', false);
        $('html, body').animate({
            scrollTop: $('#box_selisih').offset().top
        }, 'slow', function() {
            $('#box_selisih').focus();
        });
    }


    function show_detail_selisih_stok_opname(id) {
        $.ajax({
            url: '<?= base_url("Manajemen_Persediaan/stokopname/show_detail_selisih_stok_opname"); ?>',
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
            url: '<?= base_url("Manajemen_Persediaan/stokopname/tambah_detail_selisih"); ?>',
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

        var display = '<li id=' + id + ' data-edit="no"><div class="form-group row">' +
            '<div class="col-sm-3">' +
            '<input type="number" id="qty' + id + '"  class="form-control" placeholder="Qty" readonly value="' + qty + '">' +
            '</div>' +
            '<div class="col-sm-6">' +
            '<input type="text" class="form-control"  id="ket' + id + '" placeholder="-" readonly value="' + ket + '">' +
            '</div>' +
            '<div class="col-1">' +
            '<button type="button" onClick="apply_data(\'' + id + '\')" id="btn' + id + '"  class="btn btn-warning waves-effect waves-light"><i class="fa fa-edit"></i></button>' +
            '</div>' +
            '<div class="col-1">' +
            '<button type="button" onClick="remove_data(\'' + id + '\')" class="btn btn-danger waves-effect waves-light"><i class="fa  fa-times"></i></button>' +
            '</div>' +
            '</div></li>';
        $('#data_selisih').append(display)
    }

    function tambah_li(data) {

        var display = '<li id=' + data + ' data-edit="yes"><div class="form-group row">' +
            '<div class="col-sm-3">' +
            '<input type="number" id="qty' + data + '"  class="form-control" placeholder="Qty">' +
            '</div>' +
            '<div class="col-sm-6">' +
            '<input type="text" class="form-control"  id="ket' + data + '" placeholder="Keterangan">' +
            '</div>' +
            '<div class="col-1">' +
            '<button type="button" onClick="apply_data(\'' + data + '\')" id="btn' + data + '" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i></button>' +
            '</div>' +
            '<div class="col-1">' +
            '<button type="button" onClick="remove_data(\'' + data + '\')" class="btn btn-danger waves-effect waves-light"><i class="fa  fa-times"></i></button>' +
            '</div>' +
            '</div></li>';
        $('#data_selisih').append(display)
    }

    function remove_data(id) {
        var id_ref = $('#id').text();
        $.ajax({
            url: '<?= base_url("Manajemen_Persediaan/stokopname/delete_detail_selisih"); ?>',
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
        if ($('#' + id).data('edit') == 'yes') {
            if (qty.val() == "" && ket.val() == "") {
                Swal.fire(
                    'Data belum di isi !',
                    'Silahkan Cek Kembali',
                    'error'
                )
            } else {
                $.ajax({
                    url: '<?= base_url("Manajemen_Persediaan/stokopname/edit_detail_selisih"); ?>',
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
                            var qty = $('#qty' + id);
                            var ket = $('#ket' + id);
                            $(this).empty()
                            $(this).append('<i class="fa fa-edit"></i>')
                            $('#' + id).data('edit', 'no')
                            qty.attr('readonly', true)
                            ket.attr('readonly', true)
                            return $(this).is('.btn-primary, .btn-warning') ? 'btn-primary btn-warning' : 'btn-primary';
                        })

                        $('#detail_sisa_selisih').val($('#detail_qty_selisih').val() - data);
                    },
                    complete: function() {
                        $("#data_selisih").LoadingOverlay("hide");
                    }
                })
            }
        } else {
            $('#btn' + id).toggleClass(function() {
                var qty = $('#qty' + id);
                var ket = $('#ket' + id);
                $(this).empty()
                $(this).append('<i class="fa fa-check"></i>')
                $('#' + id).data('edit', 'yes')
                qty.attr('readonly', false)
                ket.attr('readonly', false)
                return $(this).is('.btn-warning, .btn-primary') ? 'btn-warning btn-primary' : 'btn-warning';
            })
        }
    }
</script>