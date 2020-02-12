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
                "url": '<?= base_url("manajemen_persediaan/reviewstokopname/getMasterStokOpnameSpv/"); ?>',
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
                    width: 200,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }, {
                    data: "status",
                    targets: 4,
                    width: 200,
                    render: function(data, type, full, meta) {
                        if (data == "1") {
                            var display = '<span class="badge badge-primary">Waiting Approve</span>'
                        } else if (data == "2") {
                            var display = '<span class="badge badge-success">Approve</span>'
                        } else if (data == "3") {
                            var display = '<span class="badge badge-warning">Review Sales</span>'
                        } else if (data == "99") {
                            var display = '<span class="badge badge-danger">Rejected</span>'

                        }
                        return display;
                    }
                },
                {
                    data: "nomor_referensi",
                    targets: 5,
                    width: 70,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "detail(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        var display2 = '<a type="button" onClick = "return(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Return Data"><i class="fa fa-share-square-o" ></i> </a>';

                        return display1 + ' ' + display2;

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

    function detail(no_ref) {
        window.location.href = "<?= base_url('manajemen_persediaan/reviewstokopname/review_detail/'); ?>" + no_ref
    }

    function warning_delete(no_ref) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Data Stok Opname dengan Referensi " + no_ref + " akan terhapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(no_ref);
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(no_ref) {
        $.ajax({
            url: "<?= base_url('manajemen_persediaan/stokopname/delete_master_stok_opname'); ?>",
            type: "post",
            data: {
                no_ref: no_ref
            },
            async: false,
            success: function(data) {
                $('#datatable-master-opname').DataTable().ajax.reload();
            }
        });
    }
</script>