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

                //Init Datatabel Master persediaan Persediaan 
                var table = $('#datatable-master-persediaan').DataTable({
                    "oLanguage": {
                        sProcessing: "Sabar yah...",
                        sZeroRecords: "Tidak ada Data..."
                    },
                    "searching": false,
                    "deferRender": true,
                    "order": [],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": '<?= base_url("Manajemen_Barang/MasterPersediaan/getData"); ?>',
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
                            title: "Kode Barang",
                            data: "kode_barang",
                            searching: true,
                            targets: 1,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Nama Barang",
                            data: "nama_barang",
                            searching: true,
                            targets: 2,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Jumlah Persediaan",
                            data: "jumlah_persediaan",
                            searching: true,
                            targets: 3,
                            render: function(data, type, full, meta) {
                                return data;
                            },
                        },
                        {
                            title: "Jumlah di Keranjang",
                            data: "jumlah_persediaan",
                            searching: true,
                            targets: 4,
                            render: function(data, type, full, meta) {
                                return data;
                            },
                        },
                        {
                            title: "Harga Satuan",
                            data: "harga_satuan",
                            searching: true,
                            targets: 5,
                            render: function(data, type, full, meta) {
                                return formatRupiah(data, 'Rp.');
                            }
                        },
                        {
                            title: "Action",
                            data: "kode_barang",
                            searching: true,
                            targets: 6,
                            render: function(data, type, full, meta) {
                                var display = '<a type="button" class="btn btn-icon waves-effect waves-light btn-success btn-sm" href="<?= base_url('Manajemen_Barang/MasterPersediaan/detail_persediaan/'); ?>' + data + '" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i></a>';
                                return display;
                            }
                        }
                    ],
                    "rowCallback": function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });

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

                $('#searchInput').on('keypress', function(e) {
                    var code = e.keyCode || e.which;
                    if (code == 13) {
                        $('#datatable-master-persediaan').DataTable().destroy();
                        var input = $('#searchInput').val();
                        var table = $('#datatable-master-persediaan').DataTable({
                            "oLanguage": {
                                sProcessing: "Sabar yah...",
                                sZeroRecords: "Tidak ada Data..."
                            },
                            "searching": false,
                            "deferRender": true,
                            "order": [],
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": '<?= base_url("Manajemen_Barang/MasterPersediaan/getData/"); ?>' + input,
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
                                    title: "Kode Barang",
                                    data: "kode_barang",
                                    searching: true,
                                    targets: 1,
                                    render: function(data, type, full, meta) {
                                        return data;
                                    }
                                },
                                {
                                    title: "Nama Barang",
                                    data: "nama_barang",
                                    searching: true,
                                    targets: 2,
                                    render: function(data, type, full, meta) {
                                        return data;
                                    }
                                },
                                {
                                    title: "Jumlah Persediaan",
                                    data: "jumlah_persediaan",
                                    searching: true,
                                    targets: 3,
                                    render: function(data, type, full, meta) {
                                        return data;
                                    },
                                },
                                {
                                    title: "Jumlah di Keranjang",
                                    data: "jumlah_persediaan",
                                    searching: true,
                                    targets: 4,
                                    render: function(data, type, full, meta) {
                                        return data;
                                    },
                                },
                                {
                                    title: "Harga Satuan",
                                    data: "harga_satuan",
                                    searching: true,
                                    targets: 5,
                                    render: function(data, type, full, meta) {
                                        return formatRupiah(data, 'Rp.');
                                    }
                                },
                                {
                                    title: "Action",
                                    data: "kode_barang",
                                    searching: true,
                                    targets: 6,
                                    render: function(data, type, full, meta) {
                                        var display = '<a type="button" class="btn btn-icon waves-effect waves-light btn-success btn-sm" href="<?= base_url('Manajemen_Barang/MasterPersediaan/detail_persediaan/'); ?>' + data + '" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i></a>';
                                        return display;
                                    }
                                }
                            ],
                            "rowCallback": function(row, data, iDisplayIndex) {
                                var info = this.fnPagingInfo();
                                var page = info.iPage;
                                var length = info.iLength;
                                var index = page * length + (iDisplayIndex + 1);
                                $('td:eq(0)', row).html(index);
                            }
                        });
                    }
                });
            });
        </script>