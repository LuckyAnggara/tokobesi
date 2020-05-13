<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
$tanggal_hari_ini = date("d M Y");

?>
<div class="container-fluid">
	<!-- Page-Title -->
	<div class="row">
		<div class="col-sm-10">
			<h5 class="page-title">Laporan Laba / Rugi</h5>
		</div>
		<div class="col-sm-2 m-t-20">
			<div class="form-group row">
				<label class="col-3 col-form-label"><b>Periode</b></label>
				<div class="col-9">
					<select class="form-control" id="periode">
						<?php foreach ($periode as $key => $value): ?>
                            <option value="<?=$value['id'];?>" <?php echo ($value['cek'] == 1) ? 'selected' : ''; ?>><?=$value['periode'];?></option>
                        <?php endforeach;?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12 d-print-none">
			<div class="card-box">
				<div class="row">
					<div class="col-12">
						<div class="form-group row">
							<h4 class="m-t-0 header-title">Laporan Laba / Rugi Berjalan</h4>
						</div>
						<hr>
						<form data-parsley-validate novalidate autocomplete="off" id="persediaan_form"
							enctype="multipart/form-data" class="form-horizontal"
							action="<?=base_url('laporan/laba/download');?>" method="post">
							<div class="form-group row">
                                <label class="col-3 col-sm-form-label m-t-10">Tanggal</label>
                                <input type="text" hidden id="berjalan_periode" name="periode">
								<div class="col-9">
									<div class="input-group">
										<input type="text" autocomplete="off" class="form-control"
											placeholder="mm/dd/yyyy" id="tanggal" name="tanggal">
										<div class="input-group-append">
											<span class="input-group-text btn-inverse"><i
													class="ti-calendar"></i></span>
										</div>
									</div><!-- input-group -->
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<button type="button" name="proses" id="proses"
										class="btn btn-primary waves-effect waves-light">
										<span>Generate</span>
									</button>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<button type="submit" class="btn btn-success waves-effect waves-light">
										<span>Download</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card-box">
				<div class="row">
					<div class="col-12">
						<div class="form-group row">
							<h4 class="m-t-0 header-title">Laporan Laba / Rugi Harian</h4>
						</div>
						<hr>
						<form data-parsley-validate novalidate autocomplete="off" id="laba_rugi_harian"
							enctype="multipart/form-data" class="form-horizontal"
                            action="<?=base_url('laporan/laba/download');?>" method="post">
                            <input type="text" hidden id="harian_periode" name="periode">
							<div class="form-group row">
								<label class="col-3 col-sm-form-label m-t-10">Tanggal</label>
								<div class="col-9">
									<div class="input-group">
										<input type="text" autocomplete="off" class="form-control"
											placeholder="mm/dd/yyyy" id="tanggal_harian" name="tanggal_harian">
										<div class="input-group-append">
											<span class="input-group-text btn-inverse"><i
													class="ti-calendar"></i></span>
										</div>
									</div><!-- input-group -->
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<button type="button" name="proses_harian" id="proses_harian"
										class="btn btn-primary waves-effect waves-light">
										<span>Generate</span>
									</button>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<button type="submit" class="btn btn-success waves-effect waves-light">
										<span>Download</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12">
			<footer class="content-page">
				<div class="card-box">
					<div class="panel-body">
						<div class="col-12" id="div_laba">
							<div class="row">
								<div class="col-12">
									<h4 class="m-t-0 header-title">Laporan Laba / Rugi per Tanggal <span
											id="display_tanggal"><?=$tanggal_hari_ini;?></span></h4>
								</div>
							</div>
							<hr>
							<ul style="list-style-type:none">
								<div>
									<li class="row">
										<div class="col-4 m-b-10">
											<b>Total Penjualan</b>
										</div>
										<div class="col-6 text-right m-b-10">
											<b id="total_penjualan"><?=rupiah($pendapatan['total_penjualan']);?></b>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>Diskon Penjulan</b>
										</div>
										<div class="col-4 text-right" id="potongan_penjualan">
											<?=rupiah($pendapatan['potongan_penjualan']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>Retur Penjualan</b>
										</div>
										<div class="col-4 text-right" id="retur_penjualan">
											<?=rupiah($pendapatan['retur_penjualan']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-6 m-t-10">
											<b>Total Potongan Penjualan</b>
										</div>
										<div class="col-4 text-right m-t-10">
											<b><span class="text-danger" id="total_potongan_penjualan">(
													<?=rupiah($pendapatan['total_potongan_penjualan']);?> )</span></b>
										</div>
									</li>
									<hr>
									<li class="row">
										<div class="col-4">
											<b>Total Penjualan Bersih</b>
										</div>
										<div class="col-6 text-right  m-t-5">
											<b
												id="total_penjualan_bersih"><?=rupiah($pendapatan['total_penjualan_bersih']);?></b>
										</div>
									</li>
								</div>
								<hr>
								<div>
									<li class="row">
										<div class="col-4">
											<b>Persediaan Awal Barang</b>
										</div>
										<div class="col-4 text-right">
											<span
												id="persediaan_awal"><?=rupiah($pendapatan['persediaan_awal']);?></span>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>Pembelian</b>
										</div>
										<div class="col-4 text-right" id="total_pembelian">
											<?=rupiah($pendapatan['total_pembelian']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>Diskon Pembelian</b>
										</div>
										<div class="col-4 text-right" id="potongan_pembelian">
											<?=rupiah($pendapatan['potongan_pembelian']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>Retur Pembelian</b>
										</div>
										<div class="col-4 text-right" id="retur_pembelian">
											<?=rupiah($pendapatan['retur_pembelian']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-4 m-t-10">
											<b>Persediaan Barang Untuk di Jual</b>
										</div>
										<div class="col-6 text-right m-t-10">
											<b><span
													id="persediaan_tersedia"><?=rupiah($pendapatan['persediaan_tersedia']);?></span></b>
										</div>
									</li>
									<li class="row">
										<div class="col-4 m-t-10">
											<b>Total Persediaan Akhir</b>
										</div>
										<div class="col-6 text-right m-t-10">
											<b><span class="text-danger"
													id="persediaan_akhir">(<?=rupiah($pendapatan['persediaan_akhir']);?>)</span></b>
										</div>
									</li>
									<hr class="m-t-10">
									<li class="row">
										<div class="col-4">
											<b>Harga Pokok Penjualan</b>
										</div>
										<div class="col-6 text-right">
											<b><span id="harga_pokok_penjualan"
													class="text-danger">(<?=rupiah($pendapatan['harga_pokok_penjualan']);?>)</span></b>
										</div>
									</li>
								</div>
								<li>
									<hr>
								</li>
								<div>
									<li class="row">
										<div class="col-4">
											<b>Pendaptan dari Penjualan</b>
										</div>
										<div class="col-6 text-right">
											<b id="laba_penjualan">
												<?php if ($pendapatan['laba_penjualan'] < 0) {;?>
												<span class="text-danger">( <?=rupiah($pendapatan['laba_penjualan']);?>
													)</span>
												<?php } else {;?>
												<?=rupiah($pendapatan['laba_penjualan']);?>
												<?php }
;?>
											</b>
										</div>
									</li>
								</div>
								<hr class="m-t-10">
								<div>
									<li class="row">
										<div class="col-4 m-b-10">
											<b>Pendapatan Lain - Lain</b>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>- Ongkos Kirim</b>
										</div>
										<div class="col-4 text-right" id="pendapatan_lain">
											<?=rupiah($pendapatan['pendapatan_lain']);?>
										</div>
									</li>
									<hr>
									<li class="row">
										<div class="col-4">
											<b>Total Pendapatan Lain - Lain</b>
										</div>
										<div class="col-6 text-right  m-t-5">
											<b
												id="total_pendapatan_lain"><?=rupiah($pendapatan['total_pendapatan_lain']);?></b>
										</div>
									</li>
								</div>
								<hr class="m-t-10">
								<div>
									<h4>
										<li class="row">
											<div class="col-6">
												<b>Total Pendapatan Bersih</b>
											</div>
											<div class="col-6 text-right">
												<b id="total_pendapatan_bersih">
													<?php if ($total_pendapatan_bersih < 0) {;?>
													<span class="text-danger">( <?=rupiah($total_pendapatan_bersih);?>
														)</span>
													<?php } else {;?>
													<?=rupiah($total_pendapatan_bersih);?>
													<?php }
;?>
												</b>
											</div>
										</li>
									</h4>
								</div>
								<hr class="m-t-10">
								<div>
									<li class="row">
										<div class="col-4 m-b-10">
											<b>Beban Operasional</b>
										</div>
									</li>
									<div id="beban_operasional">
										<?php foreach ($kategori_biaya as $key => $value): ?>
										<li class="row">
											<div class="col-4">
												<b>- <?=$value['nama_biaya'];?></b>
											</div>
											<div class="col-4 text-right">
												<?=rupiah($value['total']);?>
											</div>
										</li>
										<?php endforeach;?>
									</div>
									<li class="row">
										<div class="col-4 m-t-10">
											<b>Total Beban Operasional</b>
										</div>
										<div class="col-6 text-right m-t-10">
											<b><span class="text-danger" id="total_beban_operasional">(
													<?=rupiah($total_beban_operasional);?> )</span></b>
										</div>
									</li>
								</div>
								<hr class="m-t-10">
								<div>
									<li class="row">
										<div class="col-4 m-b-10">
											<b>Beban Gaji</b>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>- Gaji Pokok</b>
										</div>
										<div class="col-4 text-right" id="gaji_pokok">
											<?=rupiah($beban_gaji['gaji_pokok']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>- Uang Makan</b>
										</div>
										<div class="col-4 text-right" id="uang_makan">
											<?=rupiah($beban_gaji['uang_makan']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-4">
											<b>- Bonus</b>
										</div>
										<div class="col-4 text-right" id="bonus">
											<?=rupiah($beban_gaji['bonus']);?>
										</div>
									</li>
									<li class="row">
										<div class="col-4 m-t-10">
											<b>Total Beban Gaji</b>
										</div>
										<div class="col-6 text-right m-t-10">
											<b><span class="text-danger" id="total_beban_gaji">(
													<?=rupiah($total_beban_gaji);?> )</span></b>
										</div>
									</li>
								</div>
								<hr>
								<div>
									<h4>
										<li class="row">
											<div class="col-6 m-t-10">
												<b>Total Beban Usaha</b>
											</div>
											<div class="col-6 text-right m-t-10">
												<b><span class="text-danger" id="total_beban_usaha">(
														<?=rupiah($total_beban_operasional + $total_beban_gaji);?>
														)</span></b>
											</div>
										</li>
										<hr class="m-t-10">
										<li class="row">
											<div class="col-6">
												<b>Laba / Rugi Usaha</b>
											</div>
											<div class="col-6 text-right">
												<b id="laba_berjalan">
													<?php if ($laba_berjalan < 0) {;?>
													<span class="text-danger">( <?=rupiah($laba_berjalan);?> )</span>
													<?php } else {;?>
													<?=rupiah($laba_berjalan);?>
													<?php }
;?>
												</b>
											</div>
										</li>
									</h4>
								</div>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
</div> <!-- end container -->
