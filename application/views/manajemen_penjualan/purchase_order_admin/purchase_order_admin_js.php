<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>

<!-- Pusher Notif Sendiri -->
<script src="<?= base_url('assets/'); ?>js/pusher.notif.js"></script>


<!-- Input Mask Js dan Max Length-->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<!-- script init -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tanggal_awal').datepicker({
            autoclose: true,
            todayHighlight: true,
            constrainInput: false,

        });
        $('#tanggal_awal').datepicker("setDate", "01-01-" + new Date().getFullYear());
        $('#tanggal_akhir').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('#tanggal_akhir').datepicker("setDate", "12-31-" + new Date().getFullYear());

        // pusher
    });
</script>


<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {
        var pusher = new Pusher('a198692078b54078587e', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if (data.sales === 'update_po') {
                init_table();
                console.log('awee');
            }
        });
        init_table();

        function init_table(status = null, tanggal_awal = "01-01-" + new Date().getFullYear(), tanggal_akhir = "31-12-" + new Date().getFullYear()) {
            var input = {
                status: status,
                tanggal_awal: tanggal_awal,
                tanggal_akhir: tanggal_akhir
            }

            console.log(input)
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
            var role = "<?php echo $this->session->userdata('role'); ?>";
            if (role == "Direktur") {
                var visible = true
            } else {
                var visible = false
            }
            var table = $('#datatable-daftar-po').DataTable({
                destroy: true,
                paging: true,
                "oLanguage": {
                    sProcessing: "Sabar yah...",
                    sZeroRecords: "Tidak ada Data..."
                },
                "searching": true,
                "processing": true,
                "serverSide": false,
                "ordering": false,
                "ajax": {
                    "url": '<?= base_url("manajemen_penjualan/purchaseorderadmin/getDataPO/"); ?>',
                    "data": input,
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
                        data: "tanggal_input",
                        targets: 1,
                        render: function(data, type, full, meta) {
                            var date = new Date(data);
                            date = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                            return date;
                        }
                    },
                    {
                        data: "no_order",
                        targets: 2,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "pelanggan",
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return data.nama_pelanggan;
                        }
                    },
                    {
                        data: "grand_total",
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var display = formatRupiah(data, 'Rp.');
                            return display;
                        }
                    },
                    {
                        data: "sales",
                        targets: 5,
                        render: function(data, type, full, meta) {
                            return data.nama;
                        }
                    },
                    {
                        data: "status_po",
                        targets: 6,
                        render: function(data, type, full, meta) {
                            if (data == "1") {
                                var display = '<span class="badge badge-primary" >Waiting Approve</span>'
                            } else if (data == "2") {
                                var display = '<span class="badge badge-success" >Approve</span>'
                            } else if (data == "3") {
                                var display = '<span class="badge badge-warning" >Review Sales</span>'
                            } else if (data == "99") {
                                var display = '<span class="badge badge-danger" >Rejected</span>'

                            }
                            return display;
                        }
                    },
                    {
                        data: "admin",
                        targets: 7,
                        render: function(data, type, full, meta) {
                            if (data !== null) {
                                return data.nama
                            } else {
                                return "-";
                            }
                        }
                    },
                    {
                        data: "no_order",
                        targets: 8,
                        render: function(data, type, full, meta) {
                            var display1 = '<a type="button" href="<?= base_url('manajemen_penjualan/purchaseorderadmin/review/'); ?>' + data + '" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Review"><i class="fa fa-sticky-note-o" ></i> </a>';
                            var display2 = '<a type="button" href="<?= base_url('manajemen_penjualan/reviewpurchaseorder/timeline/'); ?>' + data + '" class="btn btn-icon waves-effect waves-light btn-inverse btn-sm" data-toggle="tooltip" data-placement="left" title="Timeline"><i class="fa fa-clock-o"></i> </a>';
                            return display1 + ' ' + display2;
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


        $('#filter').on('click', function() {
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();
            var status_bayar = $('#status_bayar').val();
            init_table(status_bayar, tanggal_awal, tanggal_akhir);
        });
    });
</script>