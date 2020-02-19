<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/jquery-mask/jquery.mask.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chartjs/chart.bundle.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>



<!-- script Uploader -->
<script type="text/javascript">
    $('#gambar').dropify({
        messages: {
            'default': 'Drag dan drop Gambar Barang disini',
            'replace': 'Drag dan drop gambar untuk mengganti',
            'remove': 'Hapus',
            'error': 'Ooops, terjadi sesuatu, silahkan coba lagi.'
        },
        error: {
            'fileSize': 'File terlalu besar (3 Mb max).',
            'imageFormat': 'Format Gambar tidak Support, hanya ({{ value }} saja).'
        }
    });
    $('#edit_gambar').dropify({
        messages: {
            'default': 'Drag dan drop Gambar Barang disini',
            'replace': 'Drag dan drop gambar untuk mengganti',
            'remove': 'Hapus',
            'error': 'Ooops, terjadi sesuatu, silahkan coba lagi.'
        },
        error: {
            'fileSize': 'File terlalu besar (3 Mb max).',
            'imageFormat': 'Format Gambar tidak Support, hanya ({{ value }} saja).'
        },
    });
</script>


<script>
    $(document).ready(function() {
        $('#edit_gambar_modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });
    });
</script>


<!-- Tampilkan Modal Edit Gambar -->

<script>
    $(document).ready(function() {
        $('#edit_gambar_button').on('click', function() {
            $('#edit_gambar_modal').modal('show');
        });

        // Upload Gambar
        $('#edit_gambar_form').submit(function(e) {
            e.preventDefault();
            var nip = $('#nip').val();
            var data = new FormData(document.getElementById("edit_gambar_form"));
            data.append('nip', nip);
            $.ajax({
                url: '<?= base_url("manajemen_pegawai/masterpegawai/SetGambarBaru/"); ?>' + nip,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#edit_gambar_modal').modal('hide');
                    setGambarBaru(nip);
                }
            })
        });

        function setGambarBaru(nip) {
            $.ajax({
                url: '<?= base_url("manajemen_pegawai/masterpegawai/GetGambarBaru/"); ?>' + nip,
                type: "POST",
                dataType: "JSON",
                async: false,
                success: function(data) {
                    $('#gambar_pegawai').fadeOut(2000, function() {
                        // $('#gambar_pegawai').remove();
                        // display = '<img id="gambar_pegawai" src="<?= base_url('assets/images/pegawai/'); ?>' + data.gambar + '" class="img-thumbnail" alt="profile-image">';
                        $('#gambar_pegawai').attr('src', "<?= base_url('assets/images/pegawai/'); ?>" + data.gambar)
                        // $('#div_gambar').append(display)
                        $('#gambar_pegawai').fadeIn(2000);
                    });
                    Swal.fire(
                        'Sukses!',
                        'Gambar telah di ubah.',
                        'success'
                    );
                }
            });

        }
    });
</script>


<!-- Trigger Edit Button -->

<script>
    $(document).ready(function() {
        // trigger button umum di click
        var edit_button_umum = $('#edit_trigger_umum');
        var edit_button_umum_div = $('#edit_button_umum_div');
        var edit_batal_umum = $('#edit_batal_umum');
        var edit_button_alamat = $('#edit_trigger_alamat');
        var edit_button_alamat_div = $('#edit_button_alamat_div');
        var edit_batal_alamat = $('#edit_batal_alamat');
        var edit_button_pekerjaan = $('#edit_trigger_pekerjaan');
        var edit_button_pekerjaan_div = $('#edit_button_pekerjaan_div');
        var edit_batal_pekerjaan = $('#edit_batal_pekerjaan');
        var edit_button_lainnya = $('#edit_trigger_lainnya');
        var edit_button_lainnya_div = $('#edit_button_lainnya_div');
        var edit_batal_lainnya = $('#edit_batal_lainnya');

        // UMUM - CLICK EDIT
        edit_button_umum.on('click', function() {
            edit_button_umum_div.attr("hidden", false);
            edit_button_umum.attr("hidden", true);
            set_readonly('umum', false);
        });
        // UMUM - CLICK BATAL
        edit_batal_umum.on('click', function() {
            edit_button_umum_div.attr("hidden", true);
            edit_button_umum.attr("hidden", false);
            set_readonly('umum', true);
        });

        // ALAMAT- CLICK EDIT
        edit_button_alamat.on('click', function() {
            edit_button_alamat_div.attr("hidden", false);
            edit_button_alamat.attr("hidden", true);
            set_readonly('alamat', false);
        });
        // ALAMAT- CLICK BATAL
        edit_batal_alamat.on('click', function() {
            edit_button_alamat_div.attr("hidden", true);
            edit_button_alamat.attr("hidden", false);
            set_readonly('alamat', true);
        });

        // PEKERJAAN - CLICK EDIT
        edit_button_pekerjaan.on('click', function() {
            edit_button_pekerjaan_div.attr("hidden", false);
            edit_button_pekerjaan.attr("hidden", true);
            set_readonly('pekerjaan', false);
        });
        // PEKERJAAN - CLICK BATAL
        edit_batal_pekerjaan.on('click', function() {
            edit_button_pekerjaan_div.attr("hidden", true);
            edit_button_pekerjaan.attr("hidden", false);
            set_readonly('pekerjaan', true);
        });

        // LAINNYA - CLICK EDIT
        edit_button_lainnya.on('click', function() {
            edit_button_lainnya_div.attr("hidden", false);
            edit_button_lainnya.attr("hidden", true);
            set_readonly('lainnya', false);
        });
        // LAINNYA - CLICK BATAL
        edit_batal_lainnya.on('click', function() {
            edit_button_lainnya_div.attr("hidden", true);
            edit_button_lainnya.attr("hidden", false);
            set_readonly('lainnya', true);
        });
        // Fungsi Set Kolom Jadi Not Readonly
    });

    function set_readonly(div, bol) {
        if (div == "umum") {
            if (bol == false) {
                $('#ktp').attr("readonly", bol);
                $('#nama_lengkap').attr("readonly", bol);
                $('#tanggal_lahir').attr("disabled", bol);
                $('#jenis_kelamin').attr("disabled", bol);
                $('#pendidikan_terakhir').attr("readonly", bol);
            } else {
                $('#ktp').attr("readonly", bol);
                $('#nama_lengkap').attr("readonly", bol);
                $('#tanggal_lahir').attr("disabled", bol);
                $('#jenis_kelamin').attr("disabled", bol);
                $('#pendidikan_terakhir').attr("readonly", bol);
            }
        } else if (div == "alamat") {
            if (bol == false) {
                $('#alamat').attr("readonly", bol);
                $('#kelurahan').attr("readonly", bol);
                $('#kecamatan').attr("readonly", bol);
                $('#kota').attr("readonly", bol);
            } else {
                $('#alamat').attr("readonly", bol);
                $('#kelurahan').attr("readonly", bol);
                $('#kecamatan').attr("readonly", bol);
                $('#kota').attr("readonly", bol);
            }
        } else if (div == "pekerjaan") {
            if (bol == false) {
                $('#jabatan').attr("readonly", bol);
                $('#tanggal_masuk').attr("disabled", bol);
            } else {
                $('#jabatan').attr("readonly", bol);
                $('#tanggal_masuk').attr("disabled", bol);
            }
        } else if (div == "lainnya") {
            if (bol == false) {
                $('#nomor_telepon').attr("readonly", bol);
                $('#nomor_rekening').attr("readonly", bol);
                $('#nama_bank').attr("readonly", bol);
                $('#npwp').attr("readonly", bol);
            } else {
                $('#nomor_telepon').attr("readonly", bol);
                $('#nomor_rekening').attr("readonly", bol);
                $('#nama_bank').attr("readonly", bol);
                $('#npwp').attr("readonly", bol);
            }
        }
    }
</script>
<!-- Set Data Ke Tampilan -->




<!-- init datepicker--->
<script>
    $(document).ready(function() {
        $('#tanggal_lahir').datepicker({
            autoclose: true,
        });
        $('#tanggal_masuk').datepicker({
            autoclose: true,
        });
    });
</script>

<script>
    $('#form_umum').submit(function(e) {
        var nip = $('#nip').val();
        e.preventDefault();
        warning_edit_umum(nip);
    });

    $('#form_alamat').submit(function(e) {
        var nip = $('#nip').val();
        e.preventDefault();
        warning_edit_alamat(nip);
    });

    $('#form_pekerjaan').submit(function(e) {
        var nip = $('#nip').val();
        e.preventDefault();
        warning_edit_pekerjaan(nip);
    });

    $('#form_lainnya').submit(function(e) {
        var nip = $('#nip').val();
        e.preventDefault();
        warning_edit_lainnya(nip);
    });


    function warning_edit_umum(nip) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "Data pegawai akan di berubah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                edit_data_umum(nip);
            }
        });
    }

    function edit_data_umum(nip) {
        var data = new FormData(document.getElementById("form_umum"));
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/edit_data_umum/'); ?>" + nip,
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#edit_button_umum_div').attr("hidden", true);
                $('#edit_trigger_umum').attr("hidden", false);
                set_readonly('umum', true);
                swal.fire(
                    'Edited!!!',
                    'Data ' + nip + ' telah diubah!',
                    'success'
                );
            }
        })

    }

    function warning_edit_alamat(nip) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "Data pegawai akan di berubah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                edit_data_alamat(nip);
            }
        });
    }

    function edit_data_alamat(nip) {
        var data = new FormData(document.getElementById("form_alamat"));
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/edit_data_alamat/'); ?>" + nip,
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#edit_button_alamat_div').attr("hidden", true);
                $('#edit_trigger_alamat').attr("hidden", false);
                set_readonly('alamat', true);
                swal.fire(
                    'Edited!!!',
                    'Data ' + nip + ' telah diubah!',
                    'success'
                );

            }
        })

    }

    function warning_edit_pekerjaan(nip) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "Data pegawai akan di berubah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                edit_data_pekerjaan(nip);
            }
        });
    }

    function edit_data_pekerjaan(nip) {
        var data = new FormData(document.getElementById("form_pekerjaan"));
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/edit_data_pekerjaan/'); ?>" + nip,
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#edit_button_pekerjaan_div').attr("hidden", true);
                $('#edit_trigger_pekerjaan').attr("hidden", false);
                set_readonly('pekerjaan', true);
                swal.fire(
                    'Edited!!!',
                    'Data ' + nip + ' telah diubah!',
                    'success'
                );
            }
        })

    }

    function warning_edit_lainnya(nip) {
        swal.fire({
            title: 'Apa anda yakin?',
            text: "Data pegawai akan di berubah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                edit_data_lainnya(nip);
            }
        });
    }

    function edit_data_lainnya(nip) {
        var data = new FormData(document.getElementById("form_lainnya"));
        $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masterpegawai/edit_data_lainnya/'); ?>" + nip,
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#edit_button_lainnya_div').attr("hidden", true);
                $('#edit_trigger_lainnya').attr("hidden", false);
                set_readonly('lainnya', true);
                swal.fire(
                    'Edited!!!',
                    'Data ' + nip + ' telah diubah!',
                    'success'
                );
            }
        })

    }
</script>