<!-- bootstrap touchspin -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Moment js -->
<script src="<?= base_url('assets/'); ?>plugins/moment/min/moment.min.js" type="text/javascript"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- switchery -->
<script src="<?= base_url('assets/'); ?>plugins/switchery/switchery.min.js"></script>

<!-- scrpt satuan -->
<script>
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

        var tanparp = angka.replace(/[^0-9]+/g, "");
        var tanparp = tanparp.replace("Rp", "");
        var tanparp = tanparp.replace(",-", "");
        var tanpatitik = tanparp.split(".").join("");
        return tanpatitik;
    }
</script>

<!-- DATA  -->
<script>
    $(document).ready(function() {
        setData();
        set_grand_total();
        $(".touchspin").TouchSpin({
            verticalbuttons: true,
            buttondown_class: "btn btn-primary",
            buttonup_class: "btn btn-primary",
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".touchspin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.touchspin').prev('.bootstrap-touchspin-prefix').remove();
        }

    });


    function setData() {
        var no_order = $('#no_order').text();
        $.ajax({
            url: "<?= Base_url('Manajemen_Penjualan/ReviewPurchaseOrder/setDataReview'); ?>",
            type: "post",
            data: {
                no_order: no_order,
            },
            dataType: 'json',
            cache: false,
            async: false,
            beforeSend: function() {
                $("#loading").LoadingOverlay("show");
            },
            success: function(data) {
                for (var i in data) {
                    var harga_jual = formatRupiah(data[i].harga_jual, 'Rp.');
                    var total_harga = formatRupiah(data[i].total_harga, 'Rp.');
                    var display = '<div class="col-xl-3 col-md-3 col-xs-3"><div class="card-box widget-user"><div class="pull-right"><a type="button" class="card-drop text-danger" onClick="warning_delete(\'' + data[i].id + '\')"><i class="fa fa-times-rectangle"></i></a></div><div><img src="<?= base_url('assets/images/barang/'); ?>' + data[i].gambar + '" class="img-responsive rounded-circle" alt="user"><div class="wid-u-info"><h4 class="mt-0">' + data[i].nama_barang + '</h4><h6><span class="text-danger"><b>' + data[i].jumlah_penjualan + ' </b></span>' + data[i].nama_satuan + ' @ ' + harga_jual + '</h6><h5><span><b>' + total_harga + ' </b></span></h5></div></div></div></div>'
                    $('#loading').append(display).fadeIn('slow');
                }
            },
            complete: function() {
                $("#loading").LoadingOverlay("hide", true);
            }
        });
    }

    function warning_delete(id) {
        swal.fire({
            title: 'Apa anda yakin akan hapus data ini dari Keranjang Belanja?',
            text: "Data akan di hapus dari Keranjang Belanja..",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                swal.fire(
                    'Deleted!',
                    'Data telah dihapus!',
                    'success'
                )
                deleteData_keranjang(id);
            }
        });
    }

    function deleteData_keranjang(id) {
        $.ajax({
            url: "<?= base_url('Manajemen_Penjualan/PurchaseOrderSales/delete_data_keranjang/'); ?>" + id,
            async: false,
            success: function(data) {
                setData();
                $('#loading').empty();
            }
        });
    }
</script>


<!-- script perhitungan total -->

<script>
    function set_grand_total(no_order) {
        var grand_total = $('#grand_total');
        var total_penjualan = $('#total_penjualan'); // text
        var total_diskon = $('#total_diskon'); // text
        var total_pajak = $('#total_pajak'); // text
        var no_order = $('#no_order').text();
        $.ajax({
            url: '<?= base_url("Manajemen_Penjualan/ReviewPurchaseOrder/get_total_perhitungan/"); ?>',
            type: "POST",
            data: {
                no_order: no_order,
            },
            dataType: "JSON",
            async: false,
            beforeSend: function() {
                $("#total_loading").LoadingOverlay("show");
            },
            success: function(data) {
                // matematika
                grand_total.text(formatRupiah(data.grand_total, 'Rp.'));
                total_penjualan.text(formatRupiah(data.total_keranjang, 'Rp.'));
                total_diskon.text(formatRupiah(data.diskon, 'Rp.'));
                total_pajak.val(formatRupiah(data.pajak, 'Rp.'));
            },
            complete: function() {
                $("#total_loading").LoadingOverlay("hide", true);
            }
        });
    }


    function push_total_perhitungan(no_order, pajak, ongkir) {
        $.ajax({
            url: "<?= Base_url('Manajemen_Penjualan/PurchaseOrderSales/push_total_perhitungan'); ?>",
            type: "post",
            data: {
                no_order: no_order,
                pajak: pajak,
                ongkir: ongkir,
            },
            cache: false,
            async: false,
            success: function(data) {
                set_grand_total(no_order);
            },

        })
    }

    function tutup_tombol_pajak() {
        $('#div_cari-pajak').empty();
        var display = '<button id="pajak-edit" onClick="batal_pajak();" name="pajak-edit" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-history"></i></button>'
        $('#div_cari-pajak').append(display);
    }


    function apply_pajak() {

        var no_order = $('#no_order').text();
        var total_penjualan = normalrupiah($('#total_penjualan').text());

        var pajak = total_penjualan * 0.10;
        push_total_perhitungan(no_order, pajak, 0);
        tutup_tombol_pajak();

    }

    function batal_pajak() {
        var no_order = $('#no_order').text();

        var display2 = '<button id="apply_pajak" onClick="apply_pajak();" name="apply_pajak" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>'
        $('#div_cari-pajak').empty();

        $('#div_cari-pajak').append(display2);

        push_total_perhitungan(no_order, 0, 0);
    };

    $(document).ready(function() {
        if ($('#total_pajak').val() !== "Rp. 0") {
            tutup_tombol_pajak();
        }

    })
</script>

<!-- script pelanggan -->

<script>
    function cari_pelanggan() {
        var id_pelanggan = $('#id_pelanggan');
        var nama_pelanggan = $('#nama_pelanggan');
        var alamat = $('#alamat');
        var nomor_telepon = $('#nomor_telepon');
        if (id_pelanggan.val() !== "") {
            $.ajax({
                url: '<?= base_url("Manajemen_Penjualan/PurchaseOrderSales/get_data_pelanggan/"); ?>' + id_pelanggan.val(),
                type: "POST",
                dataType: "JSON",
                async: false,
                beforeSend: function() {
                    $("#pelanggan_loading").LoadingOverlay("show");
                },
                success: function(data) {
                    if (data !== null) {
                        nama_pelanggan.val(data.nama_pelanggan);
                        alamat.val(data.alamat);
                        nomor_telepon.val(data.nomor_telepon);
                        tutup_tombol_cari();
                    } else {
                        alert_data_pelanggan("tidak_ada");
                        nama_pelanggan.val(null);
                        alamat.val(null);
                        nomor_telepon.val(null);
                    }
                },
                complete: function() {
                    $("#pelanggan_loading").LoadingOverlay("hide", true);
                }
            });
        } else {
            $('#pelanggan_modal').modal('show');
            init_table_pelanggan();
        }
    };

    function tutup_tombol_cari() {
        $('#id_pelanggan').attr('disabled', true);
        $('#nama_pelanggan').attr('disabled', true);
        $('#alamat').attr('disabled', true);
        $('#nomor_telepon').attr('disabled', true);
        $('#div_cari-button').empty();
        $('#id_pelanggan_help').text('');
        display = '<button id="cari-edit" onClick="batal_pelanggan();" name="cari-edit" class="btn btn-success waves-effect waves-light" type="button"><i class="fa  fa-edit "></i></button>'
        $('#div_cari-button').append(display);
    }

    function init_table_pelanggan() {
        var table = $('#datatable-master-pelanggan').DataTable({
            destroy: true,
            paging: false,
            "oLanguage": {
                sProcessing: "Sabar yah...",
                sZeroRecords: "Tidak ada Data..."
            },
            "info": false,
            "order": true,
            "searching": true,
            "ajax": {
                "url": '<?= base_url("Manajemen_Data/MasterPelanggan/getData/"); ?>',
                "type": "POST",
            },
            "columnDefs": [{
                    data: "id_pelanggan",
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: "nama_pelanggan",
                    targets: 1,
                    render: function(data, type, full, meta) {
                        return data;
                    }
                }
            ],
        });
    }

    function alert_data_pelanggan(status) {
        switch (status) {
            case "kosong":
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ID Pelanggan kosong!!',
                    // footer: '<a href>Kenapa Bisa begini?</a>'
                });
                break;
            case "tidak_ada":
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ID Pelanggan Tidak ditemukan!!',
                    // footer: '<a href>Kenapa Bisa begini?</a>'
                });
        }
    }

    $('#datatable-master-pelanggan').on('click', 'tbody td', function() {

        //get textContent of the TD
        var data = this.textContent;
        $('#pelanggan_modal').modal('hide');
        $('#id_pelanggan').val(data);
    })

    function warning_pelanggan_kosong() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data Pelanggan Masih Kosong!',
        })
    }

    function batal_pelanggan() {
        $('#id_pelanggan').attr('disabled', false).val('');
        $('#nama_pelanggan').attr('disabled', false).val('');
        $('#alamat').attr('disabled', false).val('');
        $('#nomor_telepon').attr('disabled', false).val('');
        $('#div_cari-button').empty();
        $('#id_pelanggan_help').text('Kosong kan jika tidak ada ID Pelanggan');
        display = '<button id="cari-button" name="cari-button" onClick="cari_pelanggan();" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-search"></i></button>'
        $('#div_cari-button').append(display);
    };
</script>

<!-- script proses -->

<script>
    $('#proses').on('click', function() {
        var nama_pelanggan = $('#nama_pelanggan');
        var no_order = $('#no_order').text();


        if (nama_pelanggan.val() !== "") {
            konfirm();
        } else {
            warning_pelanggan_kosong();
        }
    });

    async function konfirm() {
        const {
            value: text
        } = await Swal.fire({
            input: 'textarea',
            inputPlaceholder: 'Type your message here...',
            inputAttributes: {
                'aria-label': 'Type your message here'
            },
            showCancelButton: true
        })
        if (text) {
            Swal.fire({
                title: 'Proses ??',
                text: 'Pesan anda : ' + text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Proses !'
            }).then((result) => {
                proses(text)
            })
        }

    }

    function proses(pesan) {
        var nama_pelanggan = $('#nama_pelanggan').val();
        var id_pelanggan = $('#id_pelanggan').val()
        var alamat = $('#alamat').val()
        var nomor_telepon = $('#nomor_telepon').val()
        var no_order = $('#no_order').text();
        $.ajax({
            url: '<?= base_url("Manajemen_Penjualan/ReviewPurchaseOrder/proses_ke_admin/"); ?>',
            type: "POST",
            data: {
                id_pelanggan: id_pelanggan,
                nama_pelanggan: nama_pelanggan,
                alamat: alamat,
                nomor_telepon: nomor_telepon,

                no_order: no_order,
                pesan: pesan
            },
            async: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                Swal.fire({
                    title: "Good job",
                    text: "You clicked the button!",
                    icon: "success"
                }).then(function() {
                    location.reload();
                });

            },
            complete: function() {
                $.LoadingOverlay("hide");
            }
        });
    }
</script>