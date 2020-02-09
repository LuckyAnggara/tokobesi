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
                "url": '<?= base_url("manajemen_persediaan/stockopname/getDataStockOpname"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "data_barang",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data.kode_barang;
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