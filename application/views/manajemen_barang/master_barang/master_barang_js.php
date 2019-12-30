<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
 <!-- Validation js (Parsleyjs) -->
 <script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- script validasi -->

<script type="text/javascript">
            $(document).ready(function() {
                $('submitForm').parsley();
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
        $('#addModal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })
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
            "deferRender": true,
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
                        var display = '<a type="button" class="btn btn-icon waves-effect waves-light btn-success btn-sm" href="<?= base_url('manajemen_barang/masterstock/detail_stock/'); ?>' + data + '" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i></a>';
                        return display;
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
                                var display = '<button type="button" class="btn btn-icon waves-effect waves-light btn-success btn-sm" onclick="warningDelete(' + data + ')" data-toggle="tooltip" data-placement="left" title="Click untuk melihat Detail"><i class="fa fa-search" ></i></button>';
                                return display;
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
            var kode_barang = $('#kode_barang').val();
            var nama_barang = $('#nama_barang').val();
            var harga_satuan = $('#harga_satuan').val();
            var satuan = $('#satuan').val();
            var gambar = $('#gambar').val();
            $.ajax({
                url: "<?= Base_url('manajemen_barang/masterbarang/tambah_data'); ?>",
                type: "post",
                data: {
                    kode_barang: kode_barang,
                    nama_barang: nama_barang,
                    harga_satuan: harga_satuan,
                    satuan: satuan,
                    gambar: gambar
                },
                cache: false,
                async: false,
                success: function(data) {
                    $('#datatable-master-barang').DataTable().ajax.reload();
                    $('#addModal').modal('hide');
                }
            })
        });
    });
</script>