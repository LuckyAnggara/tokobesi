<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>
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

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {

        init_table();
        init_nip()
        $('#role').select2({
            dropdownParent: $('#add_modal'),
            placeholder: "Select a state",
            allowClear: true
        });

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
            var table = $('#datatable-master-user').DataTable({
                destroy: true,
                paging: true,
                "oLanguage": {
                    sProcessing: "Sabar yah...",
                    sZeroRecords: "Tidak ada Data..."
                },
                "buttons": ['copy', 'excel', 'pdf', 'print'],
                dom: 'Bfrtip',
                "searching": true,
                "fixedColumns": true,
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": '<?= base_url("manajemen_pegawai/masteruser/getData/"); ?>',
                    "type": "POST",
                },
                "columnDefs": [{
                        data: "username",
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "nama",
                        targets: 1,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "username",
                        targets: 2,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    }, {
                        data: "role",
                        targets: 3,
                        render: function(data, type, full, meta) {
                            switch (data) {
                                case '1':
                                    return "<b>Cashier</b>";
                                    break;
                                case '2':
                                    return "<b>Administrator</b>";
                                    break;
                                case '3':
                                    return "<b>Sales</b>";
                                    break;
                                case '4':
                                    return "<b>Supervisor</b>";
                                    break;
                                case '5':
                                    return "<b>Manager</b>";
                                    break;
                                default:
                                    // code block
                            }
                            return data;
                        }
                    },
                    {
                        data: {
                            "status": "status",
                            "username": "username"
                        },
                        targets: 4,
                        render: function(data, type, full, meta) {
                            if (data.status == 1) {
                                var display = '<a  href="javascript:void(0)" class="badge badge-dark" onClick="force(\'' + data.username + '\')"><span>Login</span></a>';
                            } else {
                                var display = '<a href="javascript:void(0)" class="badge badge-primary"><span>Logout</span></a>';
                            }
                            return display;

                        }
                    }, {
                        data: "isactive",
                        targets: 5,
                        render: function(data, type, full, meta) {
                            if (data == 0) {
                                var display = '<span class="badge badge-danger">Tidak Aktif</span>'
                            } else if (data == "1") {
                                var display = '<span class="badge badge-success" >Aktif</span>'
                            }
                            return display;
                        }
                    },
                    {
                        data: {
                            "username": "username",
                            "isactive": "isactive"
                        },
                        targets: 6,
                        render: function(data, type, full, meta) {
                            var display1 = '<a type="button" onClick = "view_modal(\'' + data.username + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                            var display2 = '<a type="button" onClick = "setActive(\'' + data.username + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-primary btn-sm">Active</a>';
                            var display3 = '<a type="button" onClick = "setInActive(\'' + data.username + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm">inActive</a>';
                            if (data.isactive == "1") {
                                return display1 + " " + display3;
                            } else {
                                return display1 + " " + display2;
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


        function init_nip() {
            $('#nip').select2({
                dropdownParent: $('#add_modal'),
                ajax: {
                    url: '<?= base_url("manajemen_pegawai/masteruser/getDataPegawai/"); ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.nip,
                                text: item.nip + ' - ' + item.nama_lengkap,
                                nama: item.nama_lengkap,
                                kelamin: item.jenis_kelamin
                            });
                        });
                        return {
                            results: results
                        };
                    },
                },
                templateSelection: function(data, container) {
                    // Add custom attributes to the <option> tag for the selected option
                    $(data.element).attr('data-nama', data.nama);
                    return data.text;
                },
                templateResult: formatState
            }).on('select2:select', function(evt) {
                var data = $("#nip option:selected").data('nama');
                $('#nama_pegawai').val(data);
            });
        }

        function init_role() {

        }

        function formatState(data) {
            if (data.kelamin == 0) {
                var kelamin = "<i class='mdi mdi-human-male'> " + data.id + ' - ' + data.nama + "</i>"
            } else {
                var kelamin = "<i class='mdi mdi-human-female'> " + data.id + ' - ' + data.nama + "</i>"
            }
            var $display = $(kelamin);

            return $display;
        };




    });
</script>

<!-- tambah data -->
<script>
    $('#add_modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        $('#nip').val(null).trigger('change');
        $('#role').val(1).trigger('change')
    });

    $('#view_modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        $('#view_role').val(1).trigger('change')
    });

    $('#submitForm').submit(function(e) {
        e.preventDefault();
        $.LoadingOverlay("show");
        var data = new FormData(document.getElementById("submitForm"));
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masteruser/tambahuser'); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#datatable-master-user').DataTable().ajax.reload();
                $('#add_modal').modal('hide');
                Swal.fire(
                    'Sukses!',
                    'User telah di buat, silahkan untuk login!.',
                    'success'
                );
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
    });
</script>

<!-- view modal set Aktif Tidak Aktif -->

<script>
    function view_modal(data) {
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masteruser/getdatauser'); ?>",
            type: "post",
            dataType: 'json',
            data: {
                username: data
            },
            async: false,
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#view_nip').val(data.nip);
                $('#view_username').val(data.username);
                $('#view_role').val(data.role).trigger('change')
                $('#view_nama_pegawai').val(data.nama);
                $('#view_modal').modal('show');
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
    }

    function setActive(data) {
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masteruser/setactive'); ?>",
            type: "post",
            data: {
                username: data
            },
            async: false,
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#datatable-master-user').DataTable().ajax.reload();
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
    }

    function setInActive(username) {
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masteruser/setinactive'); ?>",
            type: "post",
            data: {
                username: username
            },
            async: false,
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#datatable-master-user').DataTable().ajax.reload();
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
    }

    $('#reset_pw').on('click', function() {
        var data = new FormData(document.getElementById("viewForm"));
        swal.fire({
            title: 'Reset Password?',
            text: "Password akan di ubah ke Default",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!'
        }).then((result) => {
            if (result.value) {
                reset(data);

            }
        });
    });

    function reset(data) {
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masteruser/resetpassword'); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                swal.fire(
                    'Reset!',
                    'Password telah di Reset!',
                    'success'
                )
            }
        })
    }
</script>

<!-- force logout -->

<script>
    function force(data) {
        if (data == 1) {
            swal.fire({
                title: 'Force Logout?',
                text: "User akan di logout dari sistem",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!'
            }).then((result) => {
                if (result.value) {
                    logout(data);
                }
            });
        }

    }

    function logout(username) {
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masteruser/forcelogout'); ?>",
            type: "post",
            data: {
                username: username
            },
            async: false,
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#datatable-master-user').DataTable().ajax.reload();

            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
    }
</script>