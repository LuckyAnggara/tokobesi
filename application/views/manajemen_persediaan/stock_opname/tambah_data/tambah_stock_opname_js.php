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
                "url": '<?= base_url("manajemen_persediaan/stockopname/getDataStockOpname/"); ?>' + no_ref,
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
                    data: "data_barang",
                    searching: true,
                    targets: 6,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_view_modal(\'' + data.kode_barang + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
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
<!-- Script Button Type -->
<script>
    $('#proses_stokopname').on('click', function() {
        var no_ref = $('#nomor_referensi');
        var tanggal = $('#tanggal');
        var ket = $('#keterangan').val();
        if (no_ref.val() !== "" && tanggal.val() !== "") {
            $('#button_data_div').attr('hidden', false);
            tambah_master(no_ref.val(), tanggal.val(), ket)
            init_table(no_ref.val());
            no_ref.attr('readonly', true);
            tanggal.attr('readonly', true);
            $('#proses_stokopname').attr('hidden', true);
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
            url: '<?= base_url("Manajemen_Persediaan/stockopname/random_ref/"); ?>',
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
        console.log($('#upload_data')[0].files.length)
        if ($('#upload_data').get(0).files.length !== 0) {
            var nomor_referensi = $('#nomor_referensi').val();
            var data = new FormData(document.getElementById("upload_form"));
            data.append('nomor_referensi', nomor_referensi);
            $.ajax({
                url: "<?= Base_url('Manajemen_Persediaan/stockopname/import_data/'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-stock-opname').DataTable().ajax.reload();
                }
            })
        } else {
            Swal.fire(
                'Data Stok Opname belum di isi !',
                'Silahkan Cek Kembali',
                'error'
            )
        }


    })
</script>