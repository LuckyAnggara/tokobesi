<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tanggal').datepicker({
            autoclose: true,
            todayHighlight: true,
            orientation: "auto",
        });
    })

    $('#proses').on('click', function() {
        var date = $('#tanggal').datepicker('getDate'),
            day = date.getDate(),
            month = date.getMonth() + 1,
            year = date.getFullYear();
        call_data(day, month, year);
        $('#display_tanggal').text($('#tanggal').val());
    })

    function call_data(day, month, year) {
        $.ajax({
            url: '<?= base_url("laporan/laba/generate_data"); ?>',
            type: "POST",
            data: {
                hari: day,
                bulan: month,
                tahun: year,
            },
            dataType: "JSON",
            beforeSend: function() {
                $('#div_laba').LoadingOverlay("show");
            },
            complete: function(data) {
                $('#div_laba').LoadingOverlay("hide");
            },
            success: function(data) {

                // pendapatan penjualan
                var total_penjualan = formatRupiah(data.pendapatan.total_penjualan.toString(), 'Rp.')
                var diskon_penjualan = formatRupiah(data.pendapatan.potongan_penjualan.toString(), 'Rp.')
                var retur_penjualan = formatRupiah(data.pendapatan.retur_penjualan.toString(), 'Rp.')
                var total_potongan_penjualan = formatRupiah(data.pendapatan.total_potongan_penjualan.toString(), 'Rp.')
                var total_penjualan_bersih = formatRupiah(data.pendapatan.total_penjualan_bersih.toString(), 'Rp.')
                var persediaan_awal = formatRupiah(data.pendapatan.persediaan_awal.toString(), 'Rp.')
                var total_pembelian = formatRupiah(data.pendapatan.total_pembelian.toString(), 'Rp.')
                var potongan_pembelian = formatRupiah(data.pendapatan.potongan_pembelian.toString(), 'Rp.')
                var retur_pembelian = formatRupiah(data.pendapatan.retur_pembelian.toString(), 'Rp.')
                var total_potongan_pembelian = formatRupiah(data.pendapatan.total_potongan_pembelian.toString(), 'Rp.')
                var pembelian_kotor = formatRupiah(data.pendapatan.pembelian_kotor.toString(), 'Rp.')
                var persediaan_tersedia = formatRupiah(data.pendapatan.persediaan_tersedia.toString(), 'Rp.')
                var persediaan_akhir = formatRupiah(data.pendapatan.persediaan_akhir.toString(), 'Rp.')
                var harga_pokok_penjualan = formatRupiah(data.pendapatan.harga_pokok_penjualan.toString(), 'Rp.')
                var laba_penjualan = formatRupiah(data.pendapatan.laba_penjualan.toString(), 'Rp.')

                //pendapatan lain - lain
                var pendapatan_lain = formatRupiah(data.pendapatan.pendapatan_lain.toString(), 'Rp.')
                var total_pendapatan_lain = formatRupiah(data.pendapatan.total_pendapatan_lain.toString(), 'Rp.')

                //total pendapatan bersih
                var total_pendapatan_bersih = formatRupiah(data.total_pendapatan_bersih.toString(), 'Rp.')

                //total beban operasional 
                var total_beban_operasional = formatRupiah(data.total_beban_operasional.toString(), 'Rp.')
                //beban gaji
                var gaji_pokok = formatRupiah(data.beban_gaji.gaji_pokok.toString(), 'Rp.')
                var uang_makan = formatRupiah(data.beban_gaji.uang_makan.toString(), 'Rp.')
                var bonus = formatRupiah(data.beban_gaji.bonus.toString(), 'Rp.')
                var total_beban_gaji = formatRupiah(data.total_beban_gaji.toString(), 'Rp.')
                //beban usaha
                var total = parseInt(data.total_beban_operasional) + parseInt(data.total_beban_gaji)
                var total_beban_usaha = formatRupiah(total.toString(), 'Rp.')
                //Laba Berjalan
                var laba_berjalan = formatRupiah(data.laba_berjalan.toString(), 'Rp.')


                //     var gaji_pokok = formatRupiah(data.beban_gaji.gaji_pokok.toString(),'Rp.')
                //     var uang_makan = formatRupiah(data.beban_gaji.uang_makan.toString(),'Rp.')
                //     var bonus = formatRupiah(data.beban_gaji.bonus.toString(),'Rp.')
                //     var total_beban = formatRupiah(data.total_beban.toString(),'Rp.')
                //     var laba_rugi = formatRupiah(data.laba_rugi.toString(),'Rp.')

                // pendapatan penjualan
                $('#total_penjualan').text(total_penjualan);
                $('#diskon_penjualan').text(diskon_penjualan);
                $('#retur_penjualan').text(retur_penjualan);
                $('#total_potongan_penjualan').text(total_potongan_penjualan);
                $('#total_penjualan_bersih').text(total_penjualan_bersih);
                $('#persediaan_awal').text(persediaan_awal);
                $('#total_pembelian').text(total_pembelian);
                $('#potongan_pembelian').text(potongan_pembelian);
                $('#retur_pembelian').text(retur_pembelian);
                $('#total_potongan_pembelian').text(total_potongan_pembelian);
                $('#pembelian_kotor').text(pembelian_kotor);
                $('#persediaan_tersedia').text(persediaan_tersedia);
                $('#persediaan_akhir').text(persediaan_akhir);
                $('#harga_pokok_penjualan').text(harga_pokok_penjualan);
                $('#laba_penjualan').text(laba_penjualan);

                // pendapatan lain - lain
                $('#pendapatan_lain').text(pendapatan_lain);
                $('#total_pendapatan_lain').text(total_pendapatan_lain);

                // pendapatan bersih
                $('#total_pendapatan_bersih').text(total_pendapatan_bersih);


                // beban operasional usaha
                $('#beban_operasional').empty();
                $.each(data.kategori_biaya, function(index, item) {
                    var total = formatRupiah(item.total.toString(), 'Rp.');
                    var display = '<li class="row">' +
                        '<div class="col-4">' +
                        '<b>- ' + item.nama_biaya + '</b>' +
                        '</div>' +
                        '<div class="col-4 text-right">' +
                        total +
                        '</div>' +
                        '</li>';
                    $('#beban_operasional').append(display);
                });
                $('#total_beban_operasional').text(total_beban_operasional);

                // beban gaji
                $('#gaji_pokok').text(gaji_pokok);
                $('#uang_makan').text(uang_makan);
                $('#bonus').text(bonus);
                $('#total_beban_gaji').text(total_beban_gaji);

                //total beban usaha
                $('#total_beban_usaha').text(total_beban_usaha);

                if (data.laba_berjalan < 0) {
                    $('#laba_berjalan').empty();
                    $('#laba_berjalan').append('<span class="text-danger">(' + laba_berjalan + ')</span>')
                } else {
                    $('#laba_berjalan').text(laba_berjalan);
                }


            }
        });
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