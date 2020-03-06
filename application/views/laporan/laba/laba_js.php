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

    $('#proses').on('click', function(){
        var date = $('#tanggal').datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
        call_data(day,month,year);
        $('#display_tanggal').text($('#tanggal').val());
    })

    function call_data(day,month,year)
    {
         $.ajax({
            url: '<?= base_url("laporan/laba/generate_data"); ?>',
            type: "POST",
            data: {
                hari: day,
                bulan: month,
                tahun: year,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var total_penjualan = formatRupiah(data.total_penjualan.toString(),'Rp.')
                var potongan_penjualan = formatRupiah(data.potongan_penjualan.toString(),'Rp.')
                var retur_penjualan = formatRupiah(data.retur_penjualan.toString(),'Rp.')
                var total_potongan_penjualan = formatRupiah(data.total_potongan_penjualan.toString(),'Rp.')
                var penjualan_kotor = formatRupiah(data.penjualan_kotor.toString(),'Rp.')
                var harga_pokok_penjualan = formatRupiah(data.harga_pokok_penjualan.toString(),'Rp.')
                var laba_rugi_kotor = formatRupiah(data.laba_rugi_kotor.toString(),'Rp.')
                var ongkos_kirim = formatRupiah(data.ongkos_kirim.toString(),'Rp.')
                var pendapatan_lain = formatRupiah(data.pendapatan_lain.toString(),'Rp.')

                var gaji_pokok = formatRupiah(data.beban_gaji.gaji_pokok.toString(),'Rp.')
                var uang_makan = formatRupiah(data.beban_gaji.uang_makan.toString(),'Rp.')
                var bonus = formatRupiah(data.beban_gaji.bonus.toString(),'Rp.')
                var total_beban = formatRupiah(data.total_beban.toString(),'Rp.')
                var laba_rugi = formatRupiah(data.laba_rugi.toString(),'Rp.')

                $('#total_penjualan').text(total_penjualan);   
                $('#potongan_penjualan').text(potongan_penjualan);   
                $('#retur_penjualan').text(retur_penjualan);   
                $('#total_potongan_penjualan').text(total_potongan_penjualan);   
                $('#penjualan_kotor').text(penjualan_kotor);   
                $('#harga_pokok_penjualan').text(harga_pokok_penjualan);
              
                // laba rugi kotor
                if(data.laba_rugi_kotor < 0){
                    $('#laba_rugi_kotor').empty();
                    $('#laba_rugi_kotor').append('<span class="text-danger">('+ laba_rugi_kotor +')</span>')
                }else{
                    $('#laba_rugi_kotor').text(laba_rugi_kotor);
                }

                $('#ongkos_kirim').text(ongkos_kirim);
                $('#pendapatan_lain').text(pendapatan_lain);

                // beban operasional usaha
                $('#beban_operasional_usaha').empty();
                $.each(data.beban_operasional_usaha, function(index, item) {

                    var display = '<div class="col-6">'+
                                    '<b>'+item.nama_biaya+'</b></div>'+
                                    '<div class="col-3 text-right">'+item.total+'</div> ';
                    $('#beban_operasional_usaha').append(display);
                });

                //beban gaji
                $('#gaji_pokok').text(gaji_pokok)
                $('#uang_makan').text(uang_makan)
                $('#bonus').text(bonus)
                $('#total_beban').text(total_beban);

                //laba rugi

                 if(data.laba_rugi < 0){
                     $('#laba_rugi').empty();
                    $('#laba_rugi').append('<span class="text-danger">('+ laba_rugi +')</span>')
                }else{
                    $('#laba_rugi').text(laba_rugi);
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