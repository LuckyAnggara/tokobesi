

<!-- Master Notif -->
<script>
$(document).ready(function () {
	
		setInterval(function () {

			<?php $data_notif = explode(",",$setting_perusahaan['notifikasi']); ?>
			<?php if ($data_notif !== "") : ?>
				var audio = document.getElementById("audio");
        audio.play();	
			<?php endif;?>
			
				<?php if (in_array("1", $data_notif)) : ?>
					get_data_notif_utang();
				<?php endif;?>

				<?php if (in_array("2", $data_notif)) : ?>
					get_data_notif_piutang();
				<?php endif;?>

		}, <?= $setting_perusahaan['frekuensi_notifikasi'] *10000;?>);
	});
</script>

<!-- Piutang -->
<script>
	function get_data_notif_piutang() {
		$.ajax({
			url: "<?= Base_url('notif/notifpiutang/get_data'); ?>",
			async: false,
			dataType: "JSON",
			success: function (data) {
				if(data.length > 0){
					call_notif_piutang(data);
				}
			}
		});
	}


	function call_notif_piutang(data) {
		
		// toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!')
		if (data.length > 1) {

			var display = "";
			$.each(data, function (index, item) {
				var nomor = parseInt(index) + 1;
				var init = "</br> " + nomor + ". " + item.no_faktur;
				display = display + init;
				display = display + '<br><br>';
			});
			Command: toastr["error"](
				"Piutang: </br> " + display + "akan jatuh tempo!",
				"Alert Jatuh Tempo Piutang")


		} else {

			Command: toastr["error"](
				"Piutang a.n <b>" + data[0].nama_pelanggan + "</b><br> Nomor Faktur : <b>" + data[0].no_faktur +
				"</b><br>akan jatuh tempo! pada <br><b> " + data[0].tanggal_jatuh_tempo +
				"</b><br>click untuk melihat detail data",
				"Alert Jatuh Tempo Piutang")

			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": true,
				"positionClass": "toast-top-right",
				"preventDuplicates": false,
				"showDuration": "20000",
				"hideDuration": "20000",
				"timeOut": "20000",
				"extendedTimeOut": "10000",
				"showEasing": "linear",
				"hideEasing": "swing",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}

			toastr.options.onclick = function () {
				window.location.href = "<?= base_url('manajemen_penjualan/detailtransaksipenjualan/nomor_faktur/'); ?>" +
					data[0].no_faktur;
			};
		}

		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"showDuration": "10000",
			"hideDuration": "10000",
			"timeOut": "10000",
			"extendedTimeOut": "10000",
			"showEasing": "linear",
			"hideEasing": "swing",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
	}

</script>


<!-- utang -->
<script>
	function get_data_notif_utang() {
		$.ajax({
			url: "<?= Base_url('notif/notifutang/get_data'); ?>",
			async: false,
			dataType: "JSON",
			success: function (data) {
				if(data.length > 0){
					setTimeout(function() {call_notif_utang(data); }, 5000);
				}
			}
		});

	}


	function call_notif_utang(data) {

		// toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!')
		if (data.length > 1) {

			var display = "";
			$.each(data, function (index, item) {
				var nomor = parseInt(index) + 1;
				var init = "</br> " + nomor + ". " + item.nomor_transaksi;
				display = display + init;
				display = display + '<br><br>';
			});
			Command: toastr["warning"](
				"Utang: </br> " + display + "akan jatuh tempo!",
				"Alert Jatuh Tempo Piutang")


		} else {

			Command: toastr["warning"](
				"Utang ke <b>" + data[0].nama_supplier + "</b><br> Nomor Faktur : <b>" + data[0].nomor_transaksi +
				"</b><br>akan jatuh tempo! pada <br><b> " + data[0].tanggal_jatuh_tempo +
				"</b><br>click untuk melihat detail data",
				"Alert Jatuh Tempo Piutang")

			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": true,
				"positionClass": "toast-top-right",
				"preventDuplicates": false,
				"showDuration": "20000",
				"hideDuration": "20000",
				"timeOut": "20000",
				"extendedTimeOut": "10000",
				"showEasing": "linear",
				"hideEasing": "swing",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}

			toastr.options.onclick = function () {
				window.location.href = "<?= base_url('manajemen_pembelian/detailtransaksipembelian/nomor_transaksi/'); ?>" +
					data[0].nomor_transaksi;
				};
		}

		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"showDuration": "10000",
			"hideDuration": "10000",
			"timeOut": "10000",
			"extendedTimeOut": "10000",
			"showEasing": "linear",
			"hideEasing": "swing",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}



	}

</script>
