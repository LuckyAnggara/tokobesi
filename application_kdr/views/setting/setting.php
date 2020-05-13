<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h4 class="page-title">Settings</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<form autocomplete="off" id="submitForm" method="post" enctype="multipart/form-data"
					class="form-horizontal">
					<div class="col-xl-12">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
									Perusahaan
								</a>
							</li>
							<li class="nav-item">
								<a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
									Faktur
								</a>
							</li>
							<li class="nav-item">
								<a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
									Transaksi
								</a>
							</li>
							<!-- <li class="nav-item">
                                <a href="#settings1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    Notifikasi
                                </a>
                            </li> -->
							<li class="nav-item">
								<a href="#databasesetting" data-toggle="tab" aria-expanded="false" class="nav-link">
									Database
								</a>
							</li>
						</ul>

						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade show active" id="home1">
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td width="35%">Nama Perusahaan</td>
											<td width="65%"><a href="javascript:void(0);" class="edit_input"
													id="nama_perusahaan"></a></td>
										</tr>
										<tr>
											<td>Alamat Perusahaan</td>
											<td><a href="javascript:void(0);" id="alamat_perusahaan"
													class="edit_textarea"></a></td>
										</tr>
										<tr>
											<td width="35%">Nomor Telepon</td>
											<td width="65%"><a href="javascript:void(0);" class="edit_input"
													id="nomor_telepon"></a></td>
										</tr>
										<tr>
											<td width="35%">Nomor Fax</td>
											<td width="65%"><a href="javascript:void(0);" class="edit_input"
													id="nomor_fax"></a></td>
										</tr>
										<tr>
											<td width="35%">Alamat Email</td>
											<td width="65%"><a href="javascript:void(0);" class="edit_input"
													id="alamat_email"></a></td>
										</tr>
										<tr>
											<td width="35%">Logo Perusahaan</td>
											<td>
												<div id="div_gambar">
													<img id="gambar_logo" src="" width="25%" height="25%"
														class="img-thumbnail" alt="Logo Perusahaan">
													<div class="float-right">
														<button type="button" id="edit_gambar_button"
															name="edit_gambar_button"
															class="btn btn-primary waves-effect waves-light"><i
																class="fa fa-image"></i> Ganti Gambar</button>
													</div>
												</div>
											</td>
										</tr>

									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="profile1">
								<div class="row">
									<div class="col-xl-8">
										<table class="table table-bordered table-striped">
											<tbody>
												<tr>
													<td width="35%">Prefix Awal</td>
													<td width="65%"><a href="javascript:void(0);" class="edit_input"
															id="prefix_faktur"></a></td>
												</tr>
												<tr>
													<td>Nomor</td>
													<td><a href="javascript:void(0);" id="nomor_faktur"></a></td>
												</tr>
												<tr>
													<td>Catatan Faktur Cash</td>
													<td><a href="javascript:void(0);" id="catatan_faktur_cash"
															class="edit_textarea"></a></td>
												</tr>
												<tr>
													<td>Catatan Faktur Kredit</td>
													<td><a href="javascript:void(0);" id="catatan_faktur_kredit"
															class="edit_textarea"></a></td>
												</tr>
												<tr>
													<td>Catatan Faktur Retur Penjualan</td>
													<td><a href="javascript:void(0);" id="catatan_retur_jual"
															class="edit_textarea"></a></td>
												</tr>
												<tr>
													<td>Catatan Faktur Retur Pembelian</td>
													<td><a href="javascript:void(0);" id="catatan_retur_beli"
															class="edit_textarea"></a></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-xl-3 col-md-6">
										<h4 class="header-title mt-0 m-b-30">Preview Faktur</h4>
										<div class="widget-chart-1">
											<div class="widget-detail-1">
												<h2 class="p-t-10 mb-0"><span class="text-dark"
														id="prefix_example"></span><span id="prefix_nomor_example"
														class="text-danger"></span></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="messages1">
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td width="35%">Threshold Bonus</td>
											<td width="65%"><a href="javascript:void(0);" id="threshold_bonus"
													step="0.01" min="0" max="10" class="edit_number">0</a></td>
										</tr>
										<tr>
											<td width="35%">Komisi Sales</td>
											<td width="65%"><a href="javascript:void(0);" id="komisi_sales" step="0.01"
													min="0" max="10" class="edit_number">0</a></td>
										</tr>
										<tr>
											<td>Password Harga</td>
											<td><a href="javascript:void(0);" id="password_harga"></a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="settings1">
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td width="35%">Notifikasi</td>
											<td width="65%"><a href="javascript:void(0);" id="notifikasi"></a></td>
										</tr>
										<tr>
											<td>Frequensi (Dalam Menit)</td>
											<td><a href="javascript:void(0);" class="edit_number"
													id="frekuensi_notifikasi"></a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="databasesetting">
								<table class="table table-bordered table-striped">
									<tbody>
									<tr>
										<td>Periode Database</td>
										<td><a href="javascript:void(0);" id="periode"></a></td>
									</tr>
										<!-- <tr>
											<td width="35%">Database</td>
											<td width="65%"><a href="javascript:void(0);" id="notifikasi"></a></td>
										</tr>
										<tr>
											<td>Frequensi (Dalam Menit)</td>
											<td><a href="javascript:void(0);" class="edit_number"
													id="frekuensi_notifikasi"></a></td>
										</tr> -->
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- end col -->

					<div class="modal-footer">
						<button type="submit" name="button-add" class="btn btn-success waves-effect waves-light">Apply
							Changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
