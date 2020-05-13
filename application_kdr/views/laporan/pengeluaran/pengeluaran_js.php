<script type="text/javascript" src="<?=base_url('assets/');?>plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="<?=base_url('assets/');?>plugins/moment/moment.js"></script>

<!-- DatePicker Js -->
<script src="<?=base_url('assets/');?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url('assets/');?>plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script>
    $(document).ready(function() {
        $('#tanggal').datepicker({
            autoclose: true,
            todayHighlight: true,
            orientation: "auto",
        });
        var periode = $('#periode').val();
        $('#berjalan_periode').val(periode)
        $('#harian_periode').val(periode)
    })
    $(document).ready(function() {
        $('#tanggal_data').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            format: 'MM/DD/YYYY',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
        });
    })

    $('#proses').on('click', function() {
        var date = $('#tanggal').datepicker('getDate'),
            day = date.getDate(),
            month = date.getMonth() + 1,
            year = date.getFullYear();
        var periode = $('#periode').val();
        call_data(day, month, year, periode);
        $('#display_tanggal').text($('#tanggal').val());
    })

    $('#periode').change(function () {
        var periode = $(this).val();
        $('#berjalan_periode').val(periode)
        $('#harian_periode').val(periode)
        var today = new Date();
        day = today.getDate(),
		month = today.getMonth() + 1,
        year = today.getFullYear();
		call_data(day, month, year, periode);
	});

    function call_data(day, month, year, periode) {
        $.ajax({
            url: '<?=base_url("laporan/pengeluaran/generate_data");?>',
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