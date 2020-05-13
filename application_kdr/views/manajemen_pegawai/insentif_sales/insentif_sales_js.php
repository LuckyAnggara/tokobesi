<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {

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
            var table = $('#datatable-insentif-sales').DataTable({
                destroy: true,
                paging: true,
                "oLanguage": {
                    sProcessing: "Sabar yah...",
                    sZeroRecords: "Tidak ada Data..."
                },
                "searching": true,
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": '<?= base_url("manajemen_pegawai/insentifsales/getData/"); ?>',
                    "type": "POST",
                },
                "columnDefs": [{
                        data: "id",
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "tanggal",
                        targets: 1,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "nomor_faktur",
                        targets: 2,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    }, {
                        data: "nama_sales",
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "gross_penjualan",
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data, 'Rp.');
                            return display;
                        }
                    }, {
                        data: "total_insentif",
                        targets: 5,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data, 'Rp.');
                            return display;
                        }
                    },
                    {
                        data: "status",
                        targets: 6,
                        render: function(data, type, full, meta) {
                            if (data == "0") {
                                var display = '<span class="badge badge-primary">Waiting Approve</span>'
                            } else if (data == "1") {
                                var display = '<span class="badge badge-success">Approve</span>'
                            } else if (data == "99") {
                                var display = '<span class="badge badge-danger">Reject</span>'
                            }
                            return display;
                        }
                    },
                    {
                        data: {
                            "id": "id",
                            "status": "status"
                        },
                        targets: 7,
                        render: function(data, type, full, meta) {
                            var approve = '<a type="button" onClick = "approve(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-primary btn-sm">Approve</a>';
                            var reject = '<a type="button" onClick = "reject(\'' + data.id + '\')" class="btn btn-icon waves-effect waves-light btn-danger btn-sm">Reject</a>';
                            if (data.status == "1" || data.status == "99") {
                                return ""
                            } else {
                                return approve + ' ' + reject;
                            }
                        }
                    }
                ],
                "deferRender": true,
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

    function approve(id) {
        console.log(id);
        swal.fire({
            title: 'Approve Insentif?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, proses!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= Base_url('manajemen_pegawai/insentifsales/approveinsentif'); ?>",
                    type: "post",
                    data: {
                        id: id
                    },
                    async: false,
                    cache: false,
                    success: function(data) {
                        if (data !== "sukses") {
                            swal.fire(
                                'Oopss!',
                                'ada trouble silahkan di coba lagi',
                                'error'
                            )

                        } else {
                            $('#datatable-insentif-sales').DataTable().ajax.reload();
                            swal.fire(
                                'Approve!',
                                '',
                                'success'
                            )
                        }

                    }
                })
            }
        });
    }

    function reject(id) {
        console.log(id);
        swal.fire({
            title: 'Reject Insentif?',
            text: "Reject Insentif Sales?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, proses!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= Base_url('manajemen_pegawai/insentifsales/rejectinsentif'); ?>",
                    type: "post",
                    data: {
                        id: id
                    },
                    async: false,
                    cache: false,
                    success: function(data) {
                        if (data !== "sukses") {
                            swal.fire(
                                'Oopss!',
                                'ada trouble silahkan di coba lagi',
                                'error'
                            )
                        } else {
                            $('#datatable-insentif-sales').DataTable().ajax.reload();
                            swal.fire(
                                'Reject!',
                                '',
                                'success'
                            )
                        }

                    }
                })
            }
        });
    }

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
</script>