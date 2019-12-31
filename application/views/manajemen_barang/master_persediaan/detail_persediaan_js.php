        <!-- Required datatable js -->
        <script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

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
                //Init Datatabel Data Supplier per Barang 
                var table = $('#datatable-data-supplier').DataTable({
                    "oLanguage": {
                        sProcessing: "Sabar yah...",
                        sZeroRecords: "Tidak ada Data..."
                    },
                    // "scrollY": "400px",
                    // "scrollX": false,
                    "scrollCollapse": false,
                    "lengthChange": false,
                    "searching": false,
                    "paging": false,
                    "info": false,
                    "ordering": false,
                    "searching": false,
                    "deferRender": true,
                    "order": [],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": '<?= base_url("manajemen_barang/MasterPersediaan/getData"); ?>',
                        "type": "POST",
                    },
                    "columnDefs": [{
                            title: "No",
                            data: "id",
                            searching: true,
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Kode Supplier",
                            data: "kode_barang",
                            searching: true,
                            targets: 1,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Nama Supplier",
                            data: "nama_barang",
                            searching: true,
                            targets: 2,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Jumlah Tersupply",
                            data: "nama_barang",
                            searching: true,
                            targets: 3,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                    ],
                    "rowCallback": function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>