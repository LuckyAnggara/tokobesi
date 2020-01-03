<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.bundle.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.min.js"></script>

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
    $('#edit_gambar_dropfy').dropify({
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
    });
</script>

<!-- Script Nominal Harga Formater -->
<script type="text/javascript">
    var rupiah = document.getElementById('harga_satuan_dummy');
    rupiah.addEventListener('keyup', function(e) {
        var data = $('#harga_satuan_dummy').val();
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
        $('#harga_satuan').val(normalrupiah(data));
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
            url: '<?= base_url("manajemen_barang/MasterBarang/cekData/"); ?>' + string,
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
        $('#add_Modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });

        $('#edit_Modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });

        $('#view_Modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#detail_barang").addClass("active show");
            $("#nav_detail_barang").addClass("active show");
            $("#nav_data_penjualan").removeClass("active show");
            var ctx = document.getElementById('bar_lucky').getContext('2d');
            var mybarchart = new Chart(ctx);
            mybarchart.destroy();
            $("#data_penjualan").removeClass("active show");
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
            "searching": false,
            "order": [],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url("manajemen_barang/MasterBarang/getData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    title: "No",
                    data: "kode_barang",
                    searching: true,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Kode Barang",
                    data: "kode_barang",
                    searching: true,
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Nama Barang",
                    data: "nama_barang",
                    searching: true,
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    title: "Harga Jual",
                    data: "hargasatuan",
                    searching: true,
                    targets: 3,
                    render: function(data, type, full, meta) {

                        var display1 = formatRupiah(data.harga_satuan, 'Rp.');
                        var display2 = display1 + " / " + data.satuan;
                        return display2;
                    }
                },
                {
                    title: "Action",
                    data: "kode_barang",
                    searching: true,
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var display1 = '<a type="button" onClick = "show_view_modal(\'' + data + '\')" class="btn btn-icon waves-effect waves-light btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                        var display2 = '<a type="button" onClick = "show_edit_modal(\'' + data + '\')"" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Edit Data"><i class="fa fa-edit" ></i> </a>';
                        var display3 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                        return display1 + " " + display2 + " " + display3;
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

        $('#searchInput').on('keypress', function(e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                $('#datatable-master-barang').DataTable().destroy();
                var input = $('#searchInput').val();
                var table = $('#datatable-master-barang').DataTable({
                    "oLanguage": {
                        sProcessing: "Sabar yah...",
                        sZeroRecords: "Tidak ada Data..."
                    },
                    "searching": false,
                    "deferRender": true,
                    "order": [],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": '<?= base_url("manajemen_barang/MasterBarang/getData/"); ?>' + input,
                        "type": "POST",
                    },
                    "columnDefs": [{
                            title: "No",
                            data: "kode_barang",
                            searching: true,
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Kode Barang",
                            data: "kode_barang",
                            searching: true,
                            targets: 1,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Nama Barang",
                            data: "nama_barang",
                            searching: true,
                            targets: 2,
                            render: function(data, type, full, meta) {
                                return data;
                            }
                        },
                        {
                            title: "Harga Satuan",
                            data: "harga_satuan",
                            searching: true,
                            targets: 3,
                            render: function(data, type, full, meta) {
                                return formatRupiah(data, 'Rp.');
                            }
                        },
                        {
                            title: "Action",
                            data: "kode_barang",
                            searching: true,
                            targets: 4,
                            render: function(data, type, full, meta) {
                                var display1 = '<a type="button" class="btn btn-icon waves-effect waves-light btn-success btn-sm" href="<?= base_url('manajemen_barang/masterpersediaan/detail_persediaan/'); ?>' + data + '" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i> </a>';
                                var display2 = '<a type="button" class="btn btn-icon waves-effect waves-light btn-primary btn-sm" data-target="#edit_Modal" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Edit Data"><i class="fa fa-edit" ></i> </a>';
                                var display3 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                                return display1 + " " + display2 + " " + display3;
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
            }
        });
    });
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#submitForm').submit(function(e) {
            e.preventDefault();
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
                    $('#add_Modal').modal('hide');
                }
            })
        });
    });
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(kode_barang) {
        swal({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Semua Data Persediaan dengan kode " + kode_barang + " juga akan terhapus",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fa7f3',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            deleteData(kode_barang);
            swal(
                'Deleted!',
                'Data ' + kode_barang + ' telah dihapus!',
                'success'
            )
        });
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
            url: '<?= base_url("manajemen_barang/MasterBarang/view_edit_data/"); ?>' + kode_barang,
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
                url: "<?= Base_url('manajemen_barang/masterbarang/edit_data/'); ?>" + kode_barang,
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

<!-- Script select2 option satuan -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#satuan").select2({
            minimumResultsForSearch: -1
        })
    });
</script>

<!-- Script View Modal -->

<!-- Script Edit Modal -->
<script type="text/javascript">
    function show_view_modal(kode_barang) {
        viewfetchdata(kode_barang);

    }

    function viewfetchdata(kode_barang) {
        var view_data_label = $('#view_data_label');
        var view_kode_barang = $('#view_kode_barang');
        var view_nama_barang = $('#view_nama_barang');
        var view_harga_satuan_dummy = $('#view_harga_satuan_dummy');
        var view_harga_satuan = $('#view_harga_satuan');
        var view_satuan = $('#view_satuan');
        var view_tanggal_input = $('#view_tanggal_input');
        var view_image = $('#view_image');
        //var edit_image = $('#edit_image');

        $.ajax({
            url: '<?= base_url("manajemen_barang/MasterBarang/view_edit_data/"); ?>' + kode_barang,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                rupiah = formatRupiah(data.harga_satuan, 'Rp.');
                view_data_label.text("View Data Barang Kode :" + data.kode_barang);
                view_kode_barang.val(data.kode_barang);
                view_nama_barang.val(data.nama_barang);
                view_harga_satuan_dummy.val(rupiah);
                view_harga_satuan.val(data.harga_satuan);
                view_satuan.val(data.satuan);
                view_tanggal_input.text(data.tanggal_input);
                //view_image.attr('data-default-file', "<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                view_image.attr('src', "<?= base_url('assets/images/barang/'); ?>" + data.gambar);
                $('#view_Modal').modal('show');
            }
        });
    }
</script>