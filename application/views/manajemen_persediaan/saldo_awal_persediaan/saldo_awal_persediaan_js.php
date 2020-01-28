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

        var edit_harga_rupiah = document.getElementById('edit_harga');
        edit_harga_rupiah.addEventListener('keyup', function(e) {
            edit_harga_rupiah.value = formatRupiah(this.value, 'Rp.');
        });

        var edit_jumlah_satuan = document.getElementById('edit_jumlah');
        edit_jumlah_satuan.addEventListener('keyup', function(e) {
            edit_jumlah_satuan.value = formatSatuan(this.value);
        });

        cari_versi_select2();
        setTable();
        setSubTotal();

    });

    function formatSatuan(x) {
        return x.toString().replace(/[^,\d]/g, '')
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
        $('#add_modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });

        $('#edit_modal').on('hidden.bs.modal', function(e) {
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
                    setSubTotal()
                    Swal.fire(
                        'Sukses!',
                        'Data Jenis Barang telah berhasil di tambahkan.',
                        'success'
                    )
                    $("#submitForm").loading('stop');
                    $('#add_modal').modal('hide');
                }
            })
        });
    });
</script>

<!-- Script Delete Data -->

<script type="text/javascript">
    function warning_delete(id) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini?',
            text: "Merubah data ini akan mempengaruhi Persediaan!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.value) {
                deleteData(id);
            }
        });
    }

    function deleteData(id) {
        $.ajax({
            url: "<?= Base_url('Manajemen_Persediaan/SaldoAwalPersediaan/delete_data/'); ?>" + id,
            async: false,
            success: function(data) {
                $('#datatable-master-saldo-awal').DataTable().ajax.reload();
                setSubTotal()
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
            }
        });
    }
</script>

<!-- Script Edit Data -->
<script type="text/javascript">
    function show_edit_modal(id) {
        swal.fire({
            title: 'Anda akan merubah Saldo Awal Data Barang?',
            text: "Merubah data ini akan mempengaruhi Persediaan!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Lanjut!'
        }).then((result) => {
            if (result.value) {
                fetchdata_edit_modal(id);
            }
        });
    }

    function fetchdata_edit_modal(id) {
        var edit_id = $('#edit_id');
        var edit_kode_barang = $('#edit_kode_barang');
        var edit_jumlah = $('#edit_jumlah');
        var edit_harga = $('#edit_harga');
        $.ajax({
            url: "<?= base_url('Manajemen_Persediaan/SaldoAwalPersediaan/view_edit_data/'); ?>" + id,
            type: "POST",
            dataType: "JSON",
            async: false,
            success: function(data) {
                edit_id.val(data.id);
                edit_kode_barang.val(data.kode_barang + ' - ' + data.nama_barang);
                edit_jumlah.val(data.qty_awal);
                edit_harga.val(formatRupiah(data.harga_awal.toString(), 'Rp.'));
                $('#edit_modal').modal('show');
            }
        });
    }

    function warning_edit(id) {
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
                editData(id);
            }
        });
    }

    function editData(id) {
        var data = new FormData(document.getElementById("edit_form"));
        $.ajax({
            url: "<?= base_url('Manajemen_Persediaan/SaldoAwalPersediaan/edit_data/'); ?>" + id,
            type: "post",
            data: data,
            async: false,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#edit_form").loading();
            },
            success: function(data) {
                swal.fire(
                    'Edited!!!',
                    'Data telah diubah!',
                    'success'
                )
                $('#datatable-master-saldo-awal').DataTable().ajax.reload();
                setSubTotal()
                $("#edit_form").loading('stop');
                $('#edit_modal').modal('hide');
            }
        })

    }
    $('#edit_form').submit(function(e) {
        var edit_id = $('#edit_id').val();
        e.preventDefault();
        warning_edit(edit_id);
    });

    function setSubTotal() {
        $.ajax({
            url: "<?= base_url('Manajemen_Persediaan/SaldoAwalPersediaan/subTotal/'); ?>",
            type: "post",
            dataType: "JSON",
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                $('#sub_total_qty').val(data.qty_awal);
                $('#sub_total_harga').val(formatRupiah(data.harga_awal, 'Rp.'));
            }
        })
    }
</script>