        <!-- Tree view js -->
        <script src="<?= base_url('assets/'); ?>plugins/jstree/jstree.min.js"></script><!-- DatePicker Js -->
        <script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#tanggal').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    orientation: "bottom left",
                });
                init_treeview();
                init_data();
            })

            function init_data() {
                var no_ref = $('#nomor_referensi').val()
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
                        // if (data.status == 1) {
                        //     $('#confirm').toggleClass(function() {
                        //         $('#confirm').text('Send');
                        //         $('#confirm').attr('disabled', true);
                        //         $('#keterangan').attr('disabled', true);
                        //         $('#tanggal').attr('disabled', true);
                        //         return $(this).is('.btn-success, .btn-dark') ? 'btn-success btn-dark' : 'btn-success';
                        //     })
                        // }
                        $('#keterangan').val(data.keterangan);
                        $('#tanggal').datepicker("setDate", new Date(data.tanggal));
                    },
                    complete: function() {
                        $.LoadingOverlay("hide");
                    }
                });
            }

            function init_treeview() {
                var no_ref = $('#nomor_referensi').val()
                $.ajax({
                    url: "<?= base_url('manajemen_persediaan/reviewstokopname/treeview'); ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        no_ref: no_ref
                    },
                    async: false,
                    success: function(data) {
                        $('#ajaxTree').jstree({
                            'core': {
                                'check_callback': true,
                                'themes': {
                                    'responsive': false
                                },
                                'data': data
                            },
                            "types": {
                                'default': {
                                    'icon': 'fa fa-sticky-note-o'
                                },
                                'file': {
                                    'icon': 'fa fa-file'
                                }
                            },
                            "plugins": [
                                "contextmenu",
                                "dnd",
                                "search",
                                "state",
                                "types",
                                "wholerow"
                            ]
                        });
                    }
                });
            }
        </script>