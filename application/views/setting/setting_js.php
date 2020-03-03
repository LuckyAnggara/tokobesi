<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- XEditable Plugin -->
<script src="<?= base_url('assets/'); ?>plugins/moment/moment.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<!-- <script type="text/javascript" src="<?= base_url('assets/'); ?>pages/jquery.xeditable.js"></script> -->

<!-- Init Data -->
<script>
    $(document).ready(function() {
        setData();

        $('#edit_gambar').dropify({
            messages: {
                'default': 'Drag dan drop Bukti Barang disini',
                'replace': 'Drag dan drop Bukti untuk mengganti',
                'remove': 'Hapus',
                'error': 'Ooops, terjadi sesuatu, silahkan coba lagi.',
            },
            tpl: {
                clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
            },
            error: {
                'fileSize': 'File terlalu besar (5 Mb max).',
                'imageFormat': 'Format Gambar tidak Support, hanya ({{ value }} saja).'
            }
        });

        $('#edit_gambar_modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $('.dropify-clear').click();
        });


        $('#edit_gambar_button').on('click', function() {
            $('#edit_gambar_modal').modal('show');
        });
    })
</script>
<script>
    $(function() {
        //modify buttons style
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
            '<button type="button" class="btn btn-secondary editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';

        //Inline editables
        $('.edit_input').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            type: 'text',
            pk: 1,
            mode: 'inline'
        });

        $('.edit_number').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            type: 'number',
            pk: 1,
            step: 'any',
            mode: 'inline'
        });

        $('#inline-firstname').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            mode: 'inline'
        });

        $('.edit_textarea').editable({
            type: 'textarea',
            pk: 1,
            mode: 'inline'
        });

        $('#nomor_faktur').editable({
            type: 'select',
            mode: 'inline',
            source: [{
                    value: 1,
                    text: 'Nomor Acak'
                },
                {
                    value: 2,
                    text: 'Nomor Urut'
                }, {
                    value: 3,
                    text: 'Tanggal + Nomor Urut'
                },
            ]
        });

        $('#password_harga').editable({
            type: 'select',
            mode: 'inline',
            source: [{
                    value: 5,
                    text: 'Manager'
                },
                {
                    value: 4,
                    text: 'Supervisor'
                }
            ]
        });

        $('#notifikasi').editable({
            type: 'checklist',
            mode: 'inline',
            source: [{
                    value: 1,
                    text: 'Alert Hutang'
                },
                {
                    value: 2,
                    text: 'Alert Piutang'
                },
                {
                    value: 3,
                    text: 'Transaksi Penjualan'
                },
                {
                    value: 4,
                    text: 'Minimum Stock Barang'
                }
            ]
        });
    })
</script>

<!-- Apply Change -->
<script>
    $('#submitForm').submit(function(e) {
        e.preventDefault();
        // var data = new FormData(document.getElementById("submitForm"));
        var input = $('.edit_input, .edit_textarea, #prefix_nomor, .edit_number, #notifikasi').editable('getValue');
        console.log(input);

        swal.fire({
            title: 'Apa anda yakin?',
            text: "Setting aplikasi akan di ubah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                confirm_setting()
            }
        });
    });

    function confirm_setting() {
        var data = $('.edit_input, .edit_textarea, #prefix_nomor, .edit_number, #notifikasi, #nomor_faktur, #password_harga').editable('getValue');
        $.ajax({
            url: '<?= base_url("setting/setting/confirmSetting/"); ?>',
            type: "POST",
            data: data,
            beforeSend: function() {
                $("#data_selisih").LoadingOverlay("show");
            },
            success: function(data) {
                setData();
                Swal.fire(
                    'Sukses!',
                    'Silahkan refresh Browser!.',
                    'success'
                );
            },
            complete: function() {
                $("#data_selisih").LoadingOverlay("hide");
            }
        });
    }


    function setData() {
        $.ajax({
            url: '<?= base_url("setting/setting/getData/"); ?>',
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#nama_perusahaan').editable('setValue', data.nama_perusahaan)
                $('#alamat_perusahaan').editable('setValue', data.alamat_perusahaan)
                $('#nomor_telepon').editable('setValue', data.nomor_telepon)
                $('#nomor_fax').editable('setValue', data.nomor_fax)
                $('#alamat_email').editable('setValue', data.alamat_email)
                $('#gambar_logo').attr('src', '<?= base_url('assets/images/'); ?>' + data.logo_perusahaan)

                $('#prefix_faktur').editable('setValue', data.prefix_faktur)
                $('#nomor_faktur').editable('setValue', data.nomor_faktur)
                $('#catatan_faktur_cash').editable('setValue', data.catatan_faktur_cash)
                $('#catatan_faktur_kredit').editable('setValue', data.catatan_faktur_kredit)
                $('#catatan_retur_jual').editable('setValue', data.catatan_retur_jual)
                $('#catatan_retur_beli').editable('setValue', data.catatan_retur_beli)
                $('#prefix_example').text(data.prefix_faktur)
                setnomorfaktur(data.nomor_faktur)

                $('#password_harga').editable('setValue', data.password_harga)
                $('#komisi_sales').editable('setValue', data.komisi_sales)
                $('#threshold_bonus').editable('setValue', data.threshold_bonus)

                $('#frekuensi_notifikasi').editable('setValue', data.frekuensi_notifikasi)

                var notifikasi = data.notifikasi.split(',')

                $('#notifikasi').editable('setValue', notifikasi)


            }
        });
    }

    $('#prefix_faktur').on('save', function(e, params) {
        $('#prefix_example').text(params.newValue);
    });

    $('#nomor_faktur').on('save', function(e, params) {
        setnomorfaktur(params.newValue)
    });

    function setnomorfaktur(id) {
        $.ajax({
            url: '<?= base_url("setting/faktur/set_dummy/"); ?>',
            type: "post",
            data: {
                id: id,
            },
            cache: false,
            async: false,
            success: function(data) {
                console.log(data);
                $('#prefix_nomor_example').text(data);
            }
        })
    }
</script>

<!-- EDIT GAMBAR -->

<script>
    // Upload Gambar
    $('#edit_gambar_form').submit(function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("edit_gambar_form"));
        $.ajax({
            url: '<?= base_url("setting/setting/SetGambarBaru/"); ?>',
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#edit_gambar_modal').modal('hide');
                setGambarBaru();
            }
        })
    });

    function setGambarBaru() {
        $.ajax({
            url: '<?= base_url("setting/setting/GetGambarBaru/"); ?>',
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#gambar_logo').fadeOut(1000, function() {
                    $('#gambar_logo').attr('src', "<?= base_url('assets/images/'); ?>" + data.value)
                    $('#gambar_logo').fadeIn(2000);
                });
                Swal.fire(
                    'Sukses!',
                    'Gambar telah di ubah.',
                    'success'
                );
            }
        });

    }
</script>