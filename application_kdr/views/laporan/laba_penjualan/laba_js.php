<!-- DatePicker Js -->
<script src="<?=base_url('assets/');?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tanggal').datepicker({
            autoclose: true,
            todayHighlight: true,
            orientation: "auto",
        });
        $('#kode_periode').val($('#periode').val())
    })

    $('#proses').on('click', function() {
        var periode = $('#periode').val();
        var date = $('#tanggal').datepicker('getDate'),
            day = date.getDate(),
            month = date.getMonth() + 1,
            year = date.getFullYear();
        call_data(day, month, year, periode);
        $('#display_tanggal').text($('#tanggal').val());
    })


	$('#periode').change(function () {
        var periode = $(this).val();
        $('#kode_periode').val(periode)
        var today = new Date();
        day = today.getDate(),
		month = today.getMonth() + 1,
        year = today.getFullYear();
		call_data(day, month, year, periode);
	});


    function call_data(day, month, year, periode) {
        $.ajax({
            url: '<?=base_url("laporan/labapenjualan/generate_data");?>',
            type: "POST",
            data: {
                hari: day,
                bulan: month,
                tahun: year,
                periode : periode
            },
            dataType: "JSON",
            beforeSend: function() {
                $('#div_laba').LoadingOverlay("show");
            },
            complete: function(data) {
                $('#div_laba').LoadingOverlay("hide");
            },
            success: function(data) {
                var total_penjualan = formatRupiah(data.total_penjualan.toString(), 'Rp.')
                var diskon_penjualan = formatRupiah(data.potongan_penjualan.toString(), 'Rp.')
                var retur_penjualan = formatRupiah(data.retur_penjualan.toString(), 'Rp.')
                var total_potongan_penjualan = formatRupiah(data.total_potongan_penjualan.toString(), 'Rp.')

                var penjualan_bersih = data.total_penjualan - data.total_potongan_penjualan

                var total_penjualan_bersih = formatRupiah(penjualan_bersih.toString(), 'Rp.')
                var persediaan_awal = formatRupiah(data.persediaan_awal.toString(), 'Rp.')
                var total_pembelian = formatRupiah(data.total_pembelian.toString(), 'Rp.')
                var potongan_pembelian = formatRupiah(data.potongan_pembelian.toString(), 'Rp.')
                var retur_pembelian = formatRupiah(data.retur_pembelian.toString(), 'Rp.')
                var total_potongan_pembelian = formatRupiah(data.total_potongan_pembelian.toString(), 'Rp.')
                var pembelian_kotor = formatRupiah(data.pembelian_kotor.toString(), 'Rp.')
                var persediaan_tersedia = formatRupiah(data.persediaan_tersedia.toString(), 'Rp.')
                var persediaan_akhir = formatRupiah(data.persediaan_akhir.toString(), 'Rp.')
                var harga_pokok_penjualan = formatRupiah(data.harga_pokok_penjualan.toString(), 'Rp.')
                var laba_penjualan = formatRupiah(data.laba_penjualan.toString(), 'Rp.')

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
                // laba rugi kotor
                if (data.laba_penjualan < 0) {
                    $('#laba_penjualan').empty();
                    $('#laba_penjualan').append('<span class="text-danger">(' + laba_penjualan + ')</span>')
                } else {
                    $('#laba_penjualan').text(laba_penjualan);
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