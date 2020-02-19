<!-- Pusher Notif Sendiri -->
<script src="<?= base_url('assets/'); ?>js/pusher.notif.js"></script>


<script>
    $('#btn_cari').on('click', function() {
        var nomor_faktur = $('#nomor_faktur').val();
        $.ajax({
            url: "<?= Base_url('manajemen_penjualan/returpenjualan/getData'); ?>",
            type: "post",
            data: {
                nomor_faktur: nomor_faktur
            },
            dataType: 'json',
            cache: false,
            async: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#id_pelanggan').val(data.id_pelanggan);
                $('#nama_pelanggan').val(data.nama_pelanggan);
                $('#nomor_telepon').val(data.nomor_telepon);
                $('#alamat').val(data.alamat);
                $('#tanggal_transaksi').val(data.tanggal_transaksi);
                if (data.status_bayar == 1) {
                    var display = "Lunas";
                } else {
                    var display = "Belum Lunas"
                }
                $('#status_pembayaran').val(display);
                $('#grand_total').val(formatRupiah(data.grand_total, 'Rp.'));
                $('#data_div').attr('hidden', false);

                panggil_detail(nomor_faktur)
            },
            complete: function() {
                $.LoadingOverlay("hide");
            }
        })
    });

    function panggil_detail(nomor_faktur) {
        $.ajax({
            url: "<?= Base_url('manajemen_penjualan/returpenjualan/getDetailData'); ?>",
            type: "post",
            data: {
                nomor_faktur: nomor_faktur
            },
            dataType: 'json',
            cache: false,
            async: false,
            success: function(data) {
                if (data.length > 0) {
                    let nomor = 0;
                    for (var i in data) {
                        console.log(data[i].kode_barang)
                        var kode_barang = data[i].kode_barang

                        var display_nomor = '<input type="text" class="form-control" placeholder="Email" value="' + nomor + '" readonly><br>';
                        var display_nama_barang = '<input type="text" class="form-control" value="' + data[i].kode_barang + '" readonly><br>';
                        var display_qty = '<input type="text" class="form-control" value="' + data[i].jumlah_penjualan + '" readonly><br>';
                        var display_harga = '<input type="text" class="form-control" value="' + formatRupiah(data[i].harga_jual, 'Rp.') + '" readonly><br>';
                        var display_qty_retur = '<input type="text" class="form-control"><br>';
                        var display_keterangan = '<input type="text" class="form-control"><br>'
                        $('#nomor').append(display_nomor)
                        $('#nama_barang').append(display_nama_barang)
                        $('#qty').append(display_qty)
                        $('#harga').append(display_harga)
                        $('#qty_retur').append(display_qty_retur)
                        $('#keterangan').append(display_keterangan)
                        nomor++;
                    }
                }
            }
        })
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