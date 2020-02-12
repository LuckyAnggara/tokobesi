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
                "url": '<?= base_url("manajemen_persediaan/stokopname/getMasterStokOpnameUser/"); ?>',
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
                    data: {
                        "nomor_referensi": "nomor_referensi",
                        "status": "status"
                    },
                    targets: 4,
                    width: 70,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_view_modal(\'' + data.nomor_referensi + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        var display2 = '<a type="button" onClick = "warning_delete(\'' + data.nomor_referensi + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Delete Data"><i class="fa fa-trash" ></i> </a>';
                        var display3 = '<span class="badge badge-warning" >Waiting</span>'
                        if (data.status == 0) {
                            return display1 + ' ' + display2;

                        } else if (data.status == 1) {
                            return display1 + ' ' + display3;
                        } else {
                            return display1
                        }
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