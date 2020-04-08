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

<!-- Form wizard -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<!-- Smart Wizard -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-smartwizard/jquery.smartwizard.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {
        setting_awal();
        init_table();
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
            var table = $('#datatable-master-pegawai').DataTable({
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
                    "url": '<?= base_url("manajemen_pegawai/masterpegawai/getData/"); ?>',
                    "type": "POST",
                },
                "columnDefs": [{
                        data: "nip",
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "nip",
                        targets: 1,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    },
                    {
                        data: "nama_lengkap",
                        targets: 2,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    }, {
                        data: "jenis_kelamin",
                        targets: 3,
                        render: function(data, type, full, meta) {
                            if (data == 0) {
                                return "Pria"
                            } else {
                                return "Wanita"
                            }
                        }
                    },
                    {
                        data: "tanggal",
                        targets: 4,
                        render: function(data, type, full, meta) {
                            return data
                        }
                    },
                    {
                        data: "pendidikan_terakhir",
                        targets: 5,
                        render: function(data, type, full, meta) {
                            return data
                        }
                    }, {
                        data: "jabatan",
                        targets: 6,
                        render: function(data, type, full, meta) {
                            return data
                        }
                    },
                    {
                        data: {
                            "status": "status",
                            "nip": "nip"
                        },
                        targets: 7,
                        render: function(data, type, full, meta) {
                            if (data.status == 1) {
                                var display = '<a  href="javascript:void(0)" class="badge badge-primary"><span>Aktif</span></a>';
                            } else {
                                var display = '<a  href="javascript:void(0)" class="badge badge-danger"><span>Tidak Aktif</span></a>';
                            }
                            return display;
                        }
                    },
                    {
                        data: {
                            "nip": "nip",
                            "status": "status"
                        },
                        targets: 8,
                        render: function(data, type, full, meta) {
                            var display1 = '<a type="button" onClick = "view_modal(\'' + data.nip + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                            var display2 = '<a type="button" onClick = "setActive(\'' + data.nip + '\')"  class="btn btn-icon waves-effect waves-light btn-primary btn-sm">Active</a>';
                            var display3 = '<a type="button" onClick = "setInActive(\'' + data.nip + '\')"  class="btn btn-icon waves-effect waves-light btn-danger btn-sm">inActive</a>';
                            if (data.status == "1") {
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

        function init_role() {}

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

<!-- init setting awal -->
<script>
    function setting_awal() {

        $('#tanggal_lahir').datepicker({
            autoclose: true,
        });
        $('#tanggal_masuk').datepicker({
            autoclose: true,
            todayHighlight: true,
            constrainInput: false,

        });
    }
</script>

<script>
    $(document).ready(function() {

        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Submit')
            .addClass('btn btn-success')
            .on('click', function(e) {
                e.preventDefault();
                if (!$(this).hasClass('disabled')) {
                    var elmForm = $("#submitForm");
                    if (elmForm) {
                        elmForm.validator('validate');
                        var elmErr = elmForm.find('.has-error');
                        if (elmErr && elmErr.length > 0) {
                            Swal.fire(
                                'Oopss!',
                                'Data masih ada yang kosong',
                                'error'
                            )
                            return false;
                        } else {
                            tambah_data();
                            // elmForm.submit();
                            return false;
                        }
                    }
                }
            });
        var btnCancel = $('<button></button>').text('Batal')
            .addClass('btn btn-danger')
            .on('click', function() {
                $('#smartwizard').smartWizard("reset");
                $('#submitForm').find("input, textarea").val("");
                $('#add_modal').modal('hide');
            });



        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'arrows',
            useURLhash: false,
            backButtonSupport: true,
            showStepURLhash: false,
            transitionEffect: 'fade',
            toolbarSettings: {
                toolbarPosition: 'bottom',
                toolbarExtraButtons: [btnFinish, btnCancel]
            },
            anchorSettings: {
                markDoneStep: true, // add done css
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            }
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmForm = $("#form-step-" + stepNumber);
            // stepDirection === 'forward' :- this condition allows to do the form validation
            // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
            if (stepDirection === 'forward' && elmForm) {
                elmForm.validator('validate');
                var elmErr = elmForm.children('.has-error');
                if (elmErr && elmErr.length > 0) {
                    // Form validation failed
                    return false;
                }
            }
            return true;
        });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // Enable finish button only on last step
            if (stepNumber == 3) {
                $('.btn-finish').removeClass('disabled');
            } else {
                $('.btn-finish').addClass('disabled');
            }
        });

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
        $('#rootwizard').bootstrapWizard({
            firstSelector: 'wizard li.first'
        })
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

    function tambah_data() {
        var data = new FormData(document.getElementById("submitForm"));
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/tambahdatapegawai'); ?>",
            type: "post",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                if (data == "duplikat") {
                    Swal.fire(
                        'Oopss!',
                        'Duplikat Nomor Induk Pegawai',
                        'error'
                    )
                } else {
                    $('#datatable-master-pegawai').DataTable().ajax.reload();
                    $('#add_modal').modal('hide');
                    Swal.fire(
                        'Success!',
                        'Data pegawai baru telah di tambahkan',
                        'success'
                    )
                }

            }
        })
    }
</script>

<!-- view modal set Aktif Tidak Aktif -->

<script>
    function view_modal(data) {
        window.location.href = "<?php echo base_url('manajemen_pegawai/masterpegawai/detail_pegawai/'); ?>" + data;
    }

    function setActive(nip) {
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/setactive'); ?>",
            type: "post",
            data: {
                nip: nip
            },
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#datatable-master-pegawai').DataTable().ajax.reload();
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
    }

    function setInActive(nip) {
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/setinactive'); ?>",
            type: "post",
            data: {
                nip: nip
            },
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#datatable-master-pegawai').DataTable().ajax.reload();
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
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/resetpassword'); ?>",
            type: "post",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
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
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#datatable-master-pegawai').DataTable().ajax.reload();
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
    }
</script>