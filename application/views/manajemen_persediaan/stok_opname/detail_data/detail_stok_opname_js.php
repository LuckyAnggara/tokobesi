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
        var table = $('#datatable-stock-opname').DataTable({
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
            url: '<?= base_url("Manajemen_Persediaan/stockopname/tambah_stokopname"); ?>',
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
        $('#box_selisih').attr('hidden', false);
        $('html, body').animate({
            scrollTop: $('#box_selisih').offset().top
        }, 'slow', function() {
            $('#box_selisih').focus();
        });
    }

    $('#add_data').on('click', function(e) {
        e.preventDefault();
        var display = '<li><div class="form-group row">' +
            '<div class="col-sm-2">' +
            '<input type="text" class="form-control" placeholder="Qty">' +
            '</div>' +
            '<div class="col-sm-8">' +
            '<input type="text" class="form-control" placeholder="Keterangan">' +
            '</div>' +
            '<div class="col-1">' +
            '<button type="button" id="add_data" class="btn btn-primary waves-effect waves-light"><i class="fa fa-check"></i></button>' +
            '</div>' +
            '</div></li>';
        $('#data_selisih').append(display)
    })
</script>