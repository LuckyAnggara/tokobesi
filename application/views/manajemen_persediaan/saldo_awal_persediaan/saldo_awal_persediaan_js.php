<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- shake effect -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.bundle.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Input Mask Js dan Max Length-->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<!-- script validasi -->
<script type="text/javascript">
    $(document).ready(function() {


        var harga_rupiah = document.getElementById('harga');
        harga_rupiah.addEventListener('keyup', function(e) {
            harga_rupiah.value = formatRupiah(this.value, 'Rp.');
        });

        var jumlah_satuan = document.getElementById('jumlah');
        jumlah_satuan.addEventListener('keyup', function(e) {
            jumlah_satuan.value = formatSatuan(this.value);
        });

        cari_versi_select2();
        setTable();

    });

    function formatSatuan(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
</script>

<!-- Script Set Data di Select2 -->
<script>
    function cari_versi_select2() {
        $("#kode_barang").select2({
            ajax: {
                url: '<?= base_url("Manajemen_Persediaan/SaldoAwalPersediaan/getData"); ?>',
                type: "post",
                dataType: 'json',
                delay: 250,
                // data: function(params) {
                //   return {
                //     search_term: params.term
                //   };
                // },
                processResults: function(data) {
                    var results = [];
                    for (var i in data.data) {
                        results.push({
                            "id": data.data[i].kode_barang,
                            "text": data.data[i].kode_barang + ' - ' + data.data[i].nama_barang
                        });
                    };
                    return {
                        results: results
                    };
                },
            },
            placeholder: "Pilih Barang .."
        });

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
    });
</script>

<!-- Isi Data Tabel -->

<script type="text/javascript">
    function setTable() {
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
        var table = $('#datatable-master-saldo-awal').DataTable({
            destroy: true,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "searching": true,
            "order": [],
            "processing": true,
            "ajax": {
                "url": '<?= Base_url("Manajemen_Persediaan/SaldoAwalPersediaan/getAllData"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "kode_barang",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "kode_barang",
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
                    data: "qty_awal",
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_satuan",
                    targets: 4,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "harga_awal",
                    targets: 5,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');
                    }
                },
                {
                    data: "total",
                    targets: 6,
                    render: function(data, type, full, meta) {
                        return formatRupiah(data, 'Rp.');

                    }
                },
                {
                    data: "id",
                    targets: 7,
                    render: function(data, type, full, meta) {
                        var display2 = '<a type="button" onClick = "show_edit_modal(\'' + data + '\')"" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Edit Data"><i class="fa fa-edit" ></i> </a>';
                        var display3 = '<a type="button" onClick = "warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash" ></i> </a>';
                        return display2 + " " + display3;
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
</script>

<!-- Script Tambah Data -->

<script>
    $(document).ready(function() {
        $('#submitForm').submit(function(e) {
            e.preventDefault();
            var data = new FormData(document.getElementById("submitForm"));
            $.ajax({
                url: "<?= Base_url('Manajemen_Persediaan/SaldoAwalPersediaan/tambah_data'); ?>",
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#submitForm").loading();
                },
                success: function(data) {
                    $('#datatable-master-saldo-awal').DataTable().ajax.reload();
                    Swal.fire(
                        'Sukses!',
                        'Data Jenis Barang telah berhasil di tambahkan.',
                        'success'
                    )
                    $("#submitForm").loading('stop');
                    $('#add_Modal').modal('hide');
                }
            })
        });
    });
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(id_jenis_barang) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Semua Data Persediaan dengan kode " + id_jenis_barang + " juga akan terhapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData(id_jenis_barang);
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }

    function deleteData(id_jenis_barang) {
        $.ajax({
            url: "<?= base_url('Manajemen_Data/MasterJenisBarang/delete_data/'); ?>" + id_jenis_barang,
            async: false,
            success: function(data) {
                $('#datatable-master-jenis_barang').DataTable().ajax.reload();
            }
        });
    }
</script>

<!-- Script Edit Data -->
<script type="text/javascript">
    function show_edit_modal(id_jenis_barang) {
        fetchdata_edit_modal(id_jenis_barang);
    }

    function fetchdata_edit_modal(id_jenis_barang) {
        var edit_data_label = $('#edit_data_label');
        var edit_id_jenis_barang = $('#edit_id_jenis_barang');
        var edit_kode_jenis_barang = $('#edit_kode_jenis_barang');
        var edit_nama_jenis_barang = $('#edit_nama_jenis_barang');
        var edit_keterangan = $('#edit_keterangan');
        var edit_tanggal_input = $('#edit_tanggal_input');
        $.ajax({
            url: '<?= base_url("Manajemen_Data/MasterJenisBarang/view_edit_data/"); ?>' + id_jenis_barang,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                edit_data_label.text("Edit Data Jenis Barang Kode :" + data.kode_jenis_barang);
                edit_id_jenis_barang.val(data.id_jenis_barang);
                edit_kode_jenis_barang.val(data.kode_jenis_barang);
                edit_nama_jenis_barang.val(data.nama_jenis_barang);
                edit_keterangan.val(data.keterangan);
                edit_tanggal_input.text(data.tanggal_input);
                $('#edit_Modal').modal('show');
            }
        });
    }

    // submit edit data
    $(document).ready(function() {

        function warning_edit(id_jenis_barang) {
            swal.fire({
                title: 'Apa anda yakin akan mengubah data ini?',
                text: "Semua Data Jenis Barang ini juga akan terubah",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Ya, Ubah ini!'
            }).then((result) => {
                if (result.value) {
                    editData(id_jenis_barang);
                    swal.fire(
                        'Edited!!!',
                        'Data telah diubah!',
                        'success'
                    )
                }
            });
        }

        function editData(id_jenis_barang) {
            var data = new FormData(document.getElementById("edit_form"));
            $.ajax({
                url: "<?= Base_url('Manajemen_Data/MasterJenisBarang/edit_data/'); ?>" + id_jenis_barang,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#datatable-master-jenis_barang').DataTable().ajax.reload();
                    $('#edit_Modal').modal('hide');
                }
            })

        }
        $('#edit_form').submit(function(e) {
            var id_jenis_barang = $('#edit_id_jenis_barang').val();
            e.preventDefault();
            warning_edit(id_jenis_barang);
        });

    });
</script>

<!-- Script Edit Modal -->
<script type="text/javascript">
    function show_view_modal(id_jenis_barang) {
        viewfetchdata(id_jenis_barang);
    }

    function viewfetchdata(id_jenis_barang) {
        var view_data_label = $('#view_data_label');
        var view_kode_jenis_barang = $('#view_kode_jenis_barang');
        var view_nama_jenis_barang = $('#view_nama_jenis_barang');
        var view_tanggal_input = $('#view_tanggal_input');
        var view_histori_tanggal_input = $('#histori_tanggal_input');
        var view_keterangan = $('#view_keterangan');
        var nav_tabel_data_jenis_barang = $('#nav_tabel_data_jenis_barang');
        $.ajax({
            url: '<?= base_url("Manajemen_Data/MasterJenisBarang/view_edit_data/"); ?>' + id_jenis_barang,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                view_data_label.text("Edit Data Jenis Barang Kode : " + data.kode_jenis_barang);
                view_kode_jenis_barang.val(data.kode_jenis_barang);
                view_nama_jenis_barang.val(data.nama_jenis_barang);
                view_keterangan.val(data.keterangan);
                view_tanggal_input.text(data.tanggal_input);
                view_histori_tanggal_input.text(data.tanggal_input);
                nav_tabel_data_jenis_barang.text('Daftar Barang Jenis ' + data.nama_jenis_barang);
                panggilDaftarTabelJenisBarang(data.id_jenis_barang);
                $('#view_Modal').modal('show');
            }
        });
    }
</script>