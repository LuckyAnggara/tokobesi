<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/jquery-mask/jquery.mask.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.bundle.min.js"></script>

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
<!-- script validasi -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#submitForm').parsley();
        $('.select2').select2({
            minimumResultsForSearch: -1
        });

        $('#edit_satuan').select2().on('select2:select', function() {
            var data = $("#satuan option:selected").text()
            $('#edit_satuan_minimum').val(data);
        })

        var edit_persediaan_minimum_input = document.getElementById('edit_persediaan_minimum');
        edit_persediaan_minimum_input.addEventListener('keyup', function(e) {
            var data = $('#edit_persediaan_minimum').val();
            edit_persediaan_minimum_input.value = this.value.replace(/[^,\d]/g, '').toString();
        });
    });
</script>

<!-- Script Nominal Harga Formater -->
<script type="text/javascript">
    var edit_harga_satuan = document.getElementById('edit_harga_satuan_dummy');
    edit_harga_satuan.addEventListener('keyup', function(e) {
        var data = $('#edit_harga_satuan_dummy').val();
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        edit_harga_satuan.value = formatRupiah(this.value, 'Rp. ');
        $('#edit_harga_satuan').val(normalrupiah(data));
    });

    var harga_pokok = document.getElementById('edit_harga_pokok_dummy');
    harga_pokok.addEventListener('keyup', function(e) {
        var data = $('#edit_harga_pokok_dummy').val();
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        harga_pokok.value = formatRupiah(this.value, 'Rp. ');
        $('#edit_harga_pokok').val(normalrupiah(data));
    });

    /* Fungsi formatRupiah */
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

    function normalrupiah(angka) {

        var tanparp = angka.replace("Rp", "");
        var tanpatitik = tanparp.split(".").join("");
        return tanpatitik;
    }
</script>

<!-- Script Auto Generate Kode Barang -->

<script>
    var nama_barang = $('#nama_barang');
    var kode_barang = $('#kode_barang');
    nama_barang.on("keyup", function() {
        string_awalan = nama_barang.val();
        string_awalan = string_awalan.substr(0, 1);
        string_awalan = string_awalan.toUpperCase();
        var tambahan = cekData(string_awalan);
        var res = string_awalan.concat(tambahan);
        kode_barang.val(res);
    });

    function cekData(string) {

        // tambah lagi if untuk string dibawah 1

        $.ajax({
            url: '<?= base_url("Manajemen_Barang/MasterBarang/cekData/"); ?>' + string,
            success: function(result) {
                data = result;
            }
        });
        return data;
    }
</script>

<!-- script close modal reset data -->

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


<!-- Script Edit Modal -->
<script type="text/javascript">
    function show_edit_modal(kode_barang) {
        fetchdata(kode_barang);
    }

    function fetchdata(kode_barang) {
        var edit_data_label = $('#edit_data_label');
        var edit_kode_barang = $('#edit_kode_barang');
        var edit_nama_barang = $('#edit_nama_barang');
        var edit_harga_satuan_dummy = $('#edit_harga_satuan_dummy');
        var edit_harga_satuan = $('#edit_harga_satuan');
        var edit_satuan = $('#edit_satuan');
        var edit_tanggal_input = $('#edit_tanggal_input');
        var edit_image = $('#edit_gambar_dropfy');
        //var edit_image = $('#edit_image');

        $.ajax({
            url: '<?= base_url("Manajemen_Barang/MasterBarang/view_edit_data/"); ?>' + kode_barang,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                rupiah = formatRupiah(data.harga_satuan, 'Rp.');
                edit_data_label.text("Edit Data Barang Kode :" + data.kode_barang);
                edit_kode_barang.val(data.kode_barang);
                edit_nama_barang.val(data.nama_barang);
                edit_harga_satuan_dummy.val(rupiah);
                edit_harga_satuan.val(data.harga_satuan);
                edit_satuan.val(data.satuan);
                edit_tanggal_input.text(data.tanggal_input);
                edit_image.attr('data-default-file', "<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                //edit_image.attr('src',"<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                $('#edit_Modal').modal('show');
            }
        });
    }

    // Edit Harga Satuan

    var edit_rupiah = document.getElementById('edit_harga_satuan_dummy');
    edit_rupiah.addEventListener('keyup', function(e) {
        var data = $('#edit_harga_satuan_dummy').val();
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        edit_rupiah.value = formatRupiah(this.value, 'Rp. ');
        $('#edit_harga_satuan').val(normalrupiah(data));
    });

    // submit edit data
    $(document).ready(function() {

        function warning_edit(kode_barang) {
            swal({
                title: 'Apa anda yakin akan mengubah data ini?',
                text: "Semua Data Persediaan dengan kode " + kode_barang + " juga akan terubah",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Ya, Ubah ini!'
            }).then(function() {
                editData(kode_barang);
                swal(
                    'Edited!!!',
                    'Data ' + kode_barang + ' telah diubah!',
                    'success'
                )
            });
        }

        function editData(kode_barang) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('Manajemen_Barang/MasterBarang/edit_data/'); ?>" + kode_barang,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-barang').DataTable().ajax.reload();
                    $('#edit_Modal').modal('hide');
                }
            })

        }
        $('#edit_form').submit(function(e) {
            var kode_barang = $('#edit_kode_barang').val();
            e.preventDefault();
            warning_edit(kode_barang);
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
            var kode_barang = $('#hide_kode_barang').text();
            var data = new FormData(document.getElementById("edit_gambar_form"));
            data.append('kode_barang', kode_barang);
            $.ajax({
                url: '<?= base_url("Manajemen_Barang/MasterBarang/SetGambarBaru/"); ?>' + kode_barang,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#edit_gambar_modal').modal('hide');
                    setGambarBaru(kode_barang);

                }
            })
        });

        function setGambarBaru(kode_barang) {
            $.ajax({
                url: '<?= base_url("Manajemen_Barang/MasterBarang/GetGambarBaru/"); ?>' + kode_barang,
                type: "POST",
                dataType: "JSON",
                async: false,
                success: function(data) {

                    var drEvent = $('#edit_gambar').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    $('#div_gambar').fadeOut(1000, function() {
                        // $('#gambar_barang').attr('src', "<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                        $('#gambar_barang').remove();
                        display = '<img id="gambar_barang" src="<?= base_url('assets/images/barang/'); ?>' + data.gambar + '" class="img-thumbnail" alt="profile-image">';
                        $('#div_gambar').append(display)
                        $('#div_gambar').fadeIn(1000);
                    });
                    Swal.fire(
                        'Sukses!',
                        'Data Supplier telah berhasil di tambahkan.',
                        'success'
                    );

                    // $('#div_gambar').fadeOut(2000, function() {
                    //     //form.html(msg).fadeIn().delay(2000);


                    //     // $('#div_gambar').load('http://localhost/tob/Manajemen_Barang/MasterBarang/Detail_Barang/B001 #div_gambar');
                    //     $('#div_gambar').fadeIn(2000);
                    // });

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
        var edit_button_harga = $('#edit_trigger_harga');
        var edit_button_harga_div = $('#edit_button_harga_div');
        var edit_batal_harga = $('#edit_batal_harga');

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

        // HARGA - CLICK EDIT
        edit_button_harga.on('click', function() {
            edit_button_harga_div.attr("hidden", false);
            edit_button_harga.attr("hidden", true);
            set_readonly('harga', false);
        });
        // HARGA - CLICK BATAL
        edit_batal_harga.on('click', function() {
            edit_button_harga_div.attr("hidden", true);
            edit_button_harga.attr("hidden", false);
            set_readonly('harga', true);
        });
        // Fungsi Set Kolom Jadi Not Readonly
        function set_readonly(div, bol) {
            if (div == "umum") {
                if (bol == false) {
                    $('#edit_tipe_barang').attr("disabled", bol);
                    $('#edit_jenis_barang').attr("disabled", bol);
                    $('#edit_merek_barang').attr("disabled", bol);
                    $('#edit_nama_barang').attr("readonly", bol);
                    $('#edit_kode_supplier').attr("disabled", bol);
                    $('#edit_keterangan').attr("readonly", bol);
                } else {
                    $('#edit_tipe_barang').attr("disabled", bol);
                    $('#edit_jenis_barang').attr("disabled", bol);
                    $('#edit_merek_barang').attr("disabled", bol);
                    $('#edit_nama_barang').attr("readonly", bol);
                    $('#edit_nama_supplier').attr("disabled", bol);
                    $('#edit_keterangan').attr("readonly", bol);
                    // CLEAR AREA INPUT
                    // $('#edit_tipe_barang').val(0);
                    // $('#edit_jenis_barang').val(0);
                    // $('#edit_merek_barang').val(0);
                    // $('#edit_nama_barang').val('');
                    // $('#edit_nama_supplier').val(0);
                    // $('#edit_keterangan').val('');
                }
            } else {
                if (bol == false) {
                    $('#edit_harga_pokok_dummy').attr("readonly", bol);
                    $('#edit_harga_satuan_dummy').attr("readonly", bol);
                    $('#edit_satuan').attr("disabled", bol);
                    $('#edit_persediaan_minimum').attr("readonly", bol);
                    $('#edit_satuan').attr("disabled", bol);
                    $('#edit_status_jual').attr("disabled", bol);
                } else {
                    $('#edit_harga_pokok_dummy').attr("readonly", bol);
                    $('#edit_harga_satuan_dummy').attr("readonly", bol);
                    $('#edit_satuan').attr("disabled", bol);
                    $('#edit_persediaan_minimum').attr("readonly", bol);
                    $('#edit_satuan').attr("disabled", bol);
                    $('#edit_status_jual').attr("disabled", bol);
                    // CLEAR AREA INPUT
                    // $('#edit_harga_pokok_dummy').val('');
                    // $('#edit_harga_satuan_dummy').val('');
                    // $('#edit_satuan').val(0);
                    // $('#edit_persediaan_minimum').val('');
                    // $('#edit_satuan').val(0);
                    // $('#edit_status_jual').val(0);
                }
            }
        }

        set_data($('#hide_kode_barang').text());
        // Fungsi Set Data Ke Kolom Pertama Kali
        function set_data(kode_barang) {
            var edit_tipe_barang = $('#edit_tipe_barang');
            var edit_jenis_barang = $('#edit_jenis_barang');
            var edit_merek_barang = $('#edit_merek_barang');
            var edit_kode_barang = $('#edit_kode_barang');
            var edit_nama_barang = $('#edit_nama_barang');
            var edit_kode_supplier = $('#edit_kode_supplier');
            var edit_keterangan = $('#edit_keterangan');
            var edit_harga_pokok_dummy = $('#edit_harga_pokok_dummy');
            var edit_harga_pokok = $('#edit_harga_pokok');
            var edit_harga_satuan_dummy = $('#edit_harga_satuan_dummy');
            var edit_harga_satuan = $('#edit_harga_satuan');
            var edit_satuan = $('#edit_satuan');
            var edit_persediaan_minimum = $('#edit_persediaan_minimum');
            var edit_satuan_minimum = $('#edit_satuan_minimum');
            var edit_status_jual = $('#edit_status_jual');
            var edit_tanggal_input = $('#edit_tanggal_input');
            //var edit_image = $('#edit_image');

            $.ajax({
                url: '<?= base_url("Manajemen_Barang/MasterBarang/get_data_for_detail/"); ?>' + kode_barang,
                type: "POST",
                dataType: "JSON",
                async: false,
                success: function(data) {
                    rupiahJual = formatRupiah(data.harga_satuan, 'Rp.');
                    rupiahPokok = formatRupiah(data.harga_pokok, 'Rp.');
                    edit_tipe_barang.val(data.tipe_barang).trigger('change');
                    edit_jenis_barang.val(data.tipe_barang).trigger('change');
                    edit_merek_barang.val(data.tipe_barang).trigger('change');
                    edit_kode_barang.val(data.kode_barang);
                    edit_nama_barang.val(data.nama_barang);
                    edit_kode_supplier.val(data.kode_supplier).trigger('change');
                    edit_keterangan.val(data.keterangan);
                    edit_harga_pokok_dummy.val(rupiahPokok);
                    edit_harga_pokok.val(data.harga_pokok);
                    edit_harga_satuan_dummy.val(rupiahJual);
                    edit_harga_satuan.val(data.harga_satuan);
                    edit_satuan.val(data.kode_satuan).trigger('change');
                    edit_persediaan_minimum.val(data.persediaan_minimum);
                    edit_satuan_minimum.val(edit_satuan.text());
                    edit_status_jual.val(data.status_jual).trigger('change');
                    edit_tanggal_input.text(data.tanggal_input);
                    // edit_image.attr('data-default-file', "<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                    //edit_image.attr('src',"<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                }
            });
        }


    });
</script>
<!-- Set Data Ke Tampilan -->