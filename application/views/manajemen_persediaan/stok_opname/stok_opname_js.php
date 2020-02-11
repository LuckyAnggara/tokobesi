<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- script sendiri -->

<script>
    $('#tambah_data').on('click', function() {
        window.location.href = "<?= base_url('manajemen_persediaan/stokopname/tambah_data'); ?>"
    })
    init_table();


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
        var table = $('#datatable-master-opname').removeAttr('width').DataTable({
            "destroy": true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "serverSide": false,
            scrollY: "400px",

            "fixedColumns": true,
            "ajax": {
                "url": '<?= base_url("manajemen_persediaan/stokopname/getMasterStokOpname/"); ?>',
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
                    data: "keterangan",
                    targets: 3,
                    width: 300,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nomor_referensi",
                    searching: true,
                    targets: 4,
                    width: 70,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_view_modal(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
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

    function show_view_modal(no_ref) {
        window.location.href = "<?= base_url('manajemen_persediaan/stokopname/detail_stokopname/'); ?>" + no_ref
    }
</script>