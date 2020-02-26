<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Form wizard -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/jquery-validation/dist/jquery.validate.min.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/jquery-mask/jquery.mask.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chartjs/chart.bundle.min.js"></script>


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

        $('#rootwizard').bootstrapWizard({
            'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted',
            'onTabClick': function(tab, navigation, index) {
                Swal.fire(
                    'Oopss!',
                    'Tekan tombol Next',
                    'error'
                )
                return false;
            },
            'onNext': function(tab, navigation, index) {
                var $valid = $("#submitForm").valid();
                if (!$valid) {
                    return false;
                }
                var $total = navigation.find('li').length;
                var $current = index + 1;
                if ($total == $current) {
                    $('#submit-add').text('Submit');
                } else {
                    $('#submit-add').text('Next');
                }
            },
        });
        $('#submit-add').on('click', function() {
            if ($('#submit-add').text() == "Submit") {
                tambah_data();
                Swal.fire(
                    'Good!',
                    'Data telah di tambahkan!',
                    'success'
                )
                $('#add_modal').modal('hide');
            }
        });


        $('#submitForm').parsley();
        $('.select2').select2({
            minimumResultsForSearch: -1
        });

        $('#satuan').select2().on('select2:select', function() {
            var data = $("#satuan option:selected").text()
            $('#satuan_minimum').val(data);
        })

        var harga_satuan = document.getElementById('persediaan_minimum');
        harga_satuan.addEventListener('keyup', function(e) {
            var data = $('#persediaan_minimum').val();
            harga_satuan.value = this.value.replace(/[^,\d]/g, '').toString();
        });
    });
</script>

<!-- Script Nominal Harga Formater -->
<script type="text/javascript">
    var harga_satuan = document.getElementById('harga_satuan_dummy');
    harga_satuan.addEventListener('keyup', function(e) {
        var data = $('#harga_satuan_dummy').val();
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        harga_satuan.value = formatRupiah(this.value, 'Rp. ');
        $('#harga_satuan').val(normalrupiah(data));
    });

    var harga_pokok = document.getElementById('harga_pokok_dummy');
    harga_pokok.addEventListener('keyup', function(e) {
        var data = $('#harga_pokok_dummy').val();
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        harga_pokok.value = formatRupiah(this.value, 'Rp. ');
        $('#harga_pokok').val(normalrupiah(data));
    });

    var komisi_sales = document.getElementById('komisi_sales_dummy');
    komisi_sales.addEventListener('keyup', function(e) {
        var data = $('#komisi_sales_dummy').val();
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        komisi_sales.value = formatRupiah(this.value, 'Rp. ');
        $('#komisi_sales').val(normalrupiah(data));
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

    function formatSatuan(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>

<!-- Script Auto Generate Kode Barang -->

<script>
    var nama_barang = $('#nama_barang');
    var kode_barang = $('#kode_barang');
    nama_barang.on("keyup", function() {
        string_awalan = nama_barang.val();
        // string_awalan = string_awalan.substr(0, 3);
        // string_awalan = string_awalan.toUpperCase();
        var tambahan = cekData(string_awalan);
        // var res = string_awalan.concat(tambahan);

        if (nama_barang.val() == '') {
            kode_barang.val('');
        } else {
            kode_barang.val(tambahan);
        }

    });

    function cekData(string) {

        // tambah lagi if untuk string dibawah 1

        $.ajax({
            url: '<?= base_url("manajemen_barang/masterbarang/cekData/"); ?>' + string,
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
        $('#add_modal').on('hidden.bs.modal', function(e) {
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

<!-- Isi Data Tabel -->

<script type="text/javascript">
    $(document).ready(function() {

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

        //Init Datatabel Master Stock Persediaan 
        var table = $('#datatable-master-barang').DataTable({
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            // "order": [],
            "processing": true,
            // "serverSide": true,
            "ajax": {
                "url": '<?= base_url("manajemen_barang/masterbarang/getData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "kode_barang",
                    searching: true,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "kode_barang",
                    searching: true,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_barang",
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_jenis_barang",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_merek_barang",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                // {
                //     data: "hargapokok",
                //     targets: 5,
                //     render: function(data, type, full, meta) {
                //         var display1 = formatRupiah(data.harga_pokok, 'Rp.');
                //         var display2 = display1 + " / " + data.nama_satuan;
                //         return display2;
                //     }
                // },
                {
                    data: "status",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        if (data.status_jual == "0") {
                            var display = '<a class="btn" onClick="status(\'' + data.kode_barang + '\')"><span class="badge badge-success">Di Jual</span></a>';
                        } else {
                            var display = '<a class="btn" onClick="status(\'' + data.kode_barang + '\')"><span class="badge badge-danger">Tidak di Jual</span></a>';
                        }
                        return display;
                    }
                },
                {
                    data: "kode_barang",
                    targets: 6,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "detail_barang(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        var display2 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                        return display1 + " " + display2;
                    }
                }
            ],
            "rowCallback": function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

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
    });
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#statusUpdateForm').submit(function(e) {
            e.preventDefault();
            kode_barang = $('#status_kode_barang').text();
            var data = new FormData(document.getElementById("statusUpdateForm"));
            data.append('kode_barang', kode_barang);
            $.ajax({
                url: "<?= Base_url('manajemen_barang/masterbarang/status_update'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-barang').DataTable().ajax.reload();
                    $('#status_modal').modal('hide');
                    Swal.fire(
                        'Sukses!',
                        'Status berhasil di ganti!!',
                        'success'
                    )
                }
            })
        });
    });

    function status(kode_barang) {
        $('#status_kode_barang').text(kode_barang);
        $('#status_modal').modal('show');
    }

    function tambah_data() {
        var data = new FormData(document.getElementById("submitForm"));
        $.ajax({
            url: "<?= Base_url('manajemen_barang/masterbarang/tambah_data'); ?>",
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#datatable-master-barang').DataTable().ajax.reload();
                $('#add_modal').modal('hide');
            }
        })
    }
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(kode_barang) {
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "Proses ini dapat mempengaruhi Sistem",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(kode_barang);
                Swal.fire(
                    'Deleted!',
                    'Data ' + kode_barang + ' telah dihapus!',
                    'success'
                )
            }
        })
    }

    function deleteData(kode_barang) {
        $.ajax({
            url: "<?= base_url('manajemen_barang/masterbarang/delete_data/'); ?>" + kode_barang,
            async: false,
            success: function(data) {
                $('#datatable-master-barang').DataTable().ajax.reload();
            }
        });
    }
</script>

<!-- Script Edit Modal -->
<script type="text/javascript">
    function detail_barang(kode_barang) {
        window.location.href = "<?= base_url('manajemen_barang/masterbarang/Detail_Barang/'); ?>" + kode_barang;
    }
</script>